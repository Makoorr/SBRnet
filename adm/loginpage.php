<?php
    include("config.php");
    if (! isset($_POST['login']) && ! isset($_POST['password'])){
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

            <form action="loginpage.php" method="post">
                <input type="text" id="login" name="login" placeholder="login">
                <input type="text" id="password" name="login" placeholder="password">
                <input type="submit" style="background-color: #18d26e;" value="Log In">
            </form>
        </div>
    </div>
</body>
</html>
<?php
    }
    else{
        // header("location: dash.php");//dashboard here
    }
?>