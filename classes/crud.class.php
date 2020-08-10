<?php 
	require_once ("autoload.php");

	class Crud extends Conexao{
		private $crud;
		private $contador;

		private function preprareStatements($query, $parametros){
			$this->countParametros($parametros);
			$this->crud = $this->Connect()->prepare($query);
			if($this->contador > 0){
				for ($i=1; $i <= $this->contador; $i++) { 
					$this->crud->bindParam($i, $parametros[$i -1], PDO::PARAM_STR);
						
				}
			}
			$this->crud->execute();
		}

		private function countParametros($parametros){
			$this->contador=count($parametros);

		}
		public function insertDB($tabela, $condicao, $parametros){
			
			try {
				$this->preprareStatements("insert into {$tabela} values ({$condicao})", $parametros);
			return $this->crud;
			} catch (Exception $erro) {
				echo "Erro: ". $erro->getMessage();
			}	
		}
		public function selectDB($campos, $tabela, $condicao, $parametros){
			
			try {
				$this->preprareStatements("select {$campos} from {$tabela} {$condicao}", $parametros);
			return $this->crud;
			} catch (Exception $erro) {
				echo "Erro: ". $erro->getMessage();
			}	
		}
		public function deletDB($tabela, $condicao, $parametros){
			
			try {
				$this->preprareStatements("delete from {$tabela} where {$condicao}", $parametros);
			return $this->crud;
			} catch (Exception $erro) {
				echo "Erro: ". $erro->getMessage();
			}	
		}
		public function updateDB($tabela, $set, $condicao, $parametros){
			try {
				$this->preprareStatements("update {$tabela} set {$set} where {$condicao}", $parametros);
				return $this->crud;
			} catch (Exception $erro) {
				echo "Erro: ". $erro->getMessage();
			}	
		}
	}

 ?>