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
            $idUnite = $this->input->post('unite'); 
            $nature = $this->input->post('nature'); 
            $data=[];

            $nomcharge = $this->session->userdata('nomCharge');
            if ($nature == '2') {
                $centres = $this->input->post('chargeVariable'); 
                if (!empty($centres)) {
                    foreach ($centres as $idCentre) {
                        $pourcentage = $this->input->post('pourcentage');
                        if (!empty($pourcentage)) {
                            $datav = [
                                'nomCharge'=> $nomcharge,
                                'montant' => $montant,
                                'daty' => date('Y-m-d'),
                                'idUnite' => $idUnite,
                                'idNature'=> $nature,
                                'pourcentages' => $pourcentage
                            ];
                            $data=$datav;
                        }
                    }
                }
            } elseif ($nature == '1') { 
                $centreFixe = $this->input->post('chargeFixe'); 
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
            redirect('FichierController/index');
        }
    }

}
?>