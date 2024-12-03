<?php
include('conn.php');

// Check if a search query was provided
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Modify SQL query to search by title, author_name, or category
    $sql = "SELECT id, title, content, category, tags, publish_date, author_name 
            FROM posts 
            WHERE title LIKE '%$search%' 
            OR author_name LIKE '%$search%' 
            OR category LIKE '%$search%'";
} else {
    // Default SQL query to show all posts
    $sql = "SELECT id, title, content, category, tags, publish_date, author_name FROM posts";
}

$result = $conn->query($sql);


?>