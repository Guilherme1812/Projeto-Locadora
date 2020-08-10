<?php

	$titulo = "Informações do Cliente";
	require_once ("controller/controllerLogin.php");
	require_once("classes/autoload.php");
	require_once("includes/header.php");
?>
<?php
	$crud = new Crud();
	$infoClient = $crud->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id  where id_locacao = ? ", array($_GET['id']));


	$historyClient = $crud->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id  where id_cliente = ? ", array($_GET['clientid']));

	
?>
<div class="div_link_voltar">
	<button class="botao_link" onclick="history.go(-1);">Voltar</button>
</div>
<div class="sobre_client">
	Sobre o Cliente
	<hr>
</div>

<div class="container_pai">
	<div class="container_tbl_dados">
		<table class="open_Cliente" cellspacing="0">
			<th colspan="4"> Informações <hr id="inform"></th>
			<?php
				$locacaoAtual = 0;
				while ($Fetch = $infoClient->fetch(PDO::FETCH_ASSOC)) :
					if($Fetch['situacao'] != "Andamento"){
						$locacaoAtual = "Não possui!";
					}else{
						$locacaoAtual = $Fetch['modelo'];
					}
			?>
			<tr>
				<td id="campo">Nome</td>
				<td><?php echo $Fetch['nome'];?></td>
				<td id="campo">Sobrenome</td>
				<td><?php echo $Fetch['sobrenome'];?></td>
			</tr>
			
			<tr>
				<td id="campo">Nascimento</td>
				<td><?php echo date('d/m/Y', strtotime($Fetch['dtnascimento']));?></td>
				<td id="campo">CPF</td>
				<td><?php echo $Fetch['cpf'];?></td>
			</tr>
			<tr>
				<td id="campo">Telefone</td>
				<td><?php echo $Fetch['fone'];?></td>
				<td id="campo">Email</td>
				<td><?php echo $Fetch['email'];?></td>
			</tr>
			<tr>
				<td id="campo">Cidade</td>
				<td><?php echo $Fetch['cidade'];?></td>
				<td id="campo">Rua</td>
				<td><?php echo $Fetch['rua'];?></td>
			</tr>
			<tr>
				<td id="campo">Número</td>
				<td><?php echo $Fetch['numero'];?></td>
				<td id="campo">Locação Atual</td>
				<td><?php echo $locacaoAtual;?></td>
			</tr>
			<?php
				endwhile;
			?>	
		</table>
	</div>
	<div class="container_tbl_history"> 
		<table class="history_client" cellspacing="0">
			<th colspan="4"> Histórico de locações <hr id="inform"> </th>
			<tr>
				<td id="campo">Veículos</td>
				<td id="campo">Data Locação</td>
				<td id="campo">Data Devolução</td>
				<td id="campo">Valor Gasto</td>
			</tr>
			<?php 
				$valor_gt = 0;
				while ($FetchHistorico = $historyClient->fetch(PDO::FETCH_ASSOC)) :
					$valor_gt += $FetchHistorico['valor_pago'];		
			?>
			<tr>
				<td><?php echo $FetchHistorico['modelo'];?></td>
				<td><?php echo date('d/m/Y', strtotime($FetchHistorico['dtlocacao']));?></td>
				<td><?php echo date('d/m/Y', strtotime($FetchHistorico['dtentrega']));?></td>
				<td><?php echo "R$ ". number_format($FetchHistorico['valor_pago'], 2,',','.');?></td>
			</tr>
			<?php 
				endwhile; 
			?>
			<tr>
				<td colspan="2" id="v_total">
				Total gasto pelo cliente
				</td>
				<td colspan="2" id="v_total"><?php echo "R$ ". number_format($valor_gt, 2, ",", "."); ?></td>
			</tr>
		</table> 
	</div>
</div>

<?php
	require_once("includes/footer.php");
?>