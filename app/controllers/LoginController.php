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
                echo "<script>alert('Invalid email or password.');</script>";
                echo "<script>window.location.href = '/homecontroller/login';</script>";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function loginAdmin()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the email and password from the request body
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate input data
            if (empty($email) || empty($password)) {
                echo "Email and password are required.";
                exit();
            }

            // Query the database to find the user with the given email
            $this->model('UserModel');
            $userModel = new UserModel();
            $user = $userModel->getAdminByEmail($email);


            // Check if the user exists and the password is correct
            if ($user && ($password === $user->password)) {
                // Set session variables
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user->admin_id;
                $_SESSION['user_name'] = $user->first_name;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['role'] = 'admin';
                // Redirect to the admin dashboard
                header('Location: /adminviewcontroller/admindashboard');
                exit();
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
                echo "<script>window.location.href = '/homecontroller/loginAdmin';</script>";
            }
        }

    }

    public function logout()
    {
        $role = $_SESSION['role'];

        // session_start();
        session_destroy();

        if ($role == 'admin') {
            header('Location: /homecontroller/loginAdmin');
            exit();
        } else {
            header('Location: /homecontroller/login');
            exit();
        }

    }
}
?>