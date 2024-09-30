<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library('session');
    }
    public function index() {
        $this->load->view('login');
    }

    public function login() {
        $nomAdmin = $this->input->post('nomAdmin');
        $mdp = $this->input->post('mdp');
        $admin = $this->AdminModel->verifyAdmin($nomAdmin, $mdp);
        
        if ($admin) {
            $this->session->set_userdata('admin', $admin);
            redirect('AdminController/insertion_charge');

            echo "Connexion réussie !";
        } else {
            $this->session->set_flashdata('error', 'Nom d’utilisateur ou mot de passe incorrect.');
            redirect('AdminController/index');
        }
    }

    public function insertion_charge() {
        $this->load->view('header');
        $this->load->view('insertion_charge');
    }

    public function handle_charge() {
        $chargeValue = $this->input->post('charge'); 
        $chargeType = $this->input->post('charge_type'); 
        $this->session->set_userdata('nomCharge', $chargeValue);
 
        if ($chargeType === 'non_incorp') {
            redirect('NonIncorpController/charge_nonincorp');
        } elseif ($chargeType === 'incorp') {
            redirect('IncorpController/charge_incorp');
            
        } elseif ($chargeType === 'supp') {
            // Traiter la charge supplétive
        }
    }    
    
    
}
?>