<?php 
	session_start();
	require_once("../classes/cadadmin.class.php");
	require_once("../classes/autoload.php");
	

	$dados = $_SESSION['dado'];
	//echo $dados['id'];
	$id = 0;
	$senha = md5($dados['senha']);
	$Acao = $dados['Acao'];
	$crud = new Crud();
	if($dados['Acao'] == 'Cadastrar'){
		$crud->insertDB("admin", "?,?,?,?,?",  array($id, $dados['nome'], $dados['sobrenome'], $dados['email'], $senha));
		$_SESSION['menssagemSucesso'] = "Cadastro realizado com sucesso!";
		header("Location:../cadastroadmin.php");	
	}
	else{
		$crud->updateDB("admin","nome=?, sobrenome=?, email=?, senha=?","id=?", array($dados['nome'], $dados['sobrenome'], $dados['email'], $senha, $dados['id']));
		$_SESSION['menssagemSucesso'] = "Dados Editados com sucesso!";
		//echo $dados['id'];
		header("Location:../cadastroadmin.php?id={$dados['id']}");
		
	}

 ?>