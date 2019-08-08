

<a  style="font-size:40px; color:black; text-decoration:none; margin-right:-300px;" href="index.php">X</a>
<div id="login">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Login</legend>
		<label for="nome">Nome:</label>
		<input type="text" name="nome" size="20"/><br><br>
		<label for="senha">Senha:</label>
		<input type="password" name="senha" size="20" maxlength="8"/><br><br>
		<input name="usuario_log" type="submit" value="Entrar">
    	</fieldset>
	</form>
<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

    if (isset($_POST['nome']) == false && isset($_POST['senha']) == false){

		echo '<p style="color:red;">Digite usuário e senha.</p>';

    } 

	else{

		try{

			require_once 'Usuario.classe.php';
			$du1 = new DAOusuario;	
			$du1->logado();

		} catch (Exception $e){

			echo $e->getMessage();

		} 

    }

?>
</div>

