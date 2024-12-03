<?php 

include('navbar.php') ;

if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2>Create New Post</h2>
                </div>
                <div class="card-body">
                    <form action="post_create.php" method="POST" enctype="multipart/form-data">
                        <!-- Post Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
                        </div>

                        <!-- Post Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Post Content</label>
                            <textarea class="form-control" id="content" name="content" rows="6" placeholder="Write your post content here"></textarea>
                        </div>

                        <!-- Post Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option selected disabled>Select a category</option>
                                <option value="Web Development">Web Development</option>
                                <option value="Mobile Apps">Mobile Apps</option>
                                <option value="Design">Design</option>
                                <option value="Technology">Technology</option>
                            </select>
                        </div>

                        <!-- Post Tags -->
                        <div class="mb-3">
                            <label for="tags" id="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags separated by commas">
                        </div>

                        <!-- Post Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <!-- Post Publish Date -->
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Publish Date</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date">
                        </div>
                        <!--Post Author Name  -->
                        <div class="mb-3">
                            <label for="author_name" class="form-label">Author Name</label>
                            <input type="text" class="form-control" id="author_name" name="author_name">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php')
?>
<?php } ?>