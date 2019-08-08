
	<div class="menu">
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Menu de cliente</legend>
			<input type=submit name=listar_cli value=Listar>
			<input type=submit name=lancar_cli value=Lançar>
			<input type=submit name=alterar_cli value=Alterar>
			<input type=submit name=volta_menu value=Início>
			<br>
			<br>
			<input type="hidden" name="id_cli" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['id_cli'] : null; ?>">
			Nome: <input type="text" name="nome_cli" size="20" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['n_cli'] : null; ?>">
			Fone: <input type="text" name="fone_cli" onKeyUp="mascara(this, '## #####-####');" maxlength= "13" title="Formato: 00 00000-0000" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['f_cli'] : null; ?>">
			Email: <input type="email" name="email_cli" title="Formato: abc123@ab12.abc" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['e_cli'] : null; ?>">
		</fieldset>
		</form>
	</div>

	
