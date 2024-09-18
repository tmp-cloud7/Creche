<?php
    $pageTitle = "Parent Registration";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

   
    // Initializing Variables
    $passError = $emailError = $phone1Error = $phone2Error = ""; # Error Variables
    // $firstname = $middlename = $surname = $gender = $dob = $password = $cpassword = $student_address = $class = $department = ""; // Student Variables
    $g_firstname = $g_middlename = $g_surname = $g_gender = $g_email = $g_phone1 = $g_phone2 = $g_maritalstatus = $guardian_address = ""; // Guardian Variables
    // htmlspecialchars()
    // Form Validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // // Capturing student bio-data
        // $firstname = htmlspecialchars(trim($_POST["firstname"]));
        // $middlename = htmlspecialchars($_POST["middlename"]);
        // $surname = htmlspecialchars($_POST["surname"]);
        // $gender = htmlspecialchars($_POST["gender"]);
        // $dob = htmlspecialchars($_POST["dob"]);
        // $password = htmlspecialchars($_POST["password"]);
        // $cpassword = htmlspecialchars($_POST["cpassword"]);
        // $student_address = htmlspecialchars($_POST['student_address']);
        // $class = htmlspecialchars($_POST['class']);
        // $department = htmlspecialchars($_POST['department']);

        // Capturing guardian bio-data
        $g_firstname = $_POST["g_firstname"];
        $g_middlename = $_POST["g_middlename"];
        $g_surname = $_POST["g_surname"];
        $g_gender = $_POST["g_gender"];
        $g_email = $_POST["g_email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $g_phone1 = $_POST["g_phone1"];
        $g_phone2 = $_POST["g_phone2"];
        $g_maritalstatus = $_POST["g_maritalstatus"];
        $guardian_address = $_POST['guardian_address'];

        // Validating email address
        if (filter_var($g_email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM guardians WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $g_email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $emailError = "$g_email already exists";
            }
        } else {
            $emailError = "Invalid email format";
        }

        

        // Password Validation
        if($password == $cpassword) {
            if(preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@%$&?-_])[A-Za-z\d!@%$&?-_]{8,}/", $password)) {
                $pass = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $passError = "Password must contain at least 8 characters, including uppercase, lowercase, number, and special character";
            }
        } else {
            $passError = "Password do not match";
        }

        // Phone Number Validation
        if (preg_match('/^0[789][01]\d{8}$|^\+234[789][01]\d{8}$/', $g_phone1)) {
            $sql = "SELECT * FROM guardians WHERE phone1 = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $g_phone1);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $phone1Error = "$g_phone1 already exists";
            }
        } else {
            $phone1Error = "Invalid Phone Number";
        }
        

        if (!empty($g_phone2)) {
            if (preg_match('/^0[789][01]\d{8}$|^\+234[789][01]\d{8}$/', $g_phone2)) {
                $sql = "SELECT * FROM guardians WHERE phone2 = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $g_phone2);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    $phone2Error = "$g_phone2 already exists";
                }
            } else {
                $phone2Error = "Invalid Phone Number";
            }
        } else {
            $g_phone2 = $g_phone1;
        }

        // Population the database
        if($emailError == "" && $passError == "" && $phone1Error == "" && $phone2Error =="") {
            // Populating the guardian database
            $sql = "INSERT INTO guardians (firstname, middlename, surname, phone1, phone2, email, password, gender, marital_status, home_address) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssssssssss",$g_firstname, $g_middlename, $g_surname, $g_phone1, $g_phone2, $g_email, $pass, $g_gender, $g_maritalstatus, $guardian_address);
                if($stmt->execute()){
                    echo "<h1>Registered Successfully</h1>";
                };
            }
        } else {
            echo "Errors: $emailError, $passError, $phone1Error, $phone2Error";
        }
        
    }

?>

<main class="m-5 p-5" style="background: gray;">
    <form autocomplete="off" method="post" action="" style="display: flex; gap: 20px; flex-flow: column">

        <h1>Guardian Biodata</h1>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="First name" name="g_firstname" value="<?= $g_firstname?>" required/>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Middlename (Optional)" name="g_middlename" value="<?= $g_middlename?>"/>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Surname" name="g_surname" value="<?= $g_surname?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="tel" class="form-control" placeholder="Phone Number" name="g_phone1" value="<?= $g_phone1?>" required/>
                <span class="text-danger"><?= $phone1Error ?></span>
            </div>
            <div class="col">
                <input type="tel" class="form-control" placeholder="Alt Phone Number (Optional)" name="g_phone2" value="<?= $g_phone2?>"/>
                <span class="text-danger"><?= $phone2Error ?></span>
            </div>
            <div class="col">
                <input type="email" class="form-control" placeholder="E-Mail Address" name="g_email" value="<?= $g_email?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="password" class="form-control" placeholder="Password" name="password" value="<?= $password?>" required/>
                <span class="text-danger"><?= $passError?></span>
            </div>
            <div class="col">
                <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" value="<?= $cpassword ?>" required />
                <span class="text-danger"><?= $passError?></span>
            </div>
        </div>

        <div class="row">
            <div class="col">
                Gender:
                <input type="radio" name="g_gender" value="Male"/> Male
                <input type="radio" name="g_gender" value="Female" checked/> Female
                <input type="radio" name="g_gender" value="Others"/> Others
            </div>
            <div class="col">
                <div class="d-flex">
                    Marital Status:
                    <select name="g_maritalstatus" required class="form-control" value="<?=$g_maritalstatus?>">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Seperated">Seperated</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <textarea placeholder="Home Address" name="guardian_address" class="form-control"><?= $guardian_address?></textarea>
            </div>
        </div>

        <div class="row ">
            <div class="col">
                <input type="submit" value="Register" class="form-control btn btn-primary"/>
            </div>
        </div>
    </form>
</main>