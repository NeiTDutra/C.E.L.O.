
		
	<div class="menu">
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Menu Usuário</legend>
			<input type=submit name=listar_usu value=Listar>
			<input type=submit name=lancar_usu value=Lançar>
			<input type=submit name=alterar_usu value=Alterar>
			<input type=submit name=volta_menu value=Início>
			<br>
			<br>
			<input type="hidden" name="id_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['id_usu'] : null; ?>">
			Nome: <input type="text" name="nome_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['n_usu'] : null; ?>">
			Senha: <input type="text" name="senha_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['s_usu'] : null; ?>">
			Nível: <input type="text" name="nivel_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['ni_usu'] : null; ?>">
		</fieldset>
		</form>
	</div>
	

