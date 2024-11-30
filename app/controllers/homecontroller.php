<?php
class HomeController extends Controller {
    public function index() {
        $this->view('pages/common/Landing');
    }


    public function login(){
        $this->view('pages/common/login');
    }
    public function loginAdmin(){
        $this->view('pages/common/loginAdmin');
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


    public function About() {
        $this->view('pages/common/About');
    }
    public function Contact() {
        $this->view('pages/common/Contact');
    }
    public function Faq() {
        $this->view('pages/common/Faq');
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

