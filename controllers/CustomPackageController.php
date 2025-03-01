<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use \app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;
use app\models\Services\Service;
use app\models\Services\ServicePackage;
use app\models\Services\ServiceCustomPackage;

class CustomPackageController extends BaseController
{
    public function getCustomPackageList($request, $response)
    {
        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $getBySeller = $queryParams['seller'] ?? false;
        if ($getBySeller) {
            $sellerId = $queryParams['seller_id'];
        }
        $getByBuyer = $queryParams['buyer'] ?? false;
        if ($getByBuyer) {
            $buyerId = $queryParams['buyer_id'];
        }

        $conditions = [];
        if($getBySeller) {
            $conditions['seller_id'] = $sellerId;
        } else if($getByBuyer) {
            $conditions['customer_id'] = $buyerId;
        }
        // $conditions['status'] = 'accepted';

        $options = [];

        $serviceCustomPackageModel = $this->model('Services\ServiceCustomPackage');
        $customPackages = $serviceCustomPackageModel->getCustomPackagesWithServiceDetails($conditions, $options);

        $response->sendJson($customPackages);
    }

    public function getCustomPackageProfile($request, $response)
    {
        $customPackageId = $request->getParam('id');

        error_log('Custom Package ID: ' . $customPackageId);

        $serviceCustomPackageModel = $this->model('Services\ServiceCustomPackage');
        $serviceModel = $this->model('Services\Service');
        $customPackage = $serviceCustomPackageModel->getCustomPackageById($customPackageId);
        $service = $serviceModel->readOne(['service_id' => $customPackage['service_id']]);

        $customPackage['service'] = $service;

        error_log(print_r($customPackage, true));

        $response->sendJson($customPackage);
    }

    public function createCustomPackage($request, $response)
    {

        $data = $request->getParsedBody();
        $data['customer_id'] = AuthHelper::getCurrentUser()['user_id'];

        $serviceModel = $this->model('Services\Service');
        $service = $serviceModel->readOne(['service_id' => $data['service_id']]);
        error_log(print_r($service, true));
        $data['seller_id'] = $service['user_id'];
        $data['status'] = 'pending';

        $serviceCustomPackageModel = $this->model('Services\ServiceCustomPackage');
        $result = $serviceCustomPackageModel->create($data);

        if ($result) {
            $response->sendJson(['success' => true]);
        } else {
            $response->sendJson(['success' => false]);
        }
    }

    public function updateCustomPackageProfile($request, $response)
    {
        $customPackageId = $request->getParam('id');
        $data = $request->getParsedBody();

        error_log('Updating custom package: ' . $customPackageId);
        error_log(print_r($data, true));



        $updatedCustomPackage['custom_package_id'] = $customPackageId;
        $updatedCustomPackage['benefits_requested'] = $data['benefits'];
        $updatedCustomPackage['delivery_days_requested'] = $data['delivery'];
        $updatedCustomPackage['revisions_requested'] = $data['revisions'];
        $updatedCustomPackage['price_requested'] = $data['price'];
        $updatedCustomPackage['status'] = 'accepted';

        error_log(print_r($updatedCustomPackage, true));

        $serviceCustomPackageModel = $this->model('Services\ServiceCustomPackage');
        $result = $serviceCustomPackageModel->updateCustomPackageById($customPackageId, $updatedCustomPackage);

        if ($result) {
            $response->sendJson(['success' => true]);
        } else {
            $response->sendJson(['success' => false]);
        }
    }

    public function deleteCustomPackage($request, $response)
    {
        $customPackageId = $request->getParam('id');

        $serviceCustomPackageModel = $this->model('Services\ServiceCustomPackage');
        $result = $serviceCustomPackageModel->deleteCustomPackageById($customPackageId);

        if ($result) {
            $response->sendJson(['success' => true]);
        } else {
            $response->sendJson(['success' => false]);
        }
    }
}

