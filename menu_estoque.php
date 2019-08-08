
	<div class="menu">
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Menu de estoque</legend>
			<input type=submit name=listar_est value=Listar>
			<input type=submit name=lancar_est value=Lançar>
			<input type=submit name=alterar_est value=Alterar>
			<input type=submit name=volta_menu value=Início>
			<br>
			<br>
			<input type="hidden" name="id_prod" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['id_prod'] : null; ?>">
			Descrição: <input type="text" name="desc_prod" size="30" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['d_prod'] : null; ?>">
			Tam.: <select name="tam_prod">
			 <option value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['t_prod'] : null; ?>"><?php echo isset($_POST['sobe_altera_prod']) ? $_POST['t_prod'] : null; ?></option>
			<option value="GG">GG</option>
			<option value="G">G</option>
			<option value="M">M</option>
			<option value="P">P</option>
			</select>
			Cor: <input type="text" name="cor_prod" size="10" maxlength="13" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['c_prod'] : null; ?>">
			<br>
			<br>
			Quant.: <input type="text" name="quan_prod" size="6" maxlength="5" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['q_prod'] : null; ?>">
			Valor R$: <input type="text" name="val_prod" onKeyUp="k(this);" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['v_prod'] : null; ?>">
		</fieldset>
		</form>
	</div>

