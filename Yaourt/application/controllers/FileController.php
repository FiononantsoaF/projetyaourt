<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileController extends CI_Controller {

    public function convert_txt_to_xlsx() {
        $txtFile = 'C:/wamp64/www/S5MrTovo/projetyaourt/Yaourt/grand_taleau.txt'; 
        
        // Vérifier si le fichier existe
        if (!file_exists($txtFile)) {
            show_error("Le fichier n'existe pas : $txtFile", 404);
            return;
        }

        // Créer une nouvelle instance de Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        try {
            // Lire les lignes du fichier texte
            $lines = file($txtFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!$lines) {
                show_error("Le fichier est vide ou illisible.", 500);
                return;
            }

            // Parcourir les lignes et les données
            foreach ($lines as $row => $line) {
                $data = explode(',', $line);
                foreach ($data as $col => $value) {
                    $sheet->setCellValueByColumnAndRow($col + 1, $row + 1, trim($value));
                }
            }

            // Configurer le nom du fichier à exporter
            $filename = 'converted_file_' . date('YmdHis') . '.xlsx';
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

            // Préparer l'envoi du fichier Excel en téléchargement
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            
            // Envoyer le fichier pour téléchargement
            $writer->save('php://output');
            exit();

        } catch (Exception $e) {
            // Gérer les erreurs pendant la lecture ou l'écriture
            show_error('Une erreur s\'est produite lors de la conversion : ' . $e->getMessage(), 500);
        }
    }
}
