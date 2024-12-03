<?php 
include('navbar.php');
include('conn.php');
include('count_user.php');


if(!isset($_SESSION["user_name"])){
header("location:log.php");
exit();
}else {





?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-lg-2 sidebar bg-dark">
            <div class="container-fluid" style="padding:10px;">
                <a class="navbar-brand text-white" href="#" >Admin Dashboard</a>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="view_emails.php"><i class="fas fa-file-alt"></i>E-Mails</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
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
            <div class="container-fluid">
                <h1 class="mb-4">Dashboard</h1>
                <div class="row">
                    <!-- Total Users Card -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">Number of users registered: <strong id="total-users"><?php echo $totalUsers ?></strong></p>
                               
                                <i class="fas fa-users card-icon"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Total Posts Card -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Posts</h5>
                                <p class="card-text">Number of posts published: <strong id="total-posts"><?php echo $totalPosts ?></strong></p>
                                <i class="fas fa-file-alt card-icon"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pending E-Mails</h5>
                                <p class="card-text">Number of Unseen E-Mails: <strong id="pending-requests"><?php echo $unseen_email_count  ?></strong></p>
                                <i class="fas fa-hourglass-half card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Charts -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User Growth</h5>
                                <div class="chart-container">
                                    <canvas id="userGrowthChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Post Statistics</h5>
                                <div class="chart-container">
                                    <canvas id="postStatisticsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activities</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Activity</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>User John Doe logged in</td>
                                            <td>2024-09-13</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Post "New Features" published</td>
                                            <td>2024-09-12</td>
                                        </tr>
                                        <!-- More rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.0/dist/chart.min.js"></script>
<script>
    // Example data
    const userGrowthData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'User Growth',
            data: [10, 20, 15, 25, 30, 40, 45],
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            fill: true
        }]
    };

    const postStatisticsData = {
        labels: ['Web Development', 'Mobile Apps', 'Design', 'Technology'],
        datasets: [{
            label: 'Posts by Category',
            data: [12, 7, 3, 8],
            backgroundColor: ['#007bff', '#28a745', '#dc3545', '#ffc107']
        }]
    };

    // Create charts
    const ctxUserGrowth = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(ctxUserGrowth, {
        type: 'line',
        data: userGrowthData
    });

    const ctxPostStatistics = document.getElementById('postStatisticsChart').getContext('2d');
    new Chart(ctxPostStatistics, {
        type: 'pie',
        data: postStatisticsData
    });
</script>
</body>
</html>
<?php } ?>