<?php 

include('navbar.php');
if(!isset($_SESSION["user_name"])){
    header("location:log.php");
    exit();
    }else {
?>

<div class="registration-container">
    <form class="registration-form shadow" action="register_user.php" method="POST">
        <h2>Regi<span class="text-theme">ster</span></h2>
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="" disabled selected>Select your Role</option>
                <option value="admin">Admin</option>
                <option value="publisher">Publisher</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="" disabled selected>Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <p class="mt-3 text-center">Already have an account? <a href="#">Login here</a></p>
    </form>
</div>

<?php include('footer.php') ?>
<?php } ?>