<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestCentre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Centre_model'); // Charger le modèle Centre_model
    }

    // Test de récupération de tous les centres
    public function get_all_centres() {
        $centres = $this->Centre_model->get_all_centres();
        echo '<pre>';
        print_r($centres); // Afficher les résultats
        echo '</pre>';
    }

    // Test d'ajout d'un centre
    public function add_centre() {
        $data = [
            'nomCentre' => 'Centre Test'
        ];

        $this->Centre_model->add_centre($data);
        echo "Centre ajouté avec succès !";
    }

    // Test de mise à jour d'un centre
    public function update_centre($idCentre) {
        $data = [
            'nomCentre' => 'Centre Modifié'
        ];

        $this->Centre_model->update_centre($idCentre, $data);
        echo "Centre mis à jour avec succès !";
    }

    // Test de suppression d'un centre
    public function delete_centre($idCentre) {
        $this->Centre_model->delete_centre($idCentre);
        echo "Centre supprimé avec succès !";
    }

    // Test de récupération d'un centre par ID
    public function get_centre($idCentre) {
        $centre = $this->Centre_model->get_centre($idCentre);
        echo '<pre>';
        print_r($centre); // Afficher les résultats
        echo '</pre>';
    }
}
?>
