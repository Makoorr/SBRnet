<?php
    require_once('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {
?>

<?php
    if(isset($_POST['dispo'])){
        $id = $_POST['supp_idproduits'];
        $dispo= $_POST['dispo'];

        $sql="UPDATE produits set disponibilite=$dispo where idproduits=$id;";
        $stminsert = $db->exec($sql);
        if ($stminsert){
            header("location: prod.php");
        }
        else{
            echo("<h1>Il y'a eu un erreur!</h1>");
            echo("<h2><a href='./prod.php'>Retour</a></h2>");
        }
    }
    else{
        echo("<h1>Il y'a eu un erreur!</h1>");
        echo("<h2><a href='./prod.php'>Retour</a></h2>");
    }
}
else{
    header("location: loginpage.php");
}
?>