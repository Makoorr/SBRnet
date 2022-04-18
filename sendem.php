<?php
  require_once('mail.php');

  if (! empty($_POST['name']) && ! empty($_POST['email']) && ! empty($_POST['message']) && ! empty($_POST['subject'])) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    try {
      $mail->addAddress('sbrpharma1@gmail.com');

      $mail->isHTML(true);
      $mail->Subject = "Demande de contact d'un client SBRPharma";
      $mail->Body = "<h3>From:$name<br> Sujet: $subject<br> Email: $email <br> Tel: $tel <br> Message: $message";

      $mail->send();
    } catch(Exception $e) {
      // echo('<div class="alert-error">
      //           <span>'.$e->getMessage().'</span>
      //         </div>');
    }
    setcookie("post",1,time()+5,"/");
  }
?>