<?php
	$titulo = "Locações";
	require_once ("controller/controllerLogin.php");
	require_once("classes/autoload.php");
	require_once("includes/header.php");

?>
<div class="container_pai">
	<div class="container_left">
		<form class="formulario_busca" method="post" action="">
			<label id="carro">Buscar por cliente</label>
			<input type="text" name="clienteN" placeholder="Nome">
			<input type="text" name="clienteS" placeholder="Sobrenome">
			<label id="carro"> Situação da locação
				<select  class="busca" name="situacao">
					<option value="" disabled="disabled" selected="selected">Selecione</option>
					<option value="Andamento">Andamento</option>
					<option value="Concluído">Concluído</option>
				</select>
			</label>
			<input type="submit" name="buscar" value="Buscar"class="botao">
			<?php 
				if(isset($_POST['buscar'])):
			?>
				<input type="submit" name="voltar" value="Voltar" class="botao">
			<?php
				endif;
			?>
			<?php 
				if(isset($_POST['voltar'])){
					$select = new Crud();
					$result = $select->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id order by nome", array());
				}
			?>

		</form>
	</div>
	<div class="container_right">
		<table class="Admin_class" cellspacing="0">
			<?php
			if (isset($_SESSION['menssagemSucesso'])) :
				echo "<p id='sucesso'>" .$_SESSION['menssagemSucesso']."</p>"?>
		<?php unset($_SESSION['menssagemSucesso']);endif;?>
			<th colspan="5">Locações</th>
			<tr id="tr_itens">
				<td>Nome</td>
				<td>Sobrenome</td>
				<td>Veículo</td>
				<td>Status</td>
				<td>Opções</td>
			</tr>
			
			<?php
				if (isset($_POST['buscar'])) {
					
					$select = new Crud();
					$result = $select->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id  where nome = ? || sobrenome = ? || situacao = ? order by nome ", array($_POST['clienteN'], $_POST['clienteS'],$_POST['situacao']));
					$rsultBusca = $result->rowCount();
					if($rsultBusca == 0 ):?>
						<th id="nRegistro" colspan="5">Nenhum registro encontrado!!!</th>
					<?php
					endif;				
					while ($Fetch = $result->fetch(PDO::FETCH_ASSOC)) {//Arrumar a parte de deletar o admin e os clientes
					?>
					<tr>
						<td><?php echo $Fetch['nome']?></td>
						<td><?php echo $Fetch['sobrenome']?></td>
						<td><?php echo $Fetch['modelo']?></td>
						<td><?php echo $Fetch['situacao']?></td>
						<td>
							<a href="<?php echo "visualizarCliente.php?id={$Fetch['id_locacao']}";?>"><img class="img_op" src="_imagens/abrir.png" alt="Visualizar"></a>
							<a href="<?php echo "editLocacao.php?id={$Fetch['id_locacao']}";?>"><img class="img_op" src="_imagens/edit.png" alt="Editar"></a>
							<a href="<?php echo "controller/controllerDeleteLocacao.php?id={$Fetch['id_locacao']}";?>"><img class="img_op" src="_imagens/delete.png" alt="Deletar"></a>
						</td>
					</tr>
					<?php
					}
				}
				else{
					$select = new Crud();
					$result = $select->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id order by nome", array());

					while ($Fetch = $result->fetch(PDO::FETCH_ASSOC)):?>

					<tr>
						<td><?php echo $Fetch['nome']?></td>
						<td><?php echo $Fetch['sobrenome']?></td>
						<td><?php echo $Fetch['modelo']?></td>
						<td><?php echo $Fetch['situacao']?></td>
						<td>
							<a href="<?php echo "visualizarCliente.php?id={$Fetch['id_locacao']}&clientid={$Fetch['id_cliente']}";?>"><img class="img_op" src="_imagens/abrir.png" alt="Visualizar"></a>
							<a href="<?php echo "editLocacao.php?id={$Fetch['id_locacao']}";?>"><img class="img_op" src="_imagens/edit.png" alt="Editar"></a>
							<a href="<?php echo "controller/controllerDeleteLocacao.php?id={$Fetch['id_locacao']}";?>"><img class="img_op" src="_imagens/delete.png" alt="Deletar"></a>
						</td>
					</tr>
				<?php 
					endwhile;}
				
			?>
		</table>
	</div>
</div>
<?php
	require_once("includes/footer.php");
?>