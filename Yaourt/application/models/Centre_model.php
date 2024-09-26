<?php

class Centre_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_centres() {
        return $this->db->get('centre')->result_array();
    }

    public function get_centre($idCentre) {
        return $this->db->get_where('centre', ['idCentre' => $idCentre])->row_array();
    }

    public function add_centre($data) {
        return $this->db->insert('centre', $data);
    }

    public function update_centre($idCentre, $data) {
        $this->db->where('idCentre', $idCentre);
        return $this->db->update('centre', $data);
    }

    public function delete_centre($idCentre) {
        $this->db->where('idCentre', $idCentre);
        return $this->db->delete('centre');
    }
}
?>
