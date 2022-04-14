<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBRPharma</title>
    <link rel = "icon" type = "image/png" href = "assets/img/iconsbr.png">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/0552f5e21b.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</head>

<body>
    <?php
        include ('includes/header.php');
    ?>

    <section class="mb-4" style="padding-top: 12%;padding-bottom: 15%;height:46em;">
        <div class="container" style="text-align: center;margin-top: 10em;">
            <h1>Votre demande a été envoyé avec succès!</h1>
            <a href="http://localhost/sbrnet/index.php">Retour</a>
        </div>
    </section>

    <?php
        include('includes/footer.php');
    ?>
</body>
</html>