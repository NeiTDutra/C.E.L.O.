<?php

	ini_set('display_errors', true); error_reporting(E_ALL);


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
