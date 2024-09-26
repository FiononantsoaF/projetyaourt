<?php

class TypeCharge_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_type_charges() {
        return $this->db->get('typeCharge')->result_array();
    }

    public function get_type_charge($idTypeCharge) {
        return $this->db->get_where('typeCharge', ['idTypeCharge' => $idTypeCharge])->row_array();
    }

    public function add_type_charge($data) {
        return $this->db->insert('typeCharge', $data);
    }

    public function update_type_charge($idTypeCharge, $data) {
        $this->db->where('idTypeCharge', $idTypeCharge);
        return $this->db->update('typeCharge', $data);
    }

    public function delete_type_charge($idTypeCharge) {
        $this->db->where('idTypeCharge', $idTypeCharge);
        return $this->db->delete('typeCharge');
    }
}
?>
