<?php
    require_once('config.php');
?>

<?php
    if(isset($_POST['supp_idproduits']) && isset($_POST['supp_nom']) && isset($_POST['supp_nom_categorie']) && isset($_POST['supp_prix'])){
        $idproduits=$_POST['supp_idproduits'];
        $nom=$_POST['supp_nom'];
        $nom_categorie=$_POST['supp_nom_categorie'];
        $prix=$_POST['supp_prix'];

        echo('idProduits: '.$idproduits . "<br>");
        echo('Nom: '.$nom . "<br>");
        echo('Categorie: '.$nom_categorie . "<br>");
        echo('Prix: '.$prix . "<br>");

        $file_pointer="../assets/img/$idproduits.jpg";
        // Use unlink() function to delete a file
        if (!unlink($file_pointer)) {
            echo ("$file_pointer ne peut pas etre effacé!");
        }
        else {
            echo ("$file_pointer a été effacé!");
        }
        $sql1="DELETE FROM produits where idproduits='$idproduits'";
        $stmtinsert = $db->exec($sql1);

        echo ("<h4>Produit $nom supprimé!</h4>");
        echo("<a href='http://localhost/sbrnet/adm/prod.php'>Retour aux produits</a>");
    }
?>