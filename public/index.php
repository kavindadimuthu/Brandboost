<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application as Application;
use app\core\Helpers\SessionHelper;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Start the session
SessionHelper::startSession();

// Create the application instance
$app = new Application();

// Define routes for Guest views
$app->router->get('/', 'GuestController@home'); // Home (Landing Page)
$app->router->get('/services', 'GuestController@servicesList'); // Services List
$app->router->get('/services/{id}', 'GuestController@serviceDetails'); // Service Details
$app->router->get('/user/{id}', 'GuestController@userProfile'); // User Profile
$app->router->get('/influencers', 'GuestController@influencersList'); // Influencers List
$app->router->get('/about', 'GuestController@about'); // About Us
$app->router->get('/contact', 'GuestController@contact'); // Contact Us
$app->router->get('/faq', 'GuestController@faq'); // FAQ
$app->router->get('/register', 'GuestController@register'); // Register
$app->router->get('/register/{role}', 'GuestController@registerForm'); // Register
$app->router->get('/login', 'GuestController@login'); // Login
$app->router->get('/forgot-password', 'GuestController@forgotPassword'); // Forgot Password
$app->router->get('/reset-password', 'GuestController@resetPassword'); // Reset Password

// Businessman routes
$app->router->get('/businessman/orders-list', 'BusinessmanController@ordersList');
$app->router->get('/businessman/order-details/{id}', 'BusinessmanController@orderDetails');
$app->router->get('/businessman/request-order', 'BusinessmanController@requestOrder');
$app->router->get('/businessman/place-order', 'BusinessmanController@placeOrder');
$app->router->get('/businessman/request-package', 'BusinessmanController@requestPackage');
// Common shared routes for businessman
$app->router->get('/businessman/custom-packages', 'BusinessmanController@customPackages');
$app->router->get('/businessman/edit-profile', 'BusinessmanController@editProfile');
$app->router->get('/businessman/change-password', 'BusinessmanController@changePassword');


// Influencer routes
$app->router->get('/influencer/dashboard', 'InfluencerController@dashboard');
$app->router->get('/influencer/my-promotions', 'InfluencerController@myPromotions');
$app->router->get('/influencer/add-promotion', 'InfluencerController@addPromotion');
$app->router->get('/influencer/edit-promotion/{id}', 'InfluencerController@editPromotion');
$app->router->get('/influencer/orders-list', 'InfluencerController@ordersList');
$app->router->get('/influencer/order-details/{id}', 'InfluencerController@orderDetails');
// Shared routes for influencer
$app->router->get('/influencer/custom-packages', 'InfluencerController@customPackages');
$app->router->get('/influencer/offer-package', 'InfluencerController@offerPackage');
$app->router->get('/influencer/earnings', 'InfluencerController@earnings');
$app->router->get('/influencer/edit-profile', 'InfluencerController@editProfile');
$app->router->get('/influencer/change-password', 'InfluencerController@changePassword');
$app->router->get('/influencer/payout-methods', 'InfluencerController@payoutMethods');
// Influencer API routes
$app->router->post('/influencer/create-promotion', 'InfluencerController@createPromotion');


// Designer routes
$app->router->get('/designer/dashboard', 'DesignerController@dashboard');
$app->router->get('/designer/my-gigs', 'DesignerController@myGigs');
$app->router->get('/designer/add-gig', 'DesignerController@addGig');
$app->router->get('/designer/edit-gig/{id}', 'DesignerController@editGig');
$app->router->get('/designer/orders-list', 'DesignerController@ordersList');
$app->router->get('/designer/order-details/{id}', 'DesignerController@orderDetails');
// Shared routes for designer
$app->router->get('/designer/custom-packages', 'DesignerController@customPackages');
$app->router->get('/designer/offer-package', 'DesignerController@offerPackage');
$app->router->get('/designer/earnings', 'DesignerController@earnings');
$app->router->get('/designer/edit-profile', 'DesignerController@editProfile');
$app->router->get('/designer/change-password', 'DesignerController@changePassword');
$app->router->get('/designer/payout-methods', 'DesignerController@payoutMethods');


// Admin routes
$app->router->get('/admin/dashboard', 'AdminController@dashboard');
// Guest service management for admin
$app->router->get('/admin/services-list', 'AdminController@servicesList');
$app->router->get('/admin/service-details/{id}', 'AdminController@serviceDetails');
// User management
$app->router->get('/admin/users-list', 'AdminController@usersList');
$app->router->get('/admin/user-profile/{id}', 'AdminController@userProfile');
// Verification management
$app->router->get('/admin/verifications-list', 'AdminController@verificationsList');
$app->router->get('/admin/verification-details/{id}', 'AdminController@verificationDetails');
// Order management
$app->router->get('/admin/orders-list', 'AdminController@ordersList');
$app->router->get('/admin/order-details/{id}', 'AdminController@orderDetails');
// Complaint management
$app->router->get('/admin/complaints-list', 'AdminController@complaintsList');
$app->router->get('/admin/complaint-details/{id}', 'AdminController@complaintDetails');
// Action management
$app->router->get('/admin/actions-list', 'AdminController@actionsList');
$app->router->get('/admin/action-details/{id}', 'AdminController@actionDetails');


// Common routes
$app->router->get('/chat', 'CommonController@chat');


// Auth routes
$app->router->post('/auth/register', 'AuthController@register');
$app->router->post('/auth/login', 'AuthController@login');
$app->router->get('/auth/logout', 'AuthController@logout');



// API routes

// User Management
$app->router->get('/getUserList', 'UserController@getUserList'); // Fetch User Profile
$app->router->get('/getUser/{id}', 'UserController@getUserProfile'); // Fetch User Profile
$app->router->post('/updateUser/{id}', 'UserController@updateUserProfile'); // Update User Profile
$app->router->get('/deleteUser/{id}', 'UserController@deleteUserProfile'); // Delete User Profile

$app->router->get('/api/influencers', 'GuestController@getInfluencerList');

// Service Management
$app->router->get('/getServiceList', 'ServiceController@getServiceList');
$app->router->get('/getServiceProfile', 'ServiceController@getServiceProfile');
$app->router->post('/api/create-gig', 'ServiceController@createService');
$app->router->post('/api/update-gig/{id}', 'ServiceController@updateService');
$app->router->get('/api/delete-gig/{id}', 'ServiceController@deleteService');

$app->router->get('/api/services', 'ServiceController@getServiceList');
$app->router->get('/api/gig/{id}', 'ServiceController@getServiceProfile');


//test routes
// $app->router->get('/test', 'DesignerController@test');
// $app->router->get('/test', 'CommonController@test');
$app->router->get('/test', 'TestController@test');

// Run the application
$app->run();

