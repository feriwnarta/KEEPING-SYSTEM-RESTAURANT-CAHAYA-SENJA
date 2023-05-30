<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use Webpatser\Uuid\Uuid;

class AutoReplyController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function request()
    {
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // add this php file to your web server and enter the complete url in AutoResponder (e.g. https://www.example.com/api_autoresponder.php)

        // to allow only authorized requests, you need to configure your .htaccess file and set the credentials with the Basic Auth option in AutoResponder

        // access a custom header added in your AutoResponder rule
        // replace XXXXXX_XXXX with the name of the header in UPPERCASE (and with '-' replaced by '_')
        // $myheader = $_SERVER['HTTP_XXXXXX_XXXX'];

        // get posted data
        $data = json_decode(file_get_contents("php://input"));


        // make sure json data is not incomplete
        if (
            !empty($data->query) &&
            !empty($data->appPackageName) &&
            !empty($data->messengerPackageName) &&
            !empty($data->query->sender) &&
            !empty($data->query->message)
        ) {

            // package name of AutoResponder to detect which AutoResponder the message comes from
            $appPackageName = $data->appPackageName;
            // package name of messenger to detect which messenger the message comes from
            $messengerPackageName = $data->messengerPackageName;
            // name/number of the message sender (like shown in the Android notification)
            $sender = $data->query->sender;
            // text of the incoming message
            $message = $data->query->message;
            // is the sender a group? true or false
            $isGroup = $data->query->isGroup;
            // name/number of the group participant who sent the message if it was sent in a group, otherwise empty
            $groupParticipant = $data->query->groupParticipant;
            // id of the AutoResponder rule which has sent the web server request
            $ruleId = $data->query->ruleId;
            // is this a test message from AutoResponder? true or false
            $isTestMessage = $data->query->isTestMessage;



            // process messages here
            $response = [];
            $message_response = null;



            if ($message == '1') {
                $message_response = $this->replyLokasi();
                $response = array(
                    'message' => $message_response
                );
            } else if ($message == '2') {
                $message_response = $this->replyJamOperator();
                $response = array(
                    'message' => $message_response
                );
            } else if ($message == '3') {
                $message_response = $this->replyMenu();
                $response = array(
                    'message' => $message_response
                );
            } else if ($message == '4') {
                $message_response = $this->replyPromo();
                $response = array(
                    'message' => $message_response
                );
            } else if ($message == '5') {
                $message_response = $this->replyKeeping();
                $response = array(
                    'message' => $message_response
                );
            } else if ($message == '1K' || $message == '1k') {
                $message_response = $this->replySimpanSisaBir();
                $response = array(
                    array('message' => "Salin Format Berikut Untuk Menyimpan Bir, Pastikan Tidak Ada Kesalahan Pengetikan Format"),
                    array('message' => $message_response),
                );
            } else if ($message == '2K' || $message == '2k') {

                $message_response = $this->replyLihatSimpananBir();
                $response = array(
                    array('message' => "Salin Format Berikut Untuk Melihat Simpanan Bir, Pastikan Tidak Ada Kesalahan Pengetikan Format"),
                    array('message' => $message_response),
                );
            } else {
                // extract format yang dikirimkan use
                // $dataInputKeeping = $this->extractValues($message);

                $dataInputKeeping = $this->extractValuesFromString($message);

                if (count($dataInputKeeping) >= 1) {

                    // ini akan dijalankan saat user menginput keeping
                    // jika formatnya sudah sesuai
                    if (count($dataInputKeeping) == 4) {
                        $message_response =  $this->saveProductKeeping($dataInputKeeping);
                    } else {
                        $message_response = 'Ada kesalahan format dalam pengetikan, pastikan format sudah sesuai';
                    }
                } else {

                    // ini akan dijalankan untuk mengambil jumlah keeping user
                    $phoneNumber = $this->extractValuesForSeeKeeping($message);
                    $dataKeeping = $this->getUserProductKeeping($phoneNumber);

                    $dateTime = date('Y-m-d');

                    $message_response = "
Daftar Simpanan Bir Anda
Cahaya Senja Caffe & eatery
----------------------------------------
Tgl: {$dateTime}
----------------------------------------
                    ";

                    if ($dataKeeping != null && count($dataKeeping) > 0) {
                        foreach ($dataKeeping as $data) {
                            $message_response .= "
----------------------------------------
Tanggal = {$data['create_at']}
Kode = {$data['code']}
Nama Minuman = {$data['product_name']}
Jumlah = {$data['product_count']}
Status = {$data['status']}
-----------------------------------------
                            ";
                        }
                    }
                    // data keeping kosong
                    else {
                        $message_response = $this->showMenu();
                    }
                }


                $response = array(
                    'message' => $message_response
                );
            }





            // set response code - 200 success
            http_response_code(200);

            // send one or multiple replies to AutoResponder
            echo json_encode(array("replies" => $response));

            // or this instead for no reply:
            // echo json_encode(array("replies" => array()));
        }

        // tell the user json data is incomplete
        else {

            // echo $this->showMenu();

            // set response code - 400 bad request
            http_response_code(400);

            // send error
            echo json_encode(array("replies" => array(
                array("message" => "Error ❌"),
                array("message" => "JSON data is incomplete. Was the request sent by AutoResponder?")
            )));
        }
    }

    private function showMenu()
    {
        $message = "
        Terimakasih telah menghubungi Cahaya Senja
        Silahkan pilih menu yang anda inginkan.
        1. Lokasi Tempat 
        2. Jam Operator 
        3. Menu
        4. Promo
        5. Simpanan Bir
        ";

        return $message;
    }

    private function replyLokasi()
    {
        $message = "https://goo.gl/maps/mWibJV7Cp2A1mLih8";
        return $message;
    }

    private function replyJamOperator()
    {
        $message = "Cahaya senja buka setiap hari dari jam 09.00 s/d 00.00
        cahaya senja";
        return $message;
    }

    private function replyMenu()
    {
        $message = "1. BAKMI GORENG
        2. BALSO RUDAL";
        return $message;
    }

    private function replyPromo()
    {
        $message = "list promo";
        return $message;
    }

    private function replyKeeping()
    {
        $message = "
        1K. Simpan Sisa Bir
        2K. Lihat Simpanan Bir 
        ";
        return $message;
    }

    private function replySimpanSisaBir()
    {
        $message = '
        Nomor telpon :
        Nama :    
        Nama Minuman:   
        Jumlah :   
        ';
        return $message;
    }

    private function replyLihatSimpananBir()
    {
        $message = '
        Nomor telpon :
        ';
        return $message;
    }

    private function replyRiwayatSimpananBir()
    {
        $message = '';
        return $message;
    }

    function extractValuesFromString(string $string)
    {
        $delimiter = ',';

        $patterns = array(
            '/Nomor Telpon:\s*([^\\r\\n]+)/i',
            '/Nama:\s*([^\\r\\n]+)/i',
            '/Nama minuman:\s*([^\\r\\n]+)/i',
            '/Jumlah:\s*([^\\r\\n]+)/i'
        );

        $values = array();

        // Periksa keberadaan pemisah koma
        if (strpos($string, $delimiter) !== false) {
            // Jika ada pemisah koma, gunakan pola regex
            foreach ($patterns as $pattern) {
                preg_match($pattern, $string, $matches);
                $value = trim($matches[1]);
                $values[] = $value;
            }
        } else {
            // Jika tidak ada pemisah koma, ambil nilai langsung dari string
            foreach ($patterns as $pattern) {
                preg_match($pattern, $string, $matches);
                if (isset($matches[1])) {
                    $value = trim($matches[1]);
                    $values[] = $value;
                }
            }
        }

        return $values;
    }

    function extractValuesForSeeKeeping(string $string)
    {
        $pattern = '/Nomor telpon\s*:\s*([^\\r\\n]+)/i';
        preg_match($pattern, $string, $matches);
        $value = isset($matches[1]) ? trim($matches[1]) : null;
        return $value;
    }

    private function extractValues($string)
    {
        $values = array();

        // Pola regex untuk mencocokkan dan mengambil nilai
        $patterns = array(
            '/nomor telpon:\s*([^,]+)/i',
            '/nama:\s*([^,]+)/i',
            '/nama minuman:\s*([^,]+)/i',
            '/jumlah:\s*([^,]+)/i'
        );

        foreach ($patterns as $pattern) {
            preg_match($pattern, $string, $matches);
            if (isset($matches[1])) {
                $values[] = trim($matches[1]);
            } else {
                $values[] = null;
            }
        }

        return $values;
    }

    private function saveProductKeeping(array $dataInputKeeping)
    {
        $query = 'INSERT INTO tb_user_keeping (id_keeping, code, code_verify, phone_number, cust_name, product_count, product_name) VALUES (:id_keeping, :code, :code_verify, :phone_number, :cust_name, :product_count, :product_name)';

        $uuid = Uuid::generate()->string;

        $code = $this->generateKode();
        $code_verify = $this->generateRandomString(6);

        if (!empty($dataInputKeeping)) {
            $this->db->query($query);
            $this->db->bindData(':id_keeping', $uuid);
            $this->db->bindData(':code', $code);
            $this->db->bindData(':code_verify', $code_verify);
            $this->db->bindData(':phone_number', $dataInputKeeping[0]);
            $this->db->bindData(':cust_name', $dataInputKeeping[1]);
            $this->db->bindData(':product_name', $dataInputKeeping[2]);
            $this->db->bindData(':product_count', $dataInputKeeping[3]);
        }

        $datetime = date('Y-m-d');


        if ($this->db->execute()) {

            $detail = "
            Detail Simpan Sisa Bir
            Cahaya Senja Coffee and Eatery
            ----------------------
            Tanggal = {$datetime}
            Kode = {$code}
            ----------------------
            Nama Produk Yang Disimpan = {$dataInputKeeping[2]}
            Jumlah = {$dataInputKeeping[3]}
            Kode Verifikasi = {$code_verify}

            Note: Berikan kode verifikasi kepada pelayan saat anda 
            menyerahkan barang yang disimpan.
            Terima kasih
            ----------------------
            ";

            return $detail;
        } else {
            return 'Maaf ada kegagalan disistem, silahkan coba lagi';
        }
    }

    function generateKode()
    {
        $year = date('Y');
        $month = date('m');

        $query = 'SELECT COUNT(id_keeping) as count FROM tb_user_keeping WHERE create_at LIKE :formatDate';

        $this->db->query($query);

        $this->db->bindData(':formatDate', "{$year}-{$month}%");

        $count = $this->db->fetch()['count'] + 1;

        $format = "KEEP{$year}{$month}{$count}";

        return $format;
    }

    private function getUserProductKeeping($phoneNumber)
    {

        if (isset($phoneNumber) && $phoneNumber != null) {

            $query = "SELECT code, phone_number, product_name, product_count, status, create_at FROM tb_user_keeping WHERE phone_number = :phone AND status = 'Menunggu' || status = 'Diserahkan' ORDER BY create_at";

            $this->db->query($query);

            $this->db->bindData(':phone', $phoneNumber);

            $result = $this->db->fetchAll();

            return $result;
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        $characterCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $characterCount - 1)];
        }

        return $randomString;
    }
}
