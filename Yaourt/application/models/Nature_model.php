<?php

class Nature_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_natures() {
        return $this->db->get('nature')->result_array();
    }

    public function get_nature($idNature) {
        return $this->db->get_where('nature', ['idNature' => $idNature])->row_array();
    }

    public function add_nature($data) {
        return $this->db->insert('nature', $data);
    }

    public function update_nature($idNature, $data) {
        $this->db->where('idNature', $idNature);
        return $this->db->update('nature', $data);
    }

    public function delete_nature($idNature) {
        $this->db->where('idNature', $idNature);
        return $this->db->delete('nature');
    }
}
?>
