<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBR-Pharma</title>
    <link rel = "icon" type = "image/png" href = "assets/img/iconsbr.png">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/0552f5e21b.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php" class="logo me-auto"><img src = "assets/img/logosbr.png" alt="" class="img-fluid"></a> -->
        <h1 class="logo me-auto"><a href="index.php" style="text-decoration:none;"><img src = "assets/img/logosbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;">  SBR-Pharma</span> </a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="active" href="index.php" style="text-decoration:none;">Accueil</a></li>
                <li class="dropdown"><a style="cursor: pointer;"><span>Nos Produits</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                    <?php
                    $sql="SELECT distinct categorie,nom_categorie FROM produits;";
                    $produits = $db->query($sql);

                    foreach($produits as $prod){
                    ?>
                        <li><a href="<?php echo($prod['categorie'])?>.php"><?php echo($prod['nom_categorie']) ?></a></li>
                    <?php
                    }
                    ?>
                    </ul>
                <li><a href="contact.php" style="text-decoration:none;">Contact</a></li>
                </li>

                <li class="cart-icon">
                    <a style="cursor: pointer;">
                    <i class="fas fa-cart-plus"></i>
                        <span id="cartquantity">0</span>
                    </a>
                <div class="cart-hover">
                    <div class="select-items"> <!-- El names are : Itemx : itemxquantity | itemxname | itemxprice | onclick="sup(1)" -->
                        <table>
                            <tbody id="cart-items">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="select-total">
                        <span>total:</span>
                        <h5>DT <h5 id="totalprice">0</h5></h5>
                    </div>
                    <div class="select-button">
                        <a href="commander.php" class="primary-btn checkout-btn">Commander</a>
                    </div>
                </div>
                </li>
            <!-- <li><a href="huilesess.php">Produits</a></li> -->
            
            <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                    </ul>
                </li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
                </ul>
            </li> -->
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

        </div>
    </header><!-- End Header -->

    <section class="mb-4" style="padding-top: 12%;padding-bottom: 15%;height:46em;">
        <div class="container" style="text-align: center;margin-top: 10em;">
            <h1>Votre demande a été envoyé avec succès!</h1>
            <a href="http://localhost/sbrnet/index.php">Retour</a>
        </div>
    </section>

    <!-- ======= Footer ======= -->
    <footer id="footer" style="height:100%">
      <!-- Copyright -->
        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> | <strong><span> SBR-Pharma</span></strong>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <strong><span>Notre page facebook&nbsp;&nbsp;</span></strong>
                <a href="https://www.facebook.com/Produits-Parapharmaceutiques-Cosm%C3%A9tiques-124308735628194" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <script src="assets/js/main.js"></script>
</body>
</html>