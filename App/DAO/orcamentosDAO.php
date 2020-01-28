<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	require_once $GLOBALS['models']. 'Orcamentos.php';

	class DAOorcamento extends Orcamento{

		public function lanca_orc(){
		
			function testa_redund(){
			
				$n_orc = isset($_SESSION['n_orc']) ? $_SESSION['n_orc'] : null;
				
				if($n_orc != null){
				
					$sql = 'SELECT cod_orc FROM tborcamento';
					
					try{
					
						$p_sql = Conexao::getInstance()->prepare($sql);
						$p_sql->execute();
						$res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
						
						foreach($res as $ar){
						
							if($ar['cod_orc'] == $n_orc){
							
								return true;
							
							}
						
						}
					
					}catch(PDOException $ex){
					
						echo $ex->getMessage();
					
					}
					
					unset ($p_sql);
				
				}
			
			}
			if(testa_redund() == true){
			
				echo '<script>alert("Já existe um orçamento com este código identificador.");</script>';
				return false;
				
				$this->lista_orc();
			
			}else if (empty($_POST['id_usu']) || empty($_POST['nome_usu']) || empty($_POST['id_cli']) || empty($_POST['nome_cli']) || empty($_POST['fone_cli'])){
			
				echo '<script>alert("Selecione os dados do cliente.");</script>';
				return false;
				
			}else{

                    $this->setId_usu_orc($_POST['id_usu']);
                    $this->setNome_usu_orc($_POST['nome_usu']);
                    $this->setId_cli_orc($_POST['id_cli']);
                    $this->setNome_cli_orc($_POST['nome_cli']);
                    $this->setFone_cli_orc($_POST['fone_cli']);
                    
                    try{
                        
                        $sql = 'INSERT INTO tborcamento (cod_usu_orc, nome_usu_orc, cod_cli_orc, nome_cli_orc, fone_cli_orc) VALUES (:cod_usu_orc, :nome_usu_orc, :cod_cli_orc, :nome_cli_orc, :fone_cli_orc)';
                        
                        $p_sql = Conexao::getInstance()->prepare($sql);
                        $p_sql->bindValue(':cod_usu_orc', $this->getId_usu_orc());
                        $p_sql->bindValue(':nome_usu_orc', $this->getNome_usu_orc());
                        $p_sql->bindValue(':cod_cli_orc', $this->getId_cli_orc());
                        $p_sql->bindValue(':nome_cli_orc', $this->getNome_cli_orc());
                        $p_sql->bindValue(':fone_cli_orc', $this->getFone_cli_orc());
                        
                        $p_sql->execute();
                        
                        return $this->lista_orc();
                        
                    } catch (PDOException $e) {
                        
						echo $e->getMessage();

                    }catch (SQLException $ex) {
                    
                    	echo $ex->getMessage();
                    
                    }
                    unset($p_sql);
            }
                
        }
                
                public function lanca_orc_prod(){
                    
                    $cod_orc = $_POST['id_orc'];
                    $id_prod = $_POST['cod_prod'];
                    $desc_prod = $_POST['desc_prod'];
                    $tam_prod = $_POST['tam_prod'];
                    $cor_prod = $_POST['cor_prod'];
                    $quan_prod = $_POST['quan_prod'];
                    $val_prod = $this->valor_e($_POST['valu_prod']);
                    
                    try {
                        
                        $sql = 'INSERT INTO tborcamento_i (cod_orc, id_prod, desc_prod, tam_prod, cor_prod, quant_prod, valor_prod) VALUES (:cod_orc, :id_prod, :desc_prod, :tam_prod, :cor_prod, :quan_prod, :val_prod)';
                        
                        $p_sql = Conexao::getInstance()->prepare($sql);
                        $p_sql->bindValue(':cod_orc', $cod_orc);
                        $p_sql->bindValue(':id_prod', $id_prod);
                        $p_sql->bindValue(':desc_prod', $desc_prod);
                        $p_sql->bindValue(':tam_prod', $tam_prod);
                        $p_sql->bindValue(':cor_prod', $cor_prod);
                        $p_sql->bindValue(':quan_prod', $quan_prod);
                        $p_sql->bindValue(':val_prod', $val_prod);
                        
                        $p_sql->execute();
                        
                        return $this->rtn_info_orc();
                        
                    } catch (Exception $e) {
                        
						echo $e->getMessage();
                        
                    }
                    unset($p_sql);
                    unset($_POST);
		}

		public function valor_e($valor) {

		   $verificaPonto = ".";

		   if(strpos("[".$valor."]", "$verificaPonto")){

		       $valor = str_replace('.','', $valor);
		       $valor = str_replace(',','.', $valor);

		   }else{

		         $valor = str_replace(',','.', $valor);   

		   }

		   return $valor;

		}

		public function lista_n_orc(){

			$sql = 'SELECT auto_increment FROM information_schema.tables WHERE table_name = "tborcamento" and table_schema = "pjcelo" ';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$n_orc = $p_sql->fetch();
				
				return $n_orc[0];
			
			}catch(PDOException $e){
			
				echo $e->getMessage();
			
			}

			unset ($p_sql);
			
		}
		
		public function infoOrc(){
		
			$usuario = $_SESSION['cod_usu'];
			
			$sql = 'SELECT * FROM tborcamento WHERE cod_usu_orc = "'.$usuario.'"';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$no_orc = $p_sql->rowCount();
				
				$_SESSION['$info_orc'] = $no_orc;
			
			} catch (PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($p_sql);
		
		}

		public function lista_orc(){
		
			$co_orc = isset($_POST['id_orc']) ? $_POST['id_orc'] : null;
			$co_usu = !empty($_POST['id_usu']) ? $_POST['id_usu'] : $_SESSION['cod_usu'];
			
			if ($co_orc == null) {
			
				$sql = 'SELECT * FROM tborcamento WHERE cod_usu_orc = "'.$co_usu.'" ORDER BY cod_orc DESC';
			
			} else {
			
				$sql = 'SELECT * FROM tborcamento WHERE cod_orc LIKE "'.$co_orc.'%" AND cod_usu_orc = "'.$co_usu.'" ORDER BY cod_orc DESC';
			
			}
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
				
				echo '<div class="menu_tab">
					<fieldset><legend>Lista de orçamentos</legend>
					<div class="tab_ctn">
					<table class="tabela">
					<th>Cod. orç.</th>
					<th>Cod. usu.</th>
					<th>Nome usu.</th>
					<th>Cod. cli.</th>
					<th>Nome cli.</th>
					<th>Fone cli.</th>
					<th>Ações</th>';
					
				foreach ($res as $l) {
				
					$this->setId_orc($l['cod_orc']);
					$this->setId_usu_orc($l['cod_usu_orc']);
					$this->setNome_usu_orc($l['nome_usu_orc']);
					$this->setId_cli_orc($l['cod_cli_orc']);
					$this->setNome_cli_orc($l['nome_cli_orc']);
					$this->setFone_cli_orc($l['fone_cli_orc']);
					
					echo '<tr><td>';
					echo $this->getId_orc();
					echo '<form method="post" action=""><input type="hidden" name="id_orc" value="';
					echo $this->getId_orc();
					echo '"></td>	<td>';
					echo $this->getId_usu_orc();
					echo '<input type="hidden" name="id_usu_orc" value="';
					echo $this->getId_usu_orc();
					echo '"></td>	<td>';
					echo $this->getNome_usu_orc();
					echo '<input type="hidden" name="nome_usu_orc" value="';
					echo $this->getNome_usu_orc();
					echo '"></td>	<td>';
					echo $this->getId_cli_orc();
					echo '<input type="hidden" name="id_cli_orc" value="';
					echo $this->getId_cli_orc();
					echo '"></td>	<td>';
					echo $this->getNome_cli_orc();
					echo '<input type="hidden" name="nome_cli_orc" value="';
					echo $this->getNome_cli_orc();
					echo '"></td>	<td>';
					echo $this->getFone_cli_orc();
					echo '<input type="hidden" name="fone_cli_orc" value="';
					echo $this->getFone_cli_orc();
					echo '"></td><td class="tdinput"><input type="submit" name="sobe_ver_orc" value="Abrir" class="altera"/><input type="submit" name="exclui_orc" value="Excluir" class="exclui"/></form></td></tr>';
				
				}

				echo '</table>
					</div>
					</fieldset>
			 		</div>';
	  
			
			} catch (PDOException $e) {
			
				echo $e->getMessage();
			
			}

			unset($p_sql);
			
		}
		
		public function rtn_info_orc(){
		
			$n_orc = isset($_SESSION['n_orc']) ? $_SESSION['n_orc'] : $_POST['id_orc'];
			$_SESSION['n_orc'] = $n_orc;
			
			require_once $GLOBALS['views']. 'menu_orcamento.php';
			
	
			$sql = 'SELECT * FROM tborcamento_i WHERE cod_orc = "'.$n_orc.'"';
			
			$p_sql = Conexao::getInstance()->prepare($sql);
			$p_sql->execute();
			$f_sql = $p_sql->fetchAll(PDO::FETCH_ASSOC);
		
			echo '<div class="menu_tab">
				<fieldset><legend>Produtos do orçamento</legend>
				<div class="tab_ctn">
				<table class="tabela">
				<th>Cod.</th>
				<th>Descrição</th>
				<th>Tam.</th>
				<th>Cor</th>
				<th>Quant.</th>
				<th>Valor</th>
				<th>Ações</th>';
		
			foreach($f_sql as $l){
			
				$id_prod = $l['id_prod'];
				$desc_prod = $l['desc_prod'];
				$tam_prod = $l['tam_prod'];
				$cor_prod = $l['cor_prod'];
				$quant_prod = $l['quant_prod'];
				$valor_prod = $l['valor_prod'];
				
				echo '<tr><td>';
				echo $id_prod;
				echo '<form method="post" action=""><input type="hidden" name="id_prod" value="';
				echo $id_prod;
				echo '"></td>	<td>';
				echo $desc_prod;
				echo '<input type="hidden" name="d_prod" value="';
				echo $desc_prod;
				echo '"></td>	<td>';
				echo $tam_prod;
				echo '<input type="hidden" name="t_prod" value="';
				echo $tam_prod;
				echo '"></td>	<td>';
				echo $cor_prod;
				echo '<input type="hidden" name="c_prod" value="';
				echo $cor_prod;
				echo '"></td>	<td>';
				echo $quant_prod;
				echo '<input type="hidden" name="q_prod" value="';
				echo $quant_prod;
				echo '"></td>	<td>';
				echo $valor_prod;
				echo '<input type="hidden" name="v_prod" value="';
				echo $valor_prod;
				echo '"></td><td class="tdinput"><input type="submit" name="sobe_altera_orc" value="Alterar" class="altera"/><input type="submit" name="exclui_iten_orc" value="Excluir" class="exclui"/></form></td></tr>';
			
			}
			
			unset ($p_sql);
		
		}

		public function altera_orc(){

			$this->setId_orc($_POST['id_orc']);
			$id_prod = $_POST['cod_prod'];
			$q_prod = $_POST['quan_prod'];
			$v_prod = $_POST['valu_prod'];
			
			$sql = 'UPDATE tborcamento_i SET quant_prod = :q_prod, valor_prod = :v_prod WHERE cod_orc = :cod_orc AND id_prod = :id_prod';
			
			try{
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':cod_orc', $this->getId_orc());
				$p_sql->bindValue(':id_prod', $id_prod);
				$p_sql->bindValue(':q_prod', $q_prod);
				$p_sql->bindValue(':v_prod', $v_prod);
				
				$p_sql->execute();
				
				return $this->rtn_info_orc();
				
			
			}catch(Exception $e){
			
				echo $e->getMessage();
			
			}
			
			unset($p_sql);

		}
		
		public function exclui_orc(){
		
			$id = $_POST['id_orc'] ?? $_SESSION['n_orc'];
			$this->setId_orc($id);
			$item = isset($_POST['id_prod']) ? $_POST['id_prod'] : null;
			
			try{
			
				if($item != null){
				
					$sql_1 = 'DELETE FROM tborcamento_i WHERE cod_orc = :id_orc AND id_prod = :item';
					
					$p_sql1 = Conexao::getInstance()->prepare($sql_1);
					$p_sql1->bindValue(':id_orc', $this->getId_orc());
					$p_sql1->bindValue(':item', $item);
					$p_sql1->execute();
					
					return $this->rtn_info_orc();
				
				}else{
			
					$sql = 'DELETE FROM tborcamento WHERE cod_orc = :id_orc';
				
					$p_sql = Conexao::getInstance()->prepare($sql);
					$p_sql->bindValue(':id_orc', $this->getId_orc());
					$p_sql->execute();
					
					$sql_1 = 'DELETE FROM tborcamento_i WHERE cod_orc = :id_orc';
					
					$p_sql1 = Conexao::getInstance()->prepare($sql_1);
					$p_sql1->bindValue(':id_orc', $this->getId_orc());
					$p_sql1->execute();
				
					return $this->lista_orc();
			
				}
			
			}catch(Exception $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($p_sql);
			unset ($p_sql1);
					
		
		}

    }
