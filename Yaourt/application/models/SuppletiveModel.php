<?php
class SuppletiveModel extends CI_Model {
    protected $table = 'suppletive';

    public function getAllSuppletives() {
        return $this->db->get($this->table)->result();
    }

    public function getSuppletiveById($id) {
        return $this->db->where('idSupp', $id)->get($this->table)->row();
    }

    public function insertSuppletive($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateSuppletive($id, $data) {
        return $this->db->where('idSupp', $id)->update($this->table, $data);
    }

    public function deleteSuppletive($id) {
        return $this->db->where('idSupp', $id)->delete($this->table);
    }
}
?>