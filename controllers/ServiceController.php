<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use \app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;
use app\models\Services\Service;
use app\models\Services\ServicePackage;

use app\core\Helpers\DebugHelper;

class ServiceController extends BaseController
{
    /**
     * Fetch a list of services provided by influencers and designers.
     * Supports search, filtering, and pagination.
     *
     * @param object $request  Request object containing query parameters.
     * @param object $response Response object for returning HTTP responses.
     */
    public function getServiceList($request, $response): void
    {
        error_log("entered to getServiceList");
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $includeUser =  $queryParams['include_user'] ?? false;
        $search = $queryParams['query'] ?? null;
        $serviceType = $queryParams['type'] ?? null;
        $role = $queryParams['role'] ?? null; // 'influencer' or 'designer'
        $user = isset($queryParams['current_user']) && $queryParams['current_user'] == 'true' ? AuthHelper::getCurrentUser()['user_id'] : null;
        $priceMin = isset($queryParams['price_min']) ? (float)$queryParams['price_min'] : null;
        $priceMax = isset($queryParams['price_max']) ? (float)$queryParams['price_max'] : null;
        $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 20;
        $offset = isset($queryParams['offset']) ? (int)$queryParams['offset'] : 0;

        $sort = $queryParams['sort'] ?? null;
        // DebugHelper::dump($sort);

        // $sortBy = $queryParams['sort'] ?? 'created_at';
        // $orderDir = $queryParams['order_dir'] ?? 'asc';

        if($sort){
            if($sort == 'newest'){
                $sortBy = 'created_at';
                $orderDir = 'desc';
            } else if($sort == 'oldest'){
                $sortBy = 'created_at';
                $orderDir = 'asc';
            } else if($sort == 'price_asc'){
                $sortBy = 'price';
                $orderDir = 'asc';
            } else if($sort == 'price_desc'){
                $sortBy = 'price';
                $orderDir = 'desc';
            } else {
                $sortBy = 'created_at';
                $orderDir = 'asc';
            }
        } else {
            $sortBy = 'created_at';
            $orderDir = 'asc';
        }

        // Retrieve the necessary models
        $serviceModel = $this->model('Services\Service');
        $servicePackageModel = $this->model('Services\ServicePackage');

        // Build conditions for the query
        $conditions = [];
        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => $sortBy . ' ' . (strtolower($orderDir) === 'desc' ? 'desc' : 'asc'),
        ];

        if ($search) {
            $options['search'] = $search;
            $options['searchColumns'] = ['title', 'description'];
        }

        if ($serviceType) {
            $conditions['service_type'] = $serviceType;
        }

        // if ($role) {
        //     $conditions['service_type'] = $role; // Filter by role (influencer or designer)
        // }
        
        if ($user) {
            $conditions['user_id'] = $user; // Filter by role (influencer or designer)
        }

        // Fetch services
        $services = $serviceModel->read($conditions, $options);

        // If no services found, return an empty list
        if (!$services) {
            $response->sendJson(['services' => [], 'message' => 'No services found.']);
            return;
        }

        // Append service packages and filter by price range if needed
        foreach ($services as &$service) {
            $packages = $servicePackageModel->getPackagesByServiceId($service['service_id']);
            if ($priceMin !== null || $priceMax !== null) {
                $packages = array_filter($packages, function ($package) use ($priceMin, $priceMax) {
                    $price = (float)$package['price'];
                    return ($priceMin === null || $price >= $priceMin) &&
                           ($priceMax === null || $price <= $priceMax);
                });
            }
            $service['packages'] = array_values($packages);
        }

        // // Append user details if requested
        if($includeUser){
            $userModel = $this->model('Users\\User');
            foreach ($services as &$service) {
                $user = $userModel->getUserById($service['user_id']);
                $service['user'] = $user;
            }
        }

        // Send the response with service data
        $response->sendJson(['services' => $services]);
    }

    
    /**
     * Fetch all details of a specific service, including associated details like packages.
     * Supports filtering and additional query conditions.
     *
     * @param object $request  Request object containing query parameters.
     * @param object $response Response object for returning HTTP responses.
     */
    public function getServiceProfile($request, $response): void
    {
        error_log("entered to getServiceProfile");
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        // $serviceId = $queryParams['service_id'] ?? null;
        $serviceId = $queryParams['id'] ?? null;
        $includeAnalytics = $queryParams['include_analytics'] ?? false;
        $includecustomPackages = $queryParams['include_custom_packages'] ?? false;
        $includeUser =  $queryParams['include_user'] ?? false;

        // Validate required parameter
        if (!$serviceId) {
            $response->sendError('Service ID is required.', 400);
            return;
        }

        // Retrieve the necessary models
        $serviceModel = $this->model('Services\Service');
        $servicePackageModel = $this->model('Services\ServicePackage');
        $serviceAnalyticsModel = $this->model('Services\ServiceAnalytics');
        $serviceCustomPackageModel = $this->model('Services\ServiceCustomPackage');

        // Fetch the main service details
        $service = $serviceModel->getServiceById($serviceId);
        if (!$service) {
            $response->sendError('Service not found.', 404);
            return;
        }
        // Decode JSON fields
        $service['media'] = json_decode($service['media']);
        // $responseData['data']['service'] = $service;

        // Fetch associated packages for the service
        $packages = $servicePackageModel->getPackagesByServiceId($serviceId);
        $service['packages'] = array_values($packages);

        // Optionally include analytics data
        if ($includeAnalytics) {
            $analytics = $serviceAnalyticsModel->getAnalyticsByServiceId($serviceId);
            $service['analytics'] = $analytics;
        }

        // Include custom package requests (if any)
        if ($includecustomPackages) {
            $customPackages = $serviceCustomPackageModel->getCustomPackagesByServiceId($serviceId);
            $service['custom_packages'] = $customPackages;
        }

        // Include user details if requested
        if ($includeUser){
            $userModel = $this->model('Users\\User');
            $user = $userModel->getUserById($service['user_id']);
            $service['user'] = $user;
        }

        // Send the response with complete service details
        $response->sendJson($service);
    }

    /**
     * Create a new service.
     * 
     * @param Request $request The HTTP request object containing form data and files.
     * @param Response $response The HTTP response object for sending responses.
     * @return Response A response indicating success or failure of service creation.
     */
    public function createService($request, $response) {

        // Extract form data from the request
        $formData = $request->getParsedBody();
        $uploadedFiles = $request->getFiles();

        // Validate required fields
        if (empty($formData['title']) || empty($formData['description']) || empty($formData['serviceType'])) {
            return $response->sendError('Missing required fields', 400);
        }

        // Handle cover image upload
        $coverImagePath = null;
        if (!empty($uploadedFiles['mainImage']) && $uploadedFiles['mainImage']['error'] === UPLOAD_ERR_OK) {
            $coverImagePath = FileHandler::imageUploader($uploadedFiles['mainImage'], 'cdn_uploads/services/');
        }

        // Handle media uploads
        $mediaPaths = [];
        for ($i = 0; $i < 4; $i++) {
            $key = "additionalImage{$i}";
            if (isset($uploadedFiles[$key]) && $uploadedFiles[$key]['error'] === UPLOAD_ERR_OK) {
                $file = $uploadedFiles[$key];
                $mediaPath = FileHandler::fileUploader($file, 'cdn_uploads/services/');
                if ($mediaPath) {
                    $mediaPaths[] = $mediaPath;
                }
            }
        }

        if(AuthHelper::getCurrentUser()['role'] == 'designer'){
            $formData['service_type'] = 'gig';
        } else if (AuthHelper::getCurrentUser()['role'] == 'influencer'){
            $formData['service_type'] = 'promotion';
        }

        // Prepare service data for insertion
        $serviceData = [
            'user_id' => $formData['user_id'] ?? AuthHelper::getCurrentUser()['user_id'],
            'title' => $formData['title'],
            'description' => $formData['description'],
            'cover_image' => $coverImagePath,
            'media' => json_encode($mediaPaths),
            'service_type' => $formData['service_type'] ?? 'gig',
            'platforms' => $formData['platforms'] ?? null,
            'delivery_formats' => $formData['delivery_formats'] ?? null,
            'tags' => $formData['tags'] ?? null
        ];

        // Create a new service in the database
        $service = new Service();
        if ($service->createService($serviceData)) {
            // Retrieve the ID of the newly created service
            $serviceId = $service->getLastInsertId();

            // Create associated service packages if provided
            foreach ($formData['packages'] as $packageType => $packageData) {
                if (in_array($packageType, ['basic', 'premium'])) {
                    $package = new ServicePackage();
                    $packageData['service_id'] = $serviceId;
                    $package->createPackage($packageData);
                }
            }

            // Send a success response with the created service details
            $response->setStatusCode(201);
            return $response->sendJson(['message' => 'Service created successfully', 'service' => $service->getServiceById($serviceId)]);
        } else {
            // Send an error response if service creation fails
            return $response->sendError('Failed to create service', 500);
        }
    }


    /**
     * Update an existing service.
     * 
     * @param Request $request The HTTP request object containing form data and files.
     * @param Response $response The HTTP response object for sending responses.
     * @return Response A response indicating success or failure of service update.
     */
    public function updateService($request, $response) {
        // Extract form data from the request
        $formData = $request->getParsedBody();
        $uploadedFiles = $request->getFiles();

        // DebugHelper::logArray($formData);

        $queryParams = $request->getQueryParams();
        $serviceId = $queryParams['id'] ?? null;
        // $serviceId = $formData['service_id'] ?? null;

        // Validate required fields
        if (!$serviceId || empty($formData['title']) || empty($formData['description'])) {
            return $response->sendError('Missing required fields', 400);
        }

        // Retrieve the existing service
        $service = new Service();
        $existingService = $service->getServiceById($serviceId);
        if (!$existingService) {
            return $response->sendError('Service not found', 404);
        }

        // Handle cover image upload
        $coverImagePath = $existingService['cover_image'];
        if (!empty($uploadedFiles['mainImage']) && $uploadedFiles['mainImage']['error'] === UPLOAD_ERR_OK) {
            $coverImagePath = FileHandler::imageUploader($uploadedFiles['mainImage'], 'cdn_uploads/services/');
        }

        // Handle media uploads
        $mediaPaths = json_decode($existingService['media'], true) ?? [];
        for ($i = 0; $i < 4; $i++) {
            $key = "additionalImage{$i}";
            if (isset($uploadedFiles[$key]) && $uploadedFiles[$key]['error'] === UPLOAD_ERR_OK) {
                $file = $uploadedFiles[$key];
                $mediaPath = FileHandler::fileUploader($file, 'cdn_uploads/services/');
                if ($mediaPath) {
                    $mediaPaths[] = $mediaPath;
                }
            }
        }

        // Handle removal of existing images
        if (!empty($formData['removedImages'])) {
            $removedImages = json_decode($formData['removedImages'], true);
            // Remove the specified images from the existing media
            $removedImages = array_map(function($image) {
                return ltrim($image, '/'); // Remove leading slash
            }, $removedImages);

            foreach ($removedImages as $removedImage) {
                $index = array_search($removedImage, $mediaPaths);
                error_log("index is", $index);
                if ($index !== false) {
                    unset($mediaPaths[$index]);
                    // Remove the image from the CDN
                    FileHandler::deleteFile('cdn_uploads/services/' . basename($removedImage));
                }
            }
            // Re-index array after unset
            $mediaPaths = array_values($mediaPaths);
        }

        // Prepare service data for update
        $serviceData = [
            'title' => $formData['title'],
            'description' => $formData['description'],
            'cover_image' => $coverImagePath,
            'media' => json_encode($mediaPaths),
            'service_type' => $formData['service_type'] ?? $existingService['service_type'],
            'platforms' => $formData['platforms'] ?? $existingService['platforms'],
            'delivery_formats' => $formData['deliveryFormats'] ?? $existingService['delivery_formats'],
            'tags' => $formData['tags'] ?? $existingService['tags']
        ];

        // Update the service in the database
        if ($service->updateServiceById($serviceId, $serviceData)) {
            // Update associated service packages if provided
            if (!empty($formData['packages'])) {
                $packageModel = new ServicePackage();
                foreach ($formData['packages'] as $packageType => $packageData) {
                    if (in_array($packageType, ['basic', 'premium'])) {
                        $existingPackage = $packageModel->getPackagesByServiceId($serviceId, ['package_type' => $packageType]);
                        if ($existingPackage) {
                            $packageModel->updatePackageById($existingPackage['package_id'], $packageData);
                        } else {
                            $packageData['service_id'] = $serviceId;
                            $packageModel->createPackage($packageData);
                        }
                    }
                }
            }

            // Send a success response with the updated service details
            $response->setStatusCode(200);
            return $response->sendJson(['message' => 'Service updated successfully', 'service' => $service->getServiceById($serviceId)]);
        } else {
            // Send an error response if service update fails
            return $response->sendError('Failed to update service', 500);
        }
    }

    /**
     * Delete a service along with its associated packages and media files.
     * 
     * @param Request $request The HTTP request object containing the service ID.
     * @param Response $response The HTTP response object for sending responses.
     * @return Response A response indicating success or failure of the service deletion.
     */
    public function deleteService($request, $response) {
        // Extract the service ID from the request
        $serviceId = $request->getParam('id');
        
        // Validate the service ID
        if (!$serviceId) {
            return $response->sendError('Service ID is required', 400);
        }

        // Retrieve the existing service
        $service = new Service();
        $existingService = $service->getServiceById($serviceId);
        if (!$existingService) {
            return $response->sendError('Service not found', 404);
        }

        // Delete associated media files from the CDN
        $mediaPaths = json_decode($existingService['media'], true) ?? [];
        foreach ($mediaPaths as $mediaPath) {
            FileHandler::deleteFile('cdn_uploads/services/' . basename($mediaPath));
        }

        // Delete the cover image from the CDN
        FileHandler::deleteFile('cdn_uploads/services/' . basename($existingService['cover_image']));

        // Delete the service from the database
        if ($service->deleteServiceById($serviceId)) {
            // Send a success response
            $response->setStatusCode(200);
            return $response->sendJson(['message' => 'Service deleted successfully']);
        } else {
            // Send an error response if service deletion fails
            return $response->sendError('Failed to delete service', 500);
        }
    }

}
