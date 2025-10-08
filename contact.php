<?php
    $pageTitle = 'Contact Page';
    require_once('assets/header.php');   
?>
    <main>
        <h1>Contact Us</h1>       
    <main>
    <?php
           $name = $email = $subject ="";
           $nameError = $emailError =  $subjectError ="";
        if ($_SERVER["REQUEST_METHOD"]  == "POST") {
            $name = $_POST['Name'];
            $email = $_POST['E-mail'];
            $subject = $_POST['Subject'];
            $message = $_POST['Message'];

            if(empty($name)) {
                $nameError = "*Your fullname is required ";
            }

            if(empty($email)) {
                $emailError = "*Email is required ";
            }

            if(empty($subject)) {
                $subjectError = "*Subject is required ";
            }

        }


    ?>

        <!-- <div class="contant">
            <div class="form">
                <form action="" method="POST">
                    <input type="text" name= "Name" value="<?= $name?>" placeholder="Enter Your Full Name" autocomplete="off"><br><span><?= $nameError?></br></span>
                    <input type="email" name= "E-mail" value="<?= $email?>" placeholder="Enter Your E-mail" autocomplete="off"><br><span><?= $emailError?></br></span>
                    <input type="text" name= "Subject" value="<?= $subject?>" placeholder="Enter Your Subject" autocomplete="off" ><br><span><?= $subjectError?></br></span>
                    <textarea name="Message" id="" value="<?= $message?>" placeholder="Your Message" autocomplete="off"></textarea>
                    <button type="submit">send</button>
                </form>

            </div>

        </div> -->


    <main class="py-5">
    <div class="container">
        <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">About Us</h1>
        <img src="slide-4.jpg" alt="About Image" class="img-fluid rounded shadow mt-3" style="max-height: 400px; object-fit: cover;">
        </div>

        <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-secondary">Vision</h2>
            <p>
            To be the secondary school of first choice for families within Lagos and beyond — known as a purposeful and effective seat of learning, a warm and caring community where all attain their academic and personal best within a state-of-the-art campus.
            </p>

            <h2 class="text-secondary mt-4">Our Mission</h2>
            <p>
            To establish, manage, and administer a model private school in all spheres with a vision for a greater tomorrow, through a broad, balanced, and functional education that is all about success in life.
            </p>
        </div>
        </div>
    </div>
    </main>

<?php require('assets/footer.php'); ?>
</body>
</html>

    <?php
    require_once('assets/footer.php');
?>        
</body>
</html>