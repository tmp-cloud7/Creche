<?php
    $pageTitle = "Student Registration";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    // Check if parent is logged in
    if(!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    // Initializing Variables
    $dpError = $passError = $emailError = $phone1Error = $phone2Error = ""; # Error Variables
    $firstname = $middlename = $surname = $gender = $dob = $password = $cpassword = $student_address = $class = $department = ""; // Student Variables
    
    $guardian_id = $_SESSION['parent_id'];
    // Form Validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capturing student bio-data
        $firstname = htmlspecialchars(trim($_POST["firstname"]));
        $middlename = htmlspecialchars(trim($_POST["middlename"]));
        $surname = htmlspecialchars(trim($_POST["surname"]));
        $gender = htmlspecialchars($_POST["gender"]);
        $dob = htmlspecialchars($_POST["dob"]);
        $student_address = htmlspecialchars($_POST['student_address']);
        $class = htmlspecialchars($_POST['class']);
        $department = htmlspecialchars($_POST['department']);
        $student_dp = $_FILES['student_dp'];

        // echo $student_dp['error'];
        if($student_dp['error'] == 0) {
            // echo pathinfo($student_dp['name'], PATHINFO_EXTENSION);
            $filename = $firstname . '_' . $surname . "_" . uniqid() . "." . pathinfo($student_dp['name'], PATHINFO_EXTENSION);
            $fileLocation = "student_dp/" . $filename;
        } else {
            $dpError = "Error in uploading file";
        }

        // Hashing the password
        $pass = password_hash($surname, PASSWORD_DEFAULT);

        // Validating email address
        $email = $firstname . $surname . rand(1,100) . "@cresh.edu.ng";
        $email = strtolower(str_replace(" ", "",$email));
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM students WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $emailError = "$email already exists";
            }
        } else {
            $emailError = "Invalid email format";
        }

        // Image Validation
        if (empty($student_dp['']))

        // Population the database
        if($emailError == "" && $dpError == "") {
            // Populating the guardian database
            $sql = "INSERT INTO students(firstname, middlename, surname, dob, email, password, gender, home_address, guardian_id, class, department, student_dp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssssssssssss",$firstname, $middlename, $surname, $dob, $email, $pass, $gender,  $student_address, $guardian_id, $class, $department, $fileLocation);
                if($stmt->execute() && move_uploaded_file($student_dp['tmp_name'], $fileLocation)){
                    // move_uploaded_file($student_dp['tmp_name'], $fileLocation);
                    echo "<h1>Registered Successfully</h1>";
                } else {
                    echo "Error: ". $stmt->error;
                };
            }
        } else {
            echo "Errors: $emailError, $dpError";
        }
        
    }

?>

<main class="m-5 p-5" style="background: gray;">
    <form autocomplete="off" method="post" action="" style="display: flex; gap: 20px; flex-flow: column" enctype="multipart/form-data">

        <h1>Student Registration</h1>
        
        <div class="row">
            <img src="" alt="File Upload" name="imagePreview" id="imagePreview" class="form-control"/>
            <input type="file" name="student_dp" id="student_dp" class="form-control" required />
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?= $firstname?>" required/>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Middlename (Optional)" name="middlename" value="<?= $middlename?>"/>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Surname" name="surname" value="<?= $surname?>" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                Gender:
                <input type="radio" name="gender" value="Male"/> Male
                <input type="radio" name="gender" value="Female" checked/> Female
                <input type="radio" name="gender" value="Others"/> Others
            </div>
            <div class="col">
                <div class="d-flex">
                    Date Of Birth:
                    <input type="date" class="form-control" name="dob" value="<?= $dob ?>" required/>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <textarea placeholder="Home Address" name="student_address" class="form-control" required><?= $student_address?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col">
                Class:
                <select class="form-select" name="class" value="<?= $class?>" required>
                    <option value="Cresh">Cresh</option>
                    <option value="KG1">KG1</option>
                    <option value="KG2">KG2</option>
                    <option value="Nur1">Nur1</option>
                    <option value="Nur2">Nur2</option>
                    <option value="Pry1">Pry1</option>
                    <option value="Pry2">Pry2</option>
                    <option value="Pry3">Pry3</option>
                    <option value="Pry4">Pry4</option>
                    <option value="Pry5">Pry5</option>
                    <option value="Pry6">Pry6</option>
                    <option value="JSS1">JSS1</option>
                    <option value="JSS2">JSS2</option>
                    <option value="JSS3">JSS3</option>
                    <option value="SSS1">SSS1</option>
                    <option value="SSS2">SSS2</option>
                    <option value="SSS3">SSS3</option>
                </select>
            </div>
            <div class="col">
                Department:
                <select class="form-select" name="department" value="<?= $department?>" required>
                    <option value="null">No Selection</option>
                    <option value="Art">Art</option>
                    <option value="Science">Science</option>
                    <option value="Commercial">Commercial</option>
                    
                </select>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Sign In"/>
    </form>
</main>


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