<?php include('navbar.php');
include('conn.php');

// Fetch all posts from the database
$sql = "SELECT id, title, content, category, tags, image, publish_date, created_at, author_name FROM posts";
$result = $conn->query($sql);


$posts_per_page = 5;

// Get the current page number from the URL, if not present default to 1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

// Calculate the OFFSET for SQL query
$offset = ($current_page - 1) * $posts_per_page;

// Get the total number of posts
$total_posts_query = "SELECT COUNT(*) as total FROM posts";
$total_posts_result = $conn->query($total_posts_query);
$total_posts_row = $total_posts_result->fetch_assoc();
$total_posts = $total_posts_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_posts / $posts_per_page);

// Retrieve posts for the current page using LIMIT and OFFSET
$sql = "SELECT id, title, content, category, tags, image, publish_date, author_name 
        FROM posts 
        ORDER BY id DESC 
        LIMIT $posts_per_page OFFSET $offset";
$result = $conn->query($sql);

?>
<!-- <?php
// echo "<html>";
// echo "<head>";
// echo "<link rel='stylesheet' type='text/css' href='css/blog.css'>";
// echo "</head>";

?> -->




    <!-- Header -->
    <header class="blog-header ">
        <div class="overlay ">
            <div class="container ">
                <h1>My <span class="text-theme"> Blog</span></h1>
                <p>Insights, tips, and stories from the world of tech and development.</p>
                <a href="#posts" class="btn btn-primary">Explore Posts</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-5" id="posts">
        <div class="row ">
        
            <!-- Blog Posts -->
            <div class="col-md-8 ">
            <?php
                if ($result->num_rows > 0) {
                    // Output each post
                    while ($row = $result->fetch_assoc()) {
                ?>
                <!-- Blog Post 1 -->
                <div class="blog-post shadow">
                <img src="uploads/<?php echo $row['image']; ?>" class="card-img" alt="Post Image">
                    <div class="post-content">
                        <h2><?php echo $row['title']; ?></h2>
                        <p><small>Posted on <?php echo $row['publish_date']; ?> by <strong><?php echo $row['author_name']; ?></strong></small></p>
                        <p><?php echo substr($row['content'], 0, 150) . '...'; ?></p>
                        <a href="read_more.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                        
                    </div>
                </div><?php
                        }
                    } else {
                        echo "<p>No posts found.</p>";
                    }

                    // Close connection
                    $conn->close();
                ?>
                
                <!-- Add more blog posts as needed -->
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="sidebar shadow bar">
                    <h4>About Me</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula, ipsum eu sagittis lacinia, sapien velit euismod nisi, nec cursus nulla purus vel turpis.</p>
                    
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Android Development</a></li>
                        <li><a href="#">Social Media Marketing</a></li>
                        <li><a href="#">General</a></li>
                    </ul>
                    
                    <h4>Archives</h4>
                    <ul>
                        <li><a href="#">September 2024</a></li>
                        <li><a href="#">August 2024</a></li>
                        <li><a href="#">July 2024</a></li>
                        <!-- Add more archive links as needed -->
                    </ul>
                </div>
            </div>
        </div>
         <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php
            // Display Previous link
            if ($current_page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
            }

            // Display page numbers
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
            }

            // Display Next link
            if ($current_page < $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
            }
            ?>
        </ul>
    </nav>
    </div>


<?php include('footer.php') ?>