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
        $mail->Username = 'sbrpharma1@gmail.com';
        $mail->Password = 'SBRPharmaSBR';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('sbrpharma1@gmail.com');//your email
    }catch(Exception $e) {
        // echo('<div class="alert-error">
        //           <span>'.$e->getMessage().'</span>
        //         </div>');
    }
?>
