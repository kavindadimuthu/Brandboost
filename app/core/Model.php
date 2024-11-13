<?php
// This is base Model class for all models

class Model {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
}

