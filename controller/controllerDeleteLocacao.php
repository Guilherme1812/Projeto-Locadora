<?php 
	require_once("../classes/autoload.php");

 ?>
 <?php

 	session_start();

	
	$idLocacao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$delete = new Crud();
	$delete->deletDB("locacao", "id_locacao=?", array($idLocacao));

	$_SESSION['mensagem'] = "Registro deletado com sucesso!";
	header("Location:../selectLocacao.php");
?>

