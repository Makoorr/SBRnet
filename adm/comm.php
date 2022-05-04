<?php
    require_once('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {
    
    if (isset($_GET['etat'])){
        $etat = $_GET['etat'];
    }
    else{
        $etat = 1;
    }

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 25;
    $offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM commande where etat=$etat;";
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
    <title>Commandes</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Commandes</h2>
        <div class="row">
            <div class="col-md-10">
                <h5><a href="dash.php">Home</a> / <a href="#">Commandes</a></h5>
            </div>

            <div class="col-md"> <!-- Pagination -->
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
                        
                        echo("<a href='?etat=$etat&pageno=$prevpage'>&laquo;</a>");
                        echo("<a href='?etat=$etat&pageno=$pageno' class='active' value='$pageno'> $pageno </a>");
                        echo("<a href='?etat=$etat&pageno=$nextpage'>&raquo;</a>");
                    ?>
                </div>
            </div>
        </div>

        <form action="comm.php" method="GET">
        <div class="row">
            <div><strong style="font-size:large;">Commandes: </strong>
            <label>
                <input onchange='this.form.submit();' type="radio" name="etat" value="1" <?php if($etat==1) echo('checked');?>> En cours
                <input onchange='this.form.submit();' type="radio" name="etat" value="0" <?php if($etat==0) echo('checked');?>> Achevé
            </label>
            </div>
        </div>
        </form> <!-- radios -->

        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th>idcommande</th>
                        <th>Date d'achat</th>
                        <th>Heure d'achat</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>TEL</th>
                        <th>Ville</th>
                        <th>Adresse</th>
                        <th>Code Postale</th>
                        <th>Total</th>
                        <th>Quantité de produits</th> <!--cartquantity-->
                        <th></th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <?php
                    $i=0;
                    $sql="SELECT * FROM commande WHERE etat=$etat ORDER BY idcommande desc LIMIT $offset, $no_of_records_per_page;";
                    $commande = $db->query($sql);

                    foreach($commande as $comm){
                ?>
                <form action="achat.php" method="POST">
                    <tr style="text-align: center;">
                        <td style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;"><input name="idcomm" value="<?php echo($comm['idcommande']);?>" style="border: 0 none;background:none;text-align: center;width:50%" readonly></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;width:20%"><?php echo($comm['date']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;width:20%"><?php echo($comm['time']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;width:20%"><?php echo($comm['nom']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;width:20%"><?php echo($comm['prenom']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['email']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['phone']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['ville']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['address']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['zip']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['total']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['cartquantity']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><input type="submit" value="Voir Achat"></td>
                </form>
                        <form action="etat_comm.php" method="POST">
                        <td style="border-right: 1px solid;border-bottom: 1px solid;">
                            <select name="etat" onchange="this.form.submit();">
                                <option <?php if($comm['etat']===1) echo('selected');?> value="1">En Cours</option>
                                <option <?php if($comm['etat']===0) echo('selected');?> value="0">Achevé</option>
                            </select>
                            <input name="idcomm" value="<?php echo($comm['idcommande']);?>" hidden>
                        </td>
                        </form>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
<?php
    }
    else{
        header("location: loginpage.php");
    }
?>