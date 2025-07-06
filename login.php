<?php

// Start the session. This must be called at the very beginning of any script
// that uses $_SESSION variables.
session_start();

// Initialize an associative array to store error messages.
// It checks if 'login_error' or 'register_error' exist in the session.
// The null coalescing operator (??) provides an empty string '' if the session variable is not set,
// preventing PHP notices/warnings.
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

// Determine which form should be active (e.g., if there was a registration error, keep register form open).
// Defaults to 'login' if 'active_form' is not set in the session.
$activeForm = $_SESSION['active_form'] ?? 'login';

// Clear all session variables. This is typically done after retrieving messages
// to ensure they don't persist across page loads unnecessarily.
// It removes all variables from the current session.
session_unset();

/**
 * Helper function to display an error message if it exists.
 *
 * @param string $error The error message to check and display.
 * @return string HTML <p> tag with the error message, or an empty string if no error.
 */
function showError($error) {
    // Checks if the $error string is empty.
    // If empty, returns an empty string.
    // If not empty, returns an HTML paragraph with the 'error-message' class and the error text.
    return empty($error) ? '' : "<p class='error-message'>$error</p>";
}

/**
 * Helper function to determine if a form should be marked as 'active'.
 * This is useful for dynamically adding a CSS class to show/hide forms.
 *
 * @param string $formName The name of the form (e.g., 'login', 'register').
 * @param string $activeForm The name of the currently active form from session.
 * @return string 'active' if $formName matches $activeForm, otherwise an empty string.
 */
function isActiveForm($formName, $activeForm) {
    // Compares the given form name with the active form name.
    // Returns 'active' (which can be used as a CSS class) if they match, otherwise an empty string.
    return $formName === $activeForm ? 'active' : '';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bodylogin">
    <header class="headerlogin">
        <div class="main">
            <div class="logo">
                <img src="images/lokos.jpg">
            </div>
            <ul>
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="about.html"><i class="fa fa-question-circle"></i> Aboutus</a></li>
                <li><a href="contact.php"><i class="fa fa-volume-control-phone"></i> Contact</a></li>
                <li class="active"><a href="login.php"><i class="fa fa-user"></i> Login</a>
            </ul>
        </div>
    </header>
    <div class="container">
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>login</h2>
                <?= showError($errors['login']);?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account?<a href="#" onclick="showForm('register-form')">Register</a></p>
            </form>
        </div>
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
           <form action="login_register.php" method="post">
            <h2>Register</h2>
                <?= showError($errors['register']);?>
            <input type="text" name="email" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">--Select Role--</option>
                <option value="parent">Parent</option>
                <option value="admin">Admin</option>
                <option value="driver">Driver</option>
            </select>
            <button type="submit" name="register">Register</button>
            <p>Already have an account?<a href="#" onclick="showForm('login-form')">Login</a></p>
           </form> 
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>