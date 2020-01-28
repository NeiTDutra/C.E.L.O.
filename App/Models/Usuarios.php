<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

	abstract class Usuario{
	  
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
