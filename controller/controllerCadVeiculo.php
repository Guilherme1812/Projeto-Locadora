<?php 
	session_start();
	require_once("../classes/cadVeiculo.class.php");
	require_once("../classes/autoload.php");
	

	$dados = $_SESSION['dado'];
	$id = 0;
	$preco = number_format($dados['preco'],2, ',', '');
	echo $preco;
	$precoFinal = str_replace("." , "" , $preco );
	$precoFinal = str_replace("," , "." , $preco );
echo $precoFinal;
	$Acao = $dados['Acao'];
	$crud = new Crud();
	if($dados['Acao'] == 'Cadastrar'){
		$crud->insertDB("veiculo", "?,?,?,?,?,?",  array($id, $dados['montadora'], $dados['modelo'], $dados['ano'], $dados['combustivel'], $precoFinal));
		$_SESSION['menssagemSucesso'] = "Veículo cadastrado com sucesso!";
		header("Location:../cadastroVeiculo.php");	
	}
	else{
		$crud->updateDB("veiculo","montadora=?, modelo=?, ano=?, combustivel=?, preco=?","id=?", array($dados['montadora'], $dados['modelo'], $dados['ano'], $dados['combustivel'], $precoFinal, $dados['id']));
		$_SESSION['menssagemSucesso'] = "Veículo editado com sucesso!";
		header("Location:../selectVeiculo.php");
		
	}

 ?>