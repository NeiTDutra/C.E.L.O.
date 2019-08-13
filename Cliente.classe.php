<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

	if (!isset($_SESSION['n_orc'])){
	
		require_once 'menu_cliente.php';
		
	}
	
	include_once('classes.php');

	class Cliente{

		private $id_cli;
		private $nome_cli;
		private $fone_cli;
		private $email_cli;

		public function getId_cli(){

		    return $this->id_cli;

		}

		public function setId_cli($id_cli){

		    return $this->id_cli = $id_cli;

		}    

		public function getNome_cli(){

		    return $this->nome_cli;

		}

		public function setNome_cli($nome_cli){

		    return $this->nome_cli = $nome_cli;

		}    

		public function getFone_cli(){

		    return $this->fone_cli;

		}

		public function setFone_cli($fone_cli){

		    return $this->fone_cli = $fone_cli;

		}    

		public function getEmail_cli(){

		    return $this->email_cli;

		}

		public function setEmail_cli($email_cli){

		    return $this->email_cli = $email_cli;

		}

	}

    class DAOcliente{

		public function lanca_cli(){

			$lan_cli = new Cliente;
			$lan_cli->setId_cli($_POST['id_cli']);
			$lan_cli->setNome_cli($_POST['nome_cli']);
			$lan_cli->setFone_cli($_POST['fone_cli']);
			$lan_cli->setEmail_cli($_POST['email_cli']);
			
			if (empty($_POST['id_cli'])){

				try{

					$sql = 'INSERT INTO tbcliente ( nome_cli, fone_cli, email_cli ) VALUES ( :nome_cli, :fone_cli, :email_cli )';

					$p1_sql = Conexao::getInstance()->prepare($sql);

					$p1_sql->bindValue(':nome_cli', $lan_cli->getNome_cli());
					$p1_sql->bindValue(':fone_cli', $lan_cli->getFone_cli());
					$p1_sql->bindValue(':email_cli', $lan_cli->getEmail_cli());

					$p1_sql->execute();
					$this->lista_cli();

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
					<th>Email</th>';
							
	  
		        foreach ($lis as $l){

					$lis_cli = new Cliente;
					$lis_cli->setId_cli($l['cod_cli']);
					$lis_cli->setNome_cli($l['nome_cli']);
					$lis_cli->setFone_cli($l['fone_cli']);
					$lis_cli->setEmail_cli($l['email_cli']);
					
				
					echo '<tr><td>';
					echo $lis_cli->getId_cli();
					echo '<form method="post" action=""><input type="hidden" name="id_cli" value="';
					echo $lis_cli->getId_cli();
					echo '"/></td><td>';
					echo $lis_cli->getNome_cli();
					echo '<input type="hidden" name="n_cli" value="';
					echo $lis_cli->getNome_cli();
					echo '"/></td><td>';
					echo $lis_cli->getFone_cli();
					echo '<input type="hidden" name="f_cli" value="';
					echo $lis_cli->getFone_cli();
					echo '"/></td><td>';
					echo $lis_cli->getEmail_cli();
					echo '<input type="hidden" name="e_cli" value="';
					echo $lis_cli->getEmail_cli();
					echo '"/></td><td><input type="submit" name="sobe_altera_cli" value="!!"/></form></td></tr>';

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

			$a_cli = new Cliente;
			$a_cli->setId_cli($_POST['id_cli']);
			$a_cli->setNome_cli($_POST['nome_cli']);
			$a_cli->setFone_cli($_POST['fone_cli']);
			$a_cli->setEmail_cli($_POST['email_cli']);
			
			try{
			
				$sql = 'UPDATE tbcliente SET nome_cli = :nome_cli, fone_cli = :fone_cli, email_cli = :email_cli WHERE cod_cli = :cod_cli';
				
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':nome_cli', $a_cli->getNome_cli());
				$p_sql->bindValue(':fone_cli', $a_cli->getFone_cli());
				$p_sql->bindValue(':email_cli', $a_cli->getEmail_cli());
				$p_sql->bindValue(':cod_cli', $a_cli->getId_cli());
				$p_sql->execute();
				$this->lista_cli();
			
			}catch(PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($a_cli);
			unset ($p_sql);
		}

    }
