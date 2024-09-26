<?php
class TypeChargeModel extends CI_Model {
    protected $table = 'typeCharge';

    public function getAllTypeCharges() {
        return $this->db->get($this->table)->result();
    }

    public function getTypeChargeById($id) {
        return $this->db->where('idTypeCharge', $id)->get($this->table)->row();
    }

    public function insertTypeCharge($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateTypeCharge($id, $data) {
        return $this->db->where('idTypeCharge', $id)->update($this->table, $data);
    }

    public function deleteTypeCharge($id) {
        return $this->db->where('idTypeCharge', $id)->delete($this->table);
    }
}
?>