<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

	include_once('classes.php');

    class Estoque{

		private $id_prod;
		private $desc_prod;
		private $tam_prod;
		private $cor_prod;
		private $quan_prod;
		private $val_prod;

		public function getId_prod(){

			return $this->id_prod;

		}

		public function setId_prod($id_prod){

			return $this->id_prod = $id_prod;

		}

		public function getDesc_prod(){

			return $this->desc_prod;

		}

		public function setDesc_prod($desc_prod){

			return $this->desc_prod = $desc_prod;

		}

		public function getTam_prod(){

			return $this->tam_prod;

		}

		public function setTam_prod($tam_prod){

			return $this->tam_prod = $tam_prod;

		}

		public function getCor_prod(){

			return $this->cor_prod;

		}

		public function setCor_prod($cor_prod){

			return $this->cor_prod = $cor_prod;

		}

		public function getQuan_prod(){

			return $this->quan_prod;

		}

		public function setQuan_prod($quan_prod){

			return $this->quan_prod = $quan_prod;

		}

		public function getVal_prod(){

			return $this->val_prod;

		}

		public function setVal_prod($val_prod){

			return $this->val_prod = $val_prod;

		}

	}

	class DAOestoque{

		public function lanca_prod(){

			$lan_prod = new Estoque;
			$lan_prod->setDesc_prod($_POST['desc_prod']);
			$lan_prod->setTam_prod($_POST['tam_prod']);
			$lan_prod->setCor_prod($_POST['cor_prod']);
			$lan_prod->setQuan_prod($_POST['quan_prod']);
			$lan_prod->setVal_prod($this->valor_e($_POST['val_prod']));
			
			if (empty($_POST['id_prod'])){

				try{

					$sql = 'INSERT INTO tbproduto ( desc_prod, tam_prod, cor_prod, quant_prod, valor_prod ) VALUES ( :desc_prod, :tam_prod, :cor_prod, :quant_prod, :valor_prod )';

					$p_sql = Conexao::getInstance()->prepare($sql);

					$p_sql->bindValue(':desc_prod', $lan_prod->getDesc_prod());
					$p_sql->bindValue(':tam_prod', $lan_prod->getTam_prod());
					$p_sql->bindValue(':cor_prod', $lan_prod->getCor_prod());
					$p_sql->bindValue(':quant_prod', $lan_prod->getQuan_prod());
					$p_sql->bindValue(':valor_prod', $lan_prod->getVal_prod());

					$p_sql->execute();
					$this->lista_prod();

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

		public function lista_prod($p){

			if ($p != 'nada'){
			
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
					<th>Valor</th>';
	  
		        foreach ($lis as $l){

					$list_prod = new Estoque;
					$list_prod->setId_prod($l['id_prod']);
					$list_prod->setDesc_prod($l['desc_prod']);
					$list_prod->setTam_prod($l['tam_prod']);
					$list_prod->setCor_prod($l['cor_prod']);
					$list_prod->setQuan_prod($l['quant_prod']);
					$list_prod->setVal_prod($this->valor_s($l['valor_prod']));

					echo '<tr><td>';
					echo $list_prod->getId_prod();
					echo '<form method="post" action=""><input type="hidden" name="id_prod" value="';
					echo $list_prod->getId_prod();
					echo '"></td>	<td>';
					echo $list_prod->getDesc_prod();
					echo '<input type="hidden" name="d_prod" value="';
					echo $list_prod->getDesc_prod();
					echo '"></td>	<td>';
					echo $list_prod->getTam_prod();
					echo '<input type="hidden" name="t_prod" value="';
					echo $list_prod->getTam_prod();
					echo '"></td>	<td>';
					echo $list_prod->getCor_prod();
					echo '<input type="hidden" name="c_prod" value="';
					echo $list_prod->getCor_prod();
					echo '"></td>	<td>';
					echo $list_prod->getQuan_prod();
					echo '<input type="hidden" name="q_prod" value="';
					echo $list_prod->getQuan_prod();
					echo '"></td>	<td>';
					echo $list_prod->getVal_prod();
					echo '<input type="hidden" name="v_prod" value="';
					echo $list_prod->getVal_prod();
					echo '"></td> <td><input type="submit" name="sobe_altera_prod" value="!!"/></form></td></tr>';

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

			$al_prod = new Estoque;
			$al_prod->setId_prod($_POST['id_prod']);
			$al_prod->setDesc_prod($_POST['desc_prod']);
			$al_prod->setTam_prod($_POST['tam_prod']);
			$al_prod->setCor_prod($_POST['cor_prod']);
			$al_prod->setQuan_prod($_POST['quan_prod']);
			$al_prod->setVal_prod($this->valor_e($_POST['val_prod']));
			
				try{
				
					$sql = 'UPDATE tbproduto SET desc_prod = :desc_prod, tam_prod = :tam_prod, cor_prod = :cor_prod, quant_prod = :quant_prod, valor_prod = :valor_prod WHERE id_prod = :id_prod';
					
					$p_sql = Conexao::getInstance()->prepare($sql);
					$p_sql->bindValue(':desc_prod', $al_prod->getDesc_prod());
					$p_sql->bindValue(':tam_prod', $al_prod->getTam_prod());
					$p_sql->bindValue(':cor_prod', $al_prod->getCor_prod());
					$p_sql->bindValue(':quant_prod', $al_prod->getQuan_prod());
					$p_sql->bindValue(':valor_prod', $al_prod->getVal_prod());
					$p_sql->bindValue(':id_prod', $al_prod->getId_prod());
					$p_sql->execute();
					$this->lista_prod();
				
				}catch(PDOException $e){
				
					echo $e->getMessage();
				
				}
			
			}
		

	}
