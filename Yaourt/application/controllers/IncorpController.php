<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IncorpController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UniteOeuvreModel');
        $this->load->model('CentreModel');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('IncorpView');
    }

    public function charge_incorp() {
            $data['allincorp'] = $this->UniteOeuvreModel->getAllUnites();
            $this->load->view('header');
            $this->load->view('IncorpView',$data);
        
    }

    public function incorporelle_fixe() {
        $this->load->view('header');
        $data['centre']=$this->CentreModel->getAllCentres();
        $this->load->view('incorporelle_fixe',$data); 
    }

    public function incorporelle_variable() {
        $this->load->view('header');
        $data['centre']=$this->CentreModel->getAllCentres();
        $this->load->view('incorporelle_variable',$data);
    }

    public function inserer_incorp() {
        $this->load->model('ChargeGeneralModel');
        if ($this->input->post()) {
            $montant = $this->input->post('montant');
            $idUnite = $this->input->post('unite'); // Récupérer l'unité d'œuvre
            $nature = $this->input->post('nature'); // Récupérer la nature
            $data=[];

            $nomcharge = $this->session->userdata('nomCharge');
            if ($nature == '2') { // Charge variable
                $centres = $this->input->post('chargeVariable'); // Centres sélectionnés
                if (!empty($centres)) {
                    foreach ($centres as $idCentre) {
                        $pourcentage = $this->input->post('pourcentage');
                        if (!empty($pourcentage)) {
                            // Insérer les données dans la base de données
                            $datav = [
                                'nomCharge'=> $nomcharge,
                                'montant' => $montant,
                                'daty' => date('Y-m-d'),
                                'idUnite' => $idUnite,
                                'idNature'=> $nature,
                                'pourcentages' => $pourcentage
                            ];
                            $data=$datav;
                            // $this->db->insert('votre_table', $data);
                        }
                    }
                }
            } elseif ($nature == '1') { // Charge fixe
                $centreFixe = $this->input->post('chargeFixe'); // Récupérer le centre fixe sélectionné
                // Insérez les données dans la base de données ici pour le centre fixe
                $dataFixe = [
                    'nomCharge'=> $nomcharge,
                    'montant' => $montant,
                    'daty' => date('Y-m-d'),
                    'idUnite' => $idUnite,
                    'idNature' =>$nature,
                    'pourcentages'=>array(
                        $centreFixe =>100
                    )
                ];
                $data=$dataFixe;
            }
            $this->load->model('ChargeGeneralModel');
            $this->ChargeGeneralModel->insertChargeGeneral($data);
             
        }
    }

}
?>