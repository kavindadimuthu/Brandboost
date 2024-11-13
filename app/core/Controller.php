<?php
// This is base Controller class for all controllers

class Controller {
    public function view($view, $data = []) {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    public function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }
}

