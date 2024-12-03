<?php 
include('navbar.php') ;
include('conn.php');

// Fetch data from the database based on ID
$id =$_GET['id'];
?>
 <a href="blog.php" class="btn btn-primary btn-back">Back to Blog</a>
    <div class="container post-container">
        
        <div class="post-header">

            <?php
                $query=mysqli_query($conn,"select * from posts where id = $id");
				$col= mysqli_fetch_row($query); ?>
            
            <img src="uploads/<?php echo $col['5']; ?>" class="card-img" alt="Post Image" style="height:500px;">
            <div class="post-title">
                <?php echo $col['1'];?>
            </div>
                <div class="post-meta">
                <small>Posted on <?php echo $col['6'];?> by <strong><?php echo $col['7'];?></strong></small></p>
                </div>
            </div>

            <div class="post-content">
                <p><?php echo $col['2'];?></p>
            </div>


             
        <!-- Comments Section -->
        <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Comments</h5>

                    <!-- Comment -->
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>John Doe</h6>
                            <p class="mb-0">This is a sample comment text from a user.</p>
                        </div>
                    </div>
                    <!-- Add more comments similarly -->

                    <!-- Leave a Comment -->
                    <div class="comment-box mt-4">
                        <h6>Leave a Comment</h6>
                        <form>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Your Comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
       
    </div>


<?php include('footer.php') ?>