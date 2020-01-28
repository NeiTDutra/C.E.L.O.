
	<div class="menu">
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Menu de cliente</legend>
			<input type="submit" name="listar_cli" value="Listar" class="lista">
			<input type="submit" name="lancar_cli" value="Lançar" class="lanca">
			<input type="submit" name="alterar_cli" value="Alterar" class="altera">
			<input type="submit" name="volta_menu" value="Início" class="lista">
			<br>
			<br>
			<input type="hidden" name="id_cli" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['id_cli'] : null; ?>">
			<label for="nome_cli">Nome:</label> 
			<input type="text" name="nome_cli" id="nome_cli" size="20" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['n_cli'] : null; ?>">
			<input type="submit" name="p_cli" value="...">
			<label for="fone_cli">Fone:</label> 
			<input type="text" name="fone_cli" id="fone_cli" onKeyUp="mascara(this, '## #####-####');" maxlength= "13" title="Formato: 00 00000-0000" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['f_cli'] : null; ?>">
			<label for="email_cli">Email:</label> 
			<input type="email" name="email_cli" id="email_cli" title="Formato: abc123@ab12.abc" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['e_cli'] : null; ?>">
		</fieldset>
		</form>
	</div>

	
