<?php
// FILE: app/controllers/RegisterController.php
class RegisterController extends Controller{
    
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = $_POST['role'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $gender = $_POST['gender'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $privacyPolicy = isset($_POST['privacy_policy']);

            // Validate data and save to the database
            if ($password === $confirmPassword && $privacyPolicy) {
                $this->model('UserModel');
                $userModel = new UserModel();
                if ($userModel->registerUser( $firstName, $lastName, $email, $phone, $password, $role, $gender)) {
                    echo "Registration successful for $firstName $lastName.";
                } else {
                    echo "Error saving to the database.";
                }
            } else {
                echo "Passwords do not match or privacy policy not accepted.";
            }
        } else {
            echo "Invalid request method.";
        }
    }
}




