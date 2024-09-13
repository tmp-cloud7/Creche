<?php
    $pageTitle = "Parent Login";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    $name = " JOHN doe ";
    echo strtolower(str_replace(" ", "",$name));

    if(!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    echo "<h1>welcome, " . $_SESSION['firstname'] . "</h1>";
    // echo "<h1>welcome, $_SESSION['firstname']</h1>";
    $student_dp = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $student_dp = $_FILES['student_dp'];

        // echo $student_dp['error'];
        if($student_dp['error'] == 0) {
            // echo pathinfo($student_dp['name'], PATHINFO_EXTENSION);
            $filename = uniqid('student_') . "." . pathinfo($student_dp['name'], PATHINFO_EXTENSION);
            $fileLocation = "student_dp/" . $filename;
            
        } else {
            echo "Error in uploading file";
        }
    }
    

?>

<style>
    #imagePreview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 5px;
    }
</style>
<form action="" method="post" enctype="multipart/form-data">
    <img src="" alt="File Upload" name="imagePreview" id="imagePreview"/> <br/>
    <input type="file" name="student_dp" id="student_dp" /> <br/>
    <input type="submit" class="btn btn-primary" value="Sign In"/>
</form>

<script>
    const preview = document.querySelector("#imagePreview");
    const studImage = document.querySelector("#student_dp");
    
    studImage.addEventListener("change", function() {
        let file = this.files[0];

        fileSize = 3 * 1024 * 1024;
        if (file['type'] == "image/jpeg" || file['type'] == "image/png" || file['type'] == "image/jpg") {
            if (!(file['size'] > fileSize)) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.src = reader.result;
                }
                reader.readAsDataURL(file);
        } else {
            alert("file exceed 3MB");
            this.value = "";
        }
        } else {
            alert(file['name'] + " is not allowed");
            this.value = "";
        }
    });
</script>