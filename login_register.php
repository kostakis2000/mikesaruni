<?php

session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);//encrypted using the password hash function
    $role = $_POST['role'];

    $checkEmail  = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
    // If email is already registered, set session error messages
    $_SESSION['register_error'] = 'Email is already registered!';//store error in session
    $_SESSION['active_form'] = 'register'; // To keep the register form active on redirect
    } else {
    // If email does not exist, insert the new user
    // IMPORTANT: This query is also vulnerable to SQL injection. Use prepared statements!
    // Also, passwords should ALWAYS be hashed before storing in the database (e.g., using password_hash())
    $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
    // You might want to add a success message here or redirect to a success page
    }

// Redirect to login.php after processing
    header("Location: login.php");
    exit(); // Always call exit() after header() to prevent further script execution


}

//Creating another condition to handle the login page 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin_page.php");
                exit();
            } elseif ($user['role'] === 'parent') {
                header("Location: parent_page.php");
                exit();
            } elseif ($user['role'] === 'driver') {
                header("Location: driver_page.php");
                exit();
            } else {
                // Optional: handle unexpected role
                $_SESSION['login_error'] = 'Unknown user role';
                header("Location: login.php");
                exit();
            }
        }
    }

    // Login failed
    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: login.php");
    exit();
}

?>