<?php
    require_once('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {
?>

<?php
if(isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['categorie']) && is_uploaded_file($_FILES['filetoupload']['tmp_name'])){
    $nom=$_POST['nom'];
    $prix=$_POST['prix'];
    $categorie=$_POST['categorie'];
    $img=$_FILES['filetoupload']['name'];

    echo("<h3>");
    echo("Nom : ".$nom." <br>");
    echo("Prix : ".$prix." <br>");
    echo("categorie : ".$categorie."  <br>");
    echo("Image : ".$img."  <br>");
    echo("</h3>");

    if (! empty($_POST['categorie']) && ! empty($_POST['nom']) && ! empty($_POST['prix']) && ! empty($_FILES['filetoupload']['name'])){
        $nom=$_POST['nom'];
        $prix=$_POST['prix'];
        $categorie=$_POST['categorie'];
        $target="../assets/img/";

        $sql = "SELECT distinct nom_categorie FROM produits WHERE categorie='$categorie'";
        foreach ($db->query($sql) as $cat) {
            $nom_categorie=$cat['nom_categorie'];
        }

        try{
            $sql1 = "INSERT INTO produits (nom,prix,disponibilite,categorie,nom_categorie) VALUES(:nom,:prix,:disponibilite,:categorie,:nom_categorie)";
            $stmtinsert = $db->prepare($sql1);
            $result = $stmtinsert->execute([':nom'=>$nom,'prix'=>$prix,':disponibilite'=>1,':categorie'=>$categorie,':nom_categorie'=>$nom_categorie]);

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
echo("<a href='./prod.php'>Retour aux produits</a>");
}
else{
    header("location: loginpage.php");
}
?>