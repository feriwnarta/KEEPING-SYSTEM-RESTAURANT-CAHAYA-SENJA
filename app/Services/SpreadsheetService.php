<?php

namespace NextG\Autoreply\Services;

use Exception;
use Google\Service\CloudSearch\BorderStyle;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Google\Service\Sheets;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;
use Google\Service\Sheets\Border;
use Google\Service\Sheets\Borders;
use Google\Service\Sheets\GridRange;
use Google\Service\Sheets\Sheet;
use Google\Service\Sheets\ValueRange;
use Google_Client;
use Google_Service_Exception;

class SpreadsheetService
{
    private $client;
    private $spreadSheet;
    private $serviceDrive;

    public function __construct()
    {
        // configure the Google Client
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Sheets API');
        $this->client->setScopes([Sheets::SPREADSHEETS,  Drive::DRIVE_FILE,]);
        $this->client->setAccessType('offline');
        $path = __DIR__ . '/../Config/credentials.json';
        $this->client->setAuthConfig($path);
    }


    public function createNewSpreadSheet($name = '', $email = '')
    {
        $mimeType = "application/vnd.google-apps.spreadsheet";
        $this->serviceDrive = new Drive($this->client);

        try {
            // Cek apakah file sudah ada dengan menggunakan metode files->list
            $fileList = $this->serviceDrive->files->listFiles([
                'q' => "name = '" . $name . "'",
                'spaces' => 'drive',
                'fields' => 'files(id)',
                'pageSize' => 1
            ]);

            if (count($fileList->getFiles()) > 0) {
                // File sudah ada, gunakan file yang ada
                $existingFile = $fileList->getFiles()[0];
                $spreadSheetId = $existingFile->getId();
                return $spreadSheetId;
            } else {
                // File belum ada, buat file baru
                $driveFile = new DriveFile();
                $driveFile->setName($name);
                $driveFile->setMimeType($mimeType);

                $this->spreadSheet = $this->serviceDrive->files->create($driveFile);
                $spreadSheetId = $this->spreadSheet->getId();

                $permission = new Permission;
                $permission->setEmailAddress($email);
                $permission->setType('user');
                $permission->setRole('writer');

                $rs = $this->serviceDrive->permissions->create($spreadSheetId, $permission);
                return $spreadSheetId;
            }

            return false;
        } catch (Google_Service_Exception $e) {
            // Tangani exception jika terjadi kesalahan dari Google Drive API
            echo "Terjadi kesalahan: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            // Tangani exception jika terjadi kesalahan lainnya
            echo "Terjadi kesalahan: " . $e->getMessage();
            return false;
        }

        return false;
    }


    public function makeNewHeaderColumn($spreadSheetId, $data, $range)
    {

        $sheetService = new Sheets($this->client);
        $newRow = [
            $data
        ];

        $valueRange = new ValueRange();
        $valueRange->setValues($newRow);

        $options = ['valueInputOption' => 'USER_ENTERED'];
        $sheetService->spreadsheets_values->append($spreadSheetId, $range, $valueRange, $options);
    }



    public function fetchAllRows()
    {
        $sheetService = new Sheets($this->client);
        $spreadSheetId = '1zjAujT7oy2fK4u14eYHBbePU0PW3WEsziaQDGt2yiF4';
        $range = 'Sheet1'; // here we use the name of the Sheet to get all the rows
        $response = $sheetService->spreadsheets_values->get($spreadSheetId, $range);
        $values = $response->getValues();
        var_dump($values);
    }

    public function insertNewRow($spreadSheetId, $data = [], $sheet)
    {

        if (!empty($data)) {
            $sheetService = new Sheets($this->client);

            try {
                $valueRange = new ValueRange();
                $valueRange->setValues($data);
                $options = ['valueInputOption' => 'USER_ENTERED'];
                $sheetService->spreadsheets_values->append($spreadSheetId, $sheet, $valueRange, $options);
                return true;
            } catch (Google_Service_Exception $e) {
                // Tangani exception jika terjadi kesalahan dari Google Sheets API
                echo "Terjadi kesalahan: " . $e->getMessage();
                return false;
            } catch (Exception $e) {
                // Tangani exception jika terjadi kesalahan lainnya
                echo "Terjadi kesalahan: " . $e->getMessage();
                return false;
            }

            return false;
        }

        return false;
    }

    public function update($spreadSheetId, $data = [], $match1 = '', $match2,  $range = 'Sheet1')
    {
        if (!empty($data)) {
            $sheetService = new Sheets($this->client);

            try {
                // Ambil data dari Google Sheet
                $response = $sheetService->spreadsheets_values->get($spreadSheetId, $range);
                $values = $response->getValues();

                // Pengecekan dan pembaruan pada baris yang sesuai
                if (!empty($values)) {
                    foreach ($values as $row => $rowData) {
                        // Pengecekan nilai pada kolom tertentu (misalnya kolom A)
                        if ($rowData[0] == $match1 && $rowData[2] == $match2) {
                            // Lakukan pembaruan pada baris yang sesuai
                            $values[$row] = $data;
                        }
                    }

                    // Update data di Google Sheet
                    $valueRange = new ValueRange();
                    $valueRange->setValues($values);
                    $options = ['valueInputOption' => 'USER_ENTERED'];
                    $sheetService->spreadsheets_values->update($spreadSheetId, $range, $valueRange, $options);
                }

                return true;
            } catch (Google_Service_Exception $e) {
                // Tangani exception jika terjadi kesalahan dari Google Sheets API
                echo "Terjadi kesalahan: " . $e->getMessage();
                return false;
            } catch (Exception $e) {
                // Tangani exception jika terjadi kesalahan lainnya
                echo "Terjadi kesalahan: " . $e->getMessage();
                return false;
            }
        }

        return false;
    }

    public function updateHistory($spreadSheetId, $data = [], $match1 = '', $match2,  $range = 'Sheet1')
    {
        if (!empty($data)) {
            $sheetService = new Sheets($this->client);

            try {
                // Ambil data dari Google Sheet
                $response = $sheetService->spreadsheets_values->get($spreadSheetId, $range);
                $values = $response->getValues();

                // Pengecekan dan pembaruan pada baris yang sesuai
                if (!empty($values)) {
                    foreach ($values as $row => $rowData) {
                        // Pengecekan nilai pada kolom tertentu (misalnya kolom A)
                        if ($rowData[1] == $match1 && $rowData[3] == $match2) {
                            // Lakukan pembaruan pada baris yang sesuai
                            $values[$row] = $data;
                        }
                    }

                    // Update data di Google Sheet
                    $valueRange = new ValueRange();
                    $valueRange->setValues($values);
                    $options = ['valueInputOption' => 'USER_ENTERED'];
                    $sheetService->spreadsheets_values->update($spreadSheetId, $range, $valueRange, $options);
                }

                return true;
            } catch (Google_Service_Exception $e) {
                // Tangani exception jika terjadi kesalahan dari Google Sheets API
                echo "Terjadi kesalahan: " . $e->getMessage();
                return false;
            } catch (Exception $e) {
                // Tangani exception jika terjadi kesalahan lainnya
                echo "Terjadi kesalahan: " . $e->getMessage();
                return false;
            }
        }

        return false;
    }
}
