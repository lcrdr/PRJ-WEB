<?php

include("conexao.php");

if(isset($_POST['confirmar']))
  //Registro dos dados

  if(!isset($_SESSION))
    session_start();

  foreach($_POST as $chave=>$valor)
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  

//Inserção no BD

  if(count($erro)==0){
    $sql_code = "INSERT INTO cliente (
    nome, 
    sobrenome, 
    idade, 
    sexo, 
    logradouro,
    numero, 
    complemento, 
    profissao, 
    email)
    VALUES(
    '$_SESSION[nome]',
    '$_SESSION[sobrenome]',
    '$_SESSION[idade]',
    '$_SESSION[sexo]',
    '$_SESSION[logradouro]',
    '$_SESSION[numero]',
    '$_SESSION[complemento]',
    '$_SESSION[profissao]',
    '$_SESSION[email]'
  )";

  $confirma = $mysqli->query($sql_code) or die ($mysqli->error);

  if($confirma){
    unset(
      $_SESSION[nome],
      $_SESSION[sobrenome],
      $_SESSION[idade],
      $_SESSION[sexo],
      $_SESSION[logradouro],
      $_SESSION[numero],
      $_SESSION[complemento],
      $_SESSION[profissao],
      $_SESSION[email]);

    sleep(4);
    echo "<script> location.href='consultaClientes.php'; </script";
  } else{
    $erro[] = $confirma;
  }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>

  <header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navbar-nav" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="inicio.html"><img src="svg/home.svg"> <span class="sr-only">(página atual)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Consultas

          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="consultaClientes.html">Clientes</a>
            <a class="dropdown-item" href="consultaProcedimento.html">Procedimentos</a>
            <a class="dropdown-item" href="ConsultaHistorico.html">Histórico</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cadastro
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="CadastroCliente.html">Clientes</a>
            <a class="dropdown-item" href="CadastroProcedimento.html">Procedimentos</a>
            <a class="dropdown-item" href="CadastroTransacao.html">Recebimento</a>
            <a class="dropdown-item" href="CadastroAtendimento.html">Agendamento</a>
            <a class="dropdown-item" href="CadastroFuncionario.html">Funcionário</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="RelatorioProcedimentos.html">Procedimentos realizados</a>
            <a class="dropdown-item" href="RelatorioAtendimentos.html">Atendimentos</a>
            <a class="dropdown-item" href="RelatorioReceitas.html">Receita Mensal</a>
          </div>
        </li>
      </li>
    </ul>

    <ul class="nav navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img src="svg/person.svg">
       </a>
       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="perfil.html">Meus Dados</a>
        <a class="dropdown-item" href="alterarsenha.html">Mudar Senha</a>
        <a class="dropdown-item" href="index.html">Logout</a>
      </div>
    </li>
  </li>
</ul>
</div>
</nav>

</header>


<div class="container">
  <div class="MyProfile">
    <h1>Novo Cliente</h1>
    <?php 
    if(count($erro) > 0){ 
      echo "<div class='erro'>"; 
      foreach($erro as $valor) 
        echo "$valor <br>"; 

      echo "</div>"; 
    }
    ?>
  </div>

  <hr>
  <!-- edit form column -->
  <div class="col-md-9 personal-info">

    <form class="form-horizontal" action="CadastroCliente.php?p=cadastrar" method="POST">
      <div class="form-group">
        <label class="col-lg-3 control-label">Nome</label>
        <div class="col-lg-8">
          <input class="form-control" type="text" name="nome" required="true" >
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Sobrenome</label>
        <div class="col-lg-8">
          <input class="form-control" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Sexo</label>
        <div class="col-lg-8">
          <select class="col-lg-3 form-control" id="exampleFormControlSelect1">
            <option>Masculino</option>
            <option>Feminino</option>
            <option>Outro</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Logradouro</label>
        <div class="col-lg-8">
          <input class="form-control" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Numero</label>
        <div class="col-lg-8">
          <input class="form-control" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Complemento</label>
        <div class="col-lg-8">
          <input class="form-control" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Profissão</label>
        <div class="col-lg-8">
          <input class="form-control" type="text" value="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Email</label>
        <div class="col-lg-8">
          <input class="form-control" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class = "col-md-3 control-label"></label>
        <div class="col-md-8">
          <input type="button" class="btn btn-primary" value="Salvar" type="submit" name="confirmar">
          <span></span>
          <input type="reset" class="btn btn-default" value="Cancelar">
        </div>
      </div>
    </form>
  </div>
</div>
</body>


