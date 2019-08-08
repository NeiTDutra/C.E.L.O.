<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="estiliza.css">
	<title>CELO v.1.0</title>
</head>
<body>

	<div id="topo">
		<div id="logo">
			<p style= "font-size:40px; margin-left:10px;">PROJETO</p>
			<p> <span style= "font-size:60px; color:red;">CELO</span></p>
			<p style= "font-size:13px;">Controle de Estoque e Lançamento de Orçamento<br> V. 1.0</p>
		</div>
		<div class="login">
<?php 

	ini_set('display_errors', true); error_reporting(E_ALL);

    session_start();
    if(isset($_SESSION['$nome'])){				
	
		$_logado = '<p style= "margin-left:10px;">Usuário: <input type= "text" value= "'.$_SESSION['$nome'].'"></p>';
		echo $_logado;

    } 
    
    else{
	
		echo '<p style= "margin-left:10px;">Usuário: <input type= "text" value= "nenhum"</input></p>';

    }
?>
		</div>
		<div class="login">
			<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post">
			<input type="submit" name="login" value="login/logout">	
			</form>
		</div>
			
	</div>
	<div class="ctn_menu">
	
<?php

    if(isset($_POST['login']) || isset($_POST['usuario_log']) && empty($_GET[''])){
	
		if(isset($_SESSION['$nome'])){

			unset($_SESSION['$nome']); 
                        unset($_SESSION['$nivel']);
			session_destroy();
			header ('location:index.php'); 

		}

	require_once('login.php');
    
    }
	
    if(isset($_SESSION['$nome'])){
	
        if(isset($_GET['op']) == '1'){
	
		    require_once('menu_inicial.php');

        }else{	
		
			require_once('classes.php');
			$mn = new Menu;
			$mn->escolhe_menu();
			
        }

    }

?>
	</div>
	<script src="scriptiza.js"></script>
	<div id="rdp">
		<p> Projeto CELO </p>
	</div>
</body>
</html>
