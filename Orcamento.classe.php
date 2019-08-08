<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

	include_once('classes.php');

	class Orcamento{

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

    class DAOorcamento{

		public function lanca_orc(){

                    $l_orc = new Orcamento;
                    $l_orc->setId_usu_orc($_POST['id_usu']);
                    $l_orc->setNome_usu_orc($_POST['nome_usu']);
                    $l_orc->setId_cli_orc($_POST['id_cli']);
                    $l_orc->setNome_cli_orc($_POST['nome_cli']);
                    $l_orc->setFone_cli_orc($_POST['fone_cli']);
                    
                    try{
                        
                        $sql = 'INSERT INTO tborcamento (cod_usu_orc, nome_usu_orc, cod_cli_orc, nome_cli_orc, fone_cli_orc) VALUES (:cod_usu_orc, :nome_usu_orc, :cod_cli_orc, :nome_cli_orc, :fone_cli_orc)';
                        
                        $p_sql = Conexao::getInstance()->prepare($sql);
                        $p_sql->bindValue(':cod_usu_orc', $l_orc->getId_usu_orc());
                        $p_sql->bindValue(':nome_usu_orc', $l_orc->getNome_usu_orc());
                        $p_sql->bindValue(':cod_cli_orc', $l_orc->getId_cli_orc());
                        $p_sql->bindValue(':nome_cli_orc', $l_orc->getNome_cli_orc());
                        $p_sql->bindValue(':fone_cli_orc', $l_orc->getFone_cli_orc());
                        
                        $p_sql->execute();
                        $this->lista_orc();
                        
                    } catch (Exception $e) {
                        
                        echo '<p>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</p>';
			echo $e->getMessage();

                    }
                    unset($p_sql);
                    unset($l_orc);
                }
                
                public function lanca_orc_prod(){
                    
                    require_once ('Estoque.classe.php');
                    
                    $cod_orc = $_POST['id_orc'];
                    $lp_orc = new Estoque;
                    $lp_orc->setId_prod($_POST['cod_prod']);
                    $lp_orc->setDesc_prod($_POST['desc_prod']);
                    $lp_orc->setTam_prod($_POST['tam_prod']);
                    $lp_orc->setCor_prod($_POST['cor_prod']);
                    $lp_orc->setQuan_prod($_POST['quan_prod']);
                    $lp_orc->setVal_prod($_POST['valu_prod']);
                    
                    try {
                        
                        $sql = 'INSERT INTO tborcamento_i (cod_orc,, id_prod, desc_prod, tam_prod, cor_prod, quant_prod, valor_prod) VALUES (:cod_orc, :id_prod, :desc_prod, :tam_prod, :cor_prod, :quan_prod, :val_prod)';
                        
                        $p_sql = Conexao::getInstance()->prepare($sql);
                        $p_sql->bindValue(':cod_orc', $cod_orc);
                        $p_sql->bindValue(':id_prod', getId_prod());
                        $p_sql->bindValue(':desc_prod', getDesc_prod());
                        $p_sql->bindValue(':tam_prod', getTam_prod());
                        $p_sql->bindValue(':cor_prod', getCor_prod());
                        $p_sql->bindValue(':quan_prod', getQuan_prod());
                        $p_sql->bindValue(':val_prod', getVal_prod());
                        
                        $p_sql->execute();
                        
                    } catch (Exception $e) {
                        
                        echo '<p>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</p>';
			echo $e->getMessage();
                        
                    }
                    unset($p_sql);
                    unset($lp_orc);
		}

		public function lista_orc(){

			
			
		}

		public function altera_orc(){



		}

    }

