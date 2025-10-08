<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
   
    <!-- ✅ Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <!-- ✅ Bootstrap JS Bundle (includes Popper.js) -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Optional: Prevent any horizontal scroll caused by elements overflowing */
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary bg-primary-subtle sticky-top">
        <!-- ✅ Use .container instead of .container-fluid to keep content centered -->
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.php">Greenville</a>

            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarTogglerDemo02" 
                aria-controls="navbarTogglerDemo02" 
                aria-expanded="false" 
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <?php if(isset($_SESSION['parent_id'])) { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="parent_ward_display.php">My Wards</a></li>    
                        <li class="nav-item"><a class="nav-link" href="student_registration.php">Register Student</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="parent_register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="parent_login.php">Parent Login</a></li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
</body>
</html>
