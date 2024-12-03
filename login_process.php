<?php
session_start();
include('conn.php');

// Store error message in session
$_SESSION['login_error'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Invalid password!';
        }
    } else {
        $_SESSION['login_error'] = 'Email not found!';
    }
}

// Redirect back to login form with error message
header("Location: log.php");
exit();
