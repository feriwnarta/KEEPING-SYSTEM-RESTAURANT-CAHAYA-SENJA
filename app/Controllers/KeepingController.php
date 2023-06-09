<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;
use PDOException;
use Webpatser\Uuid\Uuid;

class KeepingController
{

    private $database;

    public function __construct()
    {
        $this->database = new Database;
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

        $query = 'SELECT id_menu, name, thumbnail FROM tb_menu ORDER BY id_menu ASC LIMIT :start , 10 ';
        $this->database->query($query);
        $this->database->bindData(':start', $start);

        echo json_encode($this->database->fetchAll(), JSON_PRETTY_PRINT);
    }

    public function saveKeeping()
    {

        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);



        try {

            foreach ($obj as $row) {
                $this->database->conn->beginTransaction();


                $idProduct = $row['id'];
                $custPhoneNumber = $row['custPhoneNumber'];
                $tanggal = date("Y-m-d", strtotime($row['tanggal']));

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
            }




            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'data berhasil disimpan',
                'status_code' => 200
            ], JSON_PRETTY_PRINT);
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
        $query = 'SELECT k.id_keeping AS id_keeping,  k.phone_number as nomor_telpon, k.cust_name as cust_name, k.id_product as id_produk, m.name as nama_produk, k.product_count as product_count
        FROM tb_user_keeping AS k
        INNER JOIN tb_menu AS m ON k.id_product = m.id_menu
        GROUP BY k.id_product, k.phone_number;';


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
        $val = $obj['val'];

        $query = 'SELECT id_keeping, phone_number,cust_name, product_count, id_product, tanggal_input FROM tb_user_keeping WHERE phone_number = :phone_number AND id_product = :id_product GROUP BY code ORDER BY tanggal_input ASC;';

        $this->database->query($query);
        $this->database->bindData(':phone_number', $phoneNumber);
        $this->database->bindData(':id_product', $productId);
        $this->database->execute();

        $rs = $this->database->fetchAll();


        $format = [];
        foreach ($rs as $data) {

            if ($data['product_count'] != 0 && $val != 0) {
                $result = $data['product_count'] - $val;



                if ($result < 0) {
                    $total = 0;
                    $val = abs($result);
                } else {
                    $total = $result;
                    $total = 0;
                }

                $format[] = [
                    'id' => $data['id_keeping'],
                    'total' => $total
                ];
            }
        }

        echo json_encode($format);
    }
}