<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FichierController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ChargeGeneralModel');
        $this->load->library('session');
    }
    public function index() {
        $this->ChargeGeneralModel-> repartitionAdmin();
        $this->ChargeGeneralModel->getRepartitionData();
    }

 
    
}
?>