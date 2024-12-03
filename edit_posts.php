<?php
include('navbar.php');
include('conn.php');

if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {
    

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid post ID.";
    exit();
}

$post_id = (int)$_GET['id'];

// Fetch the post data from the database
$sql = "SELECT id, title, content, category, tags, image, publish_date FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    $publish_date = $_POST['publish_date'];
    
    // Handle image upload
    $image= $post['image']; // Default to existing image path
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_upload_dir = 'uploads/';
        $image = $image_upload_dir . $image_name;
        
        // Move the uploaded file to the server
        if (move_uploaded_file($image_tmp_name, $image)) {
            // File uploaded successfully
        } else {
            echo "<div class='alert alert-danger'>Failed to upload image.</div>";
        }
    }
    
    // Validate and update the post in the database
    $update_sql = "UPDATE posts SET title = ?, content = ?, category = ?, tags = ?, publish_date = ?, image = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('ssssssi', $title, $content, $category, $tags, $publish_date, $image, $post_id);

    if ($update_stmt->execute()) {
        echo "<div class='alert alert-success'>Post updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating post: " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Post</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="<?php echo htmlspecialchars($post['category']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" id="tags" name="tags" class="form-control" value="<?php echo htmlspecialchars($post['tags']); ?>">
        </div>

        <div class="mb-3">
            <label for="publish_date" class="form-label">Publish Date</label>
            <input type="date" id="publish_date" name="publish_date" class="form-control" value="<?php echo htmlspecialchars($post['publish_date']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <?php if ($post['image']): ?>
                <div>
                    <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" style="max-width: 200px; max-height: 200px;">
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="manage_post.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php } ?>