<?php

	require_once("autoload.php");
	class CadCliente extends Conexao{
		public function CadastroCl(){
			$pdo = $this->Connect();
			ob_start();
			$cadastrar = filter_input(INPUT_POST,'Cadastrar', FILTER_SANITIZE_STRING);//verifica se foi clicado em cadastar
			if ($cadastrar) {
				$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);//$dadosRecebidos recebe os valores digitados e coloca num array
				$_SESSION['teste'] = $recebeDados;

				$erro = false;
				//$email = $dados['email'];
				//$email = filter_var($email, FILTER_VALIDATE_EMAIL);
				
				$limpaTag = array_map('strip_tags', $recebeDados);//Se for digitado alguma tag a mesma será retirada
				$dados = array_map('trim', $limpaTag);//tira espaços no começo no campo


				date_default_timezone_set('America/Sao_Paulo');
				$data = str_replace("/", "-", $dados["dtnascimento"]);
				function Idade($nascimento){
					$dataN = new DateTime($nascimento);
					$atual = new DateTime();

					$idade = $atual->diff($dataN);
					return $idade->y;
				}
				$maioridade =idade( date('Y-m-d', strtotime($data)));

				$dados['cpf'] = preg_match('/[0-9]/', $dados['cpf'])?$dados['cpf']:0;
			    $dados['cpf'] = str_pad($dados['cpf'], 11, '0', STR_PAD_LEFT);

				if(in_array('', $dados)){
					$erro = true;
					$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";
					header("location:cadastroCliente.php");
				}
				elseif($maioridade < 18){
					$erro = true;
					$_SESSION['menssagem'] = "Não permitimos locação para menor de idade!";
					header("location:cadastroCliente.php");
				}
				elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {//verifica se o email é válido.
					$erro = true;
					$_SESSION['menssagem'] = "Email inválido!";
					header("location:cadastroCliente.php");
				}							   			     
			    elseif (strlen($dados['cpf']) != 11) {
			        echo "length";
			       	$erro = true;
					$_SESSION['menssagem'] = "Insira um CPF válido!";
					header("location:cadastroCliente.php");
			    }
			   	elseif ($dados['cpf'] == '00000000000' || 
			        $dados['cpf'] == '11111111111' || 
			        $dados['cpf'] == '22222222222' || 
			        $dados['cpf'] == '33333333333' || 
			        $dados['cpf'] == '44444444444' || 
			        $dados['cpf'] == '55555555555' || 
			        $dados['cpf'] == '66666666666' || 
			        $dados['cpf'] == '77777777777' || 
			        $dados['cpf'] == '88888888888' || 
			        $dados['cpf'] == '99999999999') {

			       	$erro = true;
					$_SESSION['menssagem'] = "Insira um CPF válido!";
					header("location:cadastroCliente.php");
			    } else {   
			         
			        for ($t = 9; $t < 11; $t++) {
			             
			            for ($d = 0, $c = 0; $c < $t; $c++) {
			                $d += $dados['cpf']{$c} * (($t + 1) - $c);
			            }
			            $d = ((10 * $d) % 11) % 10;
			            if ($dados['cpf']{$c} != $d) {
			               	$erro = true;
							$_SESSION['menssagem'] = "Insira um CPF válido!";
							header("location:cadastroCliente.php");
			            }
			        }
			    }
			    if($erro === true){
			    	//header("location:globo.com.br");
			    }				    
			}
			$salvar = filter_input(INPUT_POST,'Salvar', FILTER_SANITIZE_STRING);//verifica se foi clicado em cadastar
			if ($salvar) {
				$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);//$dadosRecebidos recebe os valores digitados e coloca num array
				

				$erro = false;
				//$email = $dados['email'];
				//$email = filter_var($email, FILTER_VALIDATE_EMAIL);
				
				$limpaTag = array_map('strip_tags', $recebeDados);//Se for digitado alguma tag a mesma será retirada
				$dados = array_map('trim', $limpaTag);//tira espaços no começo no campo
				if (in_array('', $dados)) {
					$erro = true;
					$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";
					header("location:cadastroCliente.php?id={$dados['id']}");
				}
				date_default_timezone_set('America/Sao_Paulo');
				$data = str_replace("/", "-", $dados["dtnascimento"]);
				function Idade($nascimento){
					$dataN = new DateTime($nascimento);
					$atual = new DateTime();

					$idade = $atual->diff($dataN);
					return $idade->y;
				}
				$maioridade =idade( date('Y-m-d', strtotime($data)));

				$dados['cpf'] = preg_match('/[0-9]/', $dados['cpf'])?$dados['cpf']:0;
			    $dados['cpf'] = str_pad($dados['cpf'], 11, '0', STR_PAD_LEFT);

				if(in_array('', $dados)){
					$erro = true;
					$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";
					header("location:cadastroCliente.php?id={$dados['id']}");

				}
				elseif($maioridade < 18){
					$erro = true;
					$_SESSION['menssagem'] = "Não permitimos locação para menor de idade!";
					header("location:cadastroCliente.php?id={$dados['id']}");

				}
				elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {//verifica se o email é válido.
					$erro = true;
					$_SESSION['menssagem'] = "Email inválido!";
					header("location:cadastroCliente.php?id={$dados['id']}");

				}							   			     
			    elseif (strlen($dados['cpf']) != 11) {
			        echo "length";
			       	$erro = true;
					$_SESSION['menssagem'] = "Insira um CPF válido!";
					header("location:cadastroCliente.php?id={$dados['id']}");

			    }
			   	elseif ($dados['cpf'] == '00000000000' || 
			        $dados['cpf'] == '11111111111' || 
			        $dados['cpf'] == '22222222222' || 
			        $dados['cpf'] == '33333333333' || 
			        $dados['cpf'] == '44444444444' || 
			        $dados['cpf'] == '55555555555' || 
			        $dados['cpf'] == '66666666666' || 
			        $dados['cpf'] == '77777777777' || 
			        $dados['cpf'] == '88888888888' || 
			        $dados['cpf'] == '99999999999') {

			       	$erro = true;
					$_SESSION['menssagem'] = "Insira um CPF válido!";
					header("location:cadastroCliente.php?id={$dados['id']}");

			    } else {   
			         
			        for ($t = 9; $t < 11; $t++) {
			             
			            for ($d = 0, $c = 0; $c < $t; $c++) {
			                $d += $dados['cpf']{$c} * (($t + 1) - $c);
			            }
			            $d = ((10 * $d) % 11) % 10;
			            if ($dados['cpf']{$c} != $d) {
			               	$erro = true;
							$_SESSION['menssagem'] = "Insira um CPF válido!";
							header("location:cadastroCliente.php?id={$dados['id']}");

			            }
			        }
			    }	
			}
			if (!$erro){
					$_SESSION['dado'] = $dados;

						header("location:controller/controllerCadCliente.php");
				}
		}
	}
?>