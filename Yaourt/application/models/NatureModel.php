<?
class NatureModel extends CI_Model {
    protected $table = 'nature';

    public function getAllNatures() {
        return $this->db->get($this->table)->result();
    }

    public function getNatureById($id) {
        return $this->db->where('idNature', $id)->get($this->table)->row();
    }

    public function insertNature($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateNature($id, $data) {
        return $this->db->where('idNature', $id)->update($this->table, $data);
    }

    public function deleteNature($id) {
        return $this->db->where('idNature', $id)->delete($this->table);
    }
}
?>