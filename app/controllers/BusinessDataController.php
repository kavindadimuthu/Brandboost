<?php

class BusinessDataController extends Controller{

    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'businessman') {
            header('location: /');
        }
    }
}