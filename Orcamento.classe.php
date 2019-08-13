<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

	include_once('classes.php');

	abstract class Orcamento{

		private $id_orc;
		private $id_usu_orc;
		private $nome_usu_orc;
		private $id_cli_orc;
		private $fone_cli_orc;
		private $nome_cli_orc;
		private $lis_prod_orc;

		public function getId_orc(){

			return $this->id_orc;

		}

		public function setId_orc($id_orc){

			return $this->id_orc = $id_orc;
		
		}

		public function getId_usu_orc(){

			return $this->id_usu_orc;

		}

		public function setId_usu_orc($id_usu_orc){

			return $this->id_usu_orc = $id_usu_orc;
		}

		public function getNome_usu_orc(){

			return $this->nome_usu_orc;

		}

		public function setNome_usu_orc($nome_usu_orc){

			return $this->nome_usu_orc = $nome_usu_orc;

		}

		public function getId_cli_orc(){

			return $this->id_cli_orc;

		}

		public function setId_cli_orc($id_cli_orc){

			return $this->id_cli_orc = $id_cli_orc;

		}

		public function getNome_cli_orc(){

			return $this->nome_cli_orc;

		}

		public function setNome_cli_orc($nome_cli_orc){

			return $this->nome_cli_orc = $nome_cli_orc;

		}

		public function getFone_cli_orc(){

			return $this->fone_cli_orc;

		}

		public function setFone_cli_orc($fone_cli_orc){

			return $this->fone_cli_orc = $fone_cli_orc;

		}

		public function getLis_prod_orc(){

			return $this->lis_prod_orc;

		}

		public function setLis_prod_orc($lis_prod_orc){

			return $this->lis_prod_orc = $lis_prod_orc;

		}
	}

    class DAOorcamento extends Orcamento{

		public function lanca_orc(){
		
			if (empty($_POST['id_usu']) || empty($_POST['nome_usu']) || empty($_POST['id_cli']) || empty($_POST['nome_cli']) || empty($_POST['fone_cli'])){
			
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
                        //$this->lista_orc();
                        
                    } catch (PDOException $e) {
                        
						echo $e->getMessage();

                    }catch (SQLException $ex) {
                    
                    	echo $ex->getMessage();
                    
                    }
                    unset($p_sql);
            }
                
        }
                
                public function lanca_orc_prod(){
                    
                    require_once 'Estoque.classe.php';
                    
                    $cod_orc = $_POST['id_orc'];
                    $lp_orc = new Estoque;
                    $lp_orc->setId_prod($_POST['cod_prod']);
                    $lp_orc->setDesc_prod($_POST['desc_prod']);
                    $lp_orc->setTam_prod($_POST['tam_prod']);
                    $lp_orc->setCor_prod($_POST['cor_prod']);
                    $lp_orc->setQuan_prod($_POST['quan_prod']);
                    $lp_orc->setVal_prod($this->valor_e($_POST['valu_prod']));
                    
                    try {
                        
                        $sql = 'INSERT INTO tborcamento_i (cod_orc, id_prod, desc_prod, tam_prod, cor_prod, quant_prod, valor_prod) VALUES (:cod_orc, :id_prod, :desc_prod, :tam_prod, :cor_prod, :quan_prod, :val_prod)';
                        
                        $p_sql = Conexao::getInstance()->prepare($sql);
                        $p_sql->bindValue(':cod_orc', $cod_orc);
                        $p_sql->bindValue(':id_prod', $lp_orc->getId_prod());
                        $p_sql->bindValue(':desc_prod', $lp_orc->getDesc_prod());
                        $p_sql->bindValue(':tam_prod', $lp_orc->getTam_prod());
                        $p_sql->bindValue(':cor_prod', $lp_orc->getCor_prod());
                        $p_sql->bindValue(':quan_prod', $lp_orc->getQuan_prod());
                        $p_sql->bindValue(':val_prod', $lp_orc->getVal_prod());
                        
                        $p_sql->execute();
                        
                    } catch (Exception $e) {
                        
						echo $e->getMessage();
                        
                    }
                    unset($p_sql);
                    unset($lp_orc);
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

			$sql = 'SELECT cod_orc FROM tborcamento ORDER BY cod_orc DESC LIMIT 1';
			
			try {
			
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->execute();
				$n_orc = $p_sql->fetch();
				$n_orc = $n_orc[0] + 1;
				return $n_orc;
			
			}catch(PDOException $e){
			
				echo $e->getMessage();
			
			}

			
			
		}

		public function lista_orc(){
		
			$co_orc = isset($_POST['id_orc']) ? $_POST['id_orc'] : null;
			$co_usu = $_POST['id_usu'];
			
			if ($co_orc == null) {
			
				$sql = 'SELECT * FROM tborcamento WHERE cod_usu_orc = "'.$co_usu.'"';
			
			} else {
			
				$sql = 'SELECT * FROM tborcamento WHERE cod_orc LIKE "'.$co_orc.'%" AND id_usu = "'.$co_usu.'"';
			
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
					<th>Fone cli.</th>';
					
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
					echo '"></td> <td><input type="submit" name="sobe_altera_orc" value="!!"/></form></td></tr>';
				
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

		public function altera_orc(){



		}

    }

