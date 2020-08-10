<?php 
	session_start();
	require_once("../classes/cadCliente.class.php");
	require_once("../classes/autoload.php");
	
    
	$dados = $_SESSION['dado'];
	//echo $dados['id'];
	//echo json_encode($dados);
	$dataN = $dados['dtnascimento'];
	$dataN = date("Y-m-d",strtotime(str_replace('/','-',$dataN)));  
	date('Y-m-d', strtotime($dataN));
	
	$id = 0;
	$Acao = $dados['Acao'];
	//echo $Acao;
	$crud = new Crud();
	try {
		if($dados['Acao'] == 'Cadastrar'){
			$crud->insertDB("clientes", "?,?,?,?,?,?,?,?,?,?",  array($id, $dados['nome'], $dados['sobrenome'], $dataN, $dados['cpf'],$dados['fone'],$dados['email'], $dados['cidade'],$dados['rua'],$dados['numero']));
			$_SESSION['menssagemSucesso'] = "Cadastro realizado com sucesso!";
			header("Location:../cadastroCliente.php");	
		}
		else{
			$crud->updateDB("clientes","nome=?, sobrenome=?, dtnascimento=?, cpf=?, fone=?, email=?, cidade=?, rua=?, numero=?","id=?", array($dados['nome'], $dados['sobrenome'], $dataN,$dados['cpf'],$dados['fone'],$dados['email'],$dados['cidade'],$dados['rua'],$dados['numero'], $dados['id']));
			$_SESSION['menssagemSucesso'] = "Dados Editados com sucesso!";
			header("Location:../cadastroCliente.php?id={$dados['id']}");	
		}
	} catch (Exception $erro) {
		echo "Erro: ".$erro->getMessage();
	}
///Depois de cadastro realizado mandar pra uma tela de impressão onde terá o comprovante para impressão
	//refazer a parte de cadastro de cliente e locação, para que seja criada primeiro o cadastro do cliente e depois seja atualizado com os dados da locação	
?>