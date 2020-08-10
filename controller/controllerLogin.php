<?php 
  require_once ("classes/autoload.php");
  $vLogin = new Login();
  $vLogin->VerificaLogin();
  if (isset($_POST['logout'])): 
    $vLogin = new Login();
    $vLogin->Logout();
  endif;
?>