<?php
  require_once('mail.php');

  if (! empty($_POST['name']) && ! empty($_POST['email']) && ! empty($_POST['message']) && ! empty($_POST['subject'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try {
      $mail->addAddress('sbrpara1@gmail.com');

      $mail->isHTML(true);
      $mail->Subject = "Demande de contact d'un client SBRPharma";
      $mail->Body = "<h3>From:$name<br> Sujet: $subject<br> Email: $email <br> Tel: $tel <br> Message: $message";

      $mail->send();
    } catch(Exception $e) {
      // echo('<div class="alert-error">
      //           <span>'.$e->getMessage().'</span>
      //         </div>');
    }
  }
?>