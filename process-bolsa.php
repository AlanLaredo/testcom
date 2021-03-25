<?php

$Name = '';
if(isset($_POST["Name"]))
$Name = $_POST["Name"];

$Lastname = '';
if(isset($_POST["Lastname"]))
$Lastname = $_POST["Lastname"];

$Phone = '';
if(isset($_POST["Phone"]))
$Phone = $_POST["Phone"];

$Email = '';
if(isset($_POST["Email"]))
$Email = $_POST["Email"];

$Role = '';
if(isset($_POST["Role "]))
$Role = $_POST["Role "];

$Message = '';
if(isset($_POST["Message"]))
$Message = $_POST["Message"];

$tmp_file = null;
if(isset($_FILES) && $_FILES["cv"]["tmp_name"])
$tmp_file = $_FILES["cv"]["tmp_name"];



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF ;                      //Enable verbose debug output DEBUG_SERVER DEBUG_OFF
    $mail->isSMTP();                                       //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'palmex.testing@gmail.com';                     //SMTP username
    $mail->Password   = 'Pass.word1';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('palmex.testing@gmail.com', 'Mailer');
    $mail->addAddress('palmex.testing@gmail.com', 'Joe User');     //Add a recipient
    
    if($tmp_file <> null)
        $mail->addAttachment($tmp_file, $Name .'-'.$Lastname .'-'.$Role.'.pdf');         //Add attachments

    $Body = "";
    $Body .= "Nombre: ";
    $Body .= $Name;
    $Body .= "<br><br>";

    $Body .= "Apellidos: ";
    $Body .= $Lastname;
    $Body .= "<br><br>";

    $Body .= "Teléfono: ";
    $Body .= $Phone;
    $Body .= "<br><br>";

    $Body .= "Email: ";
    $Body .= $Email;
    $Body .= "<br><br>";

    $Body .= "Puesto al que aspira: ";
    $Body .= $Role;
    $Body .= "<br><br>";

    $Body .= "Mensaje: ";
    $Body .= $Message;


    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Formulario de Contacto Palmex';
    $mail->Body    = $Body;

    $mail->send();
    echo 'Tu mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'Intentalo mas tarde';
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}