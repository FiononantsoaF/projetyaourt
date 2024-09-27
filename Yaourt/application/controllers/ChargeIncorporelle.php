<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChargeIncorporelle extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    // Méthode pour charger la vue fixe
    public function incorporelle_fixe() {
        $this->load->view('incorporelle_fixe');
    }

    // Méthode pour charger la vue variable
    public function incorporelle_variable() {
        $this->load->view('incorporelle_variable');
    }
}
