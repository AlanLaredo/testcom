<?php

$Name = '';
if(isset($_POST["Name"]))
$Name = $_POST["Name"];

$Company = '';
if(isset($_POST["Company"]))
$Company = $_POST["Company"];

$Phone = '';
if(isset($_POST["Phone"]))
$Phone = $_POST["Phone"];

$Email = '';
if(isset($_POST["Email"]))
$Email = $_POST["Email"];

$Country = '';
if(isset($_POST["Country"]))
$Country = $_POST["Country"];

$State = '';
if(isset($_POST["State"]))
$State = $_POST["State"];

$City = '';
if(isset($_POST["City"]))
$City = $_POST["City"];

$Message = '';
if(isset($_POST["Message"]))
$Message = $_POST["Message"];


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
    $mail->SMTPDebug = SMTP::DEBUG_OFF ;                      //Enable verbose debug outputDEBUG_SERVER
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('', 'Mailer');
    $mail->addAddress('', 'Joe User');     //Add a recipient
 
    $Body = "";
    $Body .= "Nombre: ";
    $Body .= $Name;
    $Body .= "<br><br>";

    $Body .= "Compañia: ";
    $Body .= $Company;
    $Body .= "<br><br>";

    $Body .= "Teléfono: ";
    $Body .= $Phone;
    $Body .= "<br><br>";

    $Body .= "Email: ";
    $Body .= $Email;
    $Body .= "<br><br>";

    $Body .= "País: ";
    $Body .= $Country;
    $Body .= "<br><br>";

    $Body .= "Estado: ";
    $Body .= $State;
    $Body .= "<br><br>";

    $Body .= "Ciudad: ";
    $Body .= $City;
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