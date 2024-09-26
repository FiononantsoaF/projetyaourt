<?php
class AdminModel extends CI_Model {
    protected $table = 'admin';

    public function getAllAdmins() {
        return $this->db->get($this->table)->result();
    }

    public function getAdminById($id) {
        return $this->db->where('idAdmin', $id)->get($this->table)->row();
    }

    public function insertAdmin($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateAdmin($id, $data) {
        return $this->db->where('idAdmin', $id)->update($this->table, $data);
    }

    public function deleteAdmin($id) {
        return $this->db->where('idAdmin', $id)->delete($this->table);
    }
    
    public function verifyAdmin($nomAdmin, $mdp) {
        $this->db->where('nomAdmin', $nomAdmin);
        $this->db->where('mdp', $mdp);
        $query = $this->db->get($this->table);

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}
?>