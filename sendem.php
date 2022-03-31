<?php
  use PHPMailer\PHPMailer\PHPMailer;

  require_once 'assets/php-mailer/Exception.php';
  require_once 'assets/php-mailer/PHPMailer.php';
  require_once 'assets/php-mailer/SMTP.php';

  if (! empty($_POST['name']) && ! empty($_POST['email']) && ! empty($_POST['message']) && ! empty($_POST['subject'])) {
    $mail = new PHPMailer(true);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'sbrpara1@gmail.com';
      $mail->Password = 'sbrsbrparapara13';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      $mail->setFrom('sbrpara1@gmail.com');
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