<?php
    require_once('config.php');
    if ($_COOKIE['post']==1){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBRSwitchmed</title>
    <link rel = "icon" type = "image/png" href = "assets/img/iconsbr.png">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/0552f5e21b.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <script src="assets/js/main.js"></script>
</head>

<body onload="updatecookie();">
    <?php
        include ('includes/header.php');
    ?>

    <section class="mb-4" style="padding-top: 12%;padding-bottom: 15%;height:46em;">
        <div class="container" style="text-align: center;margin-top: 10em;">
            <h1>Votre demande a été envoyé avec succès!</h1>
            <a href="./index.php">Retour</a>
        </div>
    </section>

    <?php
        include('includes/footer.php');
        include('includes/scripts.php');
        setcookie("post","0",0,"/");
    ?>
</body>
</html>
<?php
    }
    else{
        header('location:./index.php');
    }
?>