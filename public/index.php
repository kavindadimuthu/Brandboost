<?php

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

// Define routes here

// ==================================
// Guest routes
// ==================================
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

// ==================================
// Businessman routes
// ==================================
$app->router->get('/businessman/orders-list', 'BusinessmanController@ordersList');
$app->router->get('/businessman/order-details/{id}', 'BusinessmanController@orderDetails');
$app->router->get('/businessman/request-order', 'BusinessmanController@requestOrder');
$app->router->get('/businessman/place-order', 'BusinessmanController@placeOrder');
$app->router->get('/businessman/request-package', 'BusinessmanController@requestPackage');
// Common shared routes for businessman
$app->router->get('/businessman/custom-packages', 'BusinessmanController@requestedCustomPackages');
$app->router->get('/businessman/edit-profile', 'BusinessmanController@editProfile');
$app->router->get('/businessman/change-password', 'BusinessmanController@changePassword');

// ==================================
// Influencer routes
// ==================================
$app->router->get('/influencer/dashboard', 'InfluencerController@dashboard');
$app->router->get('/influencer/my-promotions', 'InfluencerController@myPromotions');
$app->router->get('/influencer/add-promotion', 'InfluencerController@addPromotion');
$app->router->get('/influencer/edit-promotion/{id}', 'InfluencerController@editPromotion');
$app->router->get('/influencer/orders-list', 'InfluencerController@ordersList');
$app->router->get('/influencer/order-details/{id}', 'InfluencerController@orderDetails');
// Shared routes for influencer
$app->router->get('/influencer/custom-packages', 'InfluencerController@sellerCustomPackages');
$app->router->get('/influencer/offer-package', 'InfluencerController@offerPackage');
$app->router->get('/influencer/earnings', 'InfluencerController@earnings');
$app->router->get('/influencer/edit-profile', 'InfluencerController@editProfile');
$app->router->get('/influencer/change-password', 'InfluencerController@changePassword');
$app->router->get('/influencer/payout-methods', 'InfluencerController@payoutMethods');

// ==================================
// Designer routes
// ==================================
$app->router->get('/designer/dashboard', 'DesignerController@dashboard');
$app->router->get('/designer/my-gigs', 'DesignerController@myGigs');
$app->router->get('/designer/add-gig', 'DesignerController@addGig');
$app->router->get('/designer/edit-gig/{id}', 'DesignerController@editGig');
$app->router->get('/designer/orders-list', 'DesignerController@ordersList');
$app->router->get('/designer/order-details/{id}', 'DesignerController@orderDetails');
// Shared routes for designer
// $app->router->get('/designer/custom-packages', 'DesignerController@customPackages');
$app->router->get('/designer/offer-package', 'DesignerController@offerPackage');
$app->router->get('/designer/earnings', 'DesignerController@earnings');
$app->router->get('/designer/edit-profile', 'DesignerController@editProfile');
$app->router->get('/designer/change-password', 'DesignerController@changePassword');
$app->router->get('/designer/payout-methods', 'DesignerController@payoutMethods');

// ==================================
// Admin routes
// ==================================
$app->router->get('/admin/dashboard', 'AdminController@dashboard');
// Service management
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



// ==================================
// Common routes
// ==================================
$app->router->get('/chat', 'CommonController@chat'); // Chat



// ==================================
// Authentication Routes
// ==================================
$app->router->post('/auth/login', 'AuthController@login'); // Login
$app->router->get('/auth/logout', 'AuthController@logout'); // Logout


// ==================================
// API routes
// ==================================

// User Management
$app->router->get('/api/users', 'UserController@getUserList'); // Get Users list
$app->router->get('/api/user/{id}', 'UserController@getUserProfile'); // Get User Profile
$app->router->post('/api/register', 'UserController@createUser'); // Register/Create User
$app->router->post('/update-user/{id}', 'UserController@updateUserProfile'); // Update User Profile
$app->router->get('/delete-user/{id}', 'UserController@deleteUserProfile'); // Delete User Profile


// Service Management
$app->router->get('/api/services', 'ServiceController@getServiceList'); // Get Service List
$app->router->get('/api/service/{id}', 'ServiceController@getServiceProfile'); // Get Service Profile
// ** gigs specific routes
$app->router->post('/api/create-gig', 'ServiceController@createService'); // Create Gig
$app->router->post('/api/update-gig/{id}', 'ServiceController@updateService'); // Update Gig
$app->router->get('/api/delete-gig/{id}', 'ServiceController@deleteService'); // Delete Gig
// ** promotions specific routes
$app->router->post('/api/create-promotion', 'ServiceController@createService'); // Create Promotion
$app->router->post('/api/update-promotion/{id}', 'ServiceController@updateService'); // Update Promotion
$app->router->get('/api/delete-promotion/{id}', 'ServiceController@deleteService'); // Delete Promotion

// Custom Package Management
$app->router->get('/api/custom-packages', 'CustomPackageController@getCustomPackageList'); // Get Custom Package List
$app->router->get('/api/custom-package/{id}', 'CustomPackageController@getCustomPackageProfile'); // Get Custom Package Profile
$app->router->post('/api/create-custom-package', 'CustomPackageController@createCustomPackage'); // Create Custom Package
$app->router->post('/api/update-custom-package/{id}', 'CustomPackageController@updateCustomPackageProfile'); // Get Custom Package Profile
$app->router->get('/api/delete-custom-package/{id}', 'CustomPackageController@deleteCustomPackage'); // Delete Custom Package

// Order Management
$app->router->get('/api/orders', 'OrderController@getOrderList'); // Get Order List
$app->router->get('/api/order/{id}', 'OrderController@getOrderProfile'); // Get Order Profile
$app->router->post('/api/create-order', 'OrderController@createOrder'); // Create Order
$app->router->post('/api/update-order', 'OrderController@updateOrder'); // Update Order
$app->router->get('/api/orders/seller', 'OrderController@getSellerOrders');

// ==================================
// Payment API routes
// ==================================
$app->router->get('/api/payments/process-releases', 'PaymentController@processScheduledReleases');
$app->router->post('/api/payments/create-transaction', 'PaymentController@createTransaction');
$app->router->post('/api/payments/release-funds', 'PaymentController@releaseFunds');
$app->router->get('/api/payments/transaction-details', 'PaymentController@getTransactionDetails');

$app->router->get('/api/payments/seller-balance', 'PaymentController@getSellerBalance');
$app->router->get('/api/payments/seller-holds', 'PaymentController@getSellerHoldBalance');
$app->router->get('/api/payments/seller-transactions', 'PaymentController@getSellerTransactions');
$app->router->get('/api/payments/period-earnings', 'PaymentController@getPeriodEarnings'); // Get earnings for a specific period

//test routes
$app->router->get('/test', 'TestController@test');

// Run the application
$app->run();