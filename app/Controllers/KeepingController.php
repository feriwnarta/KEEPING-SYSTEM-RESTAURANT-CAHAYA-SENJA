<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;
use NextG\Autoreply\Services\SpreadsheetService;
use NextG\Autoreply\Services\WhatsappBlastService;
use PDOException;
use Webpatser\Uuid\Uuid;

class KeepingController
{

    private $database;
    private $spreadSheetService;
    private $whatsappService;

    public function __construct()
    {
        $this->database = new Database;
        $this->spreadSheetService =  new SpreadsheetService();
        $this->whatsappService = new WhatsappBlastService();
    }


    public function index()
    {
        View::render('main', 'keeping/input-keeping');
    }

    public function getMenu()
    {

        $start = 0;
        if (isset($_POST['start'])) {
            $start = intval($_POST['start']);
        }

        $query = 'SELECT id_menu, name, thumbnail FROM tb_menu ORDER BY create_at ASC LIMIT :start , 10 ';
        $this->database->query($query);
        $this->database->bindData(':start', $start);

        echo json_encode($this->database->fetchAll(), JSON_PRETTY_PRINT);
    }

    public function saveKeeping()
    {

        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        $dataMessageKeeping = [];



        try {

            foreach ($obj as $row) {
                $this->database->conn->beginTransaction();


                $idProduct = $row['id'];
                $custPhoneNumber = $row['custPhoneNumber'];
                $tanggal = date("Y-m-d", strtotime($row['tanggal']));
                $jumlah = $row['count'];
                $custName = $row['custName'];
                $total = null;




                // query check nomor telpon

                $query = 'SELECT cust_name, product_count FROM tb_user_keeping WHERE phone_number = :phone';
                $this->database->query($query);
                $this->database->bindData(':phone', $custPhoneNumber);
                $checkPhoneUser = $this->database->fetch();
                if ($checkPhoneUser != false) {
                    if ($checkPhoneUser['cust_name'] != $row['custName']) {
                        http_response_code(400);
                        echo json_encode([
                            'status' => 'failed',
                            'message' => 'nama tidak boleh berbeda dengan nama yang sebelumnya',
                            'status_code' => 400
                        ], JSON_PRETTY_PRINT);
                        die();
                    }
                }


                /**
                 * query check sudah ada data terlebih dahulu
                 */
                $query = 'SELECT id_keeping, id_product, product_count FROM tb_user_keeping WHERE phone_number = :phone_number AND id_product = :id_product';

                $this->database->query($query);
                $this->database->bindData(':phone_number', $custPhoneNumber);
                $this->database->bindData(':id_product', $idProduct);
                $dataExist = $this->database->fetch();





                if (!$dataExist) {

                    /**
                     * query insert data jika didalam table tidak ada datanya
                     */
                    $query = 'INSERT INTO tb_user_keeping (id_keeping, phone_number, cust_name, product_count, id_product) VALUES (:id_keeping, :phone_number, :cust_name, :product_count, :id_product)';

                    $uuid = Uuid::generate()->string;


                    $this->database->query($query);
                    $this->database->bindData(':id_keeping', $uuid);
                    $this->database->bindData(':phone_number', $row['custPhoneNumber']);
                    $this->database->bindData(':cust_name', $row['custName']);
                    $this->database->bindData(':product_count', $row['count']);
                    $this->database->bindData(':id_product', $row['id']);
                    $this->database->execute();


                    $idHistoryKeeping = Uuid::generate()->string;
                    $status_keeping = 'IN';

                    $dataMessageKeeping[] = $idHistoryKeeping;

                    $query = 'INSERT INTO tb_history_keeping (id_history_keeping, id_keeping, status_keeping, count_keeping, tanggal) VALUES (:id_history, :id_keeping, :status_keeping, :count_keeping, :tanggal)';

                    $this->database->query($query);
                    $this->database->bindData(':id_history', $idHistoryKeeping);
                    $this->database->bindData(':id_keeping', $uuid);
                    $this->database->bindData(':status_keeping', $status_keeping);
                    $this->database->bindData(':tanggal', $tanggal);
                    $this->database->bindData(':count_keeping', $row['count']);
                    $this->database->execute();
                    $this->database->conn->commit();
                } else {

                    $id_keeping = $dataExist['id_keeping'];
                    $dateTimeNow = date('Y-m-d h:i:s');
                    $total = $row['count'] + $dataExist['product_count'];

                    /**
                     * query update data  didalam table  ada datanya
                     */

                    $query = 'UPDATE tb_user_keeping SET product_count = :product_count, update_at = :update_at WHERE id_keeping = :id_keeping';

                    $this->database->query($query);
                    $this->database->bindData(':product_count', $total);
                    $this->database->bindData(':update_at', $dateTimeNow);
                    $this->database->bindData(':id_keeping', $id_keeping);

                    $this->database->execute();


                    $query = 'INSERT INTO tb_history_keeping (id_history_keeping, id_keeping, status_keeping, count_keeping, tanggal) VALUES (:id_history, :id_keeping, :status_keeping, :count_keeping, :tanggal)';

                    $idHistoryKeeping = Uuid::generate()->string;

                    $dataMessageKeeping[] = $idHistoryKeeping;

                    $status_keeping = 'IN';
                    $this->database->query($query);
                    $this->database->bindData(':id_history', $idHistoryKeeping);
                    $this->database->bindData(':id_keeping', $id_keeping);
                    $this->database->bindData(':status_keeping', $status_keeping);
                    $this->database->bindData(':tanggal', $tanggal);
                    $this->database->bindData(':count_keeping', $row['count']);
                    $this->database->execute();

                    $this->database->conn->commit();
                }

                // dapatkan nama barang / produk
                $query = 'SELECT name FROM tb_menu WHERE id_menu = :id';
                $this->database->query($query);
                $this->database->bindData(':id', $idProduct);
                $nameProduct = $this->database->fetch();


                // buat spread sheet 
                $result = $this->makeSpreadSheet();
                $dateUpload = date('Y-m');

                // spreadsheet baru dengan berhasil dibuat
                if ($result != false) {



                    $idSpreadSheet = $result;

                    // bikin header table history
                    $this->spreadSheetService->makeNewHeaderColumn(
                        $idSpreadSheet,
                        ['Tanggal', 'No Hp', 'Nama Customer', 'Barang', 'Status', 'Jumlah'],
                        'Sheet1!A1:F'
                    );

                    $this->spreadSheetService->insertNewRow($idSpreadSheet, [
                        [
                            $tanggal, $custPhoneNumber, $custName, $nameProduct['name'], $status_keeping, $jumlah
                        ]
                    ], 'Sheet1');

                    // bikin header table stock
                    $this->spreadSheetService->makeNewHeaderColumn(
                        $idSpreadSheet,
                        ['Nomor Telpon', 'Nama Customer', 'Barang', 'Jumlah'],
                        'Sheet1!I1:L'
                    );

                    $this->spreadSheetService->insertNewRow($idSpreadSheet, [
                        [
                            $custPhoneNumber, $custName, $nameProduct['name'], $jumlah
                        ]
                    ], 'Sheet1!I1:L');



                    $id = Uuid::generate()->string;
                    $query = 'INSERT INTO tb_spreadsheet_version (id_spreadsheet, id_google_spreadsheet, tanggal) VALUES (:id, :id_spreadsheet, :tanggal)';
                    try {
                        $this->database->conn->beginTransaction();
                        $this->database->query($query);
                        $this->database->bindData(':id', $id);
                        $this->database->bindData(':id_spreadsheet', $idSpreadSheet);
                        $this->database->bindData(':tanggal', $dateUpload);
                        $this->database->execute();
                        $this->database->conn->commit();
                    } catch (PDOException $e) {
                        if ($this->database->conn->inTransaction()) {
                            $this->database->conn->rollBack();
                        }
                    }
                } else {

                    $query = 'SELECT id_google_spreadsheet FROM tb_spreadsheet_version WHERE tanggal = :tanggal';
                    $this->database->query($query);
                    $this->database->bindData(':tanggal', $dateUpload);
                    $result = $this->database->fetch();
                    $idSpreadSheet = $result['id_google_spreadsheet'];


                    // insert data ke table exel jika belum ada data
                    if (!$dataExist) {

                        /**
                         * insert data ke google sheet jika didalam table tidak ada datanya
                         */

                        $this->spreadSheetService->insertNewRow($idSpreadSheet, [
                            [
                                $tanggal, $custPhoneNumber, $custName, $nameProduct['name'], $status_keeping, $jumlah
                            ]
                        ], 'Sheet1!A1:F');

                        $this->spreadSheetService->insertNewRow($idSpreadSheet, [
                            [
                                $custPhoneNumber, $custName, $nameProduct['name'], $jumlah
                            ]
                        ], 'Sheet1!I1:L');
                    } else {
                        $this->spreadSheetService->insertNewRow($idSpreadSheet, [
                            [
                                $tanggal, $custPhoneNumber, $custName, $nameProduct['name'], $status_keeping, $jumlah
                            ]
                        ], 'Sheet1!A1:F');



                        $this->spreadSheetService->update(
                            $idSpreadSheet,
                            [
                                $custPhoneNumber, $custName, $nameProduct['name'], $total
                            ],
                            $custPhoneNumber,
                            $nameProduct['name'],
                            'Sheet1!I1:L'
                        );
                    }
                }
            }

            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'data berhasil disimpan',
                'status_code' => 200
            ], JSON_PRETTY_PRINT);


            $message = $this->messageFormat($dataMessageKeeping);

            // send message to whatsapp
            $result = $this->sendSuccessMessageToCust($custPhoneNumber, $message);
        } catch (PDOException $e) {

            if ($this->database->conn->inTransaction()) {
                $this->database->conn->rollBack();
            }

            http_response_code(400);
            echo json_encode([
                'status' => 'failed',
                'message' => 'data gagal disimpan',
                'status_code' => 400
            ], JSON_PRETTY_PRINT);
        }
    }

    function messageFormat($idHistoryKeeping)
    {
        // $idHistoryKeeping = [
        //     '0106cea0-09be-11ee-a4b5-fb4f69c770d8',
        //     '13f94130-09be-11ee-b7e9-bf146722bb72'
        // ];
        // dapatkan message dari database
        $message = $this->getMessageSaveKeeping();

        // ambil option dari message
        $tags = $this->optionExplode($message);

        if (empty($tags)) {
            return $message;
        }


        foreach ($tags as $tag) {

            $query = "SELECT COUNT(id) as count, value_name, option_name FROM tb_config WHERE option_name = '%{$tag}%'  ";
            $this->database->query($query);
            $rs = $this->database->fetch();


            if ($rs['count'] != 0) {

                switch ($rs['value_name']) {
                    case 'dapatkan nama customer':
                        $custName = $this->getCustName($idHistoryKeeping[0]);
                        $message = str_replace("{$rs['option_name']}", $custName, $message);
                        break;
                    case 'dapatkan nomor telpon customer':
                        $custPhone = $this->getCustPhoneNumber($idHistoryKeeping[0]);
                        $message = str_replace("{$rs['option_name']}", $custPhone, $message);

                        break;
                    case 'dapatkan jumlah barang yang disimpan':
                        $countProductKeeping = $this->getCountProductKeeping($idHistoryKeeping);
                        $total = 0;
                        if (!empty($countProductKeeping)) {
                            foreach ($countProductKeeping as $product) {
                                $total += $product['count_keeping'];
                            }
                        }
                        $message = str_replace("{$rs['option_name']}", $total, $message);
                        break;
                    case 'dapatkan nama barang yang disimpan':
                        $nameProductKeeping = $this->getNameProductKeeping($idHistoryKeeping);

                        $name = '';
                        if (!empty($nameProductKeeping)) {
                            foreach ($nameProductKeeping as $product) {
                                $name .= $product['name'] . ', ';
                            }
                        }
                        $message = str_replace("{$rs['option_name']}", $name, $message);

                        break;

                    case 'dapatkan status barang':
                        $allStatus = $this->getStatusProduct($idHistoryKeeping);
                        $format = '';
                        if (!empty($allStatus)) {

                            foreach ($allStatus as $status) {
                                // $message = str_replace("{$rs['option_name']}", "{$status['name']} => {$status['in']}", $message);
                                $format .= "{$status['name']} => {$status['status_keeping']}, ";
                            }
                        }
                        $message = str_replace("{$rs['option_name']}", $format, $message);
                        break;


                    case 'dapatkan tanggal penyimpanan':
                        $tanggalPenyimpanan = $this->getTanggalPenyimpanan($idHistoryKeeping[0]);

                        $tanggal = null;
                        if (!empty($tanggalPenyimpanan)) {
                            $tanggal .= $tanggalPenyimpanan['create_at'];
                        }

                        $message = str_replace("{$rs['option_name']}", $tanggal, $message);

                        break;

                    case 'dapatkan detail barang':

                        /**
                         * UBAH INI SECARA HARDCODE
                         */
                        $details = $this->getDetailPenyimpanan($idHistoryKeeping);
                        $tanggal = null;
                        $format = '';
                        if (!empty($details)) {

                            foreach ($details as $detail) {
                                $format .= "
Nama Barang = {$detail['name']}
Jumlah = {$detail['count_keeping']}
                                ";
                                $tanggal = "{$detail['create_at']}";
                            }
                            $format .= "
{$tanggal}";
                        }

                        $message = str_replace("{$rs['option_name']}", $format, $message);
                }
            }
        }

        $pattern = '/%[^%]+%/';
        $hasil = preg_replace($pattern, '', $message);



        return $hasil;
    }

    function getDetailPenyimpanan($idHistoryKeeping)
    {
        $data = [];
        foreach ($idHistoryKeeping as $id) {
            $query = "SELECT m.name, h.status_keeping, h.count_keeping, h.tanggal, h.create_at, u.phone_number, u.cust_name FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON u.id_keeping = h.id_keeping INNER JOIN tb_menu AS m ON m.id_menu = u.id_product WHERE h.id_history_keeping = '{$id}'";
            $this->database->query($query);
            $data[] = $this->database->fetch();
        }

        return $data;
    }

    function getTanggalPenyimpanan($idHistoryKeeping)
    {


        $query = "SELECT m.name, h.status_keeping, h.count_keeping, h.tanggal, h.create_at, u.phone_number, u.cust_name FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON u.id_keeping = h.id_keeping INNER JOIN tb_menu AS m ON m.id_menu = u.id_product WHERE h.id_history_keeping = '{$idHistoryKeeping}'";
        $this->database->query($query);
        return $this->database->fetch();
    }

    function getStatusProduct($idHistoryKeeping)
    {
        $data = [];
        foreach ($idHistoryKeeping as $id) {
            $query = "SELECT m.name, h.status_keeping, h.count_keeping, h.tanggal, u.phone_number, u.cust_name FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON u.id_keeping = h.id_keeping INNER JOIN tb_menu AS m ON m.id_menu = u.id_product WHERE h.id_history_keeping = '{$id}'";
            $this->database->query($query);
            $data[] = $this->database->fetch();
        }

        return $data;
    }

    function getNameProductKeeping($idHistoryKeeping)
    {
        $data = [];
        foreach ($idHistoryKeeping as $id) {
            $query = "SELECT m.name, h.status_keeping, h.count_keeping, h.tanggal, u.phone_number, u.cust_name FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON u.id_keeping = h.id_keeping INNER JOIN tb_menu AS m ON m.id_menu = u.id_product WHERE h.id_history_keeping = '{$id}'";
            $this->database->query($query);
            $data[] = $this->database->fetch();
        }

        return $data;
    }

    function getCountProductKeeping($idHistoryKeeping)
    {
        $data = [];
        foreach ($idHistoryKeeping as $id) {
            $query = "SELECT m.name, h.status_keeping, h.count_keeping, h.tanggal, u.phone_number, u.cust_name FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON u.id_keeping = h.id_keeping INNER JOIN tb_menu AS m ON m.id_menu = u.id_product WHERE h.id_history_keeping = '{$id}'";
            $this->database->query($query);
            $data[] = $this->database->fetch();
        }

        return $data;
    }

    function getCustPhoneNumber($idHistoryKeeping)
    {
        $query = "SELECT u.phone_number FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON h.id_keeping = u.id_keeping WHERE h.id_history_keeping = '{$idHistoryKeeping}'";
        $this->database->query($query);
        $name = $this->database->fetch();
        if (!empty($name)) {
            return $name = $name['phone_number'];
        }
        return '';
    }

    function getCustName($idHistoryKeeping)
    {
        $query = "SELECT u.cust_name FROM tb_history_keeping AS h INNER JOIN tb_user_keeping AS u ON h.id_keeping = u.id_keeping WHERE h.id_history_keeping = '{$idHistoryKeeping}'";
        $this->database->query($query);
        $name = $this->database->fetch();
        if (!empty($name)) {
            return $name = $name['cust_name'];
        }
        return '';
    }



    function optionExplode($string)
    {

        $pattern = '/%([^%]+)%/'; // Ekspresi reguler untuk mencocokkan teks diapit oleh tanda persen ganda (%%)

        preg_match_all($pattern, $string, $matches);

        $result = $matches[1];
        return $result;
    }

    function getMessageSaveKeeping()
    {
        $query = 'SELECT value_name FROM tb_config WHERE option_name = "message_success_save_keeping"';

        $this->database->query($query);
        $result = $this->database->fetch();

        return $result['value_name'];
    }



    function sendSuccessMessageToCust($phoneNumber, $message)
    {
        // cek dulu device disconnect atau tidak
        $status = $this->whatsappService->checkDeviceActive();

        if ($status == 'connected') {
            return $this->whatsappService->sendText($phoneNumber, $message);
        }

        return false;
    }




    function makeSpreadSheet()
    {


        /**
         * save to spreadsheet 
         * check terlebih dahulu untuk membuat spreadsheet baru
         */

        $tanggal = date('Y-m');
        $query = 'SELECT COUNT(id_keeping) AS count FROM tb_history_keeping WHERE tanggal LIKE :tanggal';
        $this->database->query($query);
        $this->database->bindData(':tanggal', "%{$tanggal}%");
        $rs = $this->database->fetch();
        $count = $rs['count'];

        /**
         * buat spreadsheet baru
         */
        if ($count <= 1) {
            $name = "LAPORANSTOCK{$tanggal}";
            $rs = $this->spreadSheetService->createNewSpreadSheet($name, 'feriwnarta26@gmail.com');
            return $rs;
        }

        return false;
    }



    function checkPhoneNumber()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        $phoneNumber = $obj['phoneNumber'];

        $query = 'SELECT cust_name FROM tb_user_keeping WHERE phone_number LIKE :phone';
        $this->database->query($query);
        $this->database->bindData(':phone', "%$phoneNumber%");
        $rs = $this->database->fetch();


        echo json_encode($rs, JSON_PRETTY_PRINT);
    }

    function generateKode()
    {
        $year = date('Y');
        $month = date('m');

        $query = 'SELECT COUNT(id_keeping) as count FROM tb_user_keeping WHERE create_at LIKE :formatDate';

        $this->database->query($query);

        $this->database->bindData(':formatDate', "{$year}-{$month}%");

        $count = $this->database->fetch()['count'] + 1;



        $format = "KEEP{$year}{$month}{$count}";

        return $format;
    }

    function showKeeping()
    {
        // $query = 'SELECT k.id_keeping AS id_keeping,  k.phone_number as nomor_telpon, k.cust_name as cust_name, k.id_product as id_produk, m.name as nama_produk, k.product_count as product_count
        // FROM tb_user_keeping AS k
        // INNER JOIN tb_menu AS m ON k.id_product = m.id_menu
        // GROUP BY k.id_product, k.phone_number;';

        $query = 'SELECT k.id_keeping AS id_keeping, k.phone_number as nomor_telpon, k.cust_name as cust_name, k.id_product as id_produk, m.name as nama_produk, k.product_count as product_count
        FROM tb_user_keeping AS k
        INNER JOIN tb_menu AS m ON k.id_product = m.id_menu
        WHERE k.product_count <> 0
        GROUP BY k.id_product, k.phone_number
        ';


        $this->database->query($query);
        $rs = $this->database->fetchAll();

        View::render('main', 'keeping/show-keeping', $rs);
    }

    public function updateKeeping($param)
    {

        $query = 'SELECT k.id_keeping as id, k.tanggal_input as tanggal, k.phone_number AS phone_number, k.cust_name AS cust_name, k.product_count AS product_count, m.name, m.thumbnail, m.id_menu FROM tb_user_keeping as k INNER JOIN tb_menu as m ON k.id_product = m.id_menu WHERE id_keeping = :id';

        $this->database->query($query);
        $this->database->bindData(':id', $param);
        $dataUpdate = $this->database->fetch();

        $query = 'SELECT name, id_menu FROM tb_menu';
        $this->database->query($query);
        $dataMenu = $this->database->fetchAll();

        $result = [
            'data_update' => $dataUpdate,
            'data_menu' => $dataMenu
        ];


        View::render('main', 'keeping/update-keeping', $result);
    }

    public function processUpdate()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        $nameCust = $obj['nameCust'];
        $id = $obj['id'];
        $phoneNumber = $obj['phoneNumber'];
        $count = $obj['count'];
        $productId = $obj['product'];
        $datetimeNow = date('Y-m-d h:i:s');


        $query = 'UPDATE tb_user_keeping SET cust_name = :cust_name, phone_number = :phone_number, id_product = :id_product, product_count = :product_count, update_at = :update_at WHERE id_keeping = :id_keeping';


        try {
            $this->database->query($query);
            $this->database->conn->beginTransaction();


            /**
             * jalankan binding data
             */
            $this->database->bindData(':cust_name', $nameCust);
            $this->database->bindData(':phone_number', $phoneNumber);
            $this->database->bindData(':id_product', $productId);
            $this->database->bindData(':product_count', $count);
            $this->database->bindData(':update_at', $datetimeNow);
            $this->database->bindData(':id_keeping', $id);


            $rs = $this->database->execute();

            if ($rs) {
                http_response_code(200);
                echo json_encode([
                    'status_code' => 200,
                    'status' => 'success',
                    'message' => 'berhasil update data',
                ], JSON_PRETTY_PRINT);
            }

            $this->database->conn->commit();
        } catch (PDOException $e) {
            if ($this->database->conn->inTransaction()) {
                $this->database->conn->rollBack();
            }

            http_response_code(400);
            echo json_encode([
                'status_code' => 400,
                'status' => 'failed',
                'message' => 'data gagal diupdate',
            ], JSON_PRETTY_PRINT);
        }
    }

    public function outKeeping()
    {

        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        $id = $obj['id'];

        $query = 'SELECT k.id_keeping, k.phone_number, k.product_count, k.cust_name, m.name, m.thumbnail, m.id_menu FROM tb_user_keeping AS k INNER JOIN tb_menu AS m ON k.id_product = m.id_menu WHERE id_keeping = :id;
        ';

        try {
            $this->database->conn->beginTransaction();

            $this->database->query($query);

            $this->database->bindData(':id', $id);

            $this->database->execute();
            $result = $this->database->fetch();

            $this->database->conn->commit();

            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'body' => $result,
                'status_code' => 200
            ]);
        } catch (PDOException $e) {

            if ($this->database->conn->inTransaction()) {
                $this->database->conn->rollBack();
            }

            http_response_code(400);
            echo json_encode([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'status_code' => 400
            ]);
        }
    }

    public function processOut()
    {

        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);

        $phoneNumber = $obj['phoneNumber'];
        $productId = $obj['productId'];
        $id = $obj['id'];
        $val = $obj['val'];
        $idHistoryKeeping = Uuid::generate()->string;
        $status = 'OUT';


        $query = 'SELECT id_keeping, product_count, cust_name FROM tb_user_keeping WHERE id_keeping = :id_keeping';

        $this->database->query($query);
        $this->database->bindData(':id_keeping', $id);
        $productCount = $this->database->fetch();
        $custName = $productCount['cust_name'];

        if ($productCount != false) {
            $count = $productCount['product_count'];

            $total = $count - $val;
            $dateTimeNow = date('Y-m-d h:i:s');

            $query = 'UPDATE tb_user_keeping SET product_count = :product_count, update_at = :update_at WHERE id_keeping = :id';

            try {
                $this->database->conn->beginTransaction();
                $this->database->query($query);
                $this->database->bindData(':id', $id);
                $this->database->bindData(':product_count', $total);
                $this->database->bindData(':update_at', $dateTimeNow);
                $this->database->execute();

                // dapatkan nama barang / produk
                $query = 'SELECT name FROM tb_menu WHERE id_menu = :id';
                $this->database->query($query);
                $this->database->bindData(':id', $productId);
                $nameProduct = $this->database->fetch();

                $dateUpload = date('Y-m');
                $query = 'SELECT id_google_spreadsheet FROM tb_spreadsheet_version WHERE tanggal = :tanggal';
                $this->database->query($query);
                $this->database->bindData(':tanggal', $dateUpload);
                $result = $this->database->fetch();
                $idSpreadSheet = $result['id_google_spreadsheet'];

                // update sheet table stock
                $this->spreadSheetService->update(
                    $idSpreadSheet,
                    [
                        $phoneNumber, $custName, $nameProduct['name'], $total
                    ],
                    $phoneNumber,
                    $nameProduct['name'],
                    'Sheet1!I1:L'
                );


                $query = 'INSERT INTO tb_history_keeping (id_history_keeping, id_keeping, status_keeping, count_keeping, tanggal) VALUES (:id_history, :id_keeping, :status_keeping, :count_keeping, :tanggal)';

                $this->database->query($query);
                $this->database->bindData(':id_history', $idHistoryKeeping);
                $this->database->bindData(':id_keeping', $id);
                $this->database->bindData(':status_keeping', $status);
                $this->database->bindData(':count_keeping', $val);
                $this->database->bindData(':tanggal', $dateTimeNow);

                $this->database->execute();

                $this->database->conn->commit();

                $dateTimeNow = date('Y-m-d');

                // update sheet table history
                $this->spreadSheetService->insertNewRow($idSpreadSheet, [
                    [
                        $dateTimeNow, $phoneNumber, $custName, $nameProduct['name'], $status, $val
                    ]
                ], 'Sheet1!A1:F');



                http_response_code(200);
                echo json_encode([
                    'status_code' => 200,
                    'status' => 'success',
                    'message' => 'berhasil keluarkan barang',
                ], JSON_PRETTY_PRINT);
            } catch (PDOException $e) {
                if ($this->database->conn->inTransaction()) {
                    $this->database->conn->rollBack();
                }

                http_response_code(400);
                echo json_encode([
                    'status_code' => 400,
                    'status' => 'failed',
                    'message' => 'gagal keluarkan barang',
                ], JSON_PRETTY_PRINT);
            }
        }



        // echo json_encode($format);
    }
}
