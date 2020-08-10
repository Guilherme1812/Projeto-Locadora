<?php 
  $titulo = "Página Inicial";
  require_once("classes/autoload.php");
  require_once("includes/header.php");
  require_once ("controller/controllerLogin.php");

  $select = new Crud();
  $resulta = $select->selectDB("count(id) as total", "veiculo", "where id =id", array());
  $FetchVeiculo = $resulta->fetch(PDO::FETCH_ASSOC) ;
  
  $resulta = $select->selectDB("count(id) as total", "clientes", "where id =id", array());
  $FetchCliente = $resulta->fetch(PDO::FETCH_ASSOC) ;

  $resulta = $select->selectDB("count(id_locacao) as total", "locacao", "where id_locacao =id_locacao", array());
  $FetchLocacao = $resulta->fetch(PDO::FETCH_ASSOC) ;

  $resulta = $select->selectDB("*", "clientes", "join locacao on clientes.id = locacao.id_cliente join veiculo on locacao.id_veiculo = veiculo.id order by id_locacao desc", array());
  $FetchLastLocacao = $resulta->fetch(PDO::FETCH_ASSOC) ;



?>
<h1> DASHBOARD</h1>
<div class="principal">
  <div class="carro">
    <table class="table_dash"> 
      <tr>
        <th>Total de Carros</th>
      </tr>
      <tr>
        <td><?php echo $FetchVeiculo['total'];?></td>
      </tr>
    </table>
  </div>
  <div class="cliente">
    <table class="table_dash"> 
      <tr>
        <th>Clientes</th>
      </tr>
      <tr>
         <td><?php echo $FetchCliente['total'];?></td>
      </tr>
    </table>
  </div>
  <div class="locacao">
    <table class="table_dash"> 
      <tr>
        <th>Locações</th>
      </tr>
      <tr>
        <td><?php echo $FetchLocacao['total'];?></td>
      </tr>
    </table>
  </div>
  <div class="ultimaloc">
    <table class="table_dash"> 
      <tr>
        <th>Ultima Locação</th>
      </tr>
      <tr>
        <td><?php echo $FetchLastLocacao['nome']. " -- ". $FetchLastLocacao['modelo'];?></td>
      </tr>
    </table>
  </div>
</div>
<div class="conteudo">
 
</div>



  <!---<table class="dashboard">
    <th> DASHBOARD</th>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
 
  </table>-->
    
<?php
  require_once("includes/footer.php");
?>