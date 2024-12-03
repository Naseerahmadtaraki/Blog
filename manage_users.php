<?php 
include('navbar.php') ;
include('conn.php');

if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {

// Check if a search query was provided
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
    // Escape the search query to prevent SQL injection
    $search = $conn->real_escape_string($search);
    
    // SQL query to search by full_name, email, phone, role, or gender
    $sql = "SELECT id, full_name, email, phone, role, gender 
            FROM users 
            WHERE full_name LIKE '%$search%' 
            OR email LIKE '%$search%' 
            OR phone LIKE '%$search%' 
            OR role LIKE '%$search%' 
            OR gender LIKE '%$search%'";
} else {
    // Default SQL query to show all users if no search query is provided
    $sql = "SELECT id, full_name, email, phone, role, gender FROM users";
}

$result = $conn->query($sql);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .content {
            padding: 20px;
        }

        .card-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            color: #6c757d;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .user-table {
            margin-top: 20px;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .pagination {
            justify-content: center;
        }

        .action-icons i {
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-lg-2 sidebar bg-dark">
                <div class="container-fluid" style="padding:10px;">
                    <a class="navbar-brand text-white" href="#">Admin Dashboard</a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_emails.php"><i class="fas fa-file-alt"></i>E-Mails</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
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

            <!-- Main Content -->
            <div class="col-lg-10 content">
                <h1 class="mb-4">Manage Users</h1>

                <!-- Search Bar -->
                <div class="row search-bar">
                    <div class="col-md-6">
                        <form action="" method="GET">
                            <input type="text" name="search" class="form-control" placeholder="Search Here" value="<?php echo $search; ?>">
                        </form>                    
                </div>
                    <div class="col-md-6 text-end">
                    <a href="registration.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New User</a>                    </div>
                </div>

                <!-- User Table -->
                <div class="table-responsive user-table">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Gender</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                        <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                    echo "<a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No users found</td></tr>";
            }

            // Close the connection
            $conn->close();
                ?>
                            <!-- User rows will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    
    <!-- Dummy Data and Script for User Management -->
         <?php

            include('footer.php');
            ?>


</body>

</html>
<?php } ?>