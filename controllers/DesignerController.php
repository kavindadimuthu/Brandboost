<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class DesignerController extends BaseController
{
    public function __construct()
    {
        // \app\core\Helpers\AuthHelper::CheckPermission('designer');
    }

    public function dashboard($req, $res)
    {
        $this->renderLayout('main', 'pages/common/seller_dashboard');
    }

    public function myGigs($req, $res)
    {
        $this->renderLayout('main', 'pages/designer/my_gigs');
    }

    public function addGig($req, $res)
    {
        $this->renderLayout('main', 'pages/designer/add_gig');
    }

    public function editGig($req, $res)
    {
        $this->renderLayout('main', 'pages/designer/edit_gig');
    }

    public function ordersList($req, $res)
    {
        $this->renderLayout('main', 'pages/common/seller_orders_list');
    }

    public function orderDetails($req, $res)
    {
        $this->renderLayout('main', 'pages/common/seller_order_details');
    }

    public function customPackages($req, $res)
    {
        $this->renderLayout('main', 'pages/common/custom_packages');
    }

    public function offerPackage($req, $res)
    {
        $this->renderLayout('main', 'pages/common/offer_package');
    }

    public function earnings($req, $res)
    {
        $this->renderLayout('main', 'pages/common/earnings');
    }

    public function editProfile($req, $res)
    {
        $this->renderLayout('main', 'pages/common/edit_profile');
    }

    public function changePassword($req, $res)
    {
        $this->renderLayout('main', 'pages/common/change_password');
        // $this->renderLayout('guest_layout', 'pages/common/change_password');
    }

    public function payoutMethods($req, $res)
    {
        $this->renderLayout('main', 'pages/common/payout_methods');
    }


    // API endpoints
    public function createGig($req, $res)
    {
        $serviceModel = $this->model('Services\\Service');

        $gigs = [
            [
                'service_id' => 6,
                'user_id' => 16,
                'title' => 'Review on podcast recording recommendation video',
                'description' => 'Provide a comprehensive review on podcast recording with recommendations and actionable insights.',
                'cover_image' => 'https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg',
                'media' => 'https://via.placeholder.com/40',
                'service_type' => 'gig',
                'platforms' => 'YouTube, Podcast',
                'delivery_formats' => 'PDF, Video',
                'tags' => 'podcast, review, recording',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'service_id' => 7,
                'user_id' => 16,
                'title' => 'Professional Facebook Ads Campaign Management',
                'description' => 'Expert Facebook ads campaign management to maximize your business reach.',
                'cover_image' => 'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/68748376/original/7d9d3d6e4efd2e35bc8e8b3cc2dcf2fde1e27271/design-2-outstanding-logo-in-24-hours.jpg',
                'media' => 'https://via.placeholder.com/40',
                'service_type' => 'gig',
                'platforms' => 'Facebook, Instagram',
                'delivery_formats' => 'Report, PDF',
                'tags' => 'Facebook, ads, campaign',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];


        // Loop through the gigs and create each one
        foreach ($gigs as $gig) {
            $serviceModel->create($gig);
        }

        // Provide a response indicating success
        $res->json(['message' => 'Gigs created successfully!']);
    }



    // *************
}
