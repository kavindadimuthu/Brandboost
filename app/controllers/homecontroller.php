<?php
class HomeController extends Controller {
    public function index() {
        $this->view('pages/common/index');
    }
    public function about() {
        $this->view('pages/common/about');
    }
}

