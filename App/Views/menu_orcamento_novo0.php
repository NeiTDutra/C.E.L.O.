

<fieldset class="f_fds"><legend>Produto</legend>
		
	<input type="hidden" 
	       name="cod_prod" 
	       value="<?php echo isset($_SESSION['id_prod']) ? $_SESSION['id_prod'] : null; ?>"
	       >
	
	<label for="desc_prod">Descrição:</label> 
	<input type="text" 
	       name="desc_prod" 
	       id="desc_prod" 
	       size="30" 
	       value="<?php echo isset($_SESSION['d_prod']) ? $_SESSION['d_prod'] : null; ?>"
	       >
		
	<input type="submit" name="p_prod" value="...">
	
	<label for="tam_prod">Tam.:</label> 
	<select name="tam_prod" id="tam_prod">
	
		<option value="<?php echo isset($_SESSION['t_prod']) ? $_SESSION['t_prod'] : null; ?>">
		        <?php echo isset($_SESSION['t_prod']) ? $_SESSION['t_prod'] : null; ?></option>
		<option value="GG">GG</option>
		<option value="G">G</option>
		<option value="M">M</option>
		<option value="P">P</option>
		
	</select>
	
	<label for="cor_prod">Cor:</label> 
	<input type="text" 
	       name="cor_prod" 
	       id="cor_prod" 
	       size="10" 
	       maxlength="13" 
	       value="<?php echo isset($_SESSION['c_prod']) ? $_SESSION['c_prod'] : null; ?>"
	       >
	
	<label for="quan_prod">Quant.:</label> 
	<input type="text" 
	       name="quan_prod" 
	       id="quan_prod" 
	       size="6" 
	       maxlength="5" 
	       value="<?php $q_prod = isset($_SESSION['q_prod']) ? $_SESSION['q_prod'] : null; echo $q_prod; ?>"
	       >
	
		<br>
		<br>
		
	<label for="valu_prod">V. unit. R$:</label> 
	<input type="text" 
	       name="valu_prod" 
	       id="valu_prod" 
	       size="6" 
	       value="<?php $v_prod = isset($_SESSION['v_prod']) ? $_SESSION['v_prod'] : null; echo $v_prod; ?>"
	       >
	
	<label for="valt_prod">V. total. R$:</label> 
	<input type="text" 
	       name="valt_prod" 
	       id="valt_prod" 
	       size="6" 
	       value="<?php echo floatval(str_replace(',', '.', $v_prod)) * floatval($q_prod); ?>"
	       >
	
	<input type="submit" name="adc_prod" value="Adicionar">
            	
</fieldset>
