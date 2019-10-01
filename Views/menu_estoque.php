
	<div class="menu">
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Menu de estoque</legend>
			<input type="submit" name="listar_est" value="Listar" class="lista">
			<input type="submit" name="lancar_est" value="Lançar" class="lanca">
			<input type="submit" name="alterar_est" value="Alterar" class="altera">
			<input type="submit" name="volta_menu" value="Início" class="lista">
			<br>
			<br>
			<input type="hidden" name="id_prod" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['id_prod'] : null; ?>">
			<label for="desc_prod">Descrição:</label> 
			<input type="text" name="desc_prod" id="desc_prod" size="30" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['d_prod'] : null; ?>">
			<input type="submit" name="p_prod" value="...">
			<label for="tam_prod">Tam.:</label> 
			<select name="tam_prod" id="tam_prod">
			 <option value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['t_prod'] : null; ?>"><?php echo isset($_POST['sobe_altera_prod']) ? $_POST['t_prod'] : null; ?></option>
			<option value="GG">GG</option>
			<option value="G">G</option>
			<option value="M">M</option>
			<option value="P">P</option>
			</select>
			<label for="cor_prod">Cor:</label> 
			<input type="text" name="cor_prod" id="cor_prod" size="10" maxlength="13" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['c_prod'] : null; ?>">
			<br>
			<br>
			<label for="quan_prod">Quant.:</label> 
			<input type="text" name="quan_prod" id="quan_prod" size="6" maxlength="5" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['q_prod'] : null; ?>">
			<label forl="val_prod">Valor R$:</label> 
			<input type="text" name="val_prod" id="val_prod" onKeyUp="k(this);" value="<?php echo isset($_POST['sobe_altera_prod']) ? $_POST['v_prod'] : null; ?>">
		</fieldset>
		</form>
	</div>

