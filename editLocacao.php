<?php 
	$titulo = "Editar Locação";
	require_once ("controller/controllerLogin.php");
	require_once("classes/autoload.php");
	require_once("includes/header.php");

	$Acao="Editar";
	$tituloForm = "Editar Locação";
	$btForm = "Salvar";
	$crud = new Crud();
	$BFetch=$crud->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id where id_locacao = ?", array($_GET['id']));
	$Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);
	//echo json_encode($Fetch);
	$id= $Fetch['id_locacao'];
	$id_cliente= $Fetch['id_cliente'];
	$clienteSelct = $Fetch['nome']. " ". $Fetch['sobrenome']."_". " Endereço: ". $Fetch['rua'];
	$id_veiculo= $Fetch['id_veiculo'];
	$veiculoSelect = $Fetch['montadora']."_".$Fetch['modelo']."_". $Fetch['ano']."_".$Fetch['combustivel']."_"."R$  ".$Fetch['preco']. " por dia";
	$datLo= $Fetch['dtlocacao'];
	$datEn= $Fetch['dtentrega'];
	$valorTotal = $Fetch['valor_pago'];
	$situcao = $Fetch['situacao'];
	$confirmar = filter_input(INPUT_POST,'confir', FILTER_SANITIZE_STRING);
	if ($confirmar) {
		$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$crud = new Crud();
		
		try {
				
			$crud->updateDB("locacao", "situacao= ?", "id_locacao= ?", array($recebeDados['situacao'], $id));
			$_SESSION['menssagemSucesso'] = "Registro Editado com sucesso!";
			header("Location:selectLocacao.php");
		} catch (Exception $erro) {
			echo "Erro: ".$erro->getMessage();
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>teste</title>

	</script>
</head>
<body>
	<form method="post" action="" class="form" id="form_loc">
	<h1><?php echo $tituloForm?></h1>
	<input type="hidden" name="Acao" value="Editar">
	<div class="input-container">
		<?php 
				if (isset($_SESSION['menssagem'])) {
					echo "<p id='erro'>" .$_SESSION['menssagem']."</p>";
				}
			?>
			<?php unset($_SESSION['menssagem']); ?>
		<label id="carro">Cliente
			<select name="sClient" class="location" id="sclient" required="required" disabled="disabled">
				<option value="<?php echo $id_cliente; ?>"><?php echo $clienteSelct; ?></option>
				
			</select>
		</label>
	</div>
	<div class="input-container">
		<label id="carro">Carro
			<select name="sVeiculo" class="location" id="sVeiculo" required="required" disabled="disabled">
				<option value="<?php echo $id_veiculo; ?>"><?php echo $veiculoSelect; ?></option>
				
			</select>
		</label>
	</div>
	<div class="input-container">
		<input type="text" name="dtlocacao" id="datLocacao" class="datepicker" required="required" placeholder="Data de Locação" value="<?php echo $datLo; ?>"  disabled/>
	</div>
	<div class="input-container">
		<input type="text" name="dtentrega" id="datEntrega" class="datepicker" required="required" placeholder="Data de Entrega" value="<?php echo $datEn; ?>" disabled />
	</div>
	<label id="carro"> Valor Total
		<div class="input-container">
			<p id="valor"> <?php echo "R$ ".$valorTotal;?>
		</div>
	</label>
	<div class="input-container">
		<label id="carro">Situação
			<select name="situacao" class="location" id="situacao" required="required">
				<option value="<?php echo $situcao; ?>"><?php echo $situcao;?></option>
				<option value="Concluído">Concluído</option>
				
			</select>
		</label>
	</div>
	<div class="botao1" align="center">
		<input type="submit" name="confir" value="Confirmar" class="botao">	
		<input type="submit" name="voltar" value="Voltar" class="botao">
		<?php	
			if (isset($_POST['voltar']) & isset($_GET['id'])) {
				header("Location:selectLocacao.php");
			}
		?>
	</div>
</body>
</html>