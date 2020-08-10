<?php

	class ConsultaAdmin extends Conexao{
		
		public function Buscar(){
			$pdo = $this->Connect();
  			$dados = (filter_input(INPUT_POST, 'buscar', FILTER_SANITIZE_STRING));
  			if ($dados) {
  				$rDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  			}
  			//echo json_encode($rDados);
  			$limpaTag = array_map('strip_tags', $rDados);//Se for digitado alguma tag a mesma será retirada
			$dados = array_map('trim', $limpaTag);//tira espaços no começo no campo
			try{
				$sql = "select nome, sobrenome, email from admin where nome = :nome and sobrenome = :sobrenome";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(":nome", $dados['clienteN']);
				$stmt->bindValue(":sobrenome", $dados['clienteS']);
				$stmt->execute();
				
				$result = $stmt->fetchColumn();
				echo $result;
				if (count($result) == 0) {
					echo "guilherme";
				}
				while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$nome = $result['nome'];
					$sobrenome = $result['sobrenome'];
					$email = $result['email'];
					echo $nome." - ". $sobrenome." - ". $email."<br>";
				}

			} catch (PDOException $erro) {
				echo "Erro: ". $erro->getMessage();
			}	
  		}	
	}
