<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <title>Produit</title>
    <link rel = "icon" type = "image/png" href = "assets/img/iconsbr.png">

    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" referrerpolicy="no-referrer" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.3.0/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@icon/elegant-icons@0.0.1-alpha.4/elegant-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/0552f5e21b.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <script src="assets/js/main.js"></script>
    
    <style>
        .logo { font-weight: 500 !important;}
        .text-warning {  color: #ede861 !important;}
        .text-muted { color: #bcbcbc !important;}
        .text-success { color: #50cf80 !important;}
        .text-light { color: #cfd6e1 !important;}
        .bg-dark { background-color: #212934 !important;}
        .bg-light { background-color: #e9eef5 !important;}
        .bg-black { background-color: #1d242d !important;}
        .bg-success { background-color: #50cf80 !important;}
        .btn-success { background-color: #50cf80 !important;border-color: #56ae6c !important;}
    </style>
</head>
<body onload="updatecookie()">
    <div class="headernoscroll">
    <?php
        include('includes/header.php');
        $idprod = intval(htmlspecialchars($_GET['product']));

        $sql = "SELECT * FROM produits where idproduits=:idprod LIMIT 1;";
        $req = $db->prepare($sql);
        $req->execute([':idprod'=>$idprod]);
        foreach($req->fetchAll() as $prod){
            $nom = $prod['nom'];
            $prix = $prod['prix'];
            $disponibilite = $prod['disponibilite'];
            $categ = $prod['categorie'];
            $nomcateg = $prod['nom_categorie'];
            $desc = $prod['description'];
            $spec = $prod['specifications'];
        }
        if (! empty($nom)){
    ?>
    </div>

    <!-- ======= Hero Section ======= -->
    <section class="d-flex justify-content-center align-items-center simple-background default_overlay" style="background-image: url('assets/img/<?php echo($categ);?>hero.jpg');">
      <div class="container position-relative" style="z-index: 100;" data-aos="zoom-in" data-aos-delay="100">
        <!-- Title -->
        <div class="row">
            <div class="col-md">
                <h1 style="text-align: center;color:white;font-family: Montserrat;">
                    <?php
                    echo($nomcateg);
                    ?>
                </h1>
            </div>
        </div>
        <!-- Pages -->
        <div class="row">
            <div class="col-md" style="margin: 1rem;color: white;text-align: center;">
                    <a class="pagel" href="/sbrnet/"><i class="fa fa-home" aria-hidden="true" style="color: white;"></i><span style="padding-right: 2em;padding-left: 1em;color: white;">Accueil</span></a> >
                    <a class="pagel" href="/sbrnet/index.php#textc" style="padding-right: 2em;padding-left: 2em;color: white;">Produits</a> > 
                    <a class="pagel" href="/sbrnet/prod/prod.php?cat=<?php echo($categ); ?>" style="padding-left: 2em;padding-right: 2em;color: white;"><?php echo($nomcateg); ?></a> >
                    <a style="padding-left: 1em;color: white;"><?php echo($nom); ?></a>
            </div>
        </div>
        <!-- End Title -->
      </div>
    </section><!-- End Hero -->

    <!-- Start Content -->
    <div class="container py-5" style="margin-top: 2em;">
    <!-- Open Content -->
    <section style="padding: 0px !important;">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="assets/img/<?php echo($idprod); ?>.jpg" alt="" id="img<?php echo($idprod); ?>">
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <!-- <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div> -->
                        <!--End Controls-->
                        <!--Start Controls-->
                        <!-- <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div> -->
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card" style="border: 0px !important;">
                        <div class="card-body">
                            <h1 class="h2"><span id="name<?php echo($idprod); ?>"><?php echo($nom);?></span></h1>
                            <br>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6><strong>Prix :</strong></h6>
                                </li>
                                <li class="list-inline-item">
                                        <strong><span style='color:#50cf80;'><span id="price<?php echo($idprod); ?>"><?php echo($prix);?></span> DT</span></strong>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6><strong>Catégorie :</strong></h6>
                                </li>
                                <li class="list-inline-item">
                                    <strong><span style='color:#50cf80;'><?php echo($nomcateg); ?> <span></strong>
                                </li>
                            </ul>
                            <h6><strong>Utilisation :</strong></h6>
                            <p><?php echo($desc); ?></p>

                            <h6><strong>Description :</strong></h6>
                            <ul class="list-unstyled pb-3">
                                <?php
                                    $specs = explode("|",$spec);
                                    foreach ($specs as $sp){
                                ?>
                                        <li>• <?php echo($sp) ?></li>
                                <?php
                                    }
                                ?>
                            </ul>

                            <div class="row pb-3">
                                <div class="col d-flex justify-content-between">
                                    <a>Quantité: <input style="text-align: center;width: 3em;" type="number" min="0" value=1 id="quantity<?php echo($prod['idproduits']); ?>" style="width: 3em;border-color: #000;"></a>
                                    <a class="h3 justify-content-right"><button class="get-started-btn" onclick="ajt(<?php echo($prod['idproduits']); ?>)" style="width:auto;">Ajouter dans le panier</button></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
    </div>

    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb;display: block">
    
    <div class="container">
    <!-- ======= Other Section ======= -->
    <section id="about" style="padding:0 !important;" class="about">
        <h1 class="h2" style="text-align: center;margin: 2em;"><span>Produits Similaires</span></h1>
        <div class="container">
        <div class="row justify-content-center">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php
        $sql="SELECT distinct idproduits,nom FROM produits WHERE idproduits <> $idprod AND categorie= '$categ' ORDER BY idproduits desc LIMIT 12;";

        $produits = $db->query($sql);
        $el=0;
        $it=2;

        foreach($produits as $prod){
          if($el==0) $size = $produits->rowCount();
          if($it==2){
        ?>
        <div class="carousel-item col-sm-3 <?php if($el==0){echo("active");$el++;} ?>"> <?php } ?>
            <div class="card mb-4 product-wap rounded-0 cardutil simprod" style="border: none !important;box-shadow: none !important; margin-left: 2em;">
                <div class="card rounded-0">
                    <a href="/sbrnet/singleprod.php?product=<?php echo($prod['idproduits']);?>"><img class="card-img rounded-0 img-fluid" id="img<?php echo($prod['idproduits']); ?>" src="assets/img/<?php echo($prod['idproduits']);?>.jpg"></a>
                </div>
                <div class="card-body" style="border: none !important;">
                    <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                        <a href="/sbrnet/singleprod.php?product=<?php echo($prod['idproduits']);?>" class="h3 text-decoration-none" id="name<?php echo($prod['idproduits']); ?>"><?php echo($prod['nom']); ?></a>
                    </div>
                </div>
            </div>
        <?php  
          if($it==2){
          $it=1;
          }
          else{
            $it++;
          }
          $size--;
          if($it==2 || $size == 0){
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
    <!-- End Other Section -->
    </div>
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
    <?php
        include('includes/footer.php');
        include('includes/scripts.php');
    } else {
    ?>
        <section class="mb-4" style="padding-top: 12%;padding-bottom: 15%;height:46em;">
            <div class="container" style="text-align: center;margin-top: 10em;">
                <a href="./index.php">Retour</a>
            </div>
        </section>
    <?php
    }
    ?>
</body>
</html>