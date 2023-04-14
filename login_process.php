<?php
session_start();

// Retrieve form data
$email_or_username = $_POST['email_or_username'];
$password = $_POST['password'];

// Hash password using bcrypt
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query the database
$db_host = 'localhost';
$db_name = 'sanitation';
$db_user = 'root';
$db_pass = '';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$query = "SELECT * FROM users WHERE (email = '$email_or_username' OR username = '$email_or_username')";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  // User exists, verify password
  $user = mysqli_fetch_assoc($result);
  if (password_verify($password, $user['password'])) {
    // Password is correct, start session and redirect to dashboard
    $_SESSION['user_id'] = $user['id'];
    header('Location: dashboard.php');
    exit;
  } else {
    // Password is incorrect, display error message
    $error_message = 'Invalid email/username or password';
  }
} else {
  // User does not exist, display error message
  $error_message = 'Invalid email/username or password';
}

mysqli_close($conn);
?>
