<?php
    require_once('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 25;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM produits;";
    $result = $db->query($total_pages_sql);
    foreach($result as $res){
        $total_rows = $res[0];
    }
    $total_pages = ceil($total_rows / $no_of_records_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prods</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
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
                        <select name="categorie">
                            <option value="huilesveg">Huiles Végétales</option>
                            <option value="soinsch">Soins Cheveux</option>
                            <option value="soinsco">Soins Corps</option>
                            <option value="soinsvis">Soins Visage</option>
                            <option value="savons">Savons</option>
                            <option value="levre">Lèvres</option>
                            <option value="argiles">Argiles</option>
                            <option value="eauflor">Eaux Florales</option>
                            <option value="gelhydro">Gel Hydroalcoolique</option>
                            <option value="masques">Masques Jetables</option>
                            <option value="testgross">Test de Grossesse</option>
                            <option value="bouchor">Bouchons d'oreilles</option>
                            <option value="huilesess">Huiles Essentielles</option>
                        </select>
                        </td>
                        <td><input type="text" name="nom"></td>
                        <td><input type="number" name="prix"></td>
                        <td><input type="file" name="filetoupload"></td>
                        <td><button type="submit">Ajouter</td>
                    </form>
                </tr>
            </table>
        </div> <!-- Fin Add prod -->
        <div class="row">
            <div class="col-md-5">
                <h5><a href="dash.php">Home</a> / <a href="#">Produits</a></h5>
            </div>

            <div class="col-sm-5">
                <input type="button" value="Ajouter un produit" onclick="addprod()">
            </div>

            <div class="col-md">
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
                        echo("<a href='?pageno=$pageno' class='active' value='$pageno'> $pageno </a>");
                        echo("<a href='?pageno=$nextpage'>&raquo;</a>");
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            
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
                    </tr>
                </thead>
                <?php
                    $i=0;
                    $sql="SELECT * FROM produits LIMIT $offset, $no_of_records_per_page;";
                    $produits = $db->query($sql);

                    foreach($produits as $prod){
                ?>
                <form method="POST" action="changedisp.php">
                <tr style="text-align: center;">
                    <td style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;"><input type="text" name="supp_idproduits" style="border: 0 none;text-align:center;width:2em;background:none;" value="<?php echo($prod['idproduits']); ?>" readonly></td>
                    <!-- <td style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;"><img src="../assets/img/<?php echo($prod['idproduits']);?>.jpg" style="width: 50%;"></td> -->
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><input type="text" name="supp_nom_categorie" style="border: 0 none;text-align:center;background:none;width:10em;" value="<?php echo($prod['nom_categorie']); ?>" readonly></td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;"><input type="text" name="supp_nom" style="border: 0 none;text-align:center;background:none;width:20em;" value="<?php echo($prod['nom']); ?>" readonly></td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;width:13em;"><input type="text" name="supp_prix" style="border: 0 none;text-align:right;width:20%;background:none;" value="<?php echo($prod['prix']); ?>" readonly> DT</td>
                    <td style="border-right: 1px solid;border-bottom: 1px solid;">
                            <select name="dispo" onchange="this.form.submit();">
                                <option <?php if($prod['disponibilite']==1) echo('selected');?> value="1">Oui</option>
                                <option <?php if($prod['disponibilite']==0) echo('selected');?> value="0">Non</option>
                                <input type="submit" id="subm" hidden>
                            </select>
                    </td>
                </form>
                <?php
                    }
                ?>
                </tr>
            </table>
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
<?php
    }
    else{
        header("location: loginpage.php");
    }
?>