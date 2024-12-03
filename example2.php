<?php
include('conn.php');
// Assuming you have an active database connection in $conn
$sql = "SELECT COUNT(*) as unseen_count FROM contact_form_submissions WHERE is_seen = 0";

// Execute the query
$result = $conn->query($sql);

// Fetch the result
if ($result && $row = $result->fetch_assoc()) {
    $unseen_email_count = $row['unseen_count'];
    echo "Number of unseen emails: " . $unseen_email_count;
} else {
    echo "Failed to fetch the unseen emails count.";
}
?>
