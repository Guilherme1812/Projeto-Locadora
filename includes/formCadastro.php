<?php
	//require_once("../classes/autoload.php");
	//$dados = $_SESSION['salvarAdmin'];
	if (isset($_GET['id'])) {
		$Acao="Editar";
		$tituloForm = "Editar Administrador";
		$btForm = "Salvar";
		$crud = new Crud();
		$BFetch=$crud->selectDB("*", "admin", "where id=?", array($_GET['id']));
		$Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);
		$id= $Fetch['id'];
		$nome= $Fetch['nome'];
		$sobrenome= $Fetch['sobrenome'];
		$email= $Fetch['email'];
		$senha= "";
		$senhaConfirma= "";
	}/*
	elseif(isset($_SESSION['menssagem'])){
		$tituloForm = "Cadastrar Administrador";
		$btForm = "Cadastrar";
		$Acao="Cadastrar";
		$id = 0;
		$nome= $dados['nome'];
		$sobrenome= $dados['sobrenome'];
		$email= $dados['email'];
		$senha= "";
		$senhaConfirma= "";
	}*/
	else{
		$tituloForm = "Cadastrar Administrador";
		$btForm = "Cadastrar";
		$Acao="Cadastrar";
		$id = 0;
		$nome ="";
		$sobrenome ="";
		$email ="";
		$senha ="";
		$senhaConfirma ="";
	}
	if (isset($_POST['cancelar']) & !isset($_GET['id'])) {
		header("Location:index.php");
	}
	elseif (isset($_POST['cancelar']) & isset($_GET['id'])) {
		header("Location:selectAdmin.php");
	}
	
?>
<form method="post" action="" name="form-admin" class="form">
	<h1><?php echo $tituloForm?></h1>
	<div class="container">
		<div class="input-container">
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

			<input type="hidden" id="acao" name="Acao" value="<?php echo $Acao;?>">
			<input type="hidden"  id="id" name="id" value="<?php echo $id;?>">
			<input type="text" name="nome" id="nome1" maxlength="50" minlength="2" outline="none" placeholder="Nome" value="<?php echo $nome;?>" />
		</div>
		<div class="input-container">
			<input type="text" name="sobrenome" id="nome2" maxlength="50" minlength="2" placeholder="Sobrenome" value="<?php echo $sobrenome;?>"/>
		</div>
		<div class="input-container">
			<input type="text" name="email" id="email" placeholder="E-mail" value="<?php echo $email;?>"/>
		</div>
		<div class="input-container">
			<input type="password" name="senha" id="senha" placeholder="Senha"value="<?php echo $senha;?>"/>
		</div>
		<div class="input-container">
			<input type="password" name="senhaConfirma" id="senha2" placeholder="Corfime sua senha"value="<?php echo $senhaConfirma;?>"/>
		</div>
		<div class="botao1" align="center">
			<input type="submit" name="<?php echo $btForm;?>" value="<?php echo $btForm;?>" class="botao">
			<?php 
				if(isset($_POST['Cadastrar'])):
					require_once ("classes/autoload.php");
					$conexao = new CadAdmin();
					$conexao->Cadastro();
				endif;
				if(isset($_POST['Salvar'])):
					require_once ("classes/autoload.php");
					$conexao = new CadAdmin();
					$conexao->Cadastro();
				endif;
			?>
			<input type="submit" name="cancelar" value="Voltar" class="botao2">
		</div>	
	</div>	 
</form>