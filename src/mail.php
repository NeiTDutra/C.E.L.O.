<?php

	include ('./phpmailer/class.phpmailer.php'); 
	include ('./phpmailer/class.smtp.php'); 
	include ('./phpmailer/PHPMailerAutoload.php');
	
	$mailDestino = 'projetocelo@gmail.com'; 
	$_nome = 'CELO';	
	/*$assunto = 'Mensagem recebida do sistema';
	$mensagem = 'Recebemos uma mensagem no sistema pjCELO <br/>
				<strong>Novo orçamento foi lançado:</strong><br/>
				<strong>Orçamento numero:</strong>'.$_SESSION['n_orc'].'<br/>
				<strong>Nome do usuário:</strong>'.$_SESSION['$nome'].'<br/>
				<strong>Nome do cliente:</strong>'.$_SESSION['n_cli'].'<br/>
				<strong>Fone do cliente:</strong>'.$_SESSION['f_cli'].'<br/>
				<strong>Descriminação:</strong><br/>
				<table style="border: 1px solid red; width: 60% !important; text-align: center;">
				<tr><th>Cod.</th><th>Desc.</th><th>Tam.</th><th>Cor</th><th>Quant.</th><th>V. Uni.</th><th>V. tot.</th></tr>'
				.$desc.
				'</table><br/>
				<strong>Valor total: R$</strong>'.$v_t_o.'<br/>';*/
				
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
		
		echo "Erro no envio da mensagem";
	}
	
	}catch(Exception $e){
	
		echo $e->getMessage();
	
	}	
