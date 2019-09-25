
		
	<div class="menu">
	
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
		
    	<fieldset><legend>Menu Usuário</legend>
    	
			<input type="submit" name="listar_usu" value="Listar" class="lista">
			<input type="submit" name="lancar_usu" value="Lançar" class="lanca">
			<input type="submit" name="alterar_usu" value="Alterar" class="altera">
			<input type="submit" name="volta_menu" value="Início" class="lista">
			
			<br>
			<br>
			
			<input type="hidden" name="id_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['id_usu'] : null; ?>">
			
			<label for="nome_usu">Nome:</label> 
			<input type="text" name="nome_usu" id="nome_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['n_usu'] : null; ?>">
			
			<label for="senha_usu">Senha:</label> 
			<input type="text" name="senha_usu" id="senha_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['s_usu'] : null; ?>">
			
			<label for="nivel_usu">Nível:</label> 
			<input type="text" name="nivel_usu" id="nivel_usu" value="<?php echo isset($_POST['sobe_altera_usu']) ? $_POST['ni_usu'] : null; ?>">
			
		</fieldset>
		
		</form>
		
	</div>
	

