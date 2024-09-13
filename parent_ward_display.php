<?php
    $pageTitle = "My Wards";
    require_once("assets/header.php");
    require_once("assets/db_connect.php");

    // Check if parent is logged in
    if(!isset($_SESSION['parent_id'])) {
        header("Location: parent_login.php");
    }

    // Get parent's wards
    $parent_id = $_SESSION['parent_id'];
    $query = "SELECT * FROM students WHERE guardian_id = $parent_id";
    $result = mysqli_query($conn, $query);

    // Check if any wards exist
    if(mysqli_num_rows($result) > 0) {
        echo "<div class='d-flex flex-wrap gap-3'>";
        while($row = mysqli_fetch_assoc($result)) {
?>
            <div class="card" style="width: 18rem; object-fit: contain;">
                <img class="card-img-top" src="<?= $row['student_dp'] ?>" alt="<?= $row['firstname'] ?>" style="height: 200px; object-fit: cover; object-position: top">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['firstname'] . " " . $row['surname'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['class'] . " - " . $row['department'] ?></h6>
                    <p class="card-text"><?= $row['email'] ?></p>
                    <a href="ward_profile.php?sid=<?= $row['student_id'] ?>" class="btn btn-primary">View Profile</a>
                </div>
            </div>
<?php
        }
        echo "</div>";
    } else {
        echo "<h3>No wards found for this parent</h3>";
    }
?>