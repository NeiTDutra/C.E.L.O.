<?php

	ini_set('display_errors', true); error_reporting(E_ALL);

    abstract class Produto{

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
