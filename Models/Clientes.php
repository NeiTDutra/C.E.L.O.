<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

	abstract class Cliente{

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
