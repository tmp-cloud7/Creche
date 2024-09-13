<?php
    $pageTitle = "Parent Login";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    // Validating the form
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get User Input
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate the input
        if(empty($email) || empty($password)) {
            echo "All fields are required";
            exit;
        }

        // Validating Parent Credentials
        $sql ="SELECT * FROM guardians WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Password Validation
            if(password_verify($password, $row['password'])) {
                $_SESSION['parent_id'] = $row['guardian_id'];
                $_SESSION['firstname'] = $row['firstname'];
                header("Location: dashboard.php");
            } else {
                echo "User not Found";
                echo "<a href='parent_register.php'>Click here to register</a>";
                // exit;
            }
        } else {
            echo "User not Found";
            echo "<a href='parent_register.php'>Click here to register</a>";
            // exit;
        }
    }
?>

<form class="m-5 p-5" method="post" action="">
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email or Phone Number">
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password"/>
    </div>
    <div class="form-group">
        <label class="form-check-label"><input type="checkbox"> Remember me</label>
    </div>
    <input type="submit" class="btn btn-primary" value="Register"/>
</form>