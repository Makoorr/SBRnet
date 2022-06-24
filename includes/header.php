<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="index.php"><img src = "assets/img/logotextsbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;font-weight: 500 !important;">  </span> </a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="hover-underline-anim" href="index.php">Accueil</a></li>
            <li class="dropdown"><a class="hover-underline-anim" style="cursor: pointer;"><span>Nos Produits</span> <i class="bi bi-chevron-down" style="margin-top: 0.5em"></i></a>
                <ul>
                <?php
                $sql="SELECT distinct categorie,nom_categorie FROM produits where disponibilite=1;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
                ?>
                    <li class="hover-underline-animation"><a href="prod/prod.php?cat=<?php echo($prod['categorie'])?>"><div><?php echo($prod['nom_categorie']) ?></div></a></li>
                <?php
                }
                ?>
                </ul>
            <li><a class="hover-underline-anim" href="contact.php">Contact</a></li>
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
            <div class="select-items" style="overflow-y: scroll;max-height: 50vh;"> <!-- El names are : Itemx : itemxquantity | itemxname | itemxprice | onclick="sup(1)" -->
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
    </div>

    </div>
</header><!-- End Header -->