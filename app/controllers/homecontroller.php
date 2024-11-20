<?php
class HomeController extends Controller {
    public function index() {
        $this->view('pages/common/landing');
    }


    public function login(){
        $this->view('pages/common/login');
    }

    //Registration
    public function register(){
        $this->view('pages/common/register');
    }
    public function registerBusiness(){
        $this->view('pages/common/registerBusiness');
    }
    public function registerInfluencer(){
        $this->view('pages/common/registerInfluencer');
    }
    public function registerDesigner(){
        $this->view('pages/common/registerDesigner');
    }


    public function about() {
        $this->view('pages/common/about');
    }
    public function contact() {
        $this->view('pages/common/contact');
    }




    public function serviceCard() {
        $this->view('components/common/serviceCard');
    }
    public function packageCard() {
        $this->view('components/common/packageCard');
    }
    public function cardSlider() {
        $this->view('components/common/cardSlider');
    }


    public function chooseRole() {
        $this->view('pages/register/chooseRole');
    }


}

