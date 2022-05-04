<?php
    require_once('config.php');
    session_start();
    // Checking is User Logged In
    if(isset($_SESSION['authentication']))
    {
?>

<?php
    if(isset($_POST['etat'])){
        $id = $_POST['idcomm'];
        $etat = $_POST['etat'];

        $sql="UPDATE commande set etat=$etat where idcommande=$id;";
        $stminsert = $db->exec($sql);
        if ($stminsert){
            header("location: comm.php");
        }
        else{
            echo("<h1>Il y'a eu un erreur!</h1>");
            echo("<h2><a href='./comm.php'>Retour</a></h2>");
        }
    }
    else{
        echo("<h1>Il y'a eu un erreur!</h1>");
        echo("<h2><a href='./comm.php'>Retour</a></h2>");
    }
}
else{
    header("location: loginpage.php");
}
?>