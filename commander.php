<?php
  require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBRPara</title>
    <link rel = "icon" type = "image/png" href = "assets/img/iconsbr.png">

    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/ajax/magnific-popup.css">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/elegant-icons.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/font-awesome.min.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/jquery-ui.min.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/nice-select.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/slicknav.min.css" rel="stylesheet">
    <link href="assets/vendor/jQuery/elegant-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/fontawesome.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/0552f5e21b.js" crossorigin="anonymous"></script>
    <script src="assets/vendor/jQuery/jquery.js"></script>
    <script src="assets/vendor/jQuery/isotope-pkgd.js"></script>
    <script src="assets/vendor/jQuery/magnific-popup.js"></script>
    <script src="assets/js/main.js"></script>
</head>

<body onload="updatecookie();checkoutajt()">
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php" class="logo me-auto"><img src = "assets/img/logosbr.png" alt="" class="img-fluid"></a> -->
        <h1 class="logo me-auto"><a href="index.php"><img src = "assets/img/logosbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;">  SBR-Pharma</span> </a></h1>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="active" href="index.php">Accueil</a></li>
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
                    <li><a href="contact.php">Contact</a></li>
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
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header><!-- End Header -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad" style="margin-top: 4em;">
        <div class="container">
            <form class="checkout-form" action="checkout.php" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Détails de la facturation</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="nom">Nom<span>*</span></label>
                                <input type="text" id="nom" name="nom">
                            </div>
                            <div class="col-lg-6">
                                <label for="prenom">Prénom<span>*</span></label>
                                <input type="text" id="prenom" name="prenom">
                            </div>
                            <div class="col-lg-12">
                                <label for="email">Adresse E-mail<span>*</span></label>
                                <input type="text" id="email" name="email">
                            </div>
                            <div class="col-lg-12">
                                <label for="phone">Numéro de téléphone<span>*</span></label>
                                <input type="number" id="phone" name="phone">
                            </div>
                            <div class="col-lg-12">
                                <label for="ville">Ville<span>*</span></label>
                                <input type="text" id="ville" name="ville">
                            </div>
                            <div class="col-lg-6">
                                <label for="address">Adresse<span>*</span></label>
                                <input type="text" id="address" name="address" class="street-first">
                            </div>
                            <div class="col-lg-6">
                                <label for="zip">Code Postal / ZIP<span>*</span></label>
                                <input type="number" id="zip" name="zip">
                            </div>
                            <div class="col-lg-6 status"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Coupon Code -->
                        <!-- <div class="checkout-content">
                            <input type="text" placeholder="Enter Your Coupon Code">
                        </div> -->
                        <!-- End Coupon Code -->
                        <div class="place-order">
                            <h4>Votre Commande</h4>
                            <div class="order-total">
                                <br>
                                <ul class="order-table" id="order-table">
                                    <li>Product <span>Total</span></li>
                                    <!-- <li class="fw-normal">Combination x 1 <span>$60.00</span></li> -->
                                </ul>
                                <br>
                                <div class="order-table">
                                    <li class="order-table total-price">Total <span style="color: #50cf80;"><a id="totalprix">0.00</a> DT</span></li>
                                </div>
                                <div class="order-btn">
                                    <!-- <button type="submit" class="site-btn place-btn">Place Order</button> -->
                                    <button class="site-btn place-btn" type="button" id="checkoutbtn" onclick="validateCheckout()">Placer Votre Commande</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- Tableau livraison -->
    <div class="container" style="text-align: center;">
      <table style="table-layout:fixed;width:100%;">
        <tr>
          <td><img src="assets/img/delivery-truck.png" alt="" style="width: 150px;height: 115px;"></td>
          <td><img src="assets/img/time.png" alt="" style="width: 150px;height: 115px;"></td>
          <td><img src="assets/img/paiement.png" alt="" style="width: 75px;height: 75px;"></td>
        </tr>
        <tr>
          <td><h6><strong>Commande par livraison</strong></h6></td>
          <td><h6><strong>Livraison à temps</strong></h6></td>
          <td><h6><strong>Paiement à la livraison</strong></h6></td>
        </tr>
      </table>
    </div> <!-- Fin Tableau -->

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- ======= Footer ======= -->
    <footer id="footer" style="height: 100%;">
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

    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>