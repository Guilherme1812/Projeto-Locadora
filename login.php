<?php 
	$titulo = "Login";
	if (!isset($_SESSION)) {
		session_start();
	}
	require_once("includes/header_login.php"); 
?>
	<form  class="form" method="post" action="">
		<h1>Login</h1>
		<div class="container">
			<?php 
				if (isset($_SESSION['menssagem'])) {
					echo "<p id='erro'>" .$_SESSION['menssagem']."</p>";
				}
			?>
			<?php unset($_SESSION['menssagem']); ?>	
			<?php 
				if (isset($_SESSION['menssagemSucesso'])) {
					echo "<p id='sucesso'>" .$_SESSION['menssagemSucesso']."</p>";
				}
			?>
			<?php unset($_SESSION['menssagemSucesso']); ?>			
			<div class="input-container">
				<input type="text" name="email" id="nome1" maxlength="50" minlength="2" outline="none" placeholder="E-mail"/>
			</div>
			<div class="input-container">
				<input type="password" name="senha" id="nome2" maxlength="50" minlength="2" placeholder="Senha"/>
			</div>
		</div>
		<div class="botao1" align="center">
			<input type="submit" name="entrar" value="Entrar" class="botao">
			<?php
				if (isset($_POST['entrar'])) :
					require_once ("classes/autoload.php");
					$login = new Login();
					$login->Logar();
				endif;
			?>
		</div>
	</form>
<?php 
	require_once("includes/footer.php");
?>