<?php
    $pageTitle = "My Wards";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    // Check if parent is logged in
    if(!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    // Check if ward is selected
    if (!isset($_GET['sid'])) {
        header("Location: parent_ward_display.php");
    }

    $student_id = $_GET['sid'];
    $query = "SELECT * FROM students WHERE student_id = $student_id lIMIT 1";
    $result = mysqli_query($conn, $query);
    $student_data = mysqli_fetch_assoc($result);

    // validating entry 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $student_dp = $_FILES['student_dp'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $surname = $_POST['surname'];
        $dob = $_POST['dob'];
        $home_address = $_POST['home_address'];

        if(isset($student_dp) && $student_dp['error'] == 0) {
            $filename = $firstname . '_' . $surname . "_" . uniqid() . "." . pathinfo($student_dp['name'], PATHINFO_EXTENSION);
            $fileLocation = "student_dp/" . $filename;
            unlink($student_data['student_dp']);
        } else {
            $fileLocation = $student_data['student_dp'];
        }

        echo "$firstname, $middlename, $surname, $dob, $home_address, $fileLocation <br/>";
        $sql = "UPDATE students SET firstname= ?, middlename = ?, surname = ?, dob = ?, home_address = ?, student_dp= ? WHERE student_id = ?";
        $updateSql = $conn -> prepare($sql);
        $updateSql->bind_param("ssssssi", $firstname, $middlename, $surname, $dob, $home_address, $fileLocation, $student_id);
        if ($updateSql->execute()) {
            move_uploaded_file($student_dp['tmp_name'], $fileLocation);
            header("Location: ward_profile.php?sid=$student_id");
        }
    }
?>
<div style="width:300px">
    <?= $student_data['student_dp']; ?>
    <form action="" method='post' enctype='multipart/form-data'>

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td colspan="2">
                        <img class="card-img-top" src="<?= $student_data['student_dp'] ?>" alt="<?= $student_data['firstname'] ?>" style="height: 200px; object-fit: cover; object-position: top" name="imagePreview" id="imagePreview">
                        <input type="file" name="student_dp" id="student_dp" class="form-control" />
                </td>
                </tr>
                <tr>
                    <th scope="row">Firstname</th>
                    <td><input type='text' class="form-control" name="firstname" value='<?= $student_data['firstname']; ?>' required/></td>
                </tr>
                <tr>
                    <th scope="row">middlename</th>
                    <td><input type='text' class="form-control" name="middlename" value='<?= $student_data['middlename']; ?>'/></td>
                </tr>
                <tr>
                    <th scope="row">Surname</th>
                    <td><input type='text' class="form-control" name="surname" value='<?= $student_data['surname']; ?>' required/></td>
                </tr>
                <tr>
                    <th scope="row">Date Of Birth</th>
                    <td><input type='date' class="form-control" name="dob" value='<?= $student_data['dob']; ?>' required/></td>
                </tr>
                <tr>
                    <th scope="row">Home Address</th>
                    <td><textarea name="home_address" required> <?= $student_data['home_address']; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type='submit' class="btn btn-success" value='Update Profile'/>
                    </td>    
                </tr>
            </tbody>
        </table>
    </form>
</div>

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