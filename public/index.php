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
$app->router->get('/designer/offer-package', 'DesignerController@offerPackage');
$app->router->get('/designer/earnings', 'DesignerController@earnings');
$app->router->get('/designer/edit-profile', 'DesignerController@editProfile');
$app->router->get('/designer/change-password', 'DesignerController@changePassword');
$app->router->get('/designer/payout-methods', 'DesignerController@payoutMethods');


// ==================================
// Admin routes
// ==================================
$app->router->get('/admin/dashboard', 'AdminController@dashboard');
$app->router->get('/admin/services-list', 'AdminController@servicesList'); // Service management
$app->router->get('/admin/service-details/{id}', 'AdminController@serviceDetails');
$app->router->get('/admin/users-list', 'AdminController@usersList'); // User management
$app->router->get('/admin/user-profile/{id}', 'AdminController@userProfile');
$app->router->get('/admin/verifications-list', 'AdminController@verificationsList'); // Verification management
$app->router->get('/admin/verification-details/{type}/{id}', 'AdminController@verificationDetails');
$app->router->get('/admin/orders-list', 'AdminController@ordersList'); // Order management
$app->router->get('/admin/order-details/{id}', 'AdminController@orderDetails');
$app->router->get('/admin/complaints-list', 'AdminController@complaintsList'); // Complaint management
$app->router->get('/admin/complaint-details/{id}', 'AdminController@complaintDetails');
$app->router->get('/admin/actions-list', 'AdminController@actionsList'); // Action management
$app->router->get('/admin/action-details/{id}', 'AdminController@actionDetails');


// ==================================
// Common routes
// ==================================
$app->router->get('/chat', 'CommonController@chat'); // Chat
$app->router->get('/notifications', 'CommonController@notifications'); // Notifications page


// ==================================
// Additional Error Handling Routes
// ==================================
$app->router->get('/404', 'GuestController@error404'); // 404 Error Page
$app->router->get('/403', 'GuestController@error403'); // 403 Error Page
$app->router->get('/401', 'GuestController@error401'); // 401 Error Page
$app->router->get('/500', 'GuestController@error500'); // 500 Error Page
$app->router->get('/503', 'GuestController@error503'); // 503 Error Page

// Payment Error or Success
$app->router->get('/payment-error', 'GuestController@paymentError'); // Payment Error Page
$app->router->get('/payment-success', 'GuestController@paymentSuccess'); // Payment Success Page

// Account Suspended or Deactivated
$app->router->get('/account-suspended', 'GuestController@accountSuspended'); // Account Suspended Page

$app->router->get('/registration-pending', 'GuestController@registrationPending'); // Account Suspended Page
$app->router->get('/registration-failed', 'GuestController@registrationFailed'); // Account Suspended Page


// ==================================
// Authentication Routes
// ==================================
$app->router->post('/auth/login', 'AuthController@login'); // Login
$app->router->get('/auth/logout', 'AuthController@logout'); // Logout





// =====================================================================================================================================================================
// ====================================================             API routes            ==============================================================================
// =====================================================================================================================================================================

// ==================================
// User Management APIs
// ==================================
$app->router->get('/api/users', 'UserController@getUserList'); // Get Users list
$app->router->get('/api/user/{id}', 'UserController@getUserProfile'); // Get User Profile
$app->router->post('/api/update-user', 'UserController@updateUserProfile'); // Update User Profile
$app->router->post('/api/update-user-account-status', 'UserController@updateUserAccountStatus'); // Update User account status
$app->router->post('/api/change-password', 'AuthController@changePassword'); // Change Password

// ** User Registration **
$app->router->post('/api/register', 'RegistrationController@createUser'); // Register/Create User
$app->router->get('/verify-email', 'RegistrationController@verifyEmail');
$app->router->post('/resend-verification', 'RegistrationController@resendVerificationEmail');

// Accepts optional query parameter: sinceTime
$app->router->get('/api/user-count', 'GetCountController@getUserCountsSummary'); 

// ==================================
// Service Management APIs
// ==================================
$app->router->get('/api/services', 'ServiceController@getServiceList'); // Get Service List
$app->router->get('/api/service/{id}', 'ServiceController@getServiceProfile'); // Get Service Profile

$app->router->get('/api/service-count', 'GetCountController@getServiceCountsSummary'); 
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
$app->router->post('/api/update-custom-package/{id}', 'CustomPackageController@updateCustomPackageProfile'); // Update Custom Package
$app->router->get('/api/delete-custom-package/{id}', 'CustomPackageController@deleteCustomPackage'); // Delete Custom Package


// ==================================
// Order Management APIs
// ==================================
$app->router->get('/api/orders', 'OrderController@getOrderList'); // Get Orders List by User
$app->router->get('/api/orders/seller', 'OrderController@getSellerOrders'); // Get Orders List by Seller   ****************************************
$app->router->get('/api/orders-admin', 'OrderController@getOrderListByAdmin'); // Get Orders List by Admin
$app->router->get('/api/order/{id}', 'OrderController@getOrderProfile'); // Get Order Profile
$app->router->post('/api/create-order', 'OrderController@createOrder'); // Create Order
$app->router->post('/api/update-order', 'OrderController@updateOrder'); // Update Order


$app->router->get('/api/orders-count', 'GetCountController@getOrderCountsSummary');

// Verification Management
$app->router->get('/api/verifications', 'VerificationController@getVerificationsList'); // Get Verification List

// ** Order Status Update **
$app->router->post('/api/order-cancellation', 'OrderController@orderCancellation'); // Order Cancellation
$app->router->post('/api/respond-to-cancellation', 'OrderController@respondToCancellation'); // Respond to Order Cancellation
// ** Order Delivery **
$app->router->get('/api/delivery/{id}', 'OrderDeliveryController@getOrderDeliveries'); // Get Order Deliveries
$app->router->post('/api/createDelivery', 'OrderDeliveryController@createDelivery'); // Create Order Delivery
// ** Order Revision **
$app->router->post('/api/request-revision', 'RevisionController@deliverNow'); // Request Revision
// ** Order Review **
$app->router->post('/api/create-review', 'ReviewController@createReview'); // Create Review


// ===================================
// Verification Management APIs
// ===================================
$app->router->get('/api/verifications', 'VerificationController@getVerificationsList'); // Get Verifications List

$app->router->get('/api/verification/{type}/{id}', 'VerificationController@getVerificationDetails'); // Get Verification Profile
$app->router->post('/api/update-verification-status', 'VerificationController@updateVerificationStatus'); // Update Verification Status


// ==================================
// Complaint Management APIs
// ==================================
$app->router->get('/api/complaints', 'ComplaintController@getComplaintList'); // Get Complaint List
$app->router->get('/api/complaint/{id}', 'ComplaintController@getComplaintDetails'); // Get specific complaint details
$app->router->post('/api/create-complaint', 'ComplaintController@CreateComplaint'); // Create Complaint
$app->router->post('/api/update-complaint-status', 'ComplaintController@updateComplaintStatus'); // Update complaint status
$app->router->post('/api/complaints-count', 'ComplaintController@getComplaintCountsSummary'); // Get complaint counts summary
// ==================================
// Admin actions Management APIs
// ==================================
$app->router->get('/api/actions', 'ActionController@getActionList'); // Get Actions List


// ==================================
// Payment APIs
// ==================================
$app->router->get('/api/payments/process-releases', 'PaymentController@processScheduledReleases');
$app->router->post('/api/payments/create-transaction', 'PaymentController@createTransaction');
$app->router->post('/api/payments/release-funds', 'PaymentController@releaseFunds');
$app->router->get('/api/payments/transaction-details', 'PaymentController@getTransactionDetails');

$app->router->post('/api/payments/withdraw-funds', 'PaymentController@withdrawFunds'); // Get transaction history

$app->router->get('/api/payments/seller-balance', 'PaymentController@getSellerBalance');
$app->router->get('/api/payments/seller-holds', 'PaymentController@getSellerHoldBalance');
$app->router->get('/api/payments/seller-transactions', 'PaymentController@getSellerTransactions');
$app->router->get('/api/payments/period-earnings', 'PaymentController@getPeriodEarnings'); // Get earnings for a specific period
$app->router->get('/api/payments/system-wallet-balance', 'PaymentController@getSystemWalletBalance'); // Get transaction history

$app->router->post('/api/payments/add-payoutmethod', 'PaymentController@addPayoutMethod');
$app->router->get('/api/payments/get-seller-payoutmethod', 'PaymentController@getSellerPayoutMethods');
$app->router->post('/api/payments/update-payoutmethod', 'PaymentController@updatePayoutMethod'); 
$app->router->get('/api/payments/delete-payoutmethod', 'PaymentController@deletePayoutMethod'); 


// ==================================
// Notification APIs
// ==================================
$app->router->get('/api/notifications', 'NotificationController@getNotifications'); // Get notifications list
$app->router->post('/api/notifications/mark-read', 'NotificationController@markAsRead'); // Mark notification as read
$app->router->post('/api/notifications/mark-all-read', 'NotificationController@markAllAsRead'); // Mark all notifications as read
$app->router->get('/api/notifications/unread-count', 'NotificationController@getUnreadCount'); // Get unread notification count



// Run the application
$app->run();