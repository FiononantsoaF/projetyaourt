<?php

class CentreModel extends CI_Model {
    protected $table = 'centre';

    public function getAllCentres() {
        return $this->db->get($this->table)->result();
    }

    public function getCentreById($id) {
        return $this->db->where('idCentre', $id)->get($this->table)->row();
    }

    public function insertCentre($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateCentre($id, $data) {
        return $this->db->where('idCentre', $id)->update($this->table, $data);
    }

    public function deleteCentre($id) {
        return $this->db->where('idCentre', $id)->delete($this->table);
    }
}
?>