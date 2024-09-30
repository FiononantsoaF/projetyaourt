
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'C:\wamp64\www\S5MrTovo\projetyaourt\Yaourt\vendor\autoload.php';

class FileController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ChargeGeneralModel');
    }

    public function convert_txt_to_xlsx() {
        $txtFile = 'C:\wamp64\www\S5MrTovo\projetyaourt\Yaourt\grand_taleau.txt'; 
        $txtFileCentre = 'C:\wamp64\www\S5MrTovo\projetyaourt\Yaourt\repartition_centre.txt'; 
        
        if (!file_exists($txtFile)) {
            show_error("Le fichier n'existe pas : $txtFile", 404);
            return;
        }
        if (!file_exists($txtFileCentre)) {
            show_error("Le fichier n'existe pas : $txtFileCentre", 404);
            return;
        }
        $this->ChargeGeneralModel->createExcelFile($txtFile);
        $this->ChargeGeneralModel->createExcelFileCentre($txtFileCentre);
        //$this->downloadExcelFile();
    }
}
