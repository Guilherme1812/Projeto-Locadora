<?php
	session_start();
		require_once("../classes/autoload.php");
	
	
	$dados = $_SESSION['dados'];
	
	$id = 0;
	$Acao = $dados['6'];
	$valor = $dados['5'];
	
	$valor = str_replace("." , "" , $valor );
	$valor = str_replace("," , "." , $valor );
	
	echo $valor."<br>";

	$crud = new Crud();
	try {
		if($Acao == 'Cadastrar'){
			$crud->insertDB("locacao","?,?,?,?,?,?,?", array($id, $dados['0'],$dados['1'],$dados['2'],$dados['3'],$dados['4'],$valor,));
			$_SESSION['menssagemSucesso'] = "Locação realizada com sucesso!";
			header("Location:../locacao.php");
		}
	} catch (Exception $erro) {
		echo "Erro: ".$erro->getMessage();
	}		
?>