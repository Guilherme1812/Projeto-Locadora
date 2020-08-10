<?php
	$titulo = "Cadastrar Cliente";
	require_once("classes/autoload.php");	
	require_once("includes/header.php");
	require_once ("controller/controllerLogin.php");
	$teste = $_SESSION['teste'];
	if (isset($_GET['id'])) {
		$Acao="Editar";
		$tituloForm = "Editar Cliente";
		$btForm = "Salvar";
		$crud = new Crud();
		$BFetch=$crud->selectDB("*", "clientes", "where id=?", array($_GET['id']));
		$Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);
		$id= $Fetch['id'];
		$nome= $Fetch['nome'];
		$sobrenome= $Fetch['sobrenome'];
		$dtnascimento= $Fetch['dtnascimento'];
		$cpf= $Fetch['cpf'];
		$fone = $Fetch['fone'];
		$email= $Fetch['email'];
		$cidade= $Fetch['cidade'];
		$rua= $Fetch['rua'];
		$numero= $Fetch['numero'];	
	}
	elseif(isset($_SESSION['menssagem'])){
		$tituloForm = "Cadastrar Cliente";
		$btForm = "Cadastrar";
		$Acao="Cadastrar";
		$id = 0;
		$nome= $teste['nome'];
		$sobrenome= $teste['sobrenome'];
		$dtnascimento= $teste['dtnascimento'];
		$cpf= $teste['cpf'];
		$fone = $teste['fone'];
		$email= $teste['email'];
		$cidade= $teste['cidade'];
		$rua= $teste['rua'];
		$numero= $teste['numero'];
	}
	else{
		$tituloForm = "Cadastrar Cliente";
		$btForm = "Cadastrar";
		$Acao="Cadastrar";
		$id = 0;
		$nome= "";
		$sobrenome= "";
		$dtnascimento= "";
		$cpf= "";
		$fone = "";
		$email= "";
		$cidade= "";
		$rua= "";
		$numero= "";
	}
	if (isset($_POST['cancelar']) & !isset($_GET['id'])) {
		header("Location:index.php");
	} 
	elseif (isset($_POST['cancelar']) & isset($_GET['id'])) {
		header("Location:selectClientes.php");
	}
?>

<form method="post" action="" name="form-admin" class="form">
	<h1><?php echo $btForm ?></h1>
	<div class="container">
		<div class="input-container">
			<input type="hidden" id="acao" name="Acao" value="<?php echo $Acao ?>">
			<input type="hidden"  id="id" name="id" value="<?php echo $Fetch['id'] ?>">
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
			<input type="text" name="nome" id="nome1" maxlength="50" minlength="2" outline="none" placeholder="Nome" value="<?php echo $nome ?>" />
		</div>
		<div class="input-container">
			<input type="text" name="sobrenome" id="nome2" maxlength="50" minlength="2" placeholder="Sobrenome" value="<?php echo $sobrenome ?>"/>
		</div>
		<div class="input-container">
				<input type="text" name="dtnascimento" class="datepicker" placeholder="Nascimento" value="<?php echo $dtnascimento?>"  />
		</div>
		<div class="input-container">
			<input type="text" name="cpf" id="cpf" placeholder="CPF"value="<?php echo $cpf ?>" onkeypress='return SomenteNumero(event)'/>
		</div>
		<div class="input-container">
			<input type="text" name="fone" id="fone" placeholder="Telefone"value="<?php echo $fone ?>" onkeypress='return SomenteNumero(event)'/>
		</div>
		<div class="input-container">
			<input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email ?>"  />
		</div>
		<div class="input-container">
			<input type="text" name="cidade" id="cidade" maxlength="50" minlength="2" placeholder="Cidade" value="<?php echo $cidade?>"  />
		</div>
		<div class="input-container">
			<input type="text" name="rua" id="rua" maxlength="100" minlength="2" placeholder="Rua" value="<?php echo $rua?>"  />
		</div>
		<div class="input-container">
			<input type="text" name="numero" id="numero" placeholder="Número" value="<?php echo $numero ?>"  onkeypress='return SomenteNumero(event)'/>
		</div>
		<div class="botao1" align="center">
			<input type="submit" name="<?php echo $btForm ?>" value="<?php echo $btForm ?>" class="botao">
			<?php 
				if(isset($_POST['Cadastrar'])):
					require_once ("classes/autoload.php");
					$conexao = new CadCliente();
					$conexao->CadastroCl();
				endif;
				if(isset($_POST['Salvar'])):
					require_once ("classes/autoload.php");
					$conexao = new CadCliente();
					$conexao->CadastroCl();
				endif;
			?>
			<input type="submit" name="cancelar" value="Voltar" class="botao2">
			
		</div>	
	</div>	 
</form>
<script language='JavaScript'>
	$(function() {
	    $(".datepicker").datepicker({
	        dateFormat: 'dd/mm/yy',
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	    });
	});
	function SomenteNumero(e){
	    var tecla=(window.event)?event.keyCode:e.which;   
	    if((tecla>47 && tecla<58)) return true;
	    else{
	    	if (tecla==8 || tecla==0) return true;
		else  return false;
	    }
	}
</script>
<?php
require_once("includes/footer.php");
?>