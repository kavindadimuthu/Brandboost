<?php
// FILE: app/models/FaqModel.php

class FaqModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllFaqs() {
        $this->db->query("SELECT * FROM faq");
        return $this->db->resultSet();
    }

    public function getFaqById($id) {
        $this->db->query("SELECT * FROM faq WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addFaq($data) {
        $this->db->query("INSERT INTO faq (question, answer) VALUES (:question, :answer)");
        $this->db->bind(':question', $data['question']);
        $this->db->bind(':answer', $data['answer']);
        return $this->db->execute();
    }

    public function updateFaq($data) {
        $this->db->query("UPDATE faq SET question = :question, answer = :answer WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':question', $data['question']);
        $this->db->bind(':answer', $data['answer']);
        return $this->db->execute();
    }

    public function deleteFaq($id) {

        $this->db->query("DELETE FROM faq WHERE id = :id");
        $this->db->bind(':id', $id);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}