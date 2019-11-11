<?php

include("conexao.php");
if(!isset($_SESSION))
  session_start();
$consulta = "SELECT * FROM funcionario WHERE username = '$_SESSION[usernameFunc]'";

$con = $mysqli->query($consulta) or die ($mysqli->error);

if(isset($_POST['confirmar'])) {
  //Registro dos dados

  if(!isset($_SESSION))
    session_start();
  foreach($_POST as $chave=>$valor)
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  

//validação dos dados

//Update no BD


  $sql_code = "UPDATE funcionario set 
  nome = '$_SESSION[nome]',
  sobrenome ='$_SESSION[sobrenome]', 
  idade = '$_SESSION[idade]', 
  sexo = '$_SESSION[sexo]',
  logradouro = '$_SESSION[logradouro]',
  numero = '$_SESSION[numero]', 
  complemento = '$_SESSION[complemento]',
  bairro = '$_SESSION[bairro]', 
  profissao = '$_SESSION[profissao]',
  email = '$_SESSION[email]'
  WHERE username = '$_SESSION[usernameFunc]'";

  $confirma = $mysqli->query($sql_code) or die ($mysqli->error);

  if($confirma){
    // unset(
    //   $_SESSION[nome],
    //   $_SESSION[sobrenome],
    //   $_SESSION[idade],
    //   $_SESSION[sexo],
    //   $_SESSION[logradouro],
    //   $_SESSION[numero],
    //   $_SESSION[complemento],
    //   $_SESSION[profissao],
    //   $_SESSION[email]);
    echo "<script> location.href='inicio.php'; </script";

  // } else
  // $erro[] = $confirma;

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
          <a class="nav-link" href="inicio.php"><img src="svg/home.svg"> <span class="sr-only">(página atual)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Consultas

          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="consultaClientes.php">Clientes</a>
            <a class="dropdown-item" href="consultaProcedimento.php">Procedimentos</a>
            <a class="dropdown-item" href="ConsultaHistorico.php">Histórico</a>
            <a class="dropdown-item" href="ConsultaFuncionario.php">Funcionários</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cadastro
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="CadastroCliente.php">Clientes</a>
            <a class="dropdown-item" href="CadastroProcedimento.php">Procedimentos</a>
            <a class="dropdown-item" href="CadastroTransacao.php">Recebimento</a>
            <a class="dropdown-item" href="CadastroAgendamento.php">Agendamento</a>
            <a class="dropdown-item" href="CadastroFuncionario.php">Funcionário</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="RelatorioProcedimentos.php">Procedimentos realizados</a>
            <a class="dropdown-item" href="RelatorioAtendimentos.php">Atendimentos</a>
            <a class="dropdown-item" href="RelatorioReceitas.php">Receita Mensal</a>
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
        <a class="dropdown-item" href="perfil.php">Meus Dados</a>
        <a class="dropdown-item" href="alterarsenha.php">Mudar Senha</a>
        <a class="dropdown-item" href="index.php">Logout</a>
      </div>
    </li>


  </li>
</ul>
</div>
</nav>

</header>

<div class="container">
  <div class="MyProfile">
    <h1>Meu perfil</h1>
  </div>

  <hr>
  <!-- edit form column -->
  <div class="col-sm-12 personal-info article-inicio row">

   <form class="formCadastroN" action="perfil.php?p=confirmar" method="POST">




    <!---------------------------------------------------  -->


    <div class="row">
      <div class="column">
        <div class="form-group">
         <label class="col-lg-3 control-label">Nome</label>
         <div class="col-lg-8">
           <?php while ($dado = $con->fetch_array()) { ?>
            <input class="form-control" type="text" name="nome" required="true" value="<?php echo $dado["nome"] ?>">
          </div>


          <div class="form-group">
            <label class="col-lg-3 control-label">Sobrenome</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="sobrenome" required="true" value="<?php echo $dado["sobrenome"] ?>">

            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-3 control-label">Idade</label>
            <div class="col-lg-8">

              <input class="form-control" type="text" name="idade" required="true" id="idade" value="<?php echo $dado["idade"] ?>">
            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-3 control-label">CPF</label>
            <div class="col-lg-8">
              <!-- <input class="form-control" type="text" name="idade" id="idade"> -->
              <input class="form-control" type="text" name="idade" required="true" id="idade" value="<?php echo $dado["cpf"] ?>" disabled>
            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-3 control-label">Sexo</label>
            <div class="col-lg-8">
              <select class="col-lg-3 form-control" id="exampleFormControlSelect1"  name="sexo" value="<?php echo $dado["sexo"] ?>">
                <option selected=""></option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
              </select>
            </div>
          </div>

        </div>

      </div>

      <div class="column">
        <div class="form-group">
          <label class="col-lg-3 control-label">Logradouro</label>
          <div class="col-lg-8">
            <!-- <input class="form-control" type="text" name="logradouro"> -->
            <input class="form-control" type="text" name="logradouro" required="true" value="<?php echo $dado["logradouro"] ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Numero</label>
          <div class="col-lg-8">
            <!-- <input class="form-control" type="text" name="numero"> -->
            <input class="form-control" type="text" name="numero" required="true" value="<?php echo $dado["numero"] ?>">
          </div>
        </div>

        <div class="form-group">
         <label class="col-lg-3 control-label">Complemento</label>
         <div class="col-lg-8">
          <!-- <input class="form-control" type="text" name="complemento"> -->
          <input class="form-control" type="text" name="complemento" required="true" value="<?php echo $dado["complemento"] ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-3 control-label">Bairro</label>
        <div class="col-lg-8">

          <input class="form-control" type="text" name="bairro" required="true" value="<?php echo $dado["bairro"] ?>">
        </div>
      </div>


      <div class="form-group">
        <label class="col-lg-3 control-label">Profissão</label>
        <div class="col-lg-8">
          <!-- <input class="form-control" type="text" name="profissao"> -->
          <input class="form-control" type="text" name="profissao" required="true" value="<?php echo $dado["profissao"] ?>">
        </div>
      </div>
      <div class="form-group">
                <label class="col-lg-3 control-label">Email</label>

        <div class="col-lg-8">
        <!-- <input class="form-control" type="text" name="email"> -->
        <input class="form-control" type="text" name="email" required="true" value="<?php echo $dado["email"] ?>">
      </div>
      </div>
      <div id="msgemail"></div>
    </div>

    <div class="form-group ajustebotao">
      <label class = "col-md-5 control-label"></label>

      <input class="btn btn-primary" value="Salvar" type="submit" name="confirmar">
      <span></span>
      <input type="reset" class="btn btn-default" value="Cancelar">
    </div>
  </div>
<?php  } ?>

</div>
</form>
</div>
</div>
</body>
</html>

