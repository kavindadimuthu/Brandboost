<?php
class HomeController extends Controller {
    public function index() {
        $this->view('pages/common/landing');
    }
    public function login(){
        $this->view('pages/common/login');
    }
    public function about() {
        $this->view('pages/common/about');
    }
}

