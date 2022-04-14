<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.php" class="logo me-auto"><img src = "../assets/img/logosbr.png" alt="" class="img-fluid"></a> -->
    <h1 class="logo me-auto"><a href="../index.php"><img src = "../assets/img/logosbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;font-weight: 500 !important;">  SBR-Pharma</span> </a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="active" href="../index.php">Accueil</a></li>
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
            <li><a href="../contact.php">Contact</a></li>
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
                    <a href="../commander.php" class="primary-btn checkout-btn">Commander</a>
                </div>
            </div>
            </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>

    </div>
</header><!-- End Header -->