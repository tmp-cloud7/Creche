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

    
     <body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 p-4" style="max-width: 420px; width: 100%;">
      <h3 class="text-center mb-4 text-primary fw-bold">Login</h3>

      <form method="post" action="">
        <!-- Email -->
        <div class="mb-3">
          <label for="inputEmail" class="form-label fw-semibold">Email</label>
          <input 
            type="email" 
            class="form-control" 
            id="inputEmail" 
            name="email" 
            placeholder="Enter your email or phone number" 
            required
          >
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="inputPassword" class="form-label fw-semibold">Password</label>
          <input 
            type="password" 
            class="form-control" 
            id="inputPassword" 
            name="password" 
            placeholder="Enter password" 
            required
          >
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-4">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>

        <!-- Submit -->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-lg">Register</button>
        </div>

        <!-- Optional Link -->
        <p class="text-center mt-3 mb-0">
          Already have an account? 
          <a href="login.php" class="text-decoration-none text-primary fw-semibold">Login here</a>
        </p>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS (optional) -->
 </body>

<!-- <form class="m-5 p-5" method="post" action="">
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
</form> -->