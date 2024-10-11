<?php 

class QuestionModel extends CI_Model {
    protected $table = 'questionnaire';

    public function getAllQuestions() {
        return $this->db->get($this->table)->result();
    }

    public function getQuestionById($id) {
        return $this->db->where('idquestion', $id)->get($this->table)->row();
    }

    public function insertQuestion($data) {
        return $this->db->insert($this->table, $data);
    }

    public function updateQuestion($id, $data) {
        return $this->db->where('idquestion', $id)->update($this->table, $data);
    }

    public function deleteQuestion($id) {
        return $this->db->where('idquestion', $id)->delete($this->table);
    }
}
?>