<?php
include('conn.php');

$id =$_GET['id'];

 $query=mysqli_query($conn,"delete from posts where id = $id");

 if (($query) === TRUE) {
    echo "User registered successfully!";
    header("Location: manage_post.php");
    exit();
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();


?>