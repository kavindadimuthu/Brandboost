<?php
// FILE: app/controllers/LoginController.php
class LoginController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate input data
            if (empty($email) || empty($password)) {
                echo "Email and Password are required.";
                return;
            }

            // Load the UserModel
            $this->model('UserModel');
            $userModel = new UserModel();

            // Check user credentials
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                // Start a session and set session variables
                session_start();
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['user_name'] = $user->first_name;
                $_SESSION['role'] = $user->role;
                $_SESSION['logged_in'] = true;

                echo "Login successful! Welcome, " . $_SESSION['user_name'];
                // Optionally redirect to a dashboard or home page
                switch ($user->role) {
                    case 'admin':
                        header('Location: /admin/dashboard');
                        break;
                    case 'businessman':
                        header('Location: /BusinessViewController/businessdashboard');
                        break;
                    case 'influencer':
                        header('Location: /InfluencerViewController/influencerDashboard');
                        break;
                    case 'designer':
                        header('Location: /DesignerViewController/designerDashboard');
                        break;
                    default:
                        echo "Unknown role. Unable to navigate.";
                        break;
                    }
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function logout()
    {
        // session_start();
        session_destroy();
        header('Location: /');
        exit();
    }
}
?>
