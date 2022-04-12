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

<body onload="updatecookie()">
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php" class="logo me-auto"><img src = "assets/img/logosbr.png" alt="" class="img-fluid"></a> -->
        <h1 class="logo me-auto"><a href="index.php"><img src = "assets/img/logosbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;font-weight: 500 !important;">  SBR-Pharma</span> </a></h1>

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

    <!--Section: Contact-->
    <section class="mb-4" style="padding-top: 10%;padding-bottom: 10%;">
        <div class="container" data-aos="fade-up">
        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Contactez-nous</h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Avez-vous des questions? N'hésitez pas à nous contacter directement. Notre équipe reviendra vers vous dans
            une question d'heures pour vous aider.</p>
 
            <div> <!--class="col-md-9 mb-md-0 mb-5"-->
                <form id="contact-form" name="contact-form" action="contact.php" method="post">
                    <div class="row">
                        <div class="col-md">
                            <div class="md-form mb-0">
                              <label for="subject" class="">Sujet</label>
                              <input type="text" id="subject" name="subject" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="md-form mb-0">
                              <label for="name" class="">Votre nom</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="md-form mb-0">
                              <label for="email" class="">Votre email</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="md-form mb-0">
                              <label for="tel" class="">Tel</label>
                                <input type="number" id="tel" name="tel" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                              <label for="message">Votre message</label>
                              <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            </div>
                        </div>
                    </div>

                <div class="text-center text-md-left">
                  <br>
                    <input class="btn" type="button" id="contactbtn" onclick="validateForm()" style="color: #fff;background-color: #24282D;border-color: #24282D;" value="Envoyer"></input>
                </div>
                <div class="status"></div>
                </form>
            </div>

            <!-- Grid column-->
            <!-- <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>San Francisco, CA 94126, USA</p>
                    </li>

                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+ 01 234 567 89</p>
                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>contact@mdbootstrap.com</p>
                    </li>
                </ul>
            </div> -->
            <!--Grid column -->
            <!-- </div> -->
        </div>
    </section>
    <!--Section: Contact-->

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

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>