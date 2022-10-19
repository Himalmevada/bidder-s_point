<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("../mail_app/vendor/phpmailer/phpmailer/src/Exception.php");
require_once("../mail_app/vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("../mail_app/vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("../mail_app/vendor/autoload.php");

require_once("../include/db_conn.php");


if (isset($_POST['email']) && !empty($_POST['email'])) {

    $email = $_POST['email'];

    $selectUser = "SELECT * FROM users WHERE user_email = ?";
    $selectUserStmt = $conn->prepare($selectUser);
    $result = $selectUserStmt->execute([$email]);

    if ($selectUserStmt->rowCount() > 0) {

        while ($row = $selectUserStmt->fetch(PDO::FETCH_OBJ)) {
            $username = $row->username;
        }
    } else {
        echo "no_found";
        exit();
    }

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "http://localhost/project/redirect-reset-password.php?selector=" . $selector . "&token_validator=" . bin2hex($token);
    $expires = date("U") + 1800;


    $deleteEmail = "DELETE FROM pwd_reset WHERE pwd_reset_email = ?";
    $deleteEmailStmt = $conn->prepare($deleteEmail);
    $result = $deleteEmailStmt->execute([$email]);

    if (!$result) {
        echo "0";
        exit();
    } else {

        $sql = "INSERT INTO pwd_reset (pwd_reset_email, pwd_reset_selector, pwd_reset_token, pwd_reset_expires) VALUES (?,?,?,?)";
        $query = $conn->prepare($sql);

        $hashed_token = password_hash($token, PASSWORD_DEFAULT);
        $result = $query->execute([$email, $selector, $hashed_token, $expires]);

        if (!$result) {
            echo "0";
            exit();
        }
    }

    // Mail body content 
    $bodyContent = "<p> Hi, " . $username . " Click here to reset your password. <a href='$url'>Click here</a></p>";

    $mail = new PHPMailer(true);

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->CharSet = "utf-8"; // set charset to utf8
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->Port = 587; // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isHTML(true); // Set email format to HTML

    $mail->Username = 'bidderspoint@gmail.com'; // SMTP username
    $mail->Password = 'Bidders@2002'; // SMTP password

    $mail->setFrom('bidderspoint@gmail.com', 'Bidder\'s Point'); //Your application NAME and EMAIL
    $mail->Subject = 'Reset Password request from Bidder\'s Point'; //Message subject
    $mail->MsgHTML($bodyContent); // Message body
    $mail->addAddress($email, $username); // Target email

    if ($mail->send()) {
        echo "1";
    } else {
        echo "0";
    }

    // $subject = "Reset Password";
    // $from = "bidderspoint@gmail.com";
    // $to = $email;
    // // $to = "businesshm2002@gmail.com";
    // $message = "Hi, " . $username . "Click here to reset your password.<br>";
    // $message .= "<a href='$url'>Click here</a>";

    // $headers = "From: bidderspoint@gmail.com";
    // $headers .= "Replay-To: bidderspoint@gmail.comrn";
    // $headers .= "Return-Path: bidderspoint@gmail.comrn";
    // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "rn";

    // if (mail($to, $subject, $message, $headers)) {
    //     echo "1";
    // } else {
    //     echo "0";
    // }
}