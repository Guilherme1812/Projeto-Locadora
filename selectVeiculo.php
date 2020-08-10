<?php
	$titulo = "Veículos";
	require_once ("controller/controllerLogin.php");
	require_once("classes/autoload.php");
	require_once("includes/header.php");

?>
<div class="container_pai">
	<div class="container_left">
		<form class="formulario_busca" method="post" action="">
			<label>Buscar por modelo</label>
			<input type="text" name="montadora" placeholder="Montadora">
			<input type="text" name="modelo" placeholder="Modelo">
			<input type="text" name="ano" maxlength="4" placeholder="Ano">
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
					$result = $select->selectDB("*", "veiculo", "order by montadora", array());
				}

			?>
		</form>
	</div>
	<div class="container_right">
		<table class="Admin_class" cellspacing="0">

			<th colspan="6">Veículos<?php
			if (isset($_SESSION['menssagemSucesso'])) :
				echo "<p id='sucesso'>" .$_SESSION['menssagemSucesso']."</p>"?>
		<?php unset($_SESSION['menssagemSucesso']);endif;?></th>

			<tr id="tr_itens">
				<td>Montadora</td>
				<td>Modelo</td>
				<td>Ano</td>
				<td>Combustível</td>
				<td>Preço</td>
				<td>Opções</td>
			</tr>
			
			<?php
				if (isset($_POST['buscar'])) {

					
					$select = new Crud();
					$result = $select->selectDB("id, montadora, modelo, ano, combustivel, preco", "veiculo", "where montadora = ? || modelo = ? || ano= ? order by montadora", array($_POST['montadora'], $_POST['modelo'],$_POST['ano']));
					$rsultBusca = $result->rowCount();
					if($rsultBusca == 0 ):?>
						<th id="nRegistro" colspan="6">Nenhum registro encontrado!!!</th>
					<?php
					endif;				
					while ($Fetch = $result->fetch(PDO::FETCH_ASSOC)) {
					?>
					<tr>
						<td><?php echo $Fetch['montadora']?></td>
						<td><?php echo $Fetch['modelo']?></td>
						<td><?php echo $Fetch['ano']?></td>
						<td><?php echo $Fetch['combustivel']?></td>
						<td><?php echo "R$ ".number_format($Fetch['preco'],2, ',', '.')?></td>
						<td>
							<a href="<?php echo "cadastroVeiculo.php?id={$Fetch['id']}";?>"><img class="img_op" src="_imagens/edit.png" alt="Editar"></a>
							<a href="<?php echo "controller/controllerDeleteVeiculo.php?id={$Fetch['id']}";?>"><img class="img_op" src="_imagens/delete.png" alt="Deletar"></a>
						</td>
					</tr>
					<?php
					}
				}
				else{
					$select = new Crud();
					$result = $select->selectDB("*", "veiculo", "order by montadora", array());

					while ($Fetch = $result->fetch(PDO::FETCH_ASSOC)) :
					?>
					<tr>
						<td><?php echo $Fetch['montadora']?></td>
						<td><?php echo $Fetch['modelo']?></td>
						<td><?php echo $Fetch['ano']?></td>
						<td><?php echo $Fetch['combustivel']?></td>
						<td><?php echo "R$ ".number_format($Fetch['preco'],2, ',', '.')?></td>
						<td>
							<a href="<?php echo "cadastroVeiculo.php?id={$Fetch['id']}";?>"><img class="img_op" src="_imagens/edit.png" alt="Editar"></a>			
							<a href="<?php echo "controller/controllerDeleteVeiculo.php?id={$Fetch['id']}";?>"><img class="img_op" src="_imagens/delete.png" alt="Deletar"></a>
						</td>
					</tr>	
				<?php 
					endwhile;
				}
			?>
		</table>
	</div>
</div>




<?php
	require_once("includes/footer.php");
?>