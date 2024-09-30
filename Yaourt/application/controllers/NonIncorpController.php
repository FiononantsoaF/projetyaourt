<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NonIncorpController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('NonIncorpModel');
        $this->load->library('session');
    }
    public function index() {
        $this->load->view('header');
        $this->load->view('NonIncorpView');
    }

    public function insertion_nonincorp() {
        $montant = $this->input->post('montant'); 
        $motif = $this->input->post('motif');
        $idUnite=1;
        $idNature=8;

        $charges = $this->session->userdata('charge');
        $nomcharge = $this->session->userdata('nomCharge');
        if (!is_array($charges)) {
            $charges = array(); // Initialiser un tableau vide si ce n'est pas un tableau
        }
        $charges[]= array(
            'nomCharge'=> $nomcharge,
            'montant' => $montant,
            'daty' => date('Y-m-d'),
            'idUnite' => $idUnite,
            'idNature' => $idNature,
            'pourcentages'=>array()
        );
        $this->load->model('ChargeGeneralModel');
        var_dump($charges);
        foreach ($charges as $charge) {
            $this->ChargeGeneralModel->insertChargeGeneral($charge);
        }

    }

    public function charge_nonincorp() {
        $data['allnonincorp'] = $this->NonIncorpModel->getAllMotifs();
        $this->load->view('header');
        $this->load->view('NonIncorpView',$data);
       
    }
}
?>