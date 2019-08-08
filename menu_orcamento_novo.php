

Cliente: <input type="text" name="nome_cli" size="20" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['n_cli'] : null; ?>">
<input type="submit" name="p_cli" value="*"/>
Fone: <input type="text" name="fone_cli" size="15" onKeyUp="mascara(this, '## #####-####');" maxlength= "13" title="Formato: 00 00000-0000" value="<?php echo isset($_POST['sobe_altera_cli']) ? $_POST['f_cli'] : null; ?>">
	<br>
        <hr>
	<br>
        <input type="hidden" name="cod_prod" value=""/>
	Descrição: <input type="text" name="desc_prod" size="30">
        <input type="submit" name="p_prod" value="*"/>
	Tam.: <select name="tam_prod">
	<option value="GG">GG</option>
	<option value="G">G</option>
	<option value="M">M</option>
	<option value="P">P</option>
	</select>
	Cor: <input type="text" name="cor_prod" size="10" maxlength="13">
	Quant.: <input type="text" name="quan_prod" size="6" maxlength="5">
	<br>
	<br>
	V. unit. R$: <input type="text" name="valu_prod" size="6">
	V. total. R$: <input type="text" name="valt_prod" size="6">
        <input type="submit" name="adc_prod" value="+"/>
