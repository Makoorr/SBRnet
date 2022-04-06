<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prods</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Produits</h2>
        <div class="row" hidden id="add-prod"> <!-- Add prod -->
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th>Categorie</th>
                        <th>Nom</th>
                        <th>Prix unitaire</th>
                    </tr>
                </thead>
                <tr style="text-align: center;">
                    <form action="addprod.php" enctype="multipart/form-data" method="POST">
                        <td>
                            <select name="nom_categorie">
                            <?php
                            $sql = "SELECT distinct nom_categorie FROM produits";
                            foreach ($db->query($sql) as $cat) {
                            ?>
                                <option value="<?php echo($cat['nom_categorie']);?>"><?php echo($cat['nom_categorie']);?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                        <td><input type="text" name="nom"></td>
                        <td><input type="number" name="prix"></td>
                        <td><input type="file" name="filetoupload"></td>
                        <td><button type="submit">Ajouter</td>
                    </form>
                </tr>
            </table>
        </div>

        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th>idproduits</th>
                        <!-- <th>Image</th> -->
                        <th>Categorie</th>
                        <th>Nom</th>
                        <th>Prix unitaire</th>
                        <th>Disponibilite</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <?php
                    $i=0;
                    $sql="SELECT * FROM produits;";
                    $produits = $db->query($sql);

                    foreach($produits as $prod){
                ?>
                <tr style="text-align: center;">
                <form action="suppprod.php" method="POST">
                    <td style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;"><input type="text" name="supp_idproduits" style="border: 0 none;text-align:center;width:10%;background:none;" value="<?php echo($prod['idproduits']); ?>" readonly></td>
                    <!-- <td style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;"><img src="../assets/img/<?php echo($prod['idproduits']);?>.png" style="width: 50%;"></td> -->
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><input type="text" name="supp_nom_categorie" style="border: 0 none;text-align:center;background:none;" value="<?php echo($prod['nom_categorie']); ?>" readonly></td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><input type="text" name="supp_nom" style="border: 0 none;text-align:center;background:none;" value="<?php echo($prod['nom']); ?>" readonly></td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><input type="text" name="supp_prix" style="border: 0 none;text-align:right;width:20%;background:none;" value="<?php echo($prod['prix']); ?>" readonly> DT</td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php if($prod['disponibilite']) echo('Oui'); else echo('Non'); ?></td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><button type="submit">X</button></td>
                </form>
                <?php
                    }
                ?>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <input type="button" value="Ajouter un produit" onclick="addprod()">
            </div>
            <!-- <div class="col-sm-2">
                <input type="button" value="Ajouter une categorie" onclick="addcateg()">
            </div> -->
        </div>

        <!-- Ajt Categ -->
        <!-- <div class="row" hidden id="add-categ"> 
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th>Id Categorie (Dans un seul mot en minuscule)</th>
                        <th>Nom Categorie</th>
                        <th></th>
                    </tr>
                </thead>
                <tr style="text-align: center;">
                    <form action="addcateg.php" method="POST">
                        <td><input type="text" name="idcateg"></td>
                        <td><input type="text" name="nomcateg"></td>
                        <td><button type="submit">Ajouter</td>
                    </form>
                </tr>
            </table>
        </div> -->

    </div> <!-- End Container -->
    <script>
        function addprod(){
            document.getElementById("add-prod").removeAttribute('hidden');
        }
        // function addcateg(){
        //     document.getElementById("add-categ").removeAttribute('hidden');
        // }
    </script>
</body>
</html>