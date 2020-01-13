
	<div class="menu">
	
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
		
			<fieldset><legend>Menu de orçamento</legend>
			
				<input type="submit" name="novo_orc" value="Novo" class="lanca">
				<input type="submit" name="listar_orc" value="Todos" class="lista">
				<input type="submit" name="lancar_orc" value="Lançar" class="lanca">
				<input type="submit" name="alterar_orc" value="Alterar" class="altera">
				<input type="submit" name="volta_menu" value="Início" class="lista">
				<?php  echo isset($_POST['sobe_ver_orc']) ? '<input type="button" onClick="up_impress()" value="Gerar PDF" class="altera">' : null; ?>
				<br>
				<br>
		                    
			<fieldset class="f_fds"><legend>Operador</legend>
		        
				<input type="hidden" name="id_usu" value="<?php echo isset($_SESSION['cod_usu']) ? $_SESSION['cod_usu'] : null; ?>">
				
				<label for="nome_usu">Usuário:</label> 
				<input type="text" name="nome_usu" id="nome_usu" size="20" value="<?php echo $_SESSION['$nome']; ?>">
				
		        <label for="nivel_usu">Nível:</label> 
		        <input type="text" name="nivel_usu" id="nivel_usu" size="4" value="<?php echo $_SESSION['$nivel']; ?>">
		        
			</fieldset>
                        
<?php 
                        
	if (isset($_POST['novo_orc']) || isset($_POST['sobe_altera_cli']) || isset($_POST['p_cli']) || isset($_POST['p_prod']) || isset($_SESSION['n_orc'])){
                            
		require_once 'menu_orcamento_novo.php';
        isset($_SESSION['n_orc']) ? require_once 'menu_orcamento_novo0.php' : null;
                            
    } else {
                                
        $_SESSION['n_orc'] = NULL;
        unset($_SESSION['n_orc']);
                                
	}
                
?>
			</fieldset>
		
		</form>
		
	</div>

	


