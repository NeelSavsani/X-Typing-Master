<?php
include "dbconnect.php";

/* PHPMailer files */
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    /* SMTP CONFIG */
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'expirochain.team@gmail.com';
    $mail->Password = 'jcpw bjzu wzvk rjrg'; // ⚠️ use app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    /* MAIL META */
    $mail->setFrom('expirochain.team@gmail.com', 'X-Typing-Master');
    $mail->isHTML(true);
    $mail->Subject = 'Join the Official WhatsApp Group: X-Typing-Master';

    /* EMAIL BODY */
    $mail->Body = "
        <div style='font-family: Arial, sans-serif; font-size: 15px; color: #333; line-height: 1.6;'>

    <p>Dear Participant,</p>

    <h2 style='color: #2c7be5; margin-bottom: 10px;'>
        🎉 Registration Successful
    </h2>

    <p>
        Greetings from the <strong>X-Typing-Master Team</strong>!
    </p>

    <p>
        We are glad to inform you that an official 
        <strong>WhatsApp group</strong> has been created for participants of
        <strong>X-Typing-Master</strong>, an event conducted during
        <strong>Xenesis Techfest</strong>.
    </p>

    <p><strong>This group will be used for:</strong></p>

    <ul style='padding-left: 18px;'>
        <li>Important announcements</li>
        <li>Event-related updates</li>
        <li>Result notifications</li>
        <li>General communication and support</li>
    </ul>

    <p>
        Kindly join the WhatsApp group using the button below:
    </p>

    <p style='margin: 20px 0;'>
        <a href='https://chat.whatsapp.com/FIql4l98ZnZLGJ8dXxdQkM'
           style='
                background-color: #25D366;
                color: #ffffff;
                padding: 12px 18px;
                text-decoration: none;
                border-radius: 6px;
                font-weight: bold;
                display: inline-block;
           '>
            👉 Join WhatsApp Group
        </a>
    </p>

    <p>
        Please make sure to join the group at the earliest so that you don’t miss
        any important updates.
    </p>

    <p>
        If you face any issues while joining, feel free to contact us directly.
    </p>

    <br>

    <p>
        Warm regards,<br>
        <strong>X-Typing-Master Team</strong><br>
        <span style='color: #555;'>
            For any issue while joining the group, contact<br>
            <strong>Ved Rathod</strong> –
            <a href='https://wa.me/919712192640'
               style='color:#25D366; text-decoration:none; font-weight:bold;'>
                +91 97121 92640
            </a>
        </span>
    </p>

</div>

    ";

    /* FETCH EMAILS (FROM ARRAY OR DB) */
    $emailList = [
        'neelsavsani7@gmail.com',
        'neelsavsani1@gmail.com',
        'neelsavsani2@gmail.com',
        'neel.ldrp.16@gmail.com',
        'vekariyajeel0@gmail.com',
        'abhisheksangani5@gmail.com'
    ];

    foreach ($emailList as $email) {
        $email = strtolower(trim($email)); // normalize
        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->send();
    }

    echo "Emails sent successfully.";

} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
