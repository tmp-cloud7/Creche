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
?>
    <div style="width:300px">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <!-- <th scope="row">Student DP</th> -->
                    <td colspan="2"><img class="card-img-top" src="<?= $student_data['student_dp'] ?>" alt="<?= $student_data['firstname'] ?>" style="height: 200px; object-fit: cover; object-position: top"></td>
                </tr>
                <tr>
                    <th scope="row">Firstname</th>
                    <td><?= $student_data['firstname']; ?></td>
                </tr>
                <tr>
                    <th scope="row">middlename</th>
                    <td><?= $student_data['middlename']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Surname</th>
                    <td><?= $student_data['surname']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Date Of Birth</th>
                    <td><?= $student_data['dob']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Email Address</th>
                    <td><?= $student_data['email']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td><?= $student_data['gender']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Home Address</th>
                    <td><?= $student_data['home_address']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Class</th>
                    <td><?= $student_data['class']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Department</th>
                    <td><?= $student_data['department']; ?></td>
                </tr>
                <tr>
                    <td><a href="edit_ward.php?sid=<?= $student_data['student_id'] ?>" class="btn btn-primary">Edit Profile</a></td>
                    <td scope="row"><a href="delete_ward.php?sid=<?= $student_data['student_id'] ?>" class="btn btn-danger">Delete Profile</a></td>
                    
                </tr>
            </tbody>
        </table>
    </div>