<?php

include("conexao.php");

$consulta = "SELECT * FROM cliente";

$con = $mysqli->query($consulta) or die ($mysqli->error);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Clientes</title>

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

<article>
  <div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
      <h1>Clientes</h1>
    </div>

    <div class="active-pink-3 active-pink-4 mb-4">
      <input class="form-control" type="text" placeholder="Ex: Ana Clara" aria-label="Search">
      <button type="button" class="btn btn-primary mb-2">Pesquisar</button>
    </div>

    <table class="table table-striped  table-bordered table-hover table-condensed">
      <thead class="thead-light">
        <tr>
          <td>Nome</td>
          <td>Sobrenome</td>
          <td>Idade</td>
          <td>Sexo</td>
          <td>Logradouro</td>
          <td>Numero</td>
          <td>Complemento</td>
          <td>Profissao</td>
          <td>Email</td>
          <td>ID</td>
        </tr>
      </thead>
      <tbody>
        <?php while ($dado = $con->fetch_array()) { ?>
        <tr class="table-hover">
        <td><?php echo $dado["nome"]; ?></td>
        <td><?php echo $dado["sobrenome"]; ?></td>
        <td><?php echo $dado["idade"]; ?></td>
        <td><?php echo $dado["sexo"]; ?></td>
        <td><?php echo $dado["logradouro"]; ?></td>
        <td><?php echo $dado["numero"]; ?></td>
        <td><?php echo $dado["complemento"]; ?></td>
        <td><?php echo $dado["profissao"]; ?></td>
        <td><?php echo $dado["email"]; ?></td>
        <td><?php echo $dado["id"]; ?></td>
        </tr>
        <?php  } ?>
      </tbody>
    </table>
  </div>
</article>

</body>
</html>