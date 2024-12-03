<?php
session_start();
include('conn.php');

if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {

// Check if an ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL to fetch the email details by ID
    $stmt = $conn->prepare('SELECT name, email, subject, message, submitted_at FROM contact_form_submissions WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email with the given ID exists
    if ($result->num_rows > 0) {
        $emailDetails = $result->fetch_assoc(); // Fetch the email details
    } else {
        echo "No email found with the given ID.";
        exit();
    }
} else {
    echo "Invalid email ID.";
    exit();
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
        .card {
            padding: 20px;
            border: 1px solid #e3e6f0;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .email-header {
            margin-bottom: 0px;
        }
        .email-header .info {
            margin-bottom: 5px;
        }
        .email-header .info span {
            font-weight: bold;
        }
        .email-actions {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <!-- Email Header -->
        <div class="email-header">
            <h2 class="text-primary mb-3"><?php echo htmlspecialchars($emailDetails['subject']); ?></h2>

            <div class="info">
                <span>From:</span> <span class="text-muted"><?php echo htmlspecialchars($emailDetails['email']); ?></span>
            </div>
            <div class="info">
                <span>To:</span> <span class="text-muted">naseerwakman11@gmail.com</span>
            </div>
            <div class="info">
                <span>Date:</span> <span class="text-muted"><?php echo htmlspecialchars($emailDetails['submitted_at']); ?></span>
            </div>
            <hr>
        </div>

        <!-- Email Body -->
        <div class="email-body">
            <p>
                Dear <?php echo htmlspecialchars($emailDetails['name']); ?>,
            </p>
            <p>
                <?php echo nl2br(htmlspecialchars($emailDetails['message'])); ?>
            </p>
            <p>
                Best regards,<br>
                <?php echo htmlspecialchars($emailDetails['name']); ?>
            </p>
        </div>

        <!-- Email Actions -->
        <div class="email-actions">
            <a href="mailto:<?php echo htmlspecialchars($emailDetails['email']); ?>" class="btn btn-primary">Reply</a>
            <a href="mailto:?subject=Fwd: <?php echo urlencode($emailDetails['subject']); ?>&body=<?php echo urlencode($emailDetails['message']); ?>" class="btn btn-secondary">Forward</a>
            <a href="view_emails.php" class="btn btn-light">Back to Inbox</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS (for optional JavaScript components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>
