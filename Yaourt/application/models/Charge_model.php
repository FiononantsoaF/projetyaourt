<?php

class Charge_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_charges() {
        return $this->db->get('charge')->result_array();
    }

    public function get_charge($idCharge) {
        return $this->db->get_where('charge', ['idCharge' => $idCharge])->row_array();
    }

    public function add_charge($data) {
        return $this->db->insert('charge', $data);
    }

    public function update_charge($idCharge, $data) {
        $this->db->where('idCharge', $idCharge);
        return $this->db->update('charge', $data);
    }

    public function delete_charge($idCharge) {
        $this->db->where('idCharge', $idCharge);
        return $this->db->delete('charge');
    }
}
?>
