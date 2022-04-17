<?php
    require_once('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {
?>
<?php
if (isset($_POST['idcomm'])){
    $idcommande=intval($_POST['idcomm']);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Achat</title>
        <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h2 style="text-align: center;">Commande N°<?php echo($idcommande) ?></h2>
            <div class="col-md-10">
                <h5><a href="dash.php">Home</a> / <a href="comm.php">Commandes</a> / <a href="#">Achat</a></h5>
                <br>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr style="text-align: center">
                            <th>idproduits</th>
                            <th>categorie du produits</th>
                            <th>nom du produits</th>
                            <th>quantite</th>
                            <th>prix unitaire</th>
                            <th>prix total</th>
                        </tr>
                    </thead>
                    <?php
                        $sql="SELECT * FROM achat WHERE idcommande=$idcommande";
                        $achat = $db->query($sql);

                        foreach($achat as $ach){
                    ?>
                    <tr style="text-align: center">
                        <td style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;"><?php echo($ach['idproduits']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php
                                                                                            $p=$ach['idproduits'];
                                                                                            $sql2="SELECT categorie FROM produits WHERE idproduits=$p";
                                                                                            $nomprod = $db->query($sql2);
                                                                                            foreach($nomprod as $n) echo($n['categorie']);
                                                                                      ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php
                                                                                            $p2=$ach['idproduits'];
                                                                                            $sql3="SELECT nom FROM produits WHERE idproduits=$p2";
                                                                                            $nomprod2 = $db->query($sql3);
                                                                                            foreach($nomprod2 as $n2) echo($n2['nom']);
                                                                                      ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($ach['quantite']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo(intval($ach['prix'])/intval($ach['quantite'])); ?> DT</td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($ach['prix']); ?> DT</td>
                    <?php
                        }
                    ?>
                    </tr>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                    <a style="font-weight: bold;color:red;font-family:'Courier New', Courier, monospace;font-size:large;">Total: 
                        <?php
                            $sql="SELECT total FROM commande WHERE idcommande=$idcommande";
                            $achat = $db->query($sql);
                            foreach($achat as $ach){
                                echo($ach['total']);
                            }
                        ?> DT
                    </a>
            </div>
            <br>
            <div class="row">
            <h2 style="text-align: center;">Information client</h2>
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th>Date d'achat</th>
                        <th>Heure d'achat</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>TEL</th>
                        <th>Ville</th>
                        <th>Adresse</th>
                        <th>Code Postale</th>
                    </tr>
                </thead>
                <?php
                    $i=0;
                    $sql="SELECT * FROM commande WHERE idcommande=$idcommande;";
                    $commande = $db->query($sql);

                    foreach($commande as $comm){
                ?>
                <form action="achat.php" method="POST">
                    <tr style="text-align: center;">
                        <td style="border-right: 1px solid;border-bottom: 1px solid;width:10%"><?php echo($comm['date']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;width:10%"><?php echo($comm['time']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['nom']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['prenom']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['email']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['phone']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['ville']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['address']); ?></td>
                        <td style="border-right: 1px solid;border-bottom: 1px solid;"><?php echo($comm['zip']); ?></td>
                    </tr>
                </form>
                <?php
                    }
                ?>
            </table>
        </div>
            <div class="row">
                <div class="col">
                    <h2><a href="comm.php">Retour au Commandes</a></h2>
                </div>
            </div>
        </div>
    </body>
    </html>
<?php
}
else{
?>
    <div>
    <h2><a href="comm.php">Retour au Commandes</a></h2>
    </div>
<?php
}
    }
    else{
        header("location: loginpage.php");
    }
?>