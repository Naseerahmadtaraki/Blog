<?php
// Include database connection
include('conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize user inputs
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    
    // Validate password confirmation
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    
    // Insert user data into the database
    $sql = "INSERT INTO users (full_name, email, password, phone, role, address, gender)
            VALUES ('$full_name', '$email', '$hashed_password', '$phone', '$role', '$address', '$gender')";
    
    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully!";
        header("Location: dashboard.php");
        exit();
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
