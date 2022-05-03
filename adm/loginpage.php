<?php
    include("config.php");
    session_start();
if(! isset($_SESSION['authentication']))
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SBRswitchmed</title>
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

                <?php
                        // Your message code
                        if(isset($_SESSION['message']))
                        {
                            echo "<h4 style='background-color: white;color: red;border: none;'>".$_SESSION['message'].'</h4>';
                            unset($_SESSION['message']);
                        } // Your message code
                ?>

                <form action="logincon.php" method="post">
                    <input type="text" id="login" name="login" placeholder="login">
                    <input type="text" style="-webkit-text-security: disc;" id="password" name="password" placeholder="password">
                    <input type="submit" id="loginbtn" style="background-color: #18d26e;" value="Log In">
                </form>
            </div>
        </div>
    </body>
    </html>
<?php
}
else{
    header("location:dash.php");
}
?>