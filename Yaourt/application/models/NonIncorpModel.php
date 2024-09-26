<?
class NonIncorpModel extends CI_Model {
    protected $table = 'nonIncorp';

    public function getAllMotifs() {
        return $this->db->get($this->table)->result();
    }

    public function getMotifById($id) {
        return $this->db->where('idMotif', $id)->get($this->table)->row();
    }

    public function insertMotif($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateMotif($id, $data) {
        return $this->db->where('idMotif', $id)->update($this->table, $data);
    }

    public function deleteMotif($id) {
        return $this->db->where('idMotif', $id)->delete($this->table);
    }
}
?>