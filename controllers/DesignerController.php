<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

use app\core\BaseModel;
use app\models\Services\ServicePackage;
use app\core\Helpers\ResponseHelper;

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
        // Extract data from the request
        $inputData = $req->getParsedBody();

        // Simulated input data (mimicking frontend input)
        // $inputData = [
        //     'user_id' => 1,
        //     'title' => 'Professional Logo Design',
        //     'description' => 'I will create a professional logo tailored to your brand.',
        //     'cover_image' => 'logo_cover.jpg',
        //     'imageUploadPaths' => [
        //         'https://example.com/image1.jpg',
        //         'https://example.com/image2.jpg',
        //         'https://example.com/image3.jpg',
        //         'https://example.com/image4.jpg'
        //     ],
        //     'service_type' => 'graphic_design',
        //     'platforms' => ['Facebook', 'Instagram'],
        //     'delivery_formats' => ['PNG', 'JPEG'],
        //     'tags' => ['logo', 'branding', 'design'],
        //     'packages' => [
        //         [
        //             'package_type' => 'Basic',
        //             'benefits' => 'Simple logo design with one revision',
        //             'delivery_days' => 2,
        //             'revisions' => 1,
        //             'price' => 50
        //         ],
        //         [
        //             'package_type' => 'Premium',
        //             'benefits' => 'Advanced logo design with unlimited revisions',
        //             'delivery_days' => 7,
        //             'revisions' => null,
        //             'price' => 150
        //         ]
        //     ]
        // ];



        // Validate incoming data


        if (!isset($inputData['user_id'], $inputData['title'], $inputData['description'], $inputData['cover_image'], $inputData['service_type'], $inputData['packages']) || empty($inputData['packages'])) {
            $res->sendError('Invalid data provided.', 400);
            return;
        }

        $serviceData = [
            'user_id'          => $inputData['user_id'],
            'title'            => $inputData['title'],
            'description'      => $inputData['description'],
            'cover_image'      => $inputData['cover_image'],
            // 'media'            => json_encode( $inputData['imageUploadPaths']) ?? null,
            'media'            => null,
            'service_type'     => $inputData['service_type'],
            'platforms'        => json_encode($inputData['platforms']) ?? null,
            'delivery_formats' => json_encode($inputData['delivery_formats']) ?? null,
            'tags'             => json_encode($inputData['tags']) ?? null,
        ];

        $serviceModel = new BaseModel('service');
        $servicePackageModel = new ServicePackage();

        try {
            // Begin transaction
            $serviceModel->beginTransaction();

            // Insert service data
            $serviceModel->create($serviceData);
            $serviceId = $serviceModel->lastInsertId();

            // Insert service packages
            foreach ($inputData['packages'] as $package) {
                if (!isset($package['type'], $package['benefits'], $package['delivery_days'], $package['price'])) {
                    throw new \Exception('Invalid package data provided.');
                }

                $packageData = [
                    'service_id'    => $serviceId,
                    'package_type'  => $package['type'],
                    'benefits'      => $package['benefits'],
                    'delivery_days' => $package['delivery_days'],
                    'revisions'     => $package['revisions'] ?? null,
                    'price'         => $package['price'],
                ];

                $servicePackageModel->create($packageData);
            }

            // Commit transaction
            $serviceModel->commit();

            $res->sendJson([
                'success' => true,
                'message' => 'Gig created successfully.',
                'service_id' => $serviceId,
            ]);
        } catch (\Exception $e) {
            // Rollback transaction in case of failure
            $serviceModel->rollback();

            $res->sendError('Failed to create gig. ' . $e->getMessage(), 500);
        }
    }


    // *************
}
