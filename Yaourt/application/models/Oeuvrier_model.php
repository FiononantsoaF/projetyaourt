<?php

class Oeuvrier_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_oeuvriers() {
        return $this->db->get('oeuvrier')->result_array();
    }

    public function get_oeuvrier($idOeuvre) {
        return $this->db->get_where('oeuvrier', ['idOeuvre' => $idOeuvre])->row_array();
    }

    public function add_oeuvrier($data) {
        return $this->db->insert('oeuvrier', $data);
    }

    public function update_oeuvrier($idOeuvre, $data) {
        $this->db->where('idOeuvre', $idOeuvre);
        return $this->db->update('oeuvrier', $data);
    }

    public function delete_oeuvrier($idOeuvre) {
        $this->db->where('idOeuvre', $idOeuvre);
        return $this->db->delete('oeuvrier');
    }
}
?>
