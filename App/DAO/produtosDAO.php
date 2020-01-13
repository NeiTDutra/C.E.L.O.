<?php

	ini_set('display_errors', true); error_reporting(E_ALL);
	
	require_once $GLOBALS['models']. 'Produtos.php';

	class DAOproduto extends Produto{

		public function lanca_prod(){

			$this->setDesc_prod($_POST['desc_prod']);
			$this->setTam_prod($_POST['tam_prod']);
			$this->setCor_prod($_POST['cor_prod']);
			$this->setQuan_prod($_POST['quan_prod']);
			$this->setVal_prod($this->valor_e($_POST['val_prod']));
			
			if (empty($_POST['id_prod'])){

				try{

					$sql = 'INSERT INTO tbproduto ( desc_prod, tam_prod, cor_prod, quant_prod, valor_prod ) VALUES ( :desc_prod, :tam_prod, :cor_prod, :quant_prod, :valor_prod )';

					$p_sql = Conexao::getInstance()->prepare($sql);

					$p_sql->bindValue(':desc_prod', $this->getDesc_prod());
					$p_sql->bindValue(':tam_prod', $this->getTam_prod());
					$p_sql->bindValue(':cor_prod', $this->getCor_prod());
					$p_sql->bindValue(':quant_prod', $this->getQuan_prod());
					$p_sql->bindValue(':valor_prod', $this->getVal_prod());

					$p_sql->execute();
					
					return $this->lista_prod('nada');

				} catch (PDOException $e){
					echo $e->getMessage();

				}
			
		
			unset($lan_prod);
			unset($p_sql);
		
			}else{
			
				echo '<script> alert("Este produto ja existe, impossível inserir novamente."); </script>';
				return false;
				
			}
		
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
		
		public function infoEst(){
		
			$usuario = $_SESSION['cod_usu'];
			$sql = 'SELECT * FROM tbproduto';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$no_pro = $p_sql->rowCount();
				
				$_SESSION['$info_pro'] = $no_pro;
			
			} catch (PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($p_sql);
			
			$q_min = 25;
			
			$sql = 'SELECT * FROM tbproduto WHERE quant_prod <= "'.$q_min.'"';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$no_pro = $p_sql->rowCount();
				
				$_SESSION['sit'] = 'sit_verme';
				$_SESSION['situa_prod'] = 'Verificar';
				$_SESSION['$info_pro_neg'] = $no_pro;
				
				if($no_pro == 0){
				
					unset($_SESSION['sit']);
					unset($_SESSION['situa_prod']);
				
				} 
			
			} catch (PDOException $e){
			
				echo $e->getMessage();
			
			}
			
			unset ($p_sql);
		
		}

		public function lista_prod($p){

			if ($p == 'crit'){
			
				$sql = 'SELECT * FROM tbproduto WHERE quant_prod <= 25';
			
			}elseif ($p != 'nada'){
			
				$sql = 'SELECT * FROM tbproduto WHERE desc_prod LIKE "'.$p.'%" ORDER BY desc_prod ASC';
			
			}else{
				
				$sql = 'SELECT * FROM tbproduto';
			
			}

			try{
				

		        $res = Conexao::getInstance()->prepare($sql);
		        $res->execute();
		        $lis = $res->fetchAll(PDO::FETCH_ASSOC);
		
				echo '<div class="menu_tab">
					<fieldset><legend>Lista de produtos</legend>
					<div class="tab_ctn">
					<table class="tabela">
					<th>Cod.</th>
					<th>Descrição</th>
					<th>Tam.</th>
					<th>Cor</th>
					<th>Quant.</th>
					<th>Valor</th>
					<th>Ações</th>';
	  
		        foreach ($lis as $l){

		        	$add_style = ' style="color:red;"';
		        	
					$this->setId_prod($l['id_prod']);
					$this->setDesc_prod($l['desc_prod']);
					$this->setTam_prod($l['tam_prod']);
					$this->setCor_prod($l['cor_prod']);
					$this->setQuan_prod($l['quant_prod']);
					$this->setVal_prod($this->valor_s($l['valor_prod']));

					echo '<tr><td>';
					echo $this->getId_prod();
					echo '<form method="post" action=""><input type="hidden" name="id_prod" value="';
					echo $this->getId_prod();
					echo '"></td>	<td>';
					echo $this->getDesc_prod();
					echo '<input type="hidden" name="d_prod" value="';
					echo $this->getDesc_prod();
					echo '"></td>	<td>';
					echo $this->getTam_prod();
					echo '<input type="hidden" name="t_prod" value="';
					echo $this->getTam_prod();
					echo '"></td>	<td>';
					echo $this->getCor_prod();
					echo '<input type="hidden" name="c_prod" value="';
					echo $this->getCor_prod();
					echo '"></td>	<td';
					echo $this->getQuan_prod() <= 25 ? $add_style : null;
					echo '>';
					echo $this->getQuan_prod();
					echo '<input type="hidden" name="q_prod" value="';
					echo $this->getQuan_prod();
					echo '"></td>	<td>';
					echo $this->getVal_prod();
					echo '<input type="hidden" name="v_prod" value="';
					echo $this->getVal_prod();
					echo '"></td> <td class="tdinput"><input type="submit" name="sobe_altera_prod" value="Alterar" class="altera"/><input type="submit" name="exclui_prod" value="Excluir" class="exclui"/></form></td></tr>';

				}

				echo '</table>
					</div>
					</fieldset>
			 		</div>';
	  
			} catch (PDOException $e){
			
				echo $e->getMessage();
				
			}

		unset($list_prod);
		unset($res);

		}  

		public function valor_s($valor) {

		   $verificaPonto = ",";

		   if(strpos("[".$valor."]", "$verificaPonto")){

		       $valor = str_replace(',','', $valor);
		       $valor = str_replace('.',',', $valor);

		   }else{

		         $valor = str_replace('.',',', $valor);   

		   }

		   return $valor;

		}

		public function altera_prod(){

			$this->setId_prod($_POST['id_prod']);
			$this->setDesc_prod($_POST['desc_prod']);
			$this->setTam_prod($_POST['tam_prod']);
			$this->setCor_prod($_POST['cor_prod']);
			$this->setQuan_prod($_POST['quan_prod']);
			$this->setVal_prod($this->valor_e($_POST['val_prod']));
			
				try{
				
					$sql = 'UPDATE tbproduto SET desc_prod = :desc_prod, tam_prod = :tam_prod, cor_prod = :cor_prod, quant_prod = :quant_prod, valor_prod = :valor_prod WHERE id_prod = :id_prod';
					
					$p_sql = Conexao::getInstance()->prepare($sql);
					$p_sql->bindValue(':desc_prod', $this->getDesc_prod());
					$p_sql->bindValue(':tam_prod', $this->getTam_prod());
					$p_sql->bindValue(':cor_prod', $this->getCor_prod());
					$p_sql->bindValue(':quant_prod', $this->getQuan_prod());
					$p_sql->bindValue(':valor_prod', $this->getVal_prod());
					$p_sql->bindValue(':id_prod', $this->getId_prod());
					$p_sql->execute();
					
					return $this->lista_prod('nada');
				
				}catch(PDOException $e){
				
					echo $e->getMessage();
				
				}
			
			}
                        
            public function exclui_prod(){
                            
 	           	$id_prod = new Estoque;
               	$id_prod->setId_prod($_POST['id_prod']);
                            
               	try {
                                
					$sql = 'DELETE FROM tbproduto WHERE id_prod = :id_prod';
                                
                    $psql = Conexao::getInstance()->prepare($sql);
                    $psql->bindValue(':id_prod', $id_prod->getId_prod());
                    $psql->execute();
                                
                    return $this->lista_prod('nada');
                                
                } catch (Exception $ex) {
                             
                    echo $ex->getMessage();
                                
                }
                            
                unset($psql);
                unset($id_prod);
                            
            }

	}
