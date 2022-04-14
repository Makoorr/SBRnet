<?php
require_once('../config.php');
if(empty($e)){
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM produits where disponibilite=1 and categorie='levre';";
    $result = $db->query($total_pages_sql);
    foreach($result as $res){
        $total_rows = $res[0];
    }
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    //checking the ?pageno
    if($pageno<1 || $pageno>$total_pages)
        header("location:./levre.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SBRPharma</title>
  <link rel = "icon" type = "image/png" href = "../assets/img/iconsbr.png">

  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> <!--logos-->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/ajax/magnific-popup.css">
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/elegant-icons.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/jquery-ui.min.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/nice-select.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/slicknav.min.css" rel="stylesheet">
  <link href="../assets/vendor/jQuery/elegant-icons.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome/fontawesome.min.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/0552f5e21b.js" crossorigin="anonymous"></script>
  <script src="../assets/vendor/jQuery/jquery.js"></script>
  <script src="../assets/vendor/jQuery/isotope-pkgd.js"></script>
  <script src="../assets/vendor/jQuery/magnific-popup.js"></script>
  <script src="../assets/js/main.js"></script>
</head>

<body onload="updatecookie()">
    <?php
        include ('includes/header.php');
    ?>

    <!-- Start Content -->
    <div class="container py-5" style="margin-top: 5em;">
        <div class="row">

            <!-- <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Gender
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Men</a></li>
                            <li><a class="text-decoration-none" href="#">Women</a></li>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Sale
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Sport</a></li>
                            <li><a class="text-decoration-none" href="#">Luxury</a></li>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Produits
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseThree" class="collapse list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Huiles Essentielles</a></li>
                            <li><a class="text-decoration-none" href="#">Crèmes</a></li>
                            <li><a class="text-decoration-none" href="#">Serums</a></li>
                        </ul>
                    </li>
                </ul>
            </div> -->

            <div class="col-sm">
                <!-- Title -->
                <div class="row">
                    <div class="col-md">
                        <!-- <ul class="list-inline shop-top-menu pb-3 pt-1">
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none" href="#">Women's</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="col-md">
                        <h4 style="text-align: center;">
                            <?php
                            $sql="SELECT nom_categorie FROM produits where categorie='levre'";
                            $produits = $db->query($sql);
                            foreach($produits as $prod){
                                $nomcateg=$prod[0];
                            }
                            echo($nomcateg);
                            ?>
                        </h4>
                    </div>
                    <div class="col-md">
                        <div class="d-flex justify-content-end">
                            <div class="pagination">
                                <?php
                                    if($pageno!=1)
                                        $prevpage=intval($pageno)-1;
                                    else
                                        $prevpage=1;

                                    if($pageno<$total_pages)
                                        $nextpage=intval($pageno)+1;
                                    else
                                        $nextpage=$total_pages;
                                    
                                    echo("<a href='?pageno=$prevpage'>&laquo;</a>");
                                    for ($i=1;$i<=$total_pages;$i++){
                                        if(intval($i)===intval($pageno))
                                            echo("<a href='?pageno=$i' class='active' value='$i'> $i </a>");
                                        else
                                            echo("<a href='?pageno=$i' value='$i'> $i </a>");
                                    }
                                    echo("<a href='?pageno=$nextpage'>&raquo;</a>");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Title -->
                <br>

                <!-- Articles --> <!-- ID'S : img id | btn onclick ajt(id) | name id | price id |-->
                <div class="row">
                    <?php
                        $sql="SELECT * FROM produits where disponibilite=1 and categorie='levre' LIMIT $offset, $no_of_records_per_page;";
                        $produits = $db->query($sql);

                        foreach($produits as $prod){
                    ?>
                    <div class="col-lg-3">
                        <div class="card mb-4 product-wap rounded-0" style="border: none !important;box-shadow: none !important;">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" style="height: 15em;" id="img<?php echo($prod['idproduits']); ?>" src="../assets/img/<?php echo($prod['idproduits']);?>.jpg">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <!-- <li><a class="btn btn-success text-white" href="#"><i class="far fa-heart"></i></a></li> -->
                                        <!-- <li><a class="btn btn-success text-white mt-2 fancylight popup-btn" href="../assets/img/.jpg" data-fancybox-group="light"><i class="far fa-eye"></i></a></li> -->
                                        <li><a class="btn btn-success text-white mt-2 fancylight popup-btn" style="background-color: #24282D;border-color:#24282D" href="../assets/img/<?php echo($prod['idproduits']); ?>.jpg" data-fancybox="gallery"><i class="far fa-eye"></i></a></li>
                                        <!-- <li><a class="btn btn-success text-white mt-2"  onclick="ajt(<?php echo($prod['idproduits']); ?>)"><i class="fas fa-cart-plus"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body" style="border: none !important;">
                                <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                                    <a  class="h3 text-decoration-none" id="name<?php echo($prod['idproduits']); ?>"><?php echo($prod['nom']); ?></a>
                                </div>
                                
                                <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                                    <div style="margin-top: 3px;">Prix: <a id="price<?php echo($prod['idproduits']); ?>"> <?php echo($prod['prix']); ?></a> DT</div>
                                    <a style="margin-left:2em">Quantité: <input type="number" min="0" max="300" id="quantity<?php echo($prod['idproduits']); ?>" style="width: 3em;border-color: #000;"></a>
                                </div>
                                <div class="w-100 d-flex justify-content-center" style="margin-top: 0.5em;">
                                    <a class="h3"><button class="get-started-btn" onclick="ajt(<?php echo($prod['idproduits']); ?>)" style="width:auto;">Ajouter dans le panier</button></a>
                                </div>
                                <!-- <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>M/L/X/XL</li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul> -->

                                <!-- Stars -->
                                <!-- <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul> -->
                                <!-- End Stars -->
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                <!-- Page Numbers-->
                <!-- <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0"  tabindex="-1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" >2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" >3</a>
                        </li>
                    </ul>
                </div> -->
                </div>
                <!-- End Arcitcles-->
        </div>
    </div>
    <!-- End Content -->
    </div>


    <!-- ====== Line Separator ====== -->
    <hr style="border-top: 3px solid #bbb">

    <!-- Tableau livraison -->
    <div class="container" style="text-align: center;">
      <table style="table-layout:fixed;width:100%;">
        <tr>
          <td><img src="../assets/img/delivery-truck.png" alt="" style="width: 150px;height: 115px;"></td>
          <td><img src="../assets/img/time.png" alt="" style="width: 150px;height: 115px;"></td>
          <td><img src="../assets/img/paiement.png" alt="" style="width: 75px;height: 75px;"></td>
        </tr>
        <tr>
          <td><h6><strong>Commande par livraison</strong></h6></td>
          <td><h6><strong>Livraison à temps</strong></h6></td>
          <td><h6><strong>Paiement à la livraison</strong></h6></td>
        </tr>
      </table>
    </div> <!-- Fin Tableau -->
    <br>

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

  <div id="preloader"></div>
  <a  class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>
<?php
}
?>