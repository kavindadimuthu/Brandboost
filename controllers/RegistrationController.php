<?php


require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class RegistrationController extends BaseController
{
    public function createUser($request, $response): void
    {
        error_log("Entering create user"); // Debugging line
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        error_log("Parsed body: " . print_r($data, true)); // Debugging line
        $name = trim(($data['firstName'] ?? '') . ' ' . ($data['lastName'] ?? ''));
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirmPassword'] ?? '';
        $role = $data['role'] ?? 'user';

        error_log("Name: $name, Email: $email, Role: $role"); // Debugging line
        // Validate input
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            $response->sendError('All fields are required.', 400);
            return;
        }

        error_log("Flag 1"); // Debugging line
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->sendError('Invalid email format.', 400);
            return;
        }

        error_log("Flag 2"); // Debugging line
        if ($password !== $confirmPassword) {
            $response->sendError('Passwords do not match.', 400);
            return;
        }

        error_log("Flag 3"); // Debugging line
        // Check if email already exists in the user table
        $userModel = $this->model('Users\User');
        if ($userModel->getUserByEmail($email)) {
            $response->sendError('Email already registered.', 400);
            return;
        }

        error_log("Flag 4"); // Debugging line
        // Check if this email is already in the pending_users table
        $pendingUserModel = $this->model('Users\PendingUser');
        $existingPendingUser = $pendingUserModel->getByEmail($email);

        if ($existingPendingUser) {
            // Delete the existing pending user to avoid duplicates
            $pendingUserModel->deleteByEmail($email);
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        error_log("Flag 5"); // Debugging line
        // Set verification status based on role
        if ($role == 'businessman' || $role == 'influencer') {
            $verificationStatus = 'unverified';
        } else if ($role == 'designer') {
            $verificationStatus = 'verified';
        }

        // Generate a verification token
        $token = bin2hex(random_bytes(32)); // 64 character hex string

        // Set token expiration (24 hours from now)
        $tokenExpiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        error_log("Token: $token, Token Expiry: $tokenExpiry"); // Debugging line
        // Create pending user record
        $pendingUser = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
            'verification_token' => $token,
            'token_expiry' => $tokenExpiry
        ];

        if (!$pendingUserModel->createPendingUser($pendingUser)) {
            $response->sendError('Error registering user.', 500);
            return;
        }

        // Send verification email
        if ($this->sendVerificationEmail($email, $name, $token)) {
            $response->sendJson([
                'success' => true,
                'message' => 'Registration pending. Please check your email to verify your account.'
            ]);
        } else {
            // If email fails to send, we should still allow the user to verify
            // but we'll inform them that the email sending failed
            $response->sendJson([
                'success' => true,
                'message' => 'Your account has been registered, but we could not send a verification email. Please contact support.'
            ]);
        }
    }

    /**
     * Send a verification email to the user.
     *
     * @param string $email The user's email address
     * @param string $name The user's name
     * @param string $token The verification token
     * @return bool True if email was sent successfully
     */
    private function sendVerificationEmail($email, $name, $token): bool
    {
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $verificationUrl = $baseUrl . "/verify-email?token=" . $token;

        $subject = "Verify Your Email - BrandBoost";

        $message = "
        <html>
        <head>
            <title>Email Verification</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #4a69bd; color: white; padding: 10px 20px; text-align: center; }
                .content { padding: 20px; background-color: #f9f9f9; }
                .button { display: inline-block; padding: 10px 20px; background-color: #4a69bd; color: white; 
                          text-decoration: none; border-radius: 4px; margin: 20px 0; }
                .footer { font-size: 12px; text-align: center; margin-top: 20px; color: #777; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>BrandBoost</h1>
                </div>
                <div class='content'>
                    <p>Hello $name,</p>
                    <p>Thank you for registering with BrandBoost. Please verify your email address by clicking the button below:</p>
                    <p style='text-align: center;'>
                        <a href='$verificationUrl' class='button'>Verify Email Address</a>
                    </p>
                    <p>If the button doesn't work, copy and paste the following link into your browser:</p>
                    <p>$verificationUrl</p>
                    <p>This link will expire in 24 hours.</p>
                    <p>If you didn't create an account, you can ignore this email.</p>
                </div>
                <div class='footer'>
                    <p>© " . date('Y') . " BrandBoost. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'naveenliyanaarachchi27@gmail.com'; // your Gmail address
            $mail->Password   = 'irhytmxomcptteda'; // your Gmail app password
            $mail->SMTPSecure = 'tls'; // Encryption
            $mail->Port       = 587;

            // Sender info
            $mail->setFrom('naveenliyanaarachchi27@gmail.com', 'BrandBoost');

            // Recipient
            $mail->addAddress($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Verify user email using token.
     *
     * @param object $request Request object containing token
     * @param object $response Response object to send back HTTP responses
     */
    public function verifyEmail($request, $response): void
    {
        $token = $request->getParam('token');

        if (empty($token)) {
            $response->sendError('Verification token is required.', 400);
            return;
        }

        $pendingUserModel = $this->model('Users\PendingUser');
        $pendingUser = $pendingUserModel->getByToken($token);
        $pendingUser = $pendingUser[0] ?? null; // Get the first result or null

        error_log("pendingUser: "); // Debugging line
        error_log(print_r($pendingUser, true)); // Debugging line

        if (!$pendingUser) {
            $response->sendError('Invalid verification token.', 400);
            return;
        }

        // Check if token has expired
        $now = new DateTime();
        $tokenExpiry = new DateTime($pendingUser['token_expiry']);

        if ($now > $tokenExpiry) {
            $pendingUserModel->deleteByEmail($pendingUser['email']);
            $response->sendError('Verification token has expired. Please register again.', 400);
            return;
        }

        // Create a new user from pending user data
        $userModel = $this->model('Users\User');

        // Set verification status based on role
        if ($pendingUser['role'] == 'businessman' || $pendingUser['role'] == 'influencer') {
            $verificationStatus = 'unverified';
        } else if ($pendingUser['role'] == 'designer') {
            $verificationStatus = 'verified';
        }

        $user = [
            'name' => $pendingUser['name'],
            'email' => $pendingUser['email'],
            'phone' => $pendingUser['phone'] ?? 'Not set',
            'password' => $pendingUser['password'],
            'role' => $pendingUser['role'],
            'profile_picture' => null,
            'bio' => null,
            'account_status' => 'active',
            'verification_status' => $verificationStatus
        ];

        try {
            // Create the user in the main users table
            if (!$userModel->createUser($user)) {
                $response->sendError('Error activating user account.', 500);
                return;
            }

            // Delete the pending user record
            if (!$pendingUserModel->deleteByEmail($pendingUser['email'])) {
                $response->sendError('Error completing verification process.', 500);
                return;
            }


            // Redirect to login page with success message
            $response->redirect('/login?verified=1');
        } catch (Exception $e) {
            $response->sendError('An error occurred during verification: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Resend verification email to user.
     *
     * @param object $request Request object containing email
     * @param object $response Response object to send back HTTP responses
     */
    public function resendVerificationEmail($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $email = trim($data['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->sendError('Valid email address is required.', 400);
            return;
        }

        $pendingUserModel = $this->model('Users\PendingUser');
        $pendingUser = $pendingUserModel->getByEmail($email);

        if (!$pendingUser) {
            // Don't reveal that the email doesn't exist for security
            $response->sendJson([
                'success' => true,
                'message' => 'If your email exists in our system, a verification link has been sent.'
            ]);
            return;
        }

        // Generate a new token and update expiry
        $token = bin2hex(random_bytes(32));
        $tokenExpiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        if (!$pendingUserModel->updateToken($email, $token, $tokenExpiry)) {
            $response->sendError('Error updating verification token.', 500);
            return;
        }

        // Send verification email
        if ($this->sendVerificationEmail($email, $pendingUser['name'], $token)) {
            $response->sendJson([
                'success' => true,
                'message' => 'A new verification link has been sent to your email.'
            ]);
        } else {
            $response->sendError('Failed to send verification email.', 500);
        }
    }
}
