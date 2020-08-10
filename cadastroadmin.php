<?php //session_start();
	if (isset($_GET['id'])) {
		$titulo = "Editar Administrador";
	}
	else{
		$titulo = "Cadastrar Administrador";
	}
	
	require_once("includes/header.php");	
  	require_once ("controller/controllerLogin.php");
?>
<?php require_once ("includes/formCadastro.php");?>
<?php
	require_once("includes/footer.php");
?> 