<header id="header" class="fixed-top" style="position: absolute;">
    <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="../index.php"><img src = "../assets/img/logosbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;font-weight: 500 !important;">  SBRSwitchmed</span> </a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="hover-underline-anim" href="../index.php">Accueil</a></li>
            <li class="dropdown"><a style="cursor: pointer;"><span>Nos Produits</span> <i class="bi bi-chevron-down" style="margin-top: 0.5em"></i></a>
                <ul>
                <?php
                $sql="SELECT distinct categorie,nom_categorie FROM produits where disponibilite=1;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
                ?>
                    <li class="hover-underline-animation"><a href="prod.php?cat=<?php echo($prod['categorie'])?>"><div><?php echo($prod['nom_categorie']) ?></div></a></li>
                <?php
                }
                ?>
                </ul>
            <li><a class="hover-underline-anim" href="../contact.php">Contact</a></li>
            </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <div class="cart-icon" style="margin-left:1em;margin-right:1em;">
        <a style="cursor: pointer;">
        <i class="fas fa-cart-plus" style="font-size: 1.25rem;"></i>
            <span id="cartquantity">0</span>
        </a>
        <div class="cart-hover">
            <div class="select-items" style="overflow-y: scroll;max-height: 50vh;">
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
                <a href="../commander.php" class="primary-btn checkout-btn">Commander</a>
            </div>
        </div>
    </div>

    </div>
</header><!-- End Header -->
<section style="position: relative;">
    <div class="container" style="text-align: center;">
        <img src="../assets/img/Coming_soon_red.png" style="height:auto;width:100%">
    </div>
</section>

<!-- ======= Footer ======= -->
<footer id="footer" style="position: fixed;bottom:0; width: 100%;height: auto;">
    <!-- Copyright -->
    <div class="container d-md-flex py-4">

    <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> | <strong><span> SBRSwitchmed</span></strong>
        </div>
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <strong><span>Notre page facebook&nbsp;&nbsp;</span></strong>
        <a href="https://www.facebook.com/Produits-Parapharmaceutiques-Cosm%C3%A9tiques-124308735628194" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
    </div>
    </div>
</footer><!-- End Footer -->