<?php
	$titulo = "Cadastro de Veículos";
	require_once ("controller/controllerLogin.php");
	require_once("classes/autoload.php");
	require_once("includes/header.php");
	$dados = $_SESSION['dadosVeiculo'];
	if (isset($_GET['id'])) {
		$Acao="Editar";
		$tituloForm = "Editar Veículo";
		$btForm = "Salvar";
		$crud = new Crud();
		$BFetch=$crud->selectDB("*", "veiculo", "where id=?", array($_GET['id']));
		$Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);
		$id= $Fetch['id'];
		$montadora= $Fetch['montadora'];
		$modelo= $Fetch['modelo'];
		$ano= $Fetch['ano'];
		$combustivel= $Fetch['combustivel'];
		$preco= $Fetch['preco'];
	}
	elseif(isset($_SESSION['menssagem'])){
		$tituloForm = "Cadastrar Veículo";
		$btForm = "Cadastrar";
		$Acao="Cadastrar";
		$id = 0;
		$montadora= $dados['montadora'];
		$modelo= $dados['modelo'];
		$ano= $dados['ano'];
		$combustivel= $dados['combustivel'];
		$preco= $dados['preco'];
	}
	else{
		$tituloForm = "Cadastrar Veículo";
		$btForm = "Cadastrar";
		$Acao="Cadastrar";
		$id = 0;
		$montadora ="";
		$modelo ="";
		$ano ="";
		$combustivel ="";
		$preco ="";
	}
	if (isset($_POST['cancelar']) & !isset($_GET['id'])) {
		header("Location:index.php");
	}
	elseif (isset($_POST['cancelar']) & isset($_GET['id'])) {
		header("Location:selectVeiculo.php");
	}
?>
<form method="post" action="" name="form-veiculo" class="form">
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
			<input type="text" name="montadora" id="nome1" maxlength="50" minlength="2" outline="none" placeholder="Montadora" value="<?php  echo $montadora;?>" />
		</div>
		<div class="input-container">
			<input type="text" name="modelo" id="nome2" maxlength="50" minlength="2" placeholder="Modelo" value="<?php echo $modelo;?>"/>
		</div>
		<div class="input-container">
			<input type="text" name="ano" id="email" placeholder="Ano" value="<?php echo $ano;?>"/>
		</div>
		<div class="input-container">
			<input type="text" name="combustivel" id="senha" placeholder="Combustível"value="<?php echo $combustivel;?>"/>
		</div>
		<div class="input-container">
			<input type="text" name="preco" id="senha2" placeholder="Preço"value="<?php echo $preco;?>"/>
		</div>
		
		<div class="botao1" align="center">
			<input type="submit" name="cadastrar" value="<?php echo $btForm;?>" class="botao">
			<?php 
				if(isset($_POST['cadastrar'])):
					require_once ("classes/autoload.php");
					$conexao = new CadVeiculo();
					$conexao->Cadastro();
				endif;
			?>
			<input type="submit" name="cancelar" value="Cancelar" class="botao2">
		</div>	
	</div>	 
</form>


<?php
	require_once("includes/footer.php");
?>