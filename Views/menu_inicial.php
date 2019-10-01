
		
	<div class="menu">
	
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
		
		    <fieldset><legend>Menu Inicial</legend>
		    
				<input type="submit" name="menu_orcamento" value="Orçamentos" class="lista">
				<input type="submit" name="menu_cliente" value="Clientes" class="lista">
				<input type="submit" name="menu_estoque" value="Estoque" class="lista">
				<input type="submit" name="menu_usuario" value="Usuários" class="lista">
				
			</fieldset>
			<br/>
			<fieldset><legend>Informações do Sistema</legend>
			
				<input type="hidden" name="info">
				
				<input type="submit" name="atualiza_info" value="Atualizar informações" class="lista"><br/><br/>
				
				<label for="cont_orc">Nº de Orçamentos:</label>
				<input style="color: black;" type="text" id="cont_orc" disabled="disabled" value="<?php echo isset($_SESSION['$info_orc']) ? $_SESSION['$info_orc'] : 'Atualize informações'; ?>">
				
				<label for="cont_cli">Nº de Clientes:</label>
				<input style="color: black;" type="text" id="cont_cli" disabled="disabled" value="<?php echo isset($_SESSION['$info_cli']) ? $_SESSION['$info_cli'] : 'Atualize informações'; ?>">
				
				<label for="cont_usu">Nº de Usuários:</label>
				<input style="color: black;" type="text" id="cont_usu" disabled="disabled" value="<?php echo isset($_SESSION['$info_usu']) ? $_SESSION['$info_usu'] : 'Atualize informações'; ?>">
				
			</fieldset>
			<br/>
			<fieldset><legend>Informações dos Produtos</legend>
			
				<label for="cont_pro">Nº de produtos:</label>
				<input style="color: black;" type="text" id="cont_pro" disabled="disabled" value="<?php echo isset($_SESSION['$info_pro']) ? $_SESSION['$info_pro'] : 'Atualize informações'; ?>">
				
				<label for="cont_pro">Quant. crítica:</label>
				<input style="color: black;" type="text" id="cont_pro_neg" disabled="disabled" value="<?php echo isset($_SESSION['$info_pro_neg']) ? $_SESSION['$info_pro_neg'] : 'Atualize informações'; ?>">
				
				<input type="submit" name="situa_prod" id="<?php echo isset($_SESSION['sit']) ? $_SESSION['sit'] : 'sit_verde'; ?>" value="<?php echo isset($_SESSION['situa_prod']) ? $_SESSION['situa_prod'] : 'Normal'; ?>">
				
			</fieldset>
		
		</form>
		
	</div>



