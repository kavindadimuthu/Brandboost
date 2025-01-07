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
        // Extract data from the request
        $inputData = $req->getParsedBody();
        $inputFileData = $req->getFiles();

        // Validate required fields
        if (!isset($inputData['title'], $inputData['description'], $inputData['serviceType'], $inputData['packages'])) {
            $res->sendError('Missing required fields', 400);
            return;
        }

        // Define upload directory
        $uploadDir = __DIR__ . '/../public/cdn_uploads/services/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Handle file uploads and get paths
        $uploadedImages = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        
        // Function to handle image upload
        $handleImageUpload = function($file) use ($uploadDir, $allowedTypes) {
            if (!in_array($file['type'], $allowedTypes)) {
                throw new \Exception('Invalid file type. Only JPG, PNG and WEBP are allowed.');
            }

            // Generate unique filename
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid('service_') . '_' . time() . '.' . $extension;
            $filepath = $uploadDir . $filename;

            // Move uploaded file
            if (!move_uploaded_file($file['tmp_name'], $filepath)) {
                throw new \Exception('Failed to upload file.');
            }

            // Return relative path for database storage
            return 'cdn_uploads/services/' . $filename;
        };

        try {
            // Handle main image
            if (isset($inputFileData['mainImage']) && $inputFileData['mainImage']['error'] === 0) {
                $coverImage = $handleImageUpload($inputFileData['mainImage']);
                $uploadedImages[] = $coverImage;
            } else {
                $res->sendError('Main image is required', 400);
                return;
            }

            // Handle additional images
            for ($i = 0; $i < 4; $i++) {
                $key = "additionalImage{$i}";
                if (isset($inputFileData[$key]) && $inputFileData[$key]['error'] === 0) {
                    $imagePath = $handleImageUpload($inputFileData[$key]);
                    $uploadedImages[] = $imagePath;
                }
            }

            // Prepare service data
            $serviceData = [
                'user_id'          => $_SESSION['user_id'] ?? 1,
                'title'            => $inputData['title'],
                'description'      => $inputData['description'],
                'cover_image'      => $coverImage,
                'media'            => json_encode($uploadedImages),
                'service_type'     => 'gig',
                'platforms'        => json_encode($inputData['platforms']),
                'delivery_formats' => json_encode($inputData['delivery_formats']),
                'tags'            => $inputData['tags'],
            ];


            $serviceModel = $this->model('Services\\Service');
            $servicePackageModel = $this->model('Services\\ServicePackage');

            // Begin transaction
            $serviceModel->beginTransaction();

            // Insert service data
            $serviceModel->create($serviceData);
            $serviceId = $serviceModel->lastInsertId();

            // Insert packages
            foreach (['basic', 'premium'] as $packageType) {
                if (isset($inputData['packages'][$packageType])) {
                    $package = $inputData['packages'][$packageType];
                    
                    $packageData = [
                        'service_id'    => $serviceId,
                        'package_type'  => $package['type'],
                        'benefits'      => $package['benefits'],
                        'delivery_days' => $package['delivery_days'],
                        'revisions'     => $package['revisions'],
                        'price'         => $package['price'],
                    ];

                    $servicePackageModel->create($packageData);
                }
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
            if (isset($serviceModel)) {
                $serviceModel->rollback();
            }

            // Clean up any uploaded files in case of database failure
            foreach ($uploadedImages as $imagePath) {
                $fullPath = __DIR__ . '/../' . $imagePath;
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }

            $res->sendError('Failed to create gig. ' . $e->getMessage(), 500);
        }
    }


    // *************
}
