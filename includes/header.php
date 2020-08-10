<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?php echo $titulo;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="shortcut icon" href="_imagens/icone_site.png">
  <link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
  <link rel="stylesheet" type="text/css" href="_css/crud.css"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
</head>
<body>
  <input type="checkbox" id="bt_menu">
  <label for="bt_menu" class="bt_menu">&#9776;</label>
  <nav class="menu_index">
    <ul>
        <li id="cad"><form  method="POST" action=""><input id="f_menu" type="submit" name="logout" value="Logout"></form></li>
      </li>
      <li><a class="naoSele">Veículos</a> 
        <ul>
          <li id="borda"><a href="cadastroVeiculo.php">Cadastrar</a></li>
          <li><a href="selectVeiculo.php?class=TblVeiculoList">Todos</a></li>
        </ul>
      </li>
      <li><a class="naoSele">Cadastrar</a>
        <ul>
          <li id="borda"><a href="cadastroadmin.php">Administrador</a></li>
          <li><a href="cadastroCliente.php">Cliente </a></li>
        </ul>
      </li>
      <li><a class="naoSele">Consultar</a>
        <ul>
          <li id="borda"><a href="selectAdmin.php?class=TblAdminList">Administrador</a></li>
          <li><a href="selectClientes.php?class=TblClientList">Clientes</a></li>
        </ul>
      </li>
      <li><a class="naoSele">Locação</a>
        <ul>
          <li id="borda"><a href="locacao.php?class=NewLocacao">Nova locação</a></li>
          <li><a href="selectLocacao.php">Consultar</a></li>
        </ul>
      </li>
    </ul>
    <div class="logo">
      <a class="logo_link" href="index.php">Locadora Caetité</a>
    </div>
  </nav>
  

  

  