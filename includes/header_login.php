<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
</head>
<body>
	<input type="checkbox" id="bt_menu">
	<label for="bt_menu">&#9776;</label>
	<nav class="menu_index">
		<ul>
			
			
			<?php 
			//require_once ("verificalogin.php");
				if (isset($_SESSION['logado'])) {
					echo "
					<li><form  method='post' action=''><input id='f_menu' type='submit' name='logout' value='Logout'></form></li>
					<li><a href='#'>Veículos</a> 
				        <ul>
				          <li><a href='#'>Antigos</a></li>
				          <li><a href='#'>Atuais</a></li>
				        </ul>
				    </li>
					<li><a class='naoSele'>Cadastrar</a>
				        <ul>
				          <li><a href='cadastroadmin.php'>Administrador</a></li>
				          <li><a href=''>Cliente </a></li>
				        </ul>
			        <li><a class='naoSele'>Consultar</a>
				        <ul>
				          <li ><a href='selectAdmin.php'>Administrador</a></li>
				          <li><a href=''>Cliente </a></li>
				        </ul>
		     	 	</li>
					";
				}
			?>
			<div class="logo">
		      	<a class="logo_link" href="">Locadora Caetité</a>
		    </div>
		</ul>
	</nav>