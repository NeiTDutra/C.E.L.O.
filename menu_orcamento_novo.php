
	<br>
	<br>
	
	<input type="hidden" name="id_cli" value="<?php echo isset($_SESSION['cod_cli']) ? $_SESSION['cod_cli'] : null; ?>">
	
	Cliente: <input type="text" name="nome_cli" size="20" value="<?php echo isset($_SESSION['n_cli']) ? $_SESSION['n_cli'] : null; ?>">
	
	<input type="submit" name="p_cli" value="*">
	
	Fone: <input type="text" name="fone_cli" size="13" onKeyUp="mascara(this, '## #####-####');" maxlength= "13" title="Formato: 00 00000-0000" value="<?php echo isset($_SESSION['f_cli']) ? $_SESSION['f_cli'] : null; ?>">
	
		<br>
		    <hr>
		<br>
		
	<input type="hidden" name="cod_prod" value="<?php echo isset($_SESSION['id_prod']) ? $_SESSION['id_prod'] : null; ?>"/>
	
		Descrição: <input type="text" name="desc_prod" size="30" value="<?php echo isset($_SESSION['d_prod']) ? $_SESSION['d_prod'] : null; ?>">
		
	<input type="submit" name="p_prod" value="*">
	
	Tam.: <select name="tam_prod">
	
		<option value="<?php echo isset($_SESSION['t_prod']) ? $_SESSION['t_prod'] : null; ?>"><?php echo isset($_SESSION['t_prod']) ? $_SESSION['t_prod'] : null; ?></option>
		<option value="GG">GG</option>
		<option value="G">G</option>
		<option value="M">M</option>
		<option value="P">P</option>
		
	</select>
	
	Cor: <input type="text" name="cor_prod" size="10" maxlength="13" value="<?php echo isset($_SESSION['c_prod']) ? $_SESSION['c_prod'] : null; ?>">
	
	Quant.: <input type="text" name="quan_prod" size="6" maxlength="5" value="<?php echo isset($_SESSION['q_prod']) ? $_SESSION['q_prod'] : null; ?>">
	
		<br>
		<br>
		
	V. unit. R$: <input type="text" name="valu_prod" size="6" value="<?php echo isset($_SESSION['v_prod']) ? $_SESSION['v_prod'] : null; ?>">
	
	V. total. R$: <input type="text" name="valt_prod" size="6" value="<?php echo floatval(str_replace(',', '.', $_SESSION['v_prod'])) * floatval($_SESSION['q_prod']); ?>">
	
	<input type="submit" name="adc_prod" value="+">
	
