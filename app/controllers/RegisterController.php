<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $privacyPolicy = isset($_POST['privacy_policy']);

    // Validate data and save to the database
    if ($password === $confirmPassword && $privacyPolicy) {
        $db = Database::getInstance();
        $db->query("INSERT INTO users (first_name, last_name, email, phone, password) VALUES (:firstName, :lastName, :email, :phone, :password)");
        $db->bind(':firstName', $firstName);
        $db->bind(':lastName', $lastName);
        $db->bind(':email', $email);
        $db->bind(':phone', $phone);
        $db->bind(':password', password_hash($password, PASSWORD_BCRYPT)); // Hash the password
        if ($db->execute()) {
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