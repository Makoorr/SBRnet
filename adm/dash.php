<?php
    include('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SBRDashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <?php
                    // Your message code
                    if(isset($_SESSION['message']))
                    {
                        echo '<h4 class="alert alert-warning">'.$_SESSION['message'].'</h4>';
                        unset($_SESSION['message']);
                    } // Your message code
                ?>

                <h4>Welcome to Home Page</h4>
                <ul>
                    <li><a href="comm.php">Commandes</a></li>
                    <li><a href="prod.php">Produits</a></li>
                </ul>
                
                <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
}
else{
    header("location: loginpage.php");
}
?>