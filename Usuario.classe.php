
<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
        
    require_once ('menu_usuario.php');

	include_once('classes.php');

	class Usuario{
	  
		private $id_usu;
		private $nome_usu;
		private $nivel_usu;
		private $senha_usu;

  
		public function getId_usu() {

		    return $this->id_usu;
		}
	  
		public function setId_usu($id_usu) {

		    $this->id_usu = $id_usu;
		}
	  
		public function getNome_usu() {

		    return $this->nome_usu;
		}
	  
		public function setNome_usu($nome_usu) {

		    $this->nome_usu = $nome_usu;
		}
	  
		public function getNivel_usu() {

		    return $this->nivel_usu;
		}
	  
		public function setNivel_usu($nivel_usu) {

		    $this->nivel_usu = $nivel_usu;
		}
	  
		public function getSenha_usu() {

		    return $this->senha_usu;
		}
	  
		public function setSenha_usu($senha_usu) {

		    $this->senha_usu = $senha_usu;
		}
	  
	}

    class DAOusuario{

		public function logado(){

			$u1 = new Usuario;
			$u1->setNome_usu($_POST['nome']);
			$u1->setSenha_usu($_POST['senha']);


			/*if ($u1->getNome_usu() == '' || $u1->getSenha_usu() == ''){

	  			echo '<p style="color:red;">Falta usuário ou senha!!!</p>';

			}else{*/

				$nome_usu = $u1->getNome_usu();
				$senha_usu = $u1->getSenha_usu();

				try{

					$sql = 'SELECT * FROM tbusuario WHERE nome_usu = "'.$nome_usu.'" AND senha_usu = "'.$senha_usu.'"';

					$v_sql = Conexao::getInstance()->prepare($sql);
					$v_sql->execute();
					$lis = $v_sql->fetchAll(PDO::FETCH_ASSOC);
                                        
                    foreach ($lis as $l){
                                            
                    	$cod_usu = $l['cod_usu'];
                        $nivel = $l['nivel_usu'];
                                            
                    }

					if ($lis == null){

						echo '<p style="color:red;">Usuário não existe!!!</p>';

					}else{

						session_start();
						
						$_SESSION['cod_usu'] = $cod_usu;
						$_SESSION['$nome'] = $u1->getNome_usu();
                        $_SESSION['$nivel'] = $nivel;
                        
						header ('location:index.php?op=1');

					}

				}

			    catch(Exception $e){

					echo $e->getMessage();

				}

			//}

			unset($u1);
			unset($v_sql);

		}

		public function lanca_usu(){

			$lan_usu = new Usuario;
			$lan_usu->setId_usu($_POST['id_usu']);
			$lan_usu->setNome_usu($_POST['nome_usu']);
		    $lan_usu->setSenha_usu($_POST['senha_usu']);
	 	    $lan_usu->setNivel_usu($_POST['nivel_usu']);

			if (empty($_POST['id_usu'])){
		       
				try {

				    $sql = 'INSERT INTO tbusuario ( nome_usu, senha_usu, nivel_usu ) VALUES ( :nome_usu, :senha_usu, :nivel_usu )';
		  
				    $p_sql = Conexao::getInstance()->prepare($sql);
				    $p_sql->bindValue(':nome_usu', $lan_usu->getNome_usu());
				    $p_sql->bindValue(':senha_usu', $lan_usu->getSenha_usu());
				    $p_sql->bindValue(':nivel_usu', $lan_usu->getNivel_usu());

				    $p_sql->execute();
					$this->lista_usu();

				} catch (PDOException $e) {

				    echo '<p>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</p>';
					echo $e->getMessage();

				}
				
				//require_once 'classes.php';
				//$mail = new Mail;
				//$mail->enviar();
				//unset($mail);
			
				unset($lan_usu);
				unset($p_sql);

			}else{

				echo '<script> alert("Este usuario ja existe, impossível inserir novamente."); </script>';
				return false;

			}

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
					<th>Nível</th>';
							
	  
		        foreach ($lis as $l){

					$u2 = new Usuario;
					$u2->setId_usu($l['cod_usu']);
					$u2->setNome_usu($l['nome_usu']);
					$u2->setSenha_usu($l['senha_usu']);
					$u2->setNivel_usu($l['nivel_usu']);
					
				
					echo '<tr><td>';
					echo $u2->getId_usu();
					echo '<form method="post" action=""><input type="hidden" name="id_usu" value="';
					echo $u2->getId_usu();
					echo '"/></td><td>';
					echo $u2->getNome_usu();
					echo '<input type="hidden" name="n_usu" value="';
					echo $u2->getNome_usu();
					echo '"/></td><td>';
					echo $u2->getSenha_usu();
					echo '<input type="hidden" name="s_usu" value="';
					echo $u2->getSenha_usu();
					echo '"/></td><td>';
					echo $u2->getNivel_usu();
					echo '<input type="hidden" name="ni_usu" value="';
					echo $u2->getNivel_usu();
					echo '"/></td><td><input type="submit" name="sobe_altera_usu" value="?"/></form></td></tr>';

				}

					echo'</table>
						</div>
						</fieldset>
						</div>';
	  

			} catch (PDOException $e){

				echo '<p>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</p>';
				echo $e->getMessage();

			}

			unset ($u2);
			unset ($res);

		}

		public function altera_usu(){

			$a_usu = new Usuario;
			$a_usu->setId_usu($_POST['id_usu']);
			$a_usu->setNome_usu($_POST['nome_usu']);
			$a_usu->setSenha_usu($_POST['senha_usu']);
			$a_usu->setNivel_usu($_POST['nivel_usu']);

			try{

				$sql = 'UPDATE tbusuario SET nome_usu = :nome_usu, senha_usu = :senha_usu, nivel_usu = :nivel_usu WHERE cod_usu = :cod_usu';

				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':nome_usu', $a_usu->getNome_usu());
				$p_sql->bindValue(':senha_usu', $a_usu->getSenha_usu());
				$p_sql->bindValue(':nivel_usu', $a_usu->getNivel_usu());
				$p_sql->bindValue(':cod_usu', $a_usu->getId_usu());

				$p_sql->execute();
				$this->lista_usu();

			}catch(PDOException $e){

				echo $e->getMesage();

			}

			unset ($a_usu);
			unset ($p_sql);
		
		}

	}
