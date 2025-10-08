<?php
    $pageTitle = 'Contact Page';
    require_once('assets/header.php');   
?>
    <!-- <main>
        <h1>Contact Us</h1>       
    <main> -->
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

    <div class="container my-5">
  <div class="contant text-center">
    <h1 class="mb-4 text-primary">Contact Us</h1>
    
    <div class="form mx-auto" style="max-width: 600px;">
      <form action="" method="POST" class="p-4 border rounded-3 shadow-sm bg-light">

        <div class="mb-3 text-start">
          <input 
            type="text" 
            name="Name" 
            value="<?= $name?>" 
            placeholder="Enter Your Full Name" 
            autocomplete="off" 
            class="form-control"
          >
          <span class="text-danger small"><?= $nameError?></span>
        </div>

        <div class="mb-3 text-start">
          <input 
            type="email" 
            name="E-mail" 
            value="<?= $email?>" 
            placeholder="Enter Your E-mail" 
            autocomplete="off" 
            class="form-control"
          >
          <span class="text-danger small"><?= $emailError?></span>
        </div>

        <div class="mb-3 text-start">
          <input 
            type="text" 
            name="Subject" 
            value="<?= $subject?>" 
            placeholder="Enter Your Subject" 
            autocomplete="off" 
            class="form-control"
          >
          <span class="text-danger small"><?= $subjectError?></span>
        </div>

        <div class="mb-3 text-start">
          <textarea 
            name="Message" 
            placeholder="Your Message" 
            autocomplete="off" 
            class="form-control" 
            rows="4"
          ></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Send</button>
      </form>
    </div>
  </div>
</div>

<!-- 
        <div class="contant">
             <h1>Contact Us</h1> 
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



    <?php
    require_once('assets/footer.php');
?>        
</body>
</html>