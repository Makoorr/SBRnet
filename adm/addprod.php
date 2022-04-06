<?php
    require_once('config.php');
?>

<?php
if(isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['nom_categorie']) && is_uploaded_file($_FILES['filetoupload']['tmp_name'])){
    $nom=$_POST['nom'];
    $prix=$_POST['prix'];
    $nom_categorie=$_POST['nom_categorie'];
    $img=$_FILES['filetoupload']['name'];

    echo("<h3>");
    echo("Nom : ".$nom." <br>");
    echo("Prix : ".$prix." <br>");
    echo("Nom_categorie : ".$nom_categorie."  <br>");
    echo("Image : ".$img."  <br>");
    echo("</h3>");

    if (! empty($_POST['nom_categorie']) && ! empty($_POST['nom']) && ! empty($_POST['prix']) && ! empty($_FILES['filetoupload']['name'])){
        $nom=$_POST['nom'];
        $prix=$_POST['prix'];
        $nom_categorie=$_POST['nom_categorie'];
        $target="../assets/img/";

        $sql = "SELECT distinct categorie FROM produits WHERE nom_categorie='$nom_categorie'";
        foreach ($db->query($sql) as $cat) {
            $categorie=$cat['categorie'];
        }

        try{
            // $sql1 = "INSERT INTO produits (nom,prix,disponibilite,categorie,nom_categorie) VALUES(:nom,:prix,:disponibilite,:categorie,:nom_categorie)";
            // $stmtinsert = $db->prepare($sql1);
            // $result = $stmtinsert->execute([':nom'=>$nom,'prix'=>$prix,':disponibilite'=>1,':categorie'=>$categorie,':nom_categorie'=>$nom_categorie]);

            //Ajout img
            foreach($db->query("SELECT idproduits FROM produits WHERE nom='$nom' and categorie='$categorie' and prix='$prix'") as $id){
                $idnewprod=$id['idproduits'];
            }
            echo($idnewprod);
            $target_file=$target.$idnewprod.'.jpg';

            move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file);
            echo("<h2 style='color:red'>  Produits ajouté!</h2>");
        }
        catch(Exception $e){
            echo("Erreur d'ajout d'image, veuillez verifier l'emplacement de l'image!");
        }

    }
    else{
        echo("Erreur,veuillez vérifier votre demande!");
    }
}
else{
    echo('not ISSET!');
}
echo("<a href='http://localhost/sbrnet/adm/prod.php'>Retour aux produits</a>");
?>