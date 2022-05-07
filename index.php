<?php
  require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="description" content="SBR-Switchmed.com est une société spécialisée dans la vente de produits parapharmaceutiques certifiés avec des prix attractifs et avec une livraison à domicile.
    Vous aurez l'occasion d'apprécier la qualité de nos produits avec les meilleurs prix.">
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

    <script src="assets/vendor/jQuery/jquery.js"></script>
    <script src="assets/vendor/jQuery/isotope-pkgd.js"></script>
    <script src="assets/vendor/jQuery/magnific-popup.js"></script>
</head>

<body onload="updatecookie()">
    <?php
      include ('includes/header.php');
    ?>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
      <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <h1>100% Pure Rose<br>Huile essentielle</h1>
        <h2 class="has-text-align-center has-small-font-size" id="my-all-time-favourite-scent-it-smells-divine-and-lasts-all-day-a-true-and-beautiful-rose-fragrance" style="line-height:1.5;font-style: italic;"><em style="font-size:x-large;font-weight: 300;">“Notre gamme d'huiles essentielles de haute qualité a été triée sur le volet par nos spécialistes des parfums.”</em></h2>
        <a href="prod/huilesess.php" class="btn-get-started">Acheter Maintenant!</a>
      </div>
    </section><!-- End Hero -->

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- Texte -->
    <div class="wp-container-14 wp-block-group" style="padding-top:3vh;padding-bottom:3vh;text-align: center;">
      <h2 class="has-text-align-center has-small-font-size" id="my-all-time-favourite-scent-it-smells-divine-and-lasts-all-day-a-true-and-beautiful-rose-fragrance" style="line-height:1.5;font-style: italic;"><em style="font-size:x-large;font-weight: 300;">“Notre gamme de produits biologiques s'appuie sur les propriétés naturelles des plantes et de l'ensemble du monde végétal.”</em></h2>
      <p class="has-text-align-center has-small-font-size">SBR Switchmed</p>
    </div>
    <!-- Fin Texte-->

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" >
        <?php
        $sql="SELECT distinct categorie,nom_categorie FROM produits 
              WHERE (nom_categorie='Huiles Essentielles' or nom_categorie='Huiles Végétales'
              or nom_categorie='Soins Corps' or nom_categorie='Soins Visage'
              or nom_categorie='Argiles' or nom_categorie='Soins Cheveux') and disponibilite=1;";

        $produits = $db->query($sql);

        foreach($produits as $prod){
        ?>
          <div class="col-sm-3 cercle" style="margin-left:2em;margin-bottom:2em;" href="prod/<?php echo($prod['categorie'])?>.php">
            <a class="cercle-img" href="prod/<?php echo($prod['categorie'])?>.php"><img src="assets/img/<?php echo($prod['categorie'])?>.png" style="display:block;padding-top: 1%;contain: style;margin : auto;" width="70em" height="100%" alt="<?php echo($prod['nom_categorie'])?>"></a>
            <a class="cercle-texte" href="prod/<?php echo($prod['categorie'])?>.php"><?php echo($prod['nom_categorie']) ?></a>
          </div>
        <?php
        }
        ?>
        </div>
      </div>
    </section>
    <!-- End About Section -->

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


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="height: 100%;">
    <div class="footer-top" style="background-color: black;">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3 style="color: white;font-size:larger;font-weight: bold;">SBR Switchmed</h3>
            <p>
              Tunisie, TN
              <!-- <strong>Email:</strong> info@example.com<br> -->
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4 style="color: white;">Liens</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Accueil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contact.php">Contactez-nous</a></li>
              <!-- <li><i class="bx bx-chevron-right"></i> <a href="contact.php">Contact</a></li> -->
            </ul>
          </div>

          <div class="col-lg col-md footer-newsletter">
            <h4 style="color: white;">Abonnez-vous à notre Newsletter</h4>
            <!-- <p style="color: white;">Abonnez-vous à notre Newsletter et recevez 10% de réduction sur votre première commande.</p> -->
            <form>
              <input type="email" id="emailnews"><input class="newsletterbtn" type="button" onclick="newsletter()" value="S'abonner">
            </form>
            <br>
            <div class="statusnews" style="color:#ebebeb"></div>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          Copyright &copy;<script>document.write(new Date().getFullYear());</script> | <strong><span> SBRSwitchmed</span></strong>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <strong><span>Notre page facebook&nbsp;&nbsp;</span></strong>
        <a href="https://www.facebook.com/Produits-Parapharmaceutiques-Cosm%C3%A9tiques-124308735628194" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
        <!-- <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
      </div>
    </div>
  </footer><!-- End Footer -->
  
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php
    include('includes/scripts.php');
  ?>
</body>
</html>