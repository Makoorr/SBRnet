<?php
    require_once('config.php');
?>
<?php
    if(! empty($_POST['email'])){
        try{
            $email=$_POST['email'];

            $sq="SELECT email FROM newsletter WHERE email='$email';";
            $em=$db->query($sq);
            foreach($em as $e){
                $checkem=$e[0];
            }
            
            if (empty($checkem)){
                $sql="INSERT INTO newsletter(email) VALUES(:email)";
                $req=$db->prepare($sql);
                $result=$req->execute([':email'=>$email]);
            }
        }
        catch(Exception $e){
            echo($e->getMessage());
        }
    }
?>