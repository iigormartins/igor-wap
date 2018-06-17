<?php
	include_once '../conexao/Dbinfo.php';
	class conexao extends Dbinfo{

		private $conexaoDB = null;

		function __construct() {
            $this->conexaoDB = mysqli_connect($this->DadosDbHost(),$this->DadosDbUser(),$this->DadosDbSenha(), $this->DadosDbBase());
        }

        public function removeConexao(){
            $this->conexaoDB = null;
        }

		## MONTA OS CAMPOS PARA A QUERY
		private function campos($campos){
			$stringCampos = "";

			if($campos == null){
				$stringCampos = '*';
			}else{
				foreach ($campos as $key => $value) {
					$stringCampos .= $value.',';		
				}

				$stringCampos = substr($stringCampos, 0,-1);
			}

			return $stringCampos;
		}

		## MONTA AS CONDIÇÕES PARA QUERY
		private function condicao($condicao){
			$stringCondicao  = "";
			foreach ($condicao as $key => $value) {
				if($stringCondicao != "") $stringCondicao .= " AND ";
				$stringCondicao .= $key." = '".$value."'";
			}

			return $stringCondicao;
		}

		## REALIZA A BUSCA NO BANCO DE DADOS RECEBIDO PELA CONEXAO
		public function pesquisar($tabela, $campos, $condicao, $debug = false){
			$return = null;

			##MONTA A QUERY
			$query = "SELECT ".$this->campos($campos)." FROM ".$tabela;

			if($condicao != null && $condicao != "") $query.= " WHERE ".$this->condicao($condicao);

			## DEBUG, IMPRIME A QUERY
			if($debug == true) echo $query;

			## EXECUTA A QUERY			
			$resultado = $this->conexaoDB->query($query);

			if($resultado->num_rows > 0){
				while($row = $resultado->fetch_assoc())
					$return[] = $row;
			}

			return $return;        	        
	    }
	}
?>
	