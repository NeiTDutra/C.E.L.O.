
	<div class="menu">
		<form action="<?php echo $_SERVER ['PHP_SELF'] ?>" method="post">
    	<fieldset><legend>Menu de orçamento</legend>
			<input type=submit name=novo_orc value=Novo>
			<input type=submit name=listar_orc value=Listar>
			<input type=submit name=lancar_orc value=Lançar>
			<input type=submit name=alterar_orc value=Alterar>
			<input type=submit name=volta_menu value=Início>
			<br>
			<br>
                        Nº: <input type="text" name="id_orc" size="8" value="<?php echo isset($_SESSION['n_orc']) ? $_SESSION['n_orc'] : NULL; ?>">
			Usuário: <input type="text" name="nome_usu" size="20" value="<?php echo $_SESSION['$nome']; ?>">
                        Nível: <input type="text" name="nivel_usu" size="4" value="<?php echo $_SESSION['$nivel']; ?>">
                        
                        <?php 
                        
                            if (isset($_POST['novo_orc']) || isset($_POST['sobe_altera_cli'])){
                            
                                include_once('menu_orcamento_novo.php');
                            
                            } else {
                                
                                $_SESSION['n_orc'] = NULL;
                                unset($_SESSION['n_orc']);
                                
                            }
                        ?>
		</fieldset>
		</form>
	</div>

	


