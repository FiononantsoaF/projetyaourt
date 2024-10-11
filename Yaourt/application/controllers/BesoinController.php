<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BesoinController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ChargeModel');
        $this->load->model('CentreModel');
        $this->load->library('session');
    }

    public function index() {
        $data['besoins']= $this->ChargeModel->getAllCharges();
        $data['centres']= $this->CentreModel->getAllCentres();
        $this->load->view('header');  
        $this->load->view('insertion_besoin', $data); 
    }
    
}
?>