<?php

class MotifSpecial_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_motifs() {
        return $this->db->get('motifSpecial')->result_array();
    }

    public function get_motif($idMotif) {
        return $this->db->get_where('motifSpecial', ['idMotif' => $idMotif])->row_array();
    }

    public function add_motif($data) {
        return $this->db->insert('motifSpecial', $data);
    }

    public function update_motif($idMotif, $data) {
        $this->db->where('idMotif', $idMotif);
        return $this->db->update('motifSpecial', $data);
    }

    public function delete_motif($idMotif) {
        $this->db->where('idMotif', $idMotif);
        return $this->db->delete('motifSpecial');
    }
}
?>
