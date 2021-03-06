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

    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" referrerpolicy="no-referrer">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.3.0/swiper-bundle.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
</head>

<body onload="updatecookie()">
    <div class="headernoscroll">
    <?php
      include ('includes/header.php');
    ?>
    </div>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
      <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <h1>Produits BIO<br>100% Naturels</h1>
        <h2 class="has-text-align-center has-small-font-size" id="my-all-time-favourite-scent-it-smells-divine-and-lasts-all-day-a-true-and-beautiful-rose-fragrance" style="line-height:1.5;font-style: italic;"><em style="font-size:x-large;font-weight: 300;">
          ???Notre gamme de produits de haute qualit?? a ??t?? tri??e sur le volet par nos sp??cialistes.???</em>
        </h2>
        <a href="#about" class="btn-get-started">Nos Cat??gories</a>
      </div>
    </section><!-- End Hero -->

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <section>
      <div class="container" style="text-align: center;">
        <p>$Carousel items</p>
      </div>
    </section>

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- Texte -->
    <div id="textc" class="wp-container-14 wp-block-group" style="padding-top:3vh;padding-bottom:3vh;text-align: center;">
      <h2 class="has-text-align-center has-small-font-size" id="my-all-time-favourite-scent-it-smells-divine-and-lasts-all-day-a-true-and-beautiful-rose-fragrance" style="line-height:1.5;font-style: italic;"><em style="font-size:x-large;font-weight: 300;">???Notre gamme de produits biologiques s'appuie sur les propri??t??s naturelles des plantes et de l'ensemble du monde v??g??tal.???</em></h2>
      <p class="has-text-align-center has-small-font-size">SBR Switchmed</p>
    </div>
    <!-- Fin Texte-->

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php
        $sql="SELECT distinct categorie,nom_categorie FROM produits";

        $produits = $db->query($sql);
        $el=0;
        $it=3;

        foreach($produits as $prod){
          if($el==0) $size = $produits->rowCount();
          if($it==3){
        ?>
        <div class="carousel-item col-sm-3 <?php if($el==0){echo("active");$el++;} ?>"> <?php } ?>
          <div class="cercle" style="margin-left:2em;margin-bottom:2em;" href="prod/prod.php?cat=<?php echo($prod['categorie'])?>">
            <a class="cercle-img" href="prod/prod.php?cat=<?php echo($prod['categorie'])?>"><img src="assets/img/<?php echo($prod['categorie'])?>.png" style="display:block;padding-top: 1%;contain: style;margin : auto;" width="70em" height="100%" alt="<?php echo($prod['nom_categorie'])?>"></a>
            <a class="cercle-texte" href="prod/prod.php?cat=<?php echo($prod['categorie'])?>"><?php echo($prod['nom_categorie']) ?></a>
          </div>
        <?php  
          if($it==3){
          $it=1;
          }
          else{
            $it++;
          }
          $size--;
          if($it==3 || $size == 0){
        ?>
          </div>
        <?php
          }
        }
        ?>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

        </div>
        </div>
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
          <td><h6><strong>Livraison ?? temps</strong></h6></td>
          <td><h6><strong>Paiement ?? la livraison</strong></h6></td>
        </tr>
      </table>
    </div> <!-- Fin Tableau -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="height: 100%;">
    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">
    <!-- Start Brands -->
    <div id="brands" class="container" style="background: #eef0ef !important;">
      <div class="row text-center">
          <div class="col-lg-9 m-auto">
              <div class="row d-flex flex-row">
                  <div class="col brandscol">
                      <div class="row">
                          <div class="col-3 brandspad">
                              <a style="cursor: pointer;"><img class="img-fluid brand-img" src="assets/img/herbeos.png" alt="Herbeos"></a>
                          </div>
                          <div class="col-3 brandspad">
                              <a style="cursor: pointer;"><img class="img-fluid brand-img" src="assets/img/moldex.png" alt="Moldex"></a>
                          </div>
                          <div class="col-3 brandspad">
                              <a style="cursor: pointer;"><img class="img-fluid brand-img" src="assets/img/koroglu.png" alt="Koroglu"></a>
                          </div>
                          <div class="col-3 brandspad">
                              <a style="cursor: pointer;"><img class="img-fluid brand-img" src="assets/img/orthomed.png" alt="Orthomed"></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!--End Brands-->
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
            <h4 style="color: white;">Abonnez-vous ?? notre Newsletter</h4>
            <!-- <p style="color: white;">Abonnez-vous ?? notre Newsletter et recevez 10% de r??duction sur votre premi??re commande.</p> -->
            <form>
              <label></label>
              <input placeholder="Votre Email" type="email" id="emailnews"><input class="newsletterbtn" type="button" onclick="newsletter()" value="S'abonner">
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
  <script type="text/javascript">
    var nav = document.querySelector('.headernoscroll');

    window.addEventListener('scroll', function () {
      if (window.pageYOffset < 500) {
        nav.classList.add('headernoscroll');
      } else {
        nav.classList.remove('headernoscroll');
      }
    });
  </script>
</body>
</html>