<?php 
	require_once("autoload.php");
		class CadVeiculo extends Conexao{
		public function Cadastro(){
			$pdo = $this->Connect();
			//session_start();
			ob_start();
			$cadastrar = filter_input(INPUT_POST,'cadastrar', FILTER_SANITIZE_STRING);//verifica se foi clicado em cadastar
			if ($cadastrar) {
				$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);//$dadosRecebidos recebe os valores digitados e coloca num array
				 $_SESSION['dadosVeiculo'] = $recebeDados;

				$erro = false;
				//$email = $dados['email'];
				//$email = filter_var($email, FILTER_VALIDATE_EMAIL);

				$limpaTag = array_map('strip_tags', $recebeDados);//Se for digitado alguma tag a mesma será retirada
				$dados = array_map('trim', $limpaTag);//tira espaços no começo no campo
				if (in_array('', $dados)) {
					$erro = true;
					$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";
					header("location:cadastroVeiculo.php");
				}
				elseif (stristr($dados, "'")){//Se tiver o caractere aspas simples vai exibir o erro.
					$erro = true;
					$_SESSION['menssagem'] = "Caractere inválido ' na senha!";
					header("location:cadastroVeiculo.php");
				}
				elseif(strlen($dados['ano']) != 4){
					$erro = true;
					$_SESSION['menssagem'] = "Ano precisa ter 4 digitos!";
					header("location:cadastroVeiculo.php");
				}
				else{
					if($dados['Acao'] != 'Editar'){
						$sql ="select * from veiculo where montadora = :montadora, modelo = :modelo, ano = :ano, combustivel = :combustivel, preco = :preco";
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(":montadora", $dados['montadora'], PDO::PARAM_STR);
						$stmt->bindParam(":modelo", $dados['modelo'], PDO::PARAM_STR);
						$stmt->bindParam(":ano", $dados['ano'], PDO::PARAM_STR);
						$stmt->bindParam(":combustivel", $dados['combustivel'], PDO::PARAM_STR);
						$stmt->bindParam(":preco", $dados['preco'], PDO::PARAM_STR);
						$stmt->execute();
						$obj = $stmt->fetchObject();
						if ($obj) {
							$erro = true;
							$_SESSION['menssagem'] = "Veículo já cadastrado!";
							header("location:cadastroVeiculo.php");
						}
					}
				}
			}
			if (!$erro){
				$_SESSION['dado'] = $dados;
				header("location:controller/controllerCadVeiculo.php");
			}
		}
	}

 ?>