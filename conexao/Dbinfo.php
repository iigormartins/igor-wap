<?php

	class DbInfo {
				
		protected $_host;
		protected $_user;
		protected $_senha;
		protected $_porta;
		protected $_base;
		

		public function DadosDbHost() {
			$this -> _host = 'localhost';
			return $this -> _host;
		}

		public function DadosDbUser() {
			$this -> _user = 'root';
			return $this -> _user;
		}

		public function DadosDbSenha() {
			$this -> _senha = '';
			return $this -> _senha;
		}
		
		public function DadosDbPorta(){
			$this -> _porta = '3306';
			return $this -> _porta;
		}

		public function DadosDbBase(){
			$this -> _base = 'mundowap';
			return $this -> _base;
		}
			
	}
?>