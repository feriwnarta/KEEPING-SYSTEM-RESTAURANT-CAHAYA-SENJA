<?php

namespace NextG\Autoreply\Services;

use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Google\Service\Sheets;
use Google_Client;

class SheetService
{
    private $client;

    public function __construct()
    {
        // configure the Google Client
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Sheets API');
        $this->client->setScopes([Sheets::SPREADSHEETS,  Drive::DRIVE_FILE,]);
        $this->client->setAccessType('offline');
    }


    public function createNewSpreadSheet()
    {

        // $client->addScope("https://www.googleapis.com/auth/drive");

        // credentials.json is the key file we downloaded while setting up our Google Sheets API
        $path = __DIR__ . '/../Config/credentials.json';
        $this->client->setAuthConfig($path);



        $mimeType = "application/vnd.google-apps.spreadsheet";
        $serviceDrive = new Drive($this->client);

        $driveFile = new DriveFile();
        $driveFile->setName('test');
        $driveFile->setMimeType($mimeType);

        $spreadSheet = $serviceDrive->files->create($driveFile);
        $spreadSheetId = $spreadSheet->getId();

        $permission = new Permission;
        $permission->setEmailAddress('itsdownloadakun@gmail.com');
        $permission->setType('user');
        $permission->setRole('writer');

        $serviceDrive->permissions->create($spreadSheetId, $permission);

        $spreadsheet_url = "https://docs.google.com/spreadsheets/d/" . $spreadSheetId . "/edit";
        print($spreadsheet_url);
    }
}
