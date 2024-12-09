<?php

use app\core\Application;
use app\core\Helpers\SessionHelper;
use Dotenv\Dotenv;

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';


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
$app->router->get('/login', 'GuestController@login'); // Login
$app->router->get('/forgot-password', 'GuestController@forgotPassword'); // Forgot Password
$app->router->get('/reset-password', 'GuestController@resetPassword'); // Reset Password

// Businessman routes
$app->router->get('/businessman/request-order', 'BusinessmanController@requestOrder');
$app->router->get('/businessman/place-order', 'BusinessmanController@placeOrder');
$app->router->get('/businessman/request-package', 'BusinessmanController@requestPackage');
$app->router->get('/businessman/orders-list', 'BusinessmanController@ordersList');
$app->router->get('/businessman/order-details', 'BusinessmanController@orderDetails');

// Influencer routes
$app->router->get('/influencer/my-promotions', 'InfluencerController@myPromotions');
$app->router->get('/influencer/add-promotion', 'InfluencerController@addPromotion');
$app->router->get('/influencer/edit-promotion', 'InfluencerController@editPromotion');

// Designer routes
$app->router->get('/designer/my-gigs', 'DesignerController@myGigs');
$app->router->get('/designer/add-gig', 'DesignerController@addGig');
$app->router->get('/designer/edit-gig', 'DesignerController@editGig');

// Admin routes
$app->router->get('/admin/dashboard', 'AdminController@dashboard');
$app->router->get('/admin/verifications-list', 'AdminController@verificationsList');
$app->router->get('/admin/verification-details', 'AdminController@verificationDetails');
$app->router->get('/admin/complaints-list', 'AdminController@complaintsList');
$app->router->get('/admin/complaint-details', 'AdminController@complaintDetails');
$app->router->get('/admin/users-list', 'AdminController@usersList');
$app->router->get('/admin/orders-list', 'AdminController@ordersList');
$app->router->get('/admin/order-details', 'AdminController@orderDetails');
$app->router->get('/admin/actions-list', 'AdminController@actionsList');
$app->router->get('/admin/action-details', 'AdminController@actionDetails');


// Run the application
$app->run();
