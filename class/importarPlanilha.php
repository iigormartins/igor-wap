<?php
	ini_set('max_execution_time','-1');
	require_once '../vendor/phpclasses/simple-xlsx/simplexlsx.class.php';
	include_once 'conexao.php';

	class importarPlanilha{
		// Atributo recebe a instância da conexão PDO
		private $conexao  = null;
	 
	     // Atributo recebe uma instância da classe SimpleXLSX
		private $planilha = null;
	 
		// Atributo recebe a quantidade de linhas da planilha
		private $linhas   = null;
	 
		// Atributo recebe a quantidade de colunas da planilha
		private $colunas  = null;
	 
		/*
		 * Método Construtor da classe
		 * @param $path - Caminho e nome da planilha do Excel xlsx
		 * @param $conexao - Instância da conexão PDO
		 */
		public function __construct($path=null){
			if(!empty($path) && file_exists($path)){
				$this->planilha = SimpleXLSX::parse($path);
			}else{
				echo 'Arquivo não encontrado!';
				exit();
			}	

			if($this->conexao == null) 
				$this->conexao = new conexao();
		}
	 
		/*
		 * Método que retorna o valor do atributo $linhas
		 * @return Valor inteiro contendo a quantidade de linhas na planilha
		 */
		public function getQtdeLinhas(){
			return $this->linhas;
		}
	 
		/*
		 * Método que retorna o valor do atributo $colunas
		 * @return Valor inteiro contendo a quantidade de colunas na planilha
		 */
		public function getQtdeColunas(){
			return $this->colunas;
		}
	 
		/*
		 * Método que verifica se o registro CPF da planilha já existe na tabela cliente
		 * @param $cpf - CPF do cliente que está sendo lido na planilha
		 * @return Valor Booleano TRUE para duplicado e FALSE caso não 
		 */
		private function isRegistroDuplicado($codigo){
			$retorno = false;
	 
			try{
				if(!empty($codigo)){
					$where = array();
					$where['T1002_Ean'] = $codigo;
					$consulta = $this->conexao->pesquisar('tab01002', null, $where);
						 
					if(!empty($consulta))	$retorno = true;
					else	$retorno = false;
				}				
			}catch(Exception $erro){
				echo 'Erro: ' . $erro->getMessage();
				$retorno = false;
			}
	 
			return $retorno;
		}
	 
		/*
		 * Método para ler os dados da planilha e inserir no banco de dados
		 * @return Valor Inteiro contendo a quantidade de linhas importadas
		 */
		public function insertDados(){
	 		
			try{
				$campos = array();
				$campos[] = 'T1002_Ean';
				$campos[] = 'T1002_Nome_Produto';
				$campos[] = 'T1002_Preco';
				$campos[] = 'T1002_Estoque';
				$campos[] = 'T1002_Data_Fabricacao';
				
				$linhas = $this->planilha->rows();
				$total = 0;
				foreach($linhas as $linha => $dados){
					## PRIMEIRA LINHA CABEÇALHO, VERIRICO SE ESTA OKAY
					if($linha == 0){
						if(!ctype_upper($dados[0]) && $dados[0] != "EAN") return false;
						if(!ctype_upper($dados[1]) && $dados[1] != "NOME PRODUTO") return false;
						if(!ctype_upper($dados[2]) && $dados[2] != "PREÇO") return false;
						if(!ctype_upper($dados[3]) && $dados[3] != "ESTOQUE") return false;
						if(!ctype_upper($dados[4]) && $dados[4] != "DATA FABRICAÇÃO") return false;
					}else if ($linha >= 1 && !$this->isRegistroDuplicado($dados[0]) && $dados[0] != ''){
						$valor 	 = array();		
						$valor[] = trim($dados[0]);
						$valor[] = trim($dados[1]);
						$valor[] = trim($dados[2]);
						$valor[] = trim($dados[3]);
						$valor[] = substr(trim($dados[4]),0,10);
						$retorno = $this->conexao->cadastrar('tab01002', $campos, $valor);

						if($retorno == true) $total++;
					}
				}
	 
				return $total;
			}catch(Exception $erro){
				echo 'Erro: ' . $erro->getMessage();
			}	 
		}
	}
?>