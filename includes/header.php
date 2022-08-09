<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="index.php"><img src = "assets/img/logotextsbr.png" alt="" class="img-fluid" style="padding-top: 2px;"></a></h1>

    <div class="search-container" style="height: 4em;">
        <?php
            $sql = "SELECT idproduits,nom,categorie from produits;";
            $stm = $db->prepare($sql);
            $stm->execute();
            $req = $stm->fetchAll();
            $tabid = [];
            $tabnom = [];
            $tabcateg = [];

            foreach($req as $mp){
                array_push($tabid,$mp['idproduits']);
                array_push($tabnom,$mp['nom']);
                array_push($tabcateg,$mp['categorie']);
            }
        ?>
        <div id="pop">
            <button id="removeClass" class="popbtnclose" onclick="document.getElementById('pop').classList.remove('popup-box-on');document.getElementById('search').hidden=true;document.getElementById('removeClass').hidden=true;" type="button" hidden>x</button>
            <input type="text" id="search" onkeyup="searchfn('<?php echo(addslashes(implode(',',$tabid)) . '\',\'' . addslashes(implode(',',$tabnom)) . '\',\'' . addslashes(implode(',',$tabcateg)) ); ?>','1');" placeholder="Rechercher.." name="search">
            <button id="searchbtn" onclick="$('#search').focus();"><i class="fa fa-search fa-xl" style="margin-top: 1.25rem;"></i></button>
            <button id="searchbtnmob"><i class="fa fa-search fa-xl" style="margin-top: 1.25rem;"></i></button>
            <div class="elements">
                <ul id="elemsul">

                </ul>
            </div>
        </div>
    </div>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="hover-underline-anim" href="index.php">Accueil</a></li>
            <li class="dropdown"><a class="hover-underline-anim" style="cursor: pointer;"><span>Soins</span> <i class="bi bi-chevron-down" style="margin-top: 0.5em"></i></a>
                <ul style="overflow-y: scroll;max-height: 50vh;overflow-x: hidden;">
                <?php
                $sql="SELECT distinct categorie,nom_categorie FROM produits where disponibilite=1 AND ( nom_categorie LIKE 'Soins%' OR nom_categorie LIKE '%vres%' ) ORDER BY idproduits desc;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
                ?>
                    <li class="hover-underline-animation"><a href="prod/prod.php?cat=<?php echo($prod['categorie'])?>" style="color: black !important;"><div><?php echo($prod['nom_categorie']) ?></div></a></li>
                <?php
                }
                ?>
                </ul>
            </li>
            <li class="dropdown"><a class="hover-underline-anim" style="cursor: pointer;"><span>Huiles</span> <i class="bi bi-chevron-down" style="margin-top: 0.5em"></i></a>
                <ul style="overflow-y: scroll;max-height: 50vh;overflow-x: hidden;">
                <?php
                $sql="SELECT distinct categorie,nom_categorie FROM produits where disponibilite=1 AND nom_categorie LIKE 'Huiles%' ORDER BY idproduits desc;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
                ?>
                    <li class="hover-underline-animation"><a href="prod/prod.php?cat=<?php echo($prod['categorie'])?>" style="color: black !important;"><div><?php echo($prod['nom_categorie']) ?></div></a></li>
                <?php
                }
                ?>
                </ul>
            </li>
            <li class="dropdown"><a class="hover-underline-anim" style="cursor: pointer;"><span>Autres Catégories</span> <i class="bi bi-chevron-down" style="margin-top: 0.5em"></i></a>
                <ul style="overflow-y: scroll;max-height: 50vh;overflow-x: hidden;">
                <?php
                $sql="SELECT distinct categorie,nom_categorie FROM produits where nom_categorie NOT LIKE 'Soins%' AND nom_categorie NOT LIKE '%vres%' AND nom_categorie NOT LIKE 'Huiles%' AND disponibilite=1 ORDER BY idproduits desc;";
                $produits = $db->query($sql);

                foreach($produits as $prod){
                ?>
                    <li class="hover-underline-animation"><a href="prod/prod.php?cat=<?php echo($prod['categorie'])?>" style="color: black !important;"><div><?php echo($prod['nom_categorie']) ?></div></a></li>
                <?php
                }
                ?>
                </ul>
            </li>
            <li><a class="hover-underline-anim" href="contact.php">Contact</a></li>
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

<script>
    //Clicks outside search bar
    const specifiedElement = document.getElementById("search");
    document.addEventListener("click", (event) => {
        const isClickInside = specifiedElement.contains(event.target);
        let elems = document.querySelector('.elements');
        let clicked = elems.contains(event.target);

        if (!isClickInside && !clicked) {
            let wid = specifiedElement.clientWidth;
            elems.style="visibility: hidden !important;opacity: 0;width:"+wid+"px;";
        }
        else if (specifiedElement.value != ""){
            searchfn('<?php echo(addslashes(implode(',',$tabid)) . '\',\'' . addslashes(implode(',',$tabnom)) . '\',\'' . addslashes(implode(',',$tabcateg)) ); ?>','1');
        }
    });
</script>