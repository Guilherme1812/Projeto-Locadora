<?php 
	$titulo = "Cadastro de Cliente";
	require_once("includes/header.php");
  	require_once ("verificalogin.php");
?>

<form name= "signup" method="post" action="cadastrando.php" class="form">
	<div class="container">
		<div class="input-container">
			<input type="text" data-ls-module="charCounter" minlength="2" name="nome" placeholder="Nome">
		</div>
		<div class="input-container">
			<input type="text" data-ls-module="charCounter" minlength="2" name="sobrenome" placeholder="Sobrenome" >
		</div>
		<div class="input-container">
			<input type="text" name="email" placeholder="E-mail">
		</div>
		<div class="input-container">
			<input type="text" name="cidade" placeholder="Cidade">
		</div>
		<div class="input-container">
			<input type="text" name="rua" placeholder="Rua">
		</div>
		<div class="input-container">
			<input type="text" name="numerocasa" placeholder="Número">
		</div>
		<div class="input-container">
			<input type="text" name="cep" placeholder="Cep">
		</div>
		<div class="input-container">
		<label id="data"><font face="Verdana" color="#808080">Nascimento</font><input type="date" name="nascimento" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" required oninvalid="this.setCustomValidity('Preencha corretamente todos os campos!')"onchange="try{setCustomValidity('')}catch(e){}"></label></div>
		<div class="botao1" align="center">
			<input type="submit" value="Cadastrar" class="botao">
			<input type="reset" value="Limpar" class="botao2">
		</div>
	</div>
</form>
	<!--<footer><p id="rodape"> &copy; 2019 by Guilherme Pereira<br/> <a href="http://www.facebook.com/profile.php?id=100009918820872" target="_blank">facebook</a></p></footer>-->
<?php 
	require_once("includes/footer.php");
?>