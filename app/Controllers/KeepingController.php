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

        $query = 'INSERT INTO tb_user_keeping (id_keeping, code, phone_number, cust_name, product_count, id_product, tanggal_input) VALUES (:id_keeping, :code, :phone_number, :cust_name, :product_count, :id_product, :tanggal_input)';

        try {
            $this->database->conn->beginTransaction();
            foreach ($obj as $row) {
                $uuid = Uuid::generate()->string;
                $code = $this->generateKode();


                $this->database->query($query);
                $this->database->bindData(':id_keeping', $uuid);
                $this->database->bindData(':code', $code);
                $this->database->bindData(':phone_number', $row['custPhoneNumber']);
                $this->database->bindData(':cust_name', $row['custName']);
                $this->database->bindData(':product_count', $row['count']);
                $this->database->bindData(':id_product', $row['id']);
                $this->database->bindData(':tanggal_input', $row['tanggal']);

                $rs = $this->database->execute();
            }
            if ($rs) {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'data berhasil disimpan',
                    'status_code' => 200
                ], JSON_PRETTY_PRINT);
            }
        } catch (PDOException $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'failed',
                'message' => 'data gagal disimpan',
                'status_code' => 400
            ], JSON_PRETTY_PRINT);
        }
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

        $query = 'SELECT k.id_keeping, k.tanggal_input AS tanggal,  k.phone_number as nomor_telpon, k.cust_name as cust_name, k.id_product as id_produk, m.name as nama_produk, SUM(k.product_count) AS product_count
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
}
