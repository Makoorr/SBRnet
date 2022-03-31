<?php
    require_once('config.php');
?>
<?php
    if(! empty($_POST['emailnews'])){
        try{
            $email=$_POST['emailnews'];
            $sql="INSERT INTO newsletter(email) VALUES(:email)";
            $req=$db->prepare($sql);
            $result=$req->execute([':email'=>$email]);
        }
        catch(Exception $e){
        }
    }
    // header('Location: http://localhost/sbrnet/index.html');
    // exit();
?>