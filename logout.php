<?php
    session_start();
    // unset($_SESSION['parent_id']);
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
