<?php 
include('navbar.php') ;

?>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center animated-text animate">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Contact<span class="text-theme"> Me</span></h1>
                <hr class="mx-auto mb-5 w-85">
                <div class="contact-form">
                    <form action="send_email.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn submit-btn w-100" >Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php') ?>
