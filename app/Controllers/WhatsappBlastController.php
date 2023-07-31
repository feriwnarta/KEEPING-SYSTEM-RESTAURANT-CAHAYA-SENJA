<?php

namespace NextG\Autoreply\Controllers;

use NextG\Autoreply\Services\SpreadsheetService;

class WhatsappBlastController
{

    private SpreadsheetService $spreadsheet;
  
    public function __construct()
    {
        
        $this->spreadsheet = new SpreadsheetService;
    }

    public function test() {
        $id = $this->spreadsheet->createNewSpreadSheet('tester', 'senjakasir@gmail.com');
        $this->spreadsheet->makeNewHeaderColumn($id, ['Tanggal', 'No Hp', 'Nama Customer', 'Barang', 'Status', 'Jumlah'],
        'Sheet1!A1:F');
    }

}
