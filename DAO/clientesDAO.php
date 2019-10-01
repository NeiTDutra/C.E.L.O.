<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	require_once $GLOBALS['models']. 'Clientes.php';

	class DAOcliente extends Cliente{

		public function lanca_cli(){

			$this->setId_cli($_POST['id_cli']);
			$this->setNome_cli($_POST['nome_cli']);
			$this->setFone_cli($_POST['fone_cli']);
			$this->setEmail_cli($_POST['email_cli']);
			
			if (empty($_POST['id_cli'])){

				try{

					$sql = 'INSERT INTO tbcliente ( nome_cli, fone_cli, email_cli ) VALUES ( :nome_cli, :fone_cli, :email_cli )';

					$p1_sql = Conexao::getInstance()->prepare($sql);

					$p1_sql->bindValue(':nome_cli', $this->getNome_cli());
					$p1_sql->bindValue(':fone_cli', $this->getFone_cli());
					$p1_sql->bindValue(':email_cli', $this->getEmail_cli());

					$p1_sql->execute();
					$this->lista_cli('nada');

				} catch (PDOException $e){

					echo '<p>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</p>';
					echo $e->getMessage();

				}

			unset($lan_cli);
			unset($p_sql);
		
			}else{
		
				echo '<script> alert("Este cliente ja existe, impossível inserir novamente."); </script>';
				return false;
		
			}

		}
		
		public function infoCli(){
		
			$usuario = $_SESSION['cod_usu'];
			$sql = 'SELECT * FROM tbcliente';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$no_cli = $p_sql->rowCount();
				
				$_SESSION['$info_cli'] = $no_cli;
			
			} catch (PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($p_sql);
		
		}

		public function lista_cli($p){
		
			if ($p != 'nada'){
				
				$sql = 'SELECT * FROM tbcliente WHERE nome_cli LIKE "'.$p.'%" ORDER BY nome_cli ASC';
				
			}else{
			
				$sql = 'SELECT * FROM tbcliente ORDER BY cod_cli';
				
			}

			try{

		        $res = Conexao::getInstance()->prepare($sql);
				$res->execute();
		        $lis = $res->fetchAll(PDO::FETCH_ASSOC);

				echo '<div class="menu_tab">
					<fieldset><legend>Lista de clientes</legend>
					<div class="tab_ctn">
					<table class="tabela">
					<th class="idt">Cod.</th>
					<th>Nome</th>
					<th>Fone</th>
					<th>Email</th>
					<th>Ações</th>';
							
	  
		        foreach ($lis as $l){

					$this->setId_cli($l['cod_cli']);
					$this->setNome_cli($l['nome_cli']);
					$this->setFone_cli($l['fone_cli']);
					$this->setEmail_cli($l['email_cli']);
					
				
					echo '<tr><td>';
					echo $this->getId_cli();
					echo '<form method="post" action=""><input type="hidden" name="id_cli" value="';
					echo $this->getId_cli();
					echo '"/></td><td>';
					echo $this->getNome_cli();
					echo '<input type="hidden" name="n_cli" value="';
					echo $this->getNome_cli();
					echo '"/></td><td>';
					echo $this->getFone_cli();
					echo '<input type="hidden" name="f_cli" value="';
					echo $this->getFone_cli();
					echo '"/></td><td>';
					echo $this->getEmail_cli();
					echo '<input type="hidden" name="e_cli" value="';
					echo $this->getEmail_cli();
					echo '"/></td><td class="tdinput"><input type="submit" name="sobe_altera_cli" value="Alterar" class="altera"/><input type="submit" name="exclui_cli" value="Excluir" class="exclui"/></form></td></tr>';

				}

					echo'</table>
						</div>
						</fieldset>
						</div>';
	  

			} catch (PDOException $e){

				echo '<p>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</p>';
				echo $e->getMessage();

			}

			unset ($lis_cli);
			unset ($res);

		

		}

		public function altera_cli(){

			$this->setId_cli($_POST['id_cli']);
			$this->setNome_cli($_POST['nome_cli']);
			$this->setFone_cli($_POST['fone_cli']);
			$this->setEmail_cli($_POST['email_cli']);
			
			try{
			
				$sql = 'UPDATE tbcliente SET nome_cli = :nome_cli, fone_cli = :fone_cli, email_cli = :email_cli WHERE cod_cli = :cod_cli';
				
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':nome_cli', $this->getNome_cli());
				$p_sql->bindValue(':fone_cli', $this->getFone_cli());
				$p_sql->bindValue(':email_cli', $this->getEmail_cli());
				$p_sql->bindValue(':cod_cli', $this->getId_cli());
				$p_sql->execute();
				$this->lista_cli('nada');
			
			}catch(PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($a_cli);
			unset ($p_sql);
		}
                
                public function exclui_cli(){
                    
                    $ex_cli = new Cliente();
                    $ex_cli->setId_cli($_POST['id_cli']);
                    
                    try {
                    
                        $sql = 'DELETE FROM tbcliente WHERE cod_cli = :id_cli';
                        
                        $p_sql = Conexao::getInstance()->prepare($sql);
                        $p_sql->bindValue(':id_cli', $ex_cli->getId_cli());
                        $p_sql->execute();
                        
                        $this->lista_cli('nada');
                        
                    } catch (Exception $ex) {
                        
                        echo $ex->getMessage();
                        
                    }
                    
                    unset($p_sql);
                    unset($ex_cli);
                    
                }

    }
