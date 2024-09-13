<?php
    $pageTitle = "My Wards";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    // Check if parent is logged in
    if(!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    $student_id = $_GET['sid'];
    $query = "SELECT * FROM students WHERE  student_id = $student_id lIMIT 1";
    $result = mysqli_query($conn, $query);
    $student_data = mysqli_fetch_assoc($result);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $student_id = $_POST['student_id'];
        $delete_student = $_POST['delete_student'];
        $student_dp = $_POST['student_dp'];
        
        if($delete_student == "Delete") {
            $query = "DELETE FROM students WHERE student_id = $student_id lIMIT 1";
            $result = mysqli_query($conn, $query);
            unlink($student_dp);
            echo "<script>alert('Profile Deleted Successfully')</script>";
            header("Location: parent_ward_display.php");
        } else {
            header("Location: parent_ward_display.php");
        }
    }
?>

<form action="" method="post">
    <p>Do you want to delete <?= $student_data['firstname'] . " - " .$student_data['surname'] ?> Profile</p>
    <i>This Process is irreversable</i>
    <input type="hidden" name="student_id" value="<?= $student_id?>">
    <input type="hidden" name="student_dp" value="<?= $student_data['student_dp']?>">
    <input type="submit" name="delete_student" class="btn btn-danger" value="Delete"/>
    <input type="submit" class="btn btn-success" name="dont" value="Don't delete"/>
</form>