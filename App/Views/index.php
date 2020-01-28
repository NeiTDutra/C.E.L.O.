<!DOCTYPE html>
<html>
<head>

	<meta charset='utf-8'>
	<link rel="stylesheet" type="text/css" href="./App/src/estiliza.css">
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
?>
    	<p style= "margin-left:10px;">Usuário: <input type= "text" value= "<?php echo $_SESSION['$nome'] ?? 'Nenhum' ?>"></p>
		

		</div>
		
		<div class="login">
		
			<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post">
			
			<button type="submit" name="login" class="lanca">Login/Logout</button>	
			
			</form>
			
		</div>
			
	</div>
	
	<div style="width: 10%; height: auto; position: fixed; left: 0;" >
	
	</div>
	
	<div class="ctn_menu">
	
<?php
	
	$DIR = $_SERVER['DOCUMENT_ROOT'].'/CELO/';
	include $DIR . 'App/Controllers/dirdef.php'; 

    if(isset($_POST['login']) || isset($_POST['usuario_log']) && !isset($_GET[''])){
	
		if(isset($_SESSION['$nome'])){
			
			unset($_SESSION['id_usu']);
			unset($_SESSION['$nome']); 
            unset($_SESSION['$nivel']);
			session_destroy();
			header ('location:index.php'); 

		}

	require_once $GLOBALS['views'] . 'login.php';
    
    }
	
    if(isset($_SESSION['$nome'])){
	
        if(isset($_GET['op']) == '1'){
	
		    require_once $GLOBALS['views'] . 'menu_inicial.php';

        }else{	
		
			require_once $GLOBALS['controllers'] . 'generic.php';
			$mn = new Menu;
			$mn->escolhe_menu();
			
        }

    }
    
?>

	</div>
	
	<script src="./App/src/scriptiza.js"></script>
	
	<div id="rdp">
	
		<p><a href="https://sites.google.com/view/nservicos-nei/p%C3%A1gina-inicial" target="blank">< Projeto CELO - NServiços ></a></p>
		
	</div>
	
</body>
</html>
