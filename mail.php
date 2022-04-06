<?php

use PHPMailer\PHPMailer\PHPMailer;

    require_once 'assets/php-mailer/Exception.php';
    require_once 'assets/php-mailer/PHPMailer.php';
    require_once 'assets/php-mailer/SMTP.php';

    $mail = new PHPMailer();

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';//your email
        $mail->Password = '';//your password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('');//your email
    }catch(Exception $e) {
        // echo('<div class="alert-error">
        //           <span>'.$e->getMessage().'</span>
        //         </div>');
    }
?>