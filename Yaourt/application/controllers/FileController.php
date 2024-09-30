<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileController extends CI_Controller {

    public function convert_txt_to_xlsx() {
        $txtFile = 'C:/wamp64/www/S5MrTovo/projetyaourt/Yaourt/grand_taleau.txt'; 
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $lines = file($txtFile);
        foreach ($lines as $row => $line) {
            $data = explode(',', $line);
            foreach ($data as $col => $value) {
                $sheet->setCellValueByColumnAndRow($col + 1, $row + 1, trim($value));
            }
        }

        $filename = 'converted_file.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
