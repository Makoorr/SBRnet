<?php
    session_start();
    unset($_SESSION["authentication"]);
    unset($_SESSION["auth_user"]);

    $_SESSION['message'] = "Logged Out Successfully";
    header("Location: loginpage.php");
    exit(0);
?>