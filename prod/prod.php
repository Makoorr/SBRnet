<?php
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('includes/meta.php');
if(empty($e)){

if (isset($_GET['cat'])){
    $categ = $_GET['cat'];
    $totcats = "SELECT distinct categorie FROM produits";
    $testcat = $db->query($totcats);
    $arr = $testcat->fetchAll(PDO::FETCH_COLUMN,0);
if (in_array($categ, $arr)){
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 16;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $checked = [];
    if (isset($_GET['ct'])){
        $checked = $_GET['ct'];
        // $checkedcount = str_repeat('?%,', count($checked) - 1) . '?';
        $arg = '(';

        foreach($checked as $ckc){
            $arg .= " souscateg LIKE '%$ckc%' OR";
        }
        $arg .= " 1=0)";
        $total_pages_sql = "SELECT COUNT(*) FROM produits where disponibilite=1 and categorie='$categ' AND $arg;";
        $sth = $db->prepare($total_pages_sql);
        $sth->execute();

        foreach($sth->fetchAll() as $res){
            $total_rows = $res[0];
        }
    }
    else {
        $total_pages_sql = "SELECT COUNT(*) FROM produits where disponibilite=1 and categorie='$categ';";
        $result = $db->query($total_pages_sql);
        foreach($result as $res){
            $total_rows = $res[0];
        }
    }
?>
<body onload="updatecookie()">
    <div class="headernoscroll">
    <?php
        if ($total_rows > 0){
            include ('includes/header.php');
            $total_pages = ceil($total_rows / $no_of_records_per_page);
    
            //checking the ?pageno
            if($pageno<1 || $pageno>$total_pages)
                header("location:./prod.php?cat=$categ");
    ?>
    </div>

    <!-- ======= Hero Section ======= -->
    <section class="d-flex justify-content-center align-items-center simple-background default_overlay" style="background-image: url('../assets/img/<?php echo($categ);?>hero.jpg');">
      <div class="container position-relative" style="z-index: 100;" data-aos="zoom-in" data-aos-delay="100">
        <!-- Title -->
        <div class="row">
            <div class="col-md">
                <h1 style="text-align: center;color:white;font-family: Montserrat;">
                    <?php
                    $sql="SELECT nom_categorie FROM produits where categorie='$categ'";
                    $produits = $db->query($sql);
                    foreach($produits as $prod){
                        $nomcateg=$prod[0];
                    }
                    echo($nomcateg);
                    ?>
                </h1>
            </div>
        </div>
        <!-- Pages -->
        <div class="row">
            <div class="col-md" style="margin: 1rem;color: white;text-align: center;">
                    <a class="pagel" href="../"><i class="fa fa-home" aria-hidden="true" style="color: white;"></i><span style="padding-right: 2em;padding-left: 1em;color: white;">Accueil</span></a> >
                    <a class="pagel" href="../index.php#textc" style="padding-right: 2em;padding-left: 2em;color: white;">Produits</a> > 
                    <a style="padding-left: 2em;color: white;"><?php echo($nomcateg); ?></a>
            </div>
        </div>
        <!-- End Title -->
      </div>
    </section><!-- End Hero -->

    <!-- Start Content -->
    <div class="container py-5" style="margin-top: 1em;">
        <div class="row">
            <?php
                $sqll = "SELECT distinct souscateg FROM produits where categorie=:categ AND souscateg <> '';";
                $reql = $db->prepare($sqll);
                $reql->execute([':categ'=>$categ]);

                $countfilter = $reql->rowCount();
                if($countfilter > 0){
            ?>
            <div class="col-sm"> <!-- Filters -->
                <h3 style="font-family: Montserrat;">Filtrer</h3>
                <form action="" method="GET">
                    <input name="cat" value="<?= $categ ?>" hidden>
                <p>
                    <?php
                        $checked = [];
                        if (isset($_GET['ct']))
                            $checked = $_GET['ct'];
                        
                        $sqll = "SELECT distinct souscateg FROM produits where categorie=:categ AND souscateg <> '';";
                        $reql = $db->prepare($sqll);
                        $reql->execute([':categ'=>$categ]);
                        $ctsarr = [];
                        foreach($reql->fetchAll() as $prodl){
                            $ctts = $prodl['souscateg'];
                            $ctsarg = explode("|",$ctts);
                            foreach($ctsarg as $ctselem){
                                $ctselem = trim($ctselem," ");
                                if (! in_array($ctselem,$ctsarr) ){
                                    array_push($ctsarr,$ctselem);
                                }
                            }
                        }
                        foreach($ctsarr as $cts){
                    ?>
                        <input type="checkbox" id="<?= $cts ?>" name="ct[]" value="<?= $cts ?>"
                            <?php if(in_array($cts, $checked)) echo('checked'); ?>
                        >
                        <label for="<?= $cts ?>"> <?= $cts ?></label>
                    <?php
                        }
                    ?>
                    <button type="submit" class="get-started-btn">Filtrer</button>
                </p>
                </form>
            </div>
            <?php
                }
            ?>
            <div class="col-md pb-3">
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
                                        
                                    for ($i=1;$i<=$total_pages;$i++){
                                        if(intval($i)===intval($pageno))
                                            echo("<a href='?cat=$categ&pageno=$i' class='active' value='$i'> $i </a>");
                                        else
                                            echo("<a href='?cat=$categ&pageno=$i' value='$i'> $i </a>");
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <br>
        </div>

        <!-- Articles --> <!-- ID'S : img id | btn onclick ajt(id) | name id | price id |-->
        <div class="row">
            <?php
            if (isset($_GET['ct'])){ // ken fama filter
                $argprod = "( ";
                foreach($checked as $ckc){
                    $argprod .= " souscateg LIKE '%$ckc%' OR";
                }
                $argprod .= " 1=0)";
                $sql="SELECT * FROM produits WHERE disponibilite=1 AND categorie='$categ' AND $argprod ORDER BY idproduits desc LIMIT $offset, $no_of_records_per_page;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
            ?>
            <div class="col-lg-3 d-flex justify-content-center">
                <div class="card mb-4 product-wap rounded-0 cardutil" style="border: none !important;box-shadow: none !important;">
                    <div class="card rounded-0">
                        <img class="card-img rounded-0 img-fluid" style="height: 15em;" id="img<?php echo($prod['idproduits']); ?>" src="../assets/img/<?php echo($prod['idproduits']);?>.jpg">
                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <!-- <li><a class="btn btn-success text-white" href="#"><i class="far fa-heart"></i></a></li> -->
                                <!-- <li><a class="btn btn-success text-white mt-2 fancylight popup-btn" href="../assets/img/.jpg" data-fancybox-group="light"><i class="far fa-eye"></i></a></li> -->
                                <!-- <li><a class="btn btn-success text-white mt-2 fancylight popup-btn" style="background-color: #24282D;border-color:#24282D" href="../assets/img/<?php echo($prod['idproduits']); ?>.jpg" data-fancybox="gallery"><i class="far fa-eye"></i></a></li> -->
                                <!-- <li><a class="btn btn-success text-white mt-2"  onclick="ajt(<?php echo($prod['idproduits']); ?>)"><i class="fas fa-cart-plus"></i></a></li> -->
                                <!-- <li><a class="btn btn-success text-white mt-2" href="../singleprod.php?product=<?php echo($prod['idproduits']); ?>" data-fancybox data-type="iframe" data-options='{ "iframe" : {"preload" : false, "css" : {"width" : "1000px"}} }'><i class="fas fa-eye"></i></a></li> -->
                                <li><a class="btn btn-success text-white mt-2" href="../singleprod.php?product=<?php echo($prod['idproduits']); ?>"><i class="fas fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" style="border: none !important;">
                        <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                            <a  class="h3 text-decoration-none" id="name<?php echo($prod['idproduits']); ?>"><?php echo($prod['nom']); ?></a>
                        </div>
                        
                        <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                            <div style="margin-top: 3px;">Prix: <a id="price<?php echo($prod['idproduits']); ?>"> <?php echo($prod['prix']); ?></a> DT</div>
                            <a style="margin-left:2em;">Quantité: <input style="text-align: center;width: 3em;" type="number" min="0" value=1 id="quantity<?php echo($prod['idproduits']); ?>" style="width: 3em;border-color: #000;"></a>
                        </div>
                        <div class="w-100 d-flex justify-content-center" style="margin-top: 0.5em;">
                            <a class="h3" href="../singleprod.php?product=<?php echo($prod['idproduits']); ?>"><button class="get-started-btn" style="width:auto;">Voir details</button></a>
                            <a class="h3"><button class="get-started-btn" onclick="ajt(<?php echo($prod['idproduits']); ?>)" style="width:auto;">Ajouter dans le panier</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            else { // ken famech filter
                $sql="SELECT * FROM produits where disponibilite=1 and categorie='$categ' ORDER BY idproduits desc LIMIT $offset, $no_of_records_per_page;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
            ?>
            <div class="col-lg-3 d-flex justify-content-center">
                <div class="card mb-4 product-wap rounded-0 cardutil" style="border: none !important;box-shadow: none !important;">
                    <div class="card rounded-0">
                        <img class="card-img rounded-0 img-fluid" style="height: 15em;" id="img<?php echo($prod['idproduits']); ?>" src="../assets/img/<?php echo($prod['idproduits']);?>.jpg">
                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <li><a class="btn btn-success text-white mt-2" href="../singleprod.php?product=<?php echo($prod['idproduits']); ?>"><i class="fas fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" style="border: none !important;">
                        <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                            <a  class="h3 text-decoration-none" id="name<?php echo($prod['idproduits']); ?>"><?php echo($prod['nom']); ?></a>
                        </div>
                        
                        <div class="w-100 list-unstyled d-flex justify-content-center mb-0">
                            <div style="margin-top: 3px;">Prix: <a id="price<?php echo($prod['idproduits']); ?>"> <?php echo($prod['prix']); ?></a> DT</div>
                            <a style="margin-left:2em;">Quantité: <input style="text-align: center;width: 3em;" type="number" min="0" value=1 id="quantity<?php echo($prod['idproduits']); ?>" style="width: 3em;border-color: #000;"></a>
                        </div>
                        <div class="w-100 d-flex justify-content-center" style="margin-top: 0.5em;">
                            <a class="h3" href="../singleprod.php?product=<?php echo($prod['idproduits']); ?>"><button class="get-started-btn" style="width:auto;">Voir details</button></a>
                            <a class="h3"><button class="get-started-btn" onclick="ajt(<?php echo($prod['idproduits']); ?>)" style="width:auto;">Ajouter dans le panier</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- End Arcitcles-->
    </div>
    <!-- End Content -->

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

    <?php
        include ('includes/footer.php');
        } else {
            include('includes/nocontent.php');
        }
    ?>

  <div id="preloader"></div>
  <a  class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/vendor/fancyapps/jquery.fancybox.min.js"></script>
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
<?php
}
else {
    header('location:../404.php');
}
}
else {
    header('location:../404.php');
}
}
?>