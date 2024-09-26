<?php

class UniteOeuvre_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_unites() {
        return $this->db->get('uniteOeuvre')->result_array();
    }

    public function get_unite($idUnite) {
        return $this->db->get_where('uniteOeuvre', ['idUnite' => $idUnite])->row_array();
    }

    public function add_unite($data) {
        return $this->db->insert('uniteOeuvre', $data);
    }

    public function update_unite($idUnite, $data) {
        $this->db->where('idUnite', $idUnite);
        return $this->db->update('uniteOeuvre', $data);
    }

    public function delete_unite($idUnite) {
        $this->db->where('idUnite', $idUnite);
        return $this->db->delete('uniteOeuvre');
    }
}
?>
