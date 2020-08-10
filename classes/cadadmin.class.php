<?php 
	require_once("autoload.php");
		class CadAdmin extends Conexao{
		public function Cadastro(){
			$pdo = $this->Connect();
			//session_start();
			ob_start();
			$cadastrar = filter_input(INPUT_POST,'Cadastrar', FILTER_SANITIZE_STRING);//verifica se foi clicado em cadastar
			if ($cadastrar) {
				$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);//$dadosRecebidos recebe os valores digitados e coloca num array
				$_SESSION['salvarAdmin'] = $recebeDados;

				$erro = false;
				//$email = $dados['email'];
				//$email = filter_var($email, FILTER_VALIDATE_EMAIL);
				
				$limpaTag = array_map('strip_tags', $recebeDados);//Se for digitado alguma tag a mesma será retirada
				$dados = array_map('trim', $limpaTag);//tira espaços no começo no campo
				if (in_array('', $dados)) {
					$erro = true;
					$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";
					header("location:cadastroadmin.php");
				}
				elseif ((strlen($dados['senha'])) < 8 ){//Se tiver menos de 8 digitos na senha mostra o erro
					$erro = true;
					$_SESSION['menssagem'] = "A senha deve ter no mínimo 8 digitos!";
					header("location:cadastroadmin.php");
				}
				elseif (stristr($dados['senha'], "'")){//Se tiver o caractere aspas simples vai exibir o erro.
					$erro = true;
					$_SESSION['menssagem'] = "Caractere inválido ' na senha!";
					header("location:cadastroadmin.php");
				}
				elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {//verifica se o email é válido.
					$erro = true;
					$_SESSION['menssagem'] = "Email inválido!";
					header("location:cadastroadmin.php");
				}
				elseif ($dados['senhaConfirma'] != $dados['senha']) {
					$erro = true;
					$_SESSION['menssagem'] = "Senhas não coincidem!";
					header("location:cadastroadmin.php");
				}
				else{
					if($dados['Acao'] != 'Editar'){
						$sql ="select email from admin where email = :email";
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(":email", $dados['email'], PDO::PARAM_STR);
						$stmt->execute();
						$obj = $stmt->fetchObject();
						if ($obj) {
							$erro = true;
							$_SESSION['menssagem'] = "Email já cadastrado!";
							header("location:cadastroadmin.php");
						}
					}
				}
			}
			$salvar = filter_input(INPUT_POST,'Salvar', FILTER_SANITIZE_STRING);//verifica se foi clicado em cadastar
			if ($salvar) {
				$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);//$dadosRecebidos recebe os valores digitados e coloca num array
				//echo json_encode($recebeDados);

				$erro = false;
				//$email = $dados['email'];
				//$email = filter_var($email, FILTER_VALIDATE_EMAIL);
				
				$limpaTag = array_map('strip_tags', $recebeDados);//Se for digitado alguma tag a mesma será retirada
				$dados = array_map('trim', $limpaTag);//tira espaços no começo no campo
				if (in_array('', $dados)) {
					$erro = true;
					$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";
					header("location:cadastroadmin.php?id={$dados['id']}");
				}
				elseif ((strlen($dados['senha'])) < 8 ){//Se tiver menos de 8 digitos na senha mostra o erro
					$erro = true;
					$_SESSION['menssagem'] = "A senha deve ter no mínimo 8 digitos!";
					header("location:cadastroadmin.php?id={$dados['id']}");
				}
				elseif (stristr($dados['senha'], "'")){//Se tiver o caractere aspas simples vai exibir o erro.
					$erro = true;
					$_SESSION['menssagem'] = "Caractere inválido ' na senha!";
					header("location:cadastroadmin.php?id={$dados['id']}");
				}
				elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {//verifica se o email é válido.
					$erro = true;
					$_SESSION['menssagem'] = "Email inválido!";
					header("location:cadastroadmin.php?id={$dados['id']}");
				}
				elseif ($dados['senhaConfirma'] != $dados['senha']) {
					$erro = true;
					$_SESSION['menssagem'] = "Senhas não coincidem!";
					header("location:cadastroadmin.php?id={$dados['id']}");
				}
			}
			if (!$erro){
				$_SESSION['dado'] = $dados;



					header("location:controller/controllersCadAdmin.php");
				/*try {
					$password = md5($dados['senha']);
					$insere = "INSERT INTO admin (nome,sobrenome,email,senha)VALUES(:nome, :sobrenome, :email, :senha)";
					$stmt = $pdo->prepare($insere);
					$stmt->bindParam(":nome",$dados['nome'], PDO::PARAM_STR);
					$stmt->bindParam(":sobrenome",$dados['sobrenome'], PDO::PARAM_STR);
					$stmt->bindParam(":email",$dados['email'], PDO::PARAM_STR);
					$stmt->bindParam(":senha",$password, PDO::PARAM_STR);
					$stmt->execute();
					$_SESSION['cadRe'] = true;
					header("Location:login.php");
					//var_dump($stmt);
				} catch (Exception $erro) {
					echo "Não foi possivel inserir os dados no banco: ".$erro->getMessage();
				}*/
			}
		}
	}

 ?>