<?php 
	require_once("../classes/autoload.php");

 ?>
 <?php

 	session_start();

	
	$idVeiculo = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$delete = new Crud();
	$delete->deletDB("veiculo", "id=?", array($idVeiculo));

	$_SESSION['mensagem'] = "Registro deletado com sucesso!";
	header("Location:../selectVeiculo.php");
?>