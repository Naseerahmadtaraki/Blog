<?php
// Function to write logs to the database
function write_log_db($message, $log_type = 'INFO') {
    // Include database connection
    include('db_connection.php');
    
    // Prepare the SQL statement
    $sql = "INSERT INTO logs (log_type, message) VALUES ('$log_type', '$message')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Log successfully inserted into database
    } else {
        // Handle the error (you may log it to a file if DB fails)
        error_log("Failed to log to database: " . $conn->error);
    }

    // Close the connection
    $conn->close();
}
?>
