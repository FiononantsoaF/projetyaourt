<?php
class ChargeSuppModel extends CI_Model {
    protected $table = 'chargeSupp';

    public function getAllCharges() {
        return $this->db->get($this->table)->result();
    }

    public function getChargeById($id) {
        return $this->db->where('idCharge', $id)->get($this->table)->row();
    }

    public function insertCharge($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateCharge($id, $data) {
        return $this->db->where('idCharge', $id)->update($this->table, $data);
    }

    public function deleteCharge($id) {
        return $this->db->where('idCharge', $id)->delete($this->table);
    }
}
?>