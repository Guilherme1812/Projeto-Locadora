<?php
	$titulo = "Nova Locação";
	$tituloForm = "Nova Locação";
	require_once ("controller/controllerLogin.php");
	//require_once("classes/autoload.php");
	require_once("includes/header.php");

	$calcular = filter_input(INPUT_POST,'calc', FILTER_SANITIZE_STRING);
	if ($calcular) {
		$recebeDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		$erro = false;
					
		$datLo = $recebeDados['dtlocacao'];
		$datEn = $recebeDados['dtentrega'];
		
		if(in_array('', $recebeDados)){
			$_SESSION['menssagem'] = "Preencha todos os campos corretamente!";	
		}
		elseif(isset($recebeDados['sClient']) && isset($recebeDados['sVeiculo'])){
			$nome = $recebeDados['sClient'];
			$veiculo = $recebeDados['sVeiculo'];
		}else{
			$_SESSION['menssagem'] = "Selecione um cliente e um veículo!";
		}
		$crud = new Crud();
		$BFetch = $crud->selectDB("situacao", "locacao", "where id_cliente = ?", array($nome));
		
		while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)) : 
			if($Fetch['situacao'] == "Andamento"){
				$menssagem = "Este cliente tem uma locação em andamento!";
				$erro = true;
				
				
				//header("Location:locacao.php");
				//header("location:cadastroadmin.php");
			}
		endwhile;
		$datLocacao = $recebeDados['dtlocacao'];
		$datEntrega = $recebeDados['dtentrega'];

		date_default_timezone_set('America/Sao_Paulo');
		$data1 = str_replace("/", "-", $datLocacao);
		$data_inicial = date('Y-m-d', strtotime($data1));

		$data2 = str_replace("/", "-", $datEntrega);
		$data_final = date('Y-m-d', strtotime($data2));
		
		
		// Calcula a diferença em segundos entre as datas
		$difDias = strtotime($data_final) - strtotime($data_inicial);

		//Calcula a diferença em dias
		$dias = floor($difDias / (60 * 60 * 24));

		
		$crud = new Crud();
		$BFetch=$crud->selectDB("*", "veiculo", "where id= ?", array($veiculo));
		$Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
		$preco = $Fetch['preco'];
		$veiculoSelect = $Fetch['montadora']." ".$Fetch['modelo']." ". $Fetch['ano']." ".$Fetch['combustivel']." "."R$  ".$Fetch['preco']. " por dia";
		$valor = $dias*$preco;
		$valorTotal = number_format($valor, 2, ',', '.');
		$crud = new Crud();
		$BFetch=$crud->selectDB("nome, sobrenome, rua", "clientes", "where id= ?", array($nome));
		$Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
		$clienteSelct = $Fetch['nome']." ".$Fetch['sobrenome']." ".$Fetch['rua'];
		$situacao = "Andamento";
		$acao = "Cadastrar";

		$_SESSION['dados'] = array($nome, $veiculo, $data_inicial, $data_final, $situacao, $valorTotal,$acao );		
	}else{
		$datLo = "";
		$datEn = "";
		$valorTotal = "0,00";
		$nome = "";
		$veiculo ="";
		$clienteSelct = "Selecione";
		$veiculoSelect = "Selecione";
	}
	$confirmar = filter_input(INPUT_POST,'concluir', FILTER_SANITIZE_STRING);
	if ($confirmar) {
		header("Location:controller/controllerCadLocacao.php");
	}

?>
<form method="post" action="" class="form" id="form_loc">
	<h1><?php echo $tituloForm?></h1>
	<div class="input-container">
		<input type="hidden" name="Acao" value="Cadastrar">
		<?php 
				if (isset($menssagem)) {
					echo "<p id='erro'>" .$menssagem."</p>";
				}
			?>
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

			
		<label id="carro">Cliente
			<select name="sClient" class="location" id="sclient" required="required">
				<option value="<?php echo $nome; ?>"><?php echo $clienteSelct; ?></option>
				<?php
				$crud = new Crud();
				$BFetch=$crud->selectDB("*", "clientes", "order by nome", array());
				while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)){
				?>
				<option name="nClient"  value="<?php echo $Fetch['id']?>"><?php echo  $Fetch['nome']." ".$Fetch['sobrenome']." ---"." Endereço: ".$Fetch['rua'];?></option>
				<?php }?>
			</select>
		</label>
	</div>
	<div class="input-container">
		<label id="carro">Carro
			<select name="sVeiculo" class="location" id="sVeiculo" required="required">
				<option value="<?php echo $veiculo; ?>"><?php echo $veiculoSelect; ?></option>
				<?php
				$crud = new Crud();
				$BFetch=$crud->selectDB("*", "veiculo", "order by modelo", array());
				while ($Fetch = $BFetch->fetch(PDO::FETCH_ASSOC)){
				?>
				<option value="<?php echo $Fetch['id']?>"><?php echo  $Fetch['montadora']."_".$Fetch['modelo']."_". $Fetch['ano']."_".$Fetch['combustivel']."_"."R$  ".$Fetch['preco']. " por dia";?></option>
				<?php }?>
			</select>
		</label>
	</div>
	<div class="input-container">
		<input type="text" name="dtlocacao" id="datLocacao" class="datepicker" required="required" placeholder="Data de Locação" value="<?php echo $datLo; ?>"  />
	</div>
	<div class="input-container">
		<input type="text" name="dtentrega" id="datEntrega" class="datepicker" required="required" placeholder="Data de Entrega" value="<?php echo $datEn; ?>"  />
	</div>
	<label id="carro"> Valor Total
		<div class="input-container">
			<p id="valor"> <?php echo "R$ ".$valorTotal;?>
		</div>
	</label>
	<div class="botao1" align="center">
		<input type="submit" name="calc" value="Calcular" class="botao">	
		<?php if(!isset($_POST['calc'])){?>
			<input type="submit" name="concluir" value="Concluir Locação" class="botao2" disabled="disabled">
		<?php	
			}elseif(isset($menssagem)){ ?>
				<input type="submit" name="concluir" value="Concluir Locação" class="botao2" disabled="disabled">
			<?php
			 unset($menssagem);
			 
			}else{?>
				<input type="submit" name="concluir" value="Concluir Locação" class="botao2">
		<?php
			}
		?>
		
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
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	        minDate: new Date()
	        
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