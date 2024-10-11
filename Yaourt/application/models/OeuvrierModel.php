<?php
class OeuvrierModel extends CI_Model {
    protected $table = 'oeuvrier';

    public function getAllOeuvriers() {
        return $this->db->get($this->table)->result();
    }

    public function getOeuvrierById($id) {
        return $this->db->where('idOeuvre', $id)->get($this->table)->row();
    }

    public function insertOeuvrier($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateOeuvrier($id, $data) {
        return $this->db->where('idOeuvre', $id)->update($this->table, $data);
    }

    public function deleteOeuvrier($id) {
        return $this->db->where('idOeuvre', $id)->delete($this->table);
    }
    
    public function getOeuvrierByCentre($idcentre) {
        return $this->db->where('idCentre', $idcentre)->get($this->table)->result();
    }
}
?>