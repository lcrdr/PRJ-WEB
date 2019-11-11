<?php

include("conexao.php");
//registro dos dados
if(isset($_POST['confirmar'])) {
  //Registro dos dados

  if(!isset($_SESSION))
    session_start();

  foreach($_POST as $chave=>$valor)
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  

//validação dos dados

  if(strlen($_SESSION['nomeProc'])==0){
    $erro[]="Preencha o nome";
  }  
//Inserção no BD

  // if(count($erro)==0){
  $sql_code = "INSERT INTO procedimento (
  nome, 
  valor, 
  duracao, 
  observacao)
  VALUES(
  '$_SESSION[nomeProc]',
  '$_SESSION[valorProc]',
  '$_SESSION[duracao]',
  '$_SESSION[observacao]'
)";

$confirma = $mysqli->query($sql_code) or die ($mysqli->error);

  // if($confirma){
    // unset(
    //   $_SESSION[nomeProc],
    //   $_SESSION[valor],
    //   $_SESSION[duracao],
    //   $_SESSION[observacao]);

echo "<script> location.href='consultaProcedimento.php'; </script>";

  // } else
  // $erro[] = $confirma;

// }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Cadastro</title>

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
  <script type="text/javascript">
    $('.dinheiro').mask('#.##0,00', {reverse: true});
  </script>
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
    <h1>Novo Procedimento</h1>
  </div>

  <hr>
  <!-- edit form column -->
  <div class="col-sm-12 personal-info article-inicio row">

    <form class="formCadastroN" action="CadastroProcedimento.php?p=cadastrar" method="POST" name="formCadastro">
      <!-- <div class="form-group">
        <label class="col-lg-3 control-label">Nome</label>
        <div class="col-lg-8">
          <input class="form-control" type="text" name="nomeProc">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Valor a ser cobrado</label>
        <div class="col-lg-8">
          <label for="dinheiro">R$</label>
          <input type="text" class="dinheiro form-control" style="display:inline-block" name="valorProc" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-3 control-label">Duração (Horas)</label>
        <div class="col-lg-8">
          <input type="text" id="dinheiro" class="dinheiro form-control" style="display:inline-block" name="duracao" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-lg-3 control-label">Observação</label>
        <div class="col-lg-8">
 
         <textarea class="form-control" rows="5" id="comment" name="observacao"></textarea>
            
          </textarea>
        </div>
      </div>

      <div class="form-group">
        <label class = "col-md-3 control-label"></label>
        <div class="col-md-8">
          <input type="submit" class="btn btn-primary" value="Salvar" name="confirmar">
          <span></span>
          <input type="reset" class="btn btn-default" value="Cancelar">
        </div>
      </div> -->

      <div class="row">
        <div class="column">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nome</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="nomeProc">
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Valor a ser cobrado</label>
              <div class="col-lg-8">
                <label for="dinheiro">R$</label>
                <input type="text" class="dinheiro form-control" style="display:inline-block" name="valorProc" />
              </div>
            </div>
            <div class="form-group">
             <label class="col-lg-3 control-label">Duração (Horas)</label>
             <div class="col-lg-8">
              <input type="text" id="dinheiro" class="dinheiro form-control" style="display:inline-block" name="duracao" />
            </div>
          </div>
        </div>

      </div>

      <div class="column">
        <div class="form-group">
          <label class="col-lg-3 control-label">Observação</label>
          <div class="col-lg-8">
           
           <textarea class="form-control" rows="5" id="comment" name="observacao"></textarea>
           
         </textarea>
       </div>
     </div>
     </div>

  <div class="form-group ajustebotao">
    <label class = "col-md-5 control-label"></label>

    <input class="btn btn-primary" value="Salvar" type="submit" name="confirmar">
    <span></span>
    <input type="reset" class="btn btn-default" value="Cancelar">
  </div>
</div>


</div>



</form>
</div>
</div>
</body>


