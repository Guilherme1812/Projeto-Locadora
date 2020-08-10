<?php 
	require_once("../classes/autoload.php");

 ?>
 <?php

 	session_start();

	
	$idCliente = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$delete = new Crud();
	$delete->deletDB("clientes", "id=?", array($idCliente));

	$_SESSION['mensagem'] = "Registro deletado com sucesso!";
	header("Location:../selectClientes.php");
?>