

<a  style="font-size:40px; color:black; text-decoration:none; margin-right:-300px;" href="index.php" title="Fechar">X</a>

<div id="login">

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

    	<fieldset><legend>Login</legend>

			<label for="nome">Nome:</label>
			<input type="text" name="nome" id="nome" size="20"/><br><br>

			<label for="senha">Senha:</label>
			<input type="password" name="senha" id="senha" size="20" maxlength="8"/><br><br>

			<input type="submit" name="usuario_log" value="Entrar">

    	</fieldset>

	</form>
<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	if (isset($_POST['usuario_log'])){
	
		require_once 'classes.php';
		
		$g_log = new Gate;
		$g_log->testa_login($_POST['nome'], $_POST['senha']);
	
	}

?>
</div>

