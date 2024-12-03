<?php
include('conn.php');

$id =$_GET['id'];

 $query=mysqli_query($conn,"delete from users where id = $id");

 if (($query) === TRUE) {
    echo "User registered successfully!";
    header("Location: manage_users.php");
    exit();
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();


?>