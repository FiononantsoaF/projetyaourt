<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoutController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ChargeGeneralModel');
    }

    public function calculerCouts() {
        $quantiteLait = 500; 
        $quantiteBoite = 4000; 

        $coutLitre = $this->ChargeGeneralModel->coutLitreLait($quantiteLait);
        $coutBoite = $this->ChargeGeneralModel->coutBoitYaourt($quantiteBoite);
        $coutCentre = $this->ChargeGeneralModel->repartitionAdmin();

        $data['coutLitre'] = $coutLitre;
        $data['coutBoite'] = $coutBoite;
        $data['coutCentre'] = $coutCentre;

        $this->load->view('vueCout', $data);
    }
}
?>