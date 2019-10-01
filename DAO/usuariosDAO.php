<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	require_once $GLOBALS['models']. 'Usuarios.php';
	
	class DAOusuario extends Usuario{

		public function logado($n , $s){

			$this->setNome_usu($n);
			$this->setSenha_usu(base64_encode($s));

				$nome_usu = $this->getNome_usu();
				$senha_usu = $this->getSenha_usu();

				try{

					$sql = 'SELECT * FROM tbusuario WHERE nome_usu ="'.$nome_usu.'" AND senha_usu = "'.$senha_usu.'"';

					$v_sql = Conexao::getInstance()->prepare($sql);
					$v_sql->execute();
					$lis = $v_sql->fetch();

					if ($lis == null){

						echo '<script>alert("Usuário não existe!!!")</script>';
						return;

					}else{

                    	$cod_usu = $lis['cod_usu'];
                        $nivel = $lis['nivel_usu'];
                        
						session_start();
						
						$_SESSION['cod_usu'] = $cod_usu;
						$_SESSION['$nome'] = $this->getNome_usu();
                        $_SESSION['$nivel'] = $nivel;
                        
						header ('location:index.php?op=1');

					}

				}

			    catch(Exception $e){

					echo $e->getMessage();

				}


			unset($v_sql);

		}

		public function lanca_usu(){

			$this->setId_usu($_POST['id_usu']);
			$this->setNome_usu($_POST['nome_usu']);
		    $this->setSenha_usu(base64_encode($_POST['senha_usu']));
	 	    $this->setNivel_usu($_POST['nivel_usu']);

			if (empty($_POST['id_usu'])){
		       
				try {

				    $sql = 'INSERT INTO tbusuario ( nome_usu, senha_usu, nivel_usu ) VALUES ( :nome_usu, :senha_usu, :nivel_usu )';
		  
				    $p_sql = Conexao::getInstance()->prepare($sql);
				    $p_sql->bindValue(':nome_usu', $this->getNome_usu());
				    $p_sql->bindValue(':senha_usu', $this->getSenha_usu());
				    $p_sql->bindValue(':nivel_usu', $this->getNivel_usu());

				    $p_sql->execute();
					$this->lista_usu();

				} catch (PDOException $e) {

					echo $e->getMessage();

				}
				
				$ass = 'Novo usuário';
				$mess = 'Recebemos uma mensagem no sistema pjCELO <br/></br>
					<strong>Novo usuário foi lançado:</strong><br/>
					<strong>Nome do usuário:</strong>'.$_SESSION['$nome'].'<br/><hr/>
					<strong>Nome do novo usuário:</strong>'.$this->getNome_usu().'<br/>
					<strong>Nível do novo usuário:</strong>'.$this->getNivel_usu().'<br/>';
					
					require_once $classes. 'classes.php';
			
					$mail = new Mail;
					$mail->envia($ass, $mess);
			
				unset($p_sql);

			}else{

				echo '<script> alert("Este usuario ja existe, impossível inserir novamente."); </script>';
				return false;

			}

		}
		
		public function infoUsu(){
		
			$usuario = $_SESSION['$nome'];
			$sql = 'SELECT * FROM tbusuario';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$no_usu = $p_sql->rowCount();
				
				$_SESSION['$info_usu'] = $no_usu;
			
			} catch (PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($p_sql);
		
		}

		public function lista_usu(){

			try{			

				$sql = 'SELECT * FROM tbusuario ORDER BY cod_usu';

		        $res = Conexao::getInstance()->prepare($sql);
				$res->execute();
		        $lis = $res->fetchAll(PDO::FETCH_ASSOC);

				echo '<div class="menu_tab">
					<fieldset><legend>Lista de usuários</legend>
					<div class="tab_ctn">
					<table class="tabela">
					<th>Id</th>
					<th>Nome</th>
					<th>Senha</th>
					<th>Nível</th>
					<th>Ações</th>';
		
		        foreach ($lis as $l){

					$this->setId_usu($l['cod_usu']);
					$this->setNome_usu($l['nome_usu']);
					$this->setSenha_usu(base64_decode($l['senha_usu']));
					$this->setNivel_usu($l['nivel_usu']);
					
				
					echo '<tr><td>';
					echo $this->getId_usu();
					echo '<form method="post" action=""><input type="hidden" name="id_usu" value="';
					echo $this->getId_usu();
					echo '"/></td><td>';
					echo $this->getNome_usu();
					echo '<input type="hidden" name="n_usu" value="';
					echo $this->getNome_usu();
					echo '"/></td><td>';
					echo $this->getSenha_usu();
					echo '<input type="hidden" name="s_usu" value="';
					echo $this->getSenha_usu();
					echo '"/></td><td>';
					echo $this->getNivel_usu();
					echo '<input type="hidden" name="ni_usu" value="';
					echo $this->getNivel_usu();
					echo '"/></td><td class="tdinput"><input type="submit" name="sobe_altera_usu" value="Alterar" class="altera"/><input type="submit" name="exclui_usu" value="Excluir" class="exclui"/></form></td></tr>';

				}

					echo'</table>
						</div>
						</fieldset>
						</div>';

			} catch (PDOException $e){

				echo $e->getMessage();

			}

			unset ($res);

		}

		public function altera_usu(){

			$this->setId_usu($_POST['id_usu']);
			$this->setNome_usu($_POST['nome_usu']);
			$this->setSenha_usu(base64_encode($_POST['senha_usu']));
			$this->setNivel_usu($_POST['nivel_usu']);

			try{

				$sql = 'UPDATE tbusuario SET nome_usu = :nome_usu, senha_usu = :senha_usu, nivel_usu = :nivel_usu WHERE cod_usu = :cod_usu';

				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':nome_usu', $this->getNome_usu());
				$p_sql->bindValue(':senha_usu', $this->getSenha_usu());
				$p_sql->bindValue(':nivel_usu', $this->getNivel_usu());
				$p_sql->bindValue(':cod_usu', $this->getId_usu());

				$p_sql->execute();
				$this->lista_usu();

			}catch(PDOException $e){

				echo $e->getMesage();

			}

			unset ($p_sql);
		
		}
		
		public function exclui_usu(){
		
			if($_SESSION['$nivel'] < 100){
			
				echo '<script>alert("Sem privilégios para executar esta ação.");</script>';
				
				require_once $GLOBALS['views'] . 'menu_usuario.php';
				$this->lista_usu();
				return false;
			
			}else{
		
				$this->setId_usu($_POST['id_usu']);
		
			try{
			
				$sql = 'DELETE FROM tbusuario  WHERE cod_usu = :id_usu';
				
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':id_usu', $this->getId_usu());
				
				$p_sql->execute();
				$this->lista_usu();
			
			}catch(PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset($p_sql);
			
			}
		
		}

	}
