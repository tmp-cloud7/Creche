<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
   
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary-subtle bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Greenville</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <?php if(isset($_SESSION['parent_id'])) {?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="parent_ward_display.php">My Wards</a></li>    
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="student_registration.php">Register Student</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">Logout</a></li>
                    </ul>
                <?php } else {?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="contact.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="parent_register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="parent_login.php">Parent Login</a></li>
                    </ul>
                <?php }?>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            </div>
        </div>
    </nav>