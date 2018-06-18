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

		## REALIZA A BUSCA NO BANCO DE DADOS
		public function pesquisar($tabela, $campos, $condicao, $debug = false){
			## VARIAVEL TABELA É OBRIGATORIO
			if($tabela == null) return false;

			$return = null;

			##MONTA A QUERY
			$query = "SELECT ".$this->campos($campos)." FROM ".$tabela;

			if($condicao != null && $condicao != "") $query.= " WHERE ".$this->condicao($condicao);

			## DEBUG, IMPRIME A QUERY
			if($debug == true) echo $query;

			## EXECUTA A QUERY
			try{			
				$resultado = $this->conexaoDB->query($query);

				if($resultado->num_rows > 0){
					while($row = $resultado->fetch_assoc())
						$return[] = $row;
				}
			}catch(Exception $e){
				$return = false;
			}	

			return $return;        	        
	    }

	    ## REALIZA O CADASTRO DO DADO NO BANCO DE DADOS
	    public function cadastrar($tabela, $campos, $valor, $debug = false){
	    	## VARIAVEIS TABELA, CAMPOS, VALOR É OBRIGATORIO
	    	if($tabela == false || $campos == false || $valor == false) return false;

	    	$return = true;

	    	##MONTA QUERY
	    	$query = "INSERT ".$tabela." (".$this->campos($campos).")";

	    	$stringValor = "";
	    	foreach ($valor as $key => $value) {
	    		$stringValor .= "'".$value."',";
	    	}
	    	$stringValor = substr($stringValor, 0, -1);

	    	$query .= " VALUES (".$stringValor.")";

	    	##EXECUTA QUERY
	    	try{
	    		mysqli_query($this->conexaoDB,$query);
	    	}catch(Exception $e){
	    		$return = false;
	    	}

	    	return $return;
	    }

	    ## REALIZA A REMOÇAO DO DADO NO BANCO DE DADOS
	    public function remover($tabela, $condicao, $debug = false){
	    	## VARIAVEL TABELA É OBRIGATORIO
			if($tabela == null) return false;

			$return = true;

			## MONTA A QUERY
			$query = "DELETE FROM ".$tabela;

			if($condicao != null && $condicao != "") $query.= " WHERE ".$this->condicao($condicao);

			## DEBUG, IMPRIME A QUERY
			if($debug == true) echo $query;

			## EXECUTA QUERY
	    	try{
	    		mysqli_query($this->conexaoDB,$query);
	    	}catch(Exception $e){
	    		$return = false;
	    	}

	    	return $return;
	    }
	}
?>
	