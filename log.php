<?php
include('navbar.php');

// Get error message from session and clear it
$login_error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']);
?>




<div class="login-container">

    <form class="login-form shadow" action="login_process.php" method="POST">
        <h2 style="text-align: center;">Log <span class="text-theme">In</span></h2>
        <h6 style="text-align: center;">UserName :<span class="text-theme">demo@demo.comm </span></h6>
        <h6 style="text-align: center;">Password :<span class="text-theme">demo</span></h6>
        <!-- Display error message -->
        <?php if (!empty($login_error)){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($login_error); ?>
            </div>
        <?php }else{} ?>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <p class="mt-3 text-center"><a href="#">Forgot your password?</a></p>
    </form>
</div>


<?php include('footer.php'); ?>
