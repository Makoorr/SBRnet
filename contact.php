<?php
  require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBRSwitchmed</title>
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
    <?php
        include ('includes/header.php');
    ?>

    <!--Section: Contact-->
    <section class="mb-4" style="padding-top: 10%;padding-bottom: 10%;">
        <div class="container" data-aos="fade-up">
        <!-- Pages -->
        <div class="col-md-5" style="margin: 1rem;">
            <a class="pagel" href="../"><i class="fa fa-home" aria-hidden="true"></i><span style="padding-right: 2em;padding-left: 1em;">Accueil</span></a> >
            <a style="padding-left: 2em;color: #b2b2b2;">Contact</a>
        </div>
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

<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>
</body>
</html>