<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../TousAntiPhishing/vendor/phpmailer/phpmailer/src/Exception.php';
require '../TousAntiPhishing/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../TousAntiPhishing/vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                         // Enable SMTP authentication
    $mail->SMTPDebug = 0;                             
    $mail->Username = 'tousantiphishing@gmail.com';             // SMTP username
    $mail->Password = 'epsi12345';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('tousantiphishing@gmail.com', 'Mailer');          //This is the email your form sends From
    $mail->addAddress($_POST['mail']); // Add a recipient address
    //$mail->addAddress('contact@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->ContentType = 'text/html';
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Remboursement Ameli";
    $mail->Body = file_get_contents('../TousAntiPhishing/Mail-ameli.html');
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        header("Location: ../TousAntiPhishing/index.html");
    }

?>
