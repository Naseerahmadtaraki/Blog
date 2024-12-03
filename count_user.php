
<?php 
include('conn.php');

// Query to count total users
    $userQuery = "SELECT COUNT(*) AS total_users FROM users";
    $userResult = $conn->query($userQuery);
    
    // Fetch the result
    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $totalUsers = $userRow['total_users'];
    } else {
        $totalUsers = 0;
    }

    // Query to count total posts
    $postQuery = "SELECT COUNT(*) AS total_posts FROM posts";
    $postResult = $conn->query($postQuery);
    
    // Fetch the result
    if ($postResult->num_rows > 0) {
        $postRow = $postResult->fetch_assoc();
        $totalPosts = $postRow['total_posts'];
    } else {
        $totalPosts = 0;
    }

    $sql = "SELECT COUNT(*) as unseen_count FROM contact_form_submissions WHERE is_seen = 0";

    // Execute the query
    $result = $conn->query($sql);
    
    // Fetch the result
    if ($result && $row = $result->fetch_assoc()) {
        $unseen_email_count = $row['unseen_count'];
        // echo "Number of unseen emails: " . $unseen_email_count;
    } else {
        echo "Failed to fetch the unseen emails count.";
    }    




 // Close the connection
   $conn->close();

 // Display the results on screen
//  echo "<h3>Total Users: " . $totalUsers . "</h3>";
//  echo "<h3>Total Posts: " . $totalPosts . "</h3>";


// Call the function

?>