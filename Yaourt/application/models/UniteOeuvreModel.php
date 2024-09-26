<?php
class UniteOeuvreModel extends CI_Model {
    protected $table = 'uniteOeuvre';

    public function getAllUnites() {
        return $this->db->get($this->table)->result();
    }

    public function getUniteById($id) {
        return $this->db->where('idUnite', $id)->get($this->table)->row();
    }

    public function insertUnite($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateUnite($id, $data) {
        return $this->db->where('idUnite', $id)->update($this->table, $data);
    }

    public function deleteUnite($id) {
        return $this->db->where('idUnite', $id)->delete($this->table);
    }
}
?>