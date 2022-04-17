<?php
    include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBRPharma</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="logincss.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div id="formContent">
            <!-- Icon -->
            <div style="padding: 2em;">
                <img src="../assets/img/logosbr(txt).png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form>
                <input type="text" id="login" name="login" placeholder="login">
                <input type="text" id="password" name="login" placeholder="password">
                <input type="submit" style="background-color: #18d26e;" value="Log In">
            </form>

        </div>
    </div>
</body>
</html>