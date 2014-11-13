<?php

//Le decimos a PHP que vamos a devolver objetos JSON
header('Content-type: application/json');

//Importamos la libreria de PHPMailer para el envio de emails
require 'Mailer/PHPMailerAutoload.php';

if(isset($_POST['enviar_mail'])){
	$mail = new PHPMailer;
    $mail->isSMTP();                                      // Activamos SMTP para mailer
	$mail->Host = 'single-2020.banahosting.com';  // Especificamos el host del servidor SMTP
	$mail->SMTPAuth = true;                               // Activamos la autenticacion
	$mail->Username = 'app@taxirapidoapp.com';                 // Correo SMTP
	$mail->Password = 'zxcasdqwe123';                           // Contraseña SMTP
	$mail->SMTPSecure = 'ssl';                            // Activamos la encriptacion ssl
	$mail->Port = 465;                                    // Seleccionamos el puerto del SMTP

	$mail->From = 'app@prueba.com';
	$mail->FromName = $_POST['nombre'];   // Nombre del que envia el correo
	$mail->addAddress($_POST['email']);   //Destinatario

	$mail->isHTML(true); //Decimos que lo que enviamos es HTML
	$mail->CharSet = 'UTF-8';  // Configuramos el charset 

	$mail->Subject = $_POST['asunto']; //Añadimos el asunto del mail

	$mail->Body    = '<div align="center"><img src="http://www.abondance.com/Bin/logo-mail.png"><br><br>'.
	$_POST['msg'].'</div>'; //Ponemos una imagen y el mensaje 

	//comprobamos si el mail se envio correctamente y devolvemos la respuesta al servidor
	if(!$mail->send()) {
		$R['exito'] = false;
		$R['msg'] = 'Error al enviar el email';
	} else {
		$R['exito'] = true;
		$R['msg'] = 'Email enviado con exito';
	}
	echo json_encode($R);
}

?>