<?
class RepartitionModel extends CI_Model {
    protected $table = 'repartition';

    public function getAllRepartitions() {
        return $this->db->get($this->table)->result();
    }

    public function getRepartitionById($id) {
        return $this->db->where('idRepartition', $id)->get($this->table)->row();
    }

    public function insertRepartition($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateRepartition($id, $data) {
        return $this->db->where('idRepartition', $id)->update($this->table, $data);
    }

    public function deleteRepartition($id) {
        return $this->db->where('idRepartition', $id)->delete($this->table);
    }
}
?>