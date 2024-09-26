<?php
class ChargeGeneralModel extends CI_Model {
    protected $table = 'chargeGeneral';

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

    // Fonction pour insérer une charge générale et ses répartitions
    public function insertChargeGeneral($data) {
        if ($this->db->insert($this->table, $data)) {
            $idGeneral = $this->db->insert_id();
            
            $centres = [1, 2, 3, 4];
            foreach ($centres as $idCentre) {
                $pourcentage = isset($data['pourcentages'][$idCentre]) ? $data['pourcentages'][$idCentre] : 0;

                $repartitionData = [
                    'idGeneral' => $idGeneral,
                    'idCentre' => $idCentre,
                    'pourcentage' => $pourcentage
                ];
                
                $this->db->insert('repartition', $repartitionData);
            }
            return $idGeneral; 
        }
        return false;
    }
}
?>