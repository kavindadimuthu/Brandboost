<?php
class HomeController extends Controller
{
    public function index()
    {
        $this->view('pages/common/Landing');
    }


    public function login()
    {
        if (isset($_SESSION['role'])) {
            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: /adminviewcontroller/admindashboard');
                    break;
                case 'businessman':
                    header('Location: /BusinessViewController/profile');
                    break;
                case 'influencer':
                    header('Location: /InfluencerViewController/influencerDashboard');
                    break;
                case 'designer':
                    header('Location: /DesignerViewController/designerDashboard');
                    break;
            }
        }
        $this->view('pages/common/login');
    }
    public function loginAdmin()
    {
        if (isset($_SESSION['role'])) {
            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: /adminviewcontroller/admindashboard');
                    break;
                case 'businessman':
                    header('Location: /BusinessViewController/profile');
                    break;
                case 'influencer':
                    header('Location: /InfluencerViewController/influencerDashboard');
                    break;
                case 'designer':
                    header('Location: /DesignerViewController/designerDashboard');
                    break;
            }
        }
        $this->view('pages/common/loginAdmin');
    }

    //Registration
    public function register()
    {
        $this->view('pages/common/register');
    }

    public function registerBusiness()
    {
        $this->view('pages/common/registerBusiness');
    }
    public function registerInfluencer()
    {
        $this->view('pages/common/registerInfluencer');
    }
    public function registerDesigner()
    {
        $this->view('pages/common/registerDesigner');
    }


    public function About()
    {
        $this->view('pages/common/About');
    }
    public function Contact()
    {
        $this->view('pages/common/Contact');
    }
    public function Faq()
    {
        $this->view('pages/common/Faq');
    }
    public function Chat()
    {
        if(!isset($_SESSION['role'])){
            header('Location: /homecontroller/login');
        }
        $this->view('pages/common/chat');
    }




    public function serviceCard()
    {
        $this->view('components/common/serviceCard');
    }
    public function packageCard()
    {
        $this->view('components/common/packageCard');
    }
    public function cardSlider()
    {
        $this->view('components/common/cardSlider');
    }
    public function carousel()
    {
        $this->view('components/common/carousel');
    }


    public function chooseRole()
    {
        $this->view('pages/register/chooseRole');
    }



}

