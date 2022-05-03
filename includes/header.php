<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.php" class="logo me-auto"><img src = "assets/img/logosbr.png" alt="" class="img-fluid"></a> -->
    <h1 class="logo me-auto"><a href="index.php"><img src = "assets/img/logosbr.png" alt="" class="img-fluid" style="padding-top: 2px;"><span style="color: 00ffb4;font-size: large;font-weight: 500 !important;">  SBRSwitchmed</span> </a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="hover-underline-anim" href="index.php">Accueil</a></li>
            <li class="dropdown"><a style="cursor: pointer;"><span>Nos Produits</span> <i class="bi bi-chevron-down" style="margin-top: 0.5em"></i></a>
                <ul>
                <?php
                $sql="SELECT distinct categorie,nom_categorie FROM produits;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
                ?>
                    <li class="hover-underline-animation"><a href="prod/<?php echo($prod['categorie'])?>.php"><div><?php echo($prod['nom_categorie']) ?></div></a></li>
                <?php
                }
                ?>
                </ul>
            <li><a class="hover-underline-anim" href="contact.php">Contact</a></li>
            </li>

            <li class="cart-icon">
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
            </li>
        <!-- <li><a href="prod/huilesess.php">Produits</a></li> -->
        
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