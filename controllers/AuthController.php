<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;

class AuthController extends BaseController{

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate inputs
            $name = trim($_POST['firstName'] . ' ' . $_POST['lastName']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $role = $_POST['role'];

            // Check for empty fields
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                die('Please fill in all required fields.');
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die('Invalid email address.');
            }

            // Check if passwords match
            if ($password !== $confirmPassword) {
                die('Passwords do not match.');
            }

            // Save user to the database
            $result = $this->model('UserModel')->createUser(
                $name,
                $email,
                $password,
                $role,
                null,  // Profile picture is null as it is not provided in the UI
                null   // Bio is null as it is not provided in the UI
            );

            if ($result) {
                // Registration successful
                header('Location: /login');
                exit;
            } else {
                die('Error registering user.');
            }
        } else {
            // Show the registration form (if needed)
            include 'views/register.php';
        }
    }

    public function login($req, $res) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT));

            if (!$email || !$password) {
                // Redirect back with an error message
                header("Location: /auth/login?error=Invalid%20credentials");
                exit;
            }

            // Fetch user by email from user table
            $user = $this->model('UserModel')->getUserByEmail($email);

            // If user not found in user table, check admin table
            if (!$user) {
                $user = $this->model('UserModel')->getAdminByEmail($email);
                if ($user) {
                    $user->role = 'admin';
                }
            }

            // if ($user && ($password === $user->password)) {
            if ($user && password_verify($password, $user->password)) {

                // Store user details in session
                $loggeduser['user_id'] = $user->user_id;
                $loggeduser['username'] = $user->name;
                $loggeduser['email'] = $user->email;
                $loggeduser['role'] = $user->role;

                $_SESSION['user'] = $loggeduser;

                // Redirect to the user's dashboard according to their role
                switch ($user->role) {
                    case 'admin':
                        header("Location: /admin/dashboard");
                        break;
                    case 'businessman':
                        header("Location: /services");
                        break;
                    case 'influencer':
                        // echo $_SESSION['role'];
                        header("Location: /influencer/dashboard");
                        break;
                    case 'designer':
                        header("Location: /designer/dashboard");
                        break;
                    default:
                        header("Location: /auth/login?error=Invalid%20role");
                        break;
                }
                exit;
            } else {
                // Invalid credentials
                header("Location: /auth/login?error=Invalid%20email%20or%20password");
                exit;
            }
        } else {
            // If not POST, show login form (optional, can be a separate method/view)
            header("Location: /auth/login");
            exit;
        }
    }

    public function logout($req, $res){
        AuthHelper::logOut();
        header("Location: /"); exit;
    }
}