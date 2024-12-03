<?php
include('navbar.php');
include('conn.php');

if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {

// Define how many posts to display per page
$posts_per_page = 10;

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
$offset = ($current_page - 1) * $posts_per_page;

// Modify SQL query to search by title, author_name, or category
$search_sql = '';
$search_params = [];
if ($search) {
    $search_sql = "WHERE title LIKE ? OR author_name LIKE ? OR category LIKE ?";
    $search_params = ["%$search%", "%$search%", "%$search%"];
}

// Get the total number of posts based on the search query
$total_posts_query = "SELECT COUNT(*) as total FROM posts $search_sql";
$stmt = $conn->prepare($total_posts_query);
if ($search) {
    $stmt->bind_param('sss', ...$search_params);
}
$stmt->execute();
$total_posts_result = $stmt->get_result();
$total_posts_row = $total_posts_result->fetch_assoc();
$total_posts = $total_posts_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_posts / $posts_per_page);

// Retrieve posts for the current page using LIMIT and OFFSET
$sql = "SELECT id, title, content, category, tags, publish_date, author_name 
        FROM posts 
        $search_sql 
        ORDER BY id DESC 
        LIMIT $posts_per_page OFFSET $offset";
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
            <div class="container-fluid" style="padding:10px;">
                <a class="navbar-brand text-white" href="#">Admin Dashboard</a>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="view_emails.php"><i class="fas fa-file-alt"></i>E-Mails</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="manage_post.php"><i class="fas fa-file-alt"></i> Manage Posts</a>
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
        <!-- Main Content -->
        <div class="container table-container col-lg-10 content">
            <h1 class="mb-4">Manage Posts</h1>

            <!-- Search Bar -->
            <div class="row search-bar mb-3">
                <div class="col-md-6">
                    <form action="" method="GET">
                        <input type="text" name="search" class="form-control" placeholder="Search Here" value="<?php echo htmlspecialchars($search); ?>">
                        <input type="hidden" name="page" value="<?php echo $current_page; ?>">
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <a href="newpost.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Post</a>
                </div>
            </div>

            <!-- Posts Table -->
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $formattedDate = date("F j, Y", strtotime($row['publish_date']));
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['author_name'] . "</td>";
                            echo "<td>" . $formattedDate . "</td>";
                            echo "<td>";
                            echo "<a href='edit_posts.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='delete_post.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>";
                            echo "<a href='read_more.php?id=" . $row['id'] . "' class='btn btn-secondary btn-sm'>View</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No posts found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

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
    </div>
</div>

<!-- Footer (if needed) -->
<?php include('footer.php'); ?>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
<?php } ?>