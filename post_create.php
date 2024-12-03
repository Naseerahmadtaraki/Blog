<?php
include('conn.php');
// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $publish_date = mysqli_real_escape_string($conn, $_POST['publish_date']);
    $author_name = mysqli_real_escape_string($conn, $_POST['author_name']);




    // Handle image upload
    $target_dir = "uploads/";
    $image = $_FILES['image']['name'];
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO posts (title, content, category, tags, image, publish_date, author_name)
            VALUES ('$title', '$content', '$category', '$tags', '$image', '$publish_date', '$author_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New post created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
s