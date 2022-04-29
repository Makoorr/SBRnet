<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBRPharma</title>
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
<?php
  require_once('config.php');
  if(isset($_COOKIE['cartquantity'])){
?>
    <body onload="updatecookie();checkoutajt()">
        <?php
            include ('includes/header.php');
        ?>

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
                                <div class="col-lg-3">
                                    <label for="ville">Ville<span>*</span></label><br>
                                    <select required class="form-select ville-select" aria-label="Default select example" id="ville" name="ville">
                                        <option value= "" disabled="">Sélectionner</option>
                                        <option value="Ariana" selected="">Ariana</option>
                                        <option value="Beja">Béja</option>
                                        <option value="Ben Arous">Ben Arous</option>
                                        <option value="Bizerte">Bizerte</option>
                                        <option value="Gabes">Gabes</option>
                                        <option value="Gafsa">Gafsa</option>
                                        <option value="Jendouba">Jendouba</option>
                                        <option value="Kairouan">Kairouan</option>
                                        <option value="Kasserine">Kasserine</option>
                                        <option value="Kebili">Kebili</option>
                                        <option value="La Manouba">La Manouba</option>
                                        <option value="Le Kef">Le Kef</option>
                                        <option value="Mahdia">Mahdia</option>
                                        <option value="Medenine">Médenine</option>
                                        <option value="Monastir">Monastir</option>
                                        <option value="Nabeul">Nabeul</option>
                                        <option value="Sfax">Sfax</option>
                                        <option value="Sidi Bouzid">Sidi Bouzid</option>
                                        <option value="Siliana">Siliana</option>
                                        <option value="Sousse">Sousse</option>
                                        <option value="Tataouine">Tataouine</option>
                                        <option value="Tozeur">Tozeur</option>
                                        <option value="Tunis">Tunis</option>
                                        <option value="Zaghouan">Zaghouan</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="address">Adresse<span>*</span></label>
                                    <input type="text" id="address" name="address" class="street-first">
                                </div>
                                <div class="col-lg-3">
                                    <label for="zip">Code Postale<span>*</span></label>
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
                                        <li class="order-table total-price mb-1">Sub-Total <span style="color: #50cf80;"><a id="subtotalprix">0.00</a> DT</span></li>
                                        <li class="order-table total-price mb-1">Frais de Livraion <span style="color: #50cf80;"><a>+8</a> DT</span></li>
                                        <li class="order-table total-price">Total <span style="color: #50cf80;"><a id="totalprix">0.00</a> DT</span></li>
                                    </div>
                                    <div class="order-btn">
                                        <!-- <button type="submit" class="site-btn place-btn">Place Order</button> -->
                                        <button class="site-btn place-btn" type="button" id="checkoutbtn" onclick="validateCheckout()">Passer Votre Commande</button>
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

        <?php
            include('includes/footer.php');
            include('includes/scripts.php');
        ?>
    </body>
    </html>
<?php
  }
  else{
?>
    <body>
<?php    
      include('includes/header.php');
?>

        <section class="mb-4" style="padding-top: 12%;padding-bottom: 15%;height:46em;">
            <div class="container" style="text-align: center;margin-top: 10em;">
                <a href="./index.php">Retour</a>
            </div>
        </section>

    <?php
        include('includes/footer.php');
        include('includes/scripts.php');
    ?>
    </body>
    </html>
<?php
  }
?>