<?php 
	
	abstract class Conexao{
		private $hostDB = 'mysql:host=localhost;dbname=locadora;';
		private $user = 'root';
		private $pass = '18g12u2015i';

		protected function Connect(){
			try {
				$conn = new PDO($this->hostDB, $this->user, $this->pass);
				$conn->exec("set names utf8");
				return $conn;
			} catch (PDOException $erro) {
				echo "Erro: ".$erro->getMessage();
			}
		}
	}
 ?>