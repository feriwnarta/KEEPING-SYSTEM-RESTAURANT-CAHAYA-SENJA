<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;
use PDO;
use PDOException;
use Webpatser\Uuid\Uuid;

class MenuController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function inputMenu()
    {
        View::render('main', 'menu/input-menu');
    }

    public function saveMenu()
    {

        $unique_name = 'insert-image.png';
        
        if (isset($_FILES['imageMenu'])) {
            $file_name = $_FILES['imageMenu']['name'];
            $file_size = $_FILES['imageMenu']['size'];
            $file_tmp = $_FILES['imageMenu']['tmp_name'];
            $file_type = $_FILES['imageMenu']['type'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $extensions = array("jpeg", "jpg", "png");

            if (!in_array($file_ext, $extensions)) {
                http_response_code(400);
                echo json_encode("Ekstensi file tidak diperbolehkan, hanya menerima file JPEG, JPG, dan PNG.");
                exit;
            }

            if ($file_size > 2097152) {
                http_response_code(400);
                echo json_encode("Ukuran file terlalu besar, maksimal 2MB.");
                exit;
            }

            $upload_dir = realpath(__DIR__ . '/../public/') . 'menu/'; 

            // Generate nama unik untuk gambar
            $unique_name = uniqid() . '.' . $file_ext;

            // Pindahkan gambar ke direktori penyimpanan
            $upload_path = $upload_dir . $unique_name;
            if (!move_uploaded_file($file_tmp, $upload_path)) {
                http_response_code(400);
                echo json_encode("Terjadi kesalahan saat menyimpan gambar.");
                exit;
            } 
        }

        $uuid = Uuid::generate()->string;
        $name = '';
        if(isset($_POST['menuName'])) {
            $name = $_POST['menuName'];
        }

        

        try {
            $query = 'INSERT INTO tb_menu (id_menu, name, thumbnail) VALUES (:id, :name, :thumbnail)';
            $this->db->query($query);
            $this->db->conn->beginTransaction();
            $this->db->bindData(':id', $uuid);
            $this->db->bindData(':name', $name);
            $this->db->bindData(':thumbnail', $unique_name);

            $this->db->execute();
            $this->db->conn->commit();

            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'berhasil simpan menu'
            ], JSON_PRETTY_PRINT);

        }catch(PDOException $e) {
            if($this->db->conn->inTransaction()) {
                $this->db->conn->rollBack();
            }

            http_response_code(400);
            echo json_encode([
                'status' => 'failed',
                'message' => 'gagal simpan menu'
            ]);

        }
        
    }

    public function menu() {

        $query = 'SELECT id_menu, name, thumbnail FROM tb_menu';
        $this->db->query($query);
        $rs = $this->db->fetchAll();

        View::render('main', 'menu/menu', $rs);
    }
}