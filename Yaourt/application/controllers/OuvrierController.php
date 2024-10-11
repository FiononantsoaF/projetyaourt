<?php 
    class OuvrierController extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('OeuvrierModel');
            $this->load->library('session');
        }
        
        public function index() {
        }
        public function getOuvrier($idCentre) {
            $data['ouvriers'] = $this->OeuvrierModel->getOeuvrierByCentre($idCentre);
            echo json_encode($data);
        }
    }
?>
