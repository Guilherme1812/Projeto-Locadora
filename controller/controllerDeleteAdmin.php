<?php 
	require_once("../classes/autoload.php");

 ?>
 <?php

 	session_start();

	
	$idAdmin = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$delete = new Crud();
	$delete->deletDB("admin", "id=?", array($idAdmin));

	$_SESSION['mensagem'] = "Registro deletado com sucesso!";
	
	header("Location:../selectAdmin.php");
?>



 
