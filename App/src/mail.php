<?php

	include ($GLOBALS['src'] . 'phpmailer/class.phpmailer.php'); 
	include ($GLOBALS['src'] . 'phpmailer/class.smtp.php'); 
	include ($GLOBALS['src'] . 'phpmailer/PHPMailerAutoload.php');
	
	
	$mailDestino = 'projetocelo@gmail.com'; 
	$_nome = 'CELO';	
				
	$mail = new PHPMailer();
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 0;
	$mail->CharSet = 'UTF-8';
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Host = "smtp.gmail.com"; // SMTP servers
	$mail->Port = 587; 
	$mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
	$mail->Username = "projetocelo@gmail.com"; // SMTP username
	$mail->Password = "Celo2019"; // SMTP password
	$mail->From = "projetocelo@gmail.com"; // From
	$mail->FromName = "pjCELOv-1.0" ; // Nome de quem envia o email
	$mail->AddAddress($mailDestino, $_nome); // Email e nome de quem receberá //Responder
	$mail->WordWrap = 50; // Definir quebra de linha
	$mail->IsHTML = true ; // Enviar como HTML
	$mail->Subject = $assunto ; // Assunto
	$mail->Body = '<br/>' . $mensagem . '<br/>' ; //Corpo da mensagem caso seja HTML
	$mail->AltBody = "$mensagem" ; //PlainText, para caso quem receber o email não aceite o corpo HTML

	try{
	
	if(!$mail->Send()){ // Envia o email
		
		echo '<script>alert("Erro no envio da mensagem");</script>';
		
	}else{
	
		return true;
	
	}
	
	}catch(Exception $e){
	
		echo $e->getMessage();
	
	}	
