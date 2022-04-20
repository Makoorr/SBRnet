<?php
include('config.php');
session_start();

if(isset($_POST['login']))
{
    $email = $_POST['login'];
    $password = crypt($_POST['password'],'CRYPT_SHA256');
    $hashed_pw = crypt($password,'CRYPT_MD5');

    $sql = "SELECT * FROM users where email=:email and password=:password LIMIT 1";
    $stm = $db->prepare($sql);
    $stm->execute(array('email'=>$email,'password'=>$hashed_pw));
    $req = $stm->fetchAll();
    foreach($req as $acc){
        $checkid=$acc['id'];
        $checkem=$acc['email'];
        $checkpw=$acc['password'];
    }

    if(!empty($checkid) && ! empty($checkem) && ! empty($checkpw))
    {

        // Authenticating Logged In User
        $_SESSION['authentication'] = true;

        // Storing Authenticated User data in Session
        $_SESSION['auth_user'] = [
            'user_id'=>$checkid,
            'user_email'=>$checkem,
        ];

        $_SESSION['message'] = "You are Logged In Successfully"; //message to show
        header("Location: dash.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Invalid Email or Password"; //message to show
        header("Location: loginpage.php");
        exit(0);
    }
}
?>