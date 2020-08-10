 <div class="logo">
      <a class="logo_link" href="index.php">Locadora Caetité</a>
    </div>
  </nav>



  <div class="menu_lateral">
    <ul>
      <li><p><a href="index.php"><img class="img_user" src="_imagens/icone_user.png" align="center"></a>
        <ul>
          <li id="01"><a href=""><?php $login_Name = new Login(); $login_Name->NameUser();?></a></li>
          <li id="user"><form  method="POST" action=""><input id="f_menu" type="submit" name="logout" value="Logout"></form></li>
        </ul>
      </li>
      <li id="02"><a class="naoSele">Veículos</a> 
        <ul>
          <li id="borda"><a href="cadastroVeiculo.php">Cadastrar</a></li>
          <li ><a href="selectVeiculo.php?class=TblVeiculoList">Todos</a></li>
        </ul>
      </li>
      <li id="03"><a class="naoSele">Cadastrar</a>
        <ul>
          <li id="borda"><a href="cadastroadmin.php">Administrador</a></li>
          <li><a href="cadastroCliente.php">Cliente </a></li>
        </ul>
      </li>
      <li id="04"><a class="naoSele">Consultar</a>
        <ul>
          <li id="borda"><a href="selectAdmin.php?class=TblAdminList">Administrador</a></li>
          <li><a href="selectClientes.php?class=TblClientList">Clientes</a></li>
        </ul>
      </li>
      <li id="05"><a class="naoSele">Locação</a>
        <ul>
          <li id="borda"><a href="locacao.php?class=NewLocacao">Nova locação</a></li>
          <li><a href="selectLocacao.php">Consultar</a></li>
        </ul>
      </li>
    </ul>
    <div class="logo" >
      <a class="logo_link" href="index.php">Locadora Caetité</a>
    </div>
  </div>
 