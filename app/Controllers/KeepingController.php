<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\App\Database;
use NextG\Autoreply\App\View;

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

    public function getMenu() {

        $start = 0;
        if(isset($_POST['start'])) {
            $start= intval($_POST['start']);
        }
        
        $query = 'SELECT id_menu, name, thumbnail FROM menu ORDER BY id_menu ASC LIMIT :start , 5 ';
        $this->database->query($query);
        $this->database->bindData(':start', $start);

        echo json_encode($this->database->fetchAll(), JSON_PRETTY_PRINT);
        
    }
}
