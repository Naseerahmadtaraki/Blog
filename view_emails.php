<?php

include("conn.php");
// Fetch the recent email submissions
$sql = "SELECT id, name, email, subject, message, submitted_at FROM contact_form_submissions ORDER BY submitted_at DESC";

include('navbar.php');
// User session access 
if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {


// Define how many posts to display per page
$emails_per_page = 5;

// Get the current page number from the URL, if not present default to 1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

// Get the search query
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Calculate the OFFSET for SQL query
$offset = ($current_page - 1) * $emails_per_page;

// Modify SQL query to search by title, author_name, or category
$search_sql = '';
$search_params = [];
if ($search) {
    $search_sql = "WHERE name LIKE ? OR email LIKE ? OR subject LIKE ?";
    $search_params = ["%$search%", "%$search%", "%$search%"];
}

// Get the total number of posts based on the search query
$total_email_query = "SELECT COUNT(*) as total FROM contact_form_submissions $search_sql";
$stmt = $conn->prepare($total_email_query);
if ($search) {
    $stmt->bind_param('sss', ...$search_params);
}
$stmt->execute();
$total_email_result = $stmt->get_result();
$total_email_row = $total_email_result->fetch_assoc();
$total_email = $total_email_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_email / $emails_per_page);

// Retrieve posts for the current page using LIMIT and OFFSET
$sql = "SELECT id, name, email, subject, message,submitted_at 
        FROM contact_form_submissions 
        $search_sql 
        ORDER BY id DESC 
        LIMIT $emails_per_page OFFSET $offset";
$stmt = $conn->prepare($sql);
if ($search) {
    $stmt->bind_param('sss', ...$search_params);
}
$stmt->execute();
$result = $stmt->get_result();



?>

<div class="container-fluid">
        <div class="row">

<!-- Sidebar -->
<nav class="col-lg-2 sidebar bg-dark">
                <div class="container-fluid" style="padding: 10px;">
                    <a class="navbar-brand text-white" href="#">Admin Dashboard</a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="view_emails.php"><i class="fas fa-file-alt"></i>E-Mails</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_post.php"><i class="fas fa-file-alt"></i> Manage Posts</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
<div <div class="container table-container col-lg-10 content">
    <h1>Recent Emails Sent</h1>

    <!-- Search Bar -->
            <div class="row search-bar mb-3">
                <div class="col-md-6">
                    <form action="" method="GET">
                        <input type="text" name="search" class="form-control" placeholder="Search Here" value="">
                        <input type="hidden" name="page" value="<?php echo $current_page; ?>">
                    </form>
                </div>
                <div class="col-md-6 text-end">
                <!-- <div class="col-lg-8 mb-4">
                        <div class="card" style="text-align: left;">
                    
                        <?php
                                // $sql = "SELECT COUNT(*) as unseen_count FROM contact_form_submissions WHERE is_seen = 0";
                                // $result1 = $conn->query($sql);
                                // if ($result1 && $row = $result1->fetch_assoc()) {
                                    // $email_count = $row['unseen_count'];
                                // } else {
                                    
                                // }    

                                ?>
                               
                            <div class="card-body">
                                <h5 class="card-title">Pending E-Mails</h5>
                                <p class="card-text">Unseen E-Mails: <strong id="pending-requests"><?php echo $email_count  ?></strong></p>
                                <i class="fas fa-hourglass-half card-icon"></i>
                            </div>
                        </div>
                    </div>                </div> -->
            </div>

    <!-- Email Table -->
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars(substr($row['message'],0,70))); ?></td>
                        <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                        <td><a href="view_email_details.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">View Details</a></td> <!-- Link to details page -->

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No emails have been sent recently.</p>
    <?php endif; ?>
                <!-- Pagination -->
                <nav class="pagination_nav2">
                <ul class="pagination">
                    <?php
                    // Display Previous link
                    if ($current_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '&search=' . urlencode($search) . '">Previous</a></li>';
                    }

                    // Display page numbers
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '&search=' . urlencode($search) . '">' . $i . '</a></li>';
                        }
                    }

                    // Display Next link
                    if ($current_page < $total_pages) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '&search=' . urlencode($search) . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </nav>

</div>

<?php
// Close the database connection
$conn->close();

include('footer.php');
?>

</body>
</html>
<?php } ?>