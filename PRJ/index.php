<?php
session_start();

include("conexao.php");

//registro dos dados
if(isset($_POST['logar'])) {

  foreach($_POST as $chave=>$valor)
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);


  $result = mysqli_query($mysqli, "SELECT password FROM funcionario WHERE funcionario.username ='$_SESSION[usernameFunc]' AND funcionario.password = '$_SESSION[passwordFunc]'");

  $getNome = mysqli_query($mysqli, "SELECT nome FROM funcionario WHERE funcionario.username ='$_SESSION[usernameFunc]'");

  if (mysqli_num_rows($result) == 1) {
   $sql_getData = "SELECT *FROM funcionario WHERE funcionario.username ='$_SESSION[usernameFunc]'";
   $_SESSION['erro'] = "Certo";

   echo "<script> location.href='inicio.php'; </script>";
 } else {
  $_SESSION['erro'] = "Errado";
  header("location: index.php");

}
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Laroze</title>

  <!-- Bootstrap -->

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="css/estilo.css" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $("inputPassword").hide();
    });
  </script>
  <style type="text/css">
    .desabilitado {
      visibility: hidden;
    }
    .habilitado{
      visibility: visible;
    }

  </style>
</head>
<body id="body-index">
  <?php 
  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="text-center fixed">
         <img src="img/image.png" class="img-fluid" style="height: 400px; width: 400px;">
       </div>
       <div class="card card-signin my-5 d-flex">
        <div class="card-body ">
          <?php 

          if (isset($_SESSION['erro'])) {
           if( $_SESSION['erro'] == "Errado"){
            echo  "<label name='erroLogin' class='erroLogin'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspE-mail ou senha incorretos</label>";
          }

        }


          // if($_SESSION['erro'] != "Errado" || $_SESSION['erro'] != "Certo"){
          //   $_SESSION['erro'] = "";
          // }

        ?>
          <h5 class="card-title text-center">Entrar</h5>
        <form class="form-signin" action="index.php?p=logar" method="post">
          <div class="form-label-group">
            <input type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="usernameFunc">
            <label for="inputEmail">Usuario</label>
          </div>

          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="passwordFunc" required>
            <label for="inputPassword">Senha</label>
          </div>
          <input class="btn btn-lg btn-primary btn-block text-uppercase" value="Login" type="submit" name="logar" id="btn-logar">
          <hr class="my-4">
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</body>