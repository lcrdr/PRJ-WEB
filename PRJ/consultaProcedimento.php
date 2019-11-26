<?php

include("conexao.php");

$consultaProcedimentosRel = "SELECT procedimento, COUNT(*) as qtd FROM agendamento GROUP BY procedimento";
// $consultaQtd = "SELECT COUNT(*) as conta from cliente";

$conRelatorios = $mysqli->query($consultaProcedimentosRel) or die ($mysqli->error);
// $conQTD = $mysqli->query($consultaQtd) or die ($mysqli->error);

$nomes = array();
$quantidades = array();

$quantidadeUsuarios = 0;

while ($dado = $conRelatorios->fetch_array()) {
  array_push($nomes, $dado["procedimento"]);
    array_push($quantidades, $dado["qtd"]);

}



// while ($dado = $conQTD->fetch_array()) {
//   $quantidadeUsuarios = $dado["conta"];
// }



$value = sizeof($nomes);
$X = 60;
$Y = 40;

$consulta = "SELECT * FROM procedimento";

$con = $mysqli->query($consulta) or die ($mysqli->error);

if(isset($_POST['excluir'])) {
  //Registro dos dados

  if(!isset($_SESSION))
    session_start();

  foreach($_POST as $chave=>$valor)
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  

//validação dos dados

//Inserção no BD

  // if(count($erro)==0){

  $sql_code = "DELETE FROM procedimento WHERE procedimento.id ='$_SESSION[idexcluido]'";

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

    echo "<script> location.href='consultaProcedimento.php'; </script";

    // } else
    // $erro[] = $confirma;

  }

}


if(isset($_POST['editar'])) {
  //Registro dos dados

  if(!isset($_SESSION))
    session_start();

  foreach($_POST as $chave=>$valor)
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  

//validação dos dados

//Inserção no BD

  // if(count($erro)==0){

  $sql_codeEdit = "SELECT *FROM cliente WHERE cliente.id ='$_SESSION[idEditarProcedimento]'";

  $confirmaSelect = $mysqli->query($sql_codeEdit) or die ($mysqli->error);
  $dadoClienteEdit = $_SESSION['idEditarProcedimento'];
  if($confirmaSelect){
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

    echo "<script> location.href='editarProcedimento.php'; </script";

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
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Procedimentos</title>
  <script src="https://kit.fontawesome.com/ae97e36539.js" crossorigin="anonymous"></script>

  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

  <script type="text/javascript">
    function geraRelatorio(){
      var doc = new jsPDF()
      var img = new Image()
      img.src = 'img/image.png'

      //Gerar Nomes
      doc.text('Procedimentos realizados', 70, 20)
      doc.text('Nome do procedimento', 40, 40)
      doc.text('Quantidade', 140, 40  )


      <?php for($i = 0; $i<$value;$i++){ ?>

        doc.text('<?php echo $nomes[$i] ?>', 40, <?php echo $X ?>)
        doc.text('<?php echo $quantidades[$i] ?>', 150, <?php echo $X ?> )

        <?php $X = $X + 10; ?>
        <?php $Y = $Y + 10; ?>

      <?php  } ?>

              doc.addImage(img, 'png', 160, 0, 40, 40) 


      doc.save('RelatorioProcedimentos.pdf')

      //Listar total de usuários do sistema


}

      
    </script>

  <script type="text/javascript">

    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
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
        <!-- li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="RelatorioProcedimentos.php">Procedimentos realizados</a>
            <a class="dropdown-item" href="RelatorioAtendimentos.php">Atendimentos</a>
            <a class="dropdown-item" href="RelatorioReceitas.php">Receita Mensal</a>
          </div>
        </li> -->
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

<article>
  <div class="container">

    <div class="pb-2 mt-4 mb-2 border-bottom">
      <h1>Procedimentos</h1>
    </div>

   

    <form action="consultaProcedimento.php?p=excluir" method="POST">
      <label data-toggle="collapse" data-target="#div-pesquisar"> Excluir <i class="fas fa-chevron-down"></i></label>

      <div class="active-pink-3 active-pink-4 mb-4 collapse div-consulta" id="div-pesquisar">Deseja excluir algum procedimento? Insira o ID e clique em excluir.

        <input class="form-control" type="text" placeholder="Ex: 4" aria-label="Search" name="idexcluido"><br>

        <button class="btn btn-danger mb-2" name="excluir">Excluir</button>
      </div>
    </form>

    <form action="consultaProcedimento.php?p=editar" method="POST">
      <label data-toggle="collapse" data-target="#div-editar"> Editar <i class="fas fa-chevron-down"></i></label>

      <div class="active-pink-3 active-pink-4 mb-4 collapse div-consulta" id="div-editar">Deseja editar algum procedimento? Insira o ID e clique em excluir.

        <input class="form-control" type="text" placeholder="Ex: 4" aria-label="Search" name="idEditarProcedimento"><br>

        <button class="btn btn-primary mb-2" name="editar">Editar</button>
      </div>
    </form>

    <label data-toggle="collapse" data-target="#div-relatorio">Relatório de procedimentos realizados </label><br>
      <button onclick="geraRelatorio()">Gerar</button>
    
    <div class="article-inicio">
      <input id="myInput" onkeyup="myFunction()"  class="form-control" type="text" placeholder="Pesquise um procedimento pelo seu nome" aria-label="Search" name="idexcluido"> <br>
      <table class="table table-striped  table-bordered table-hover table-condensed" id="myTable">
        <thead class="thead-light">
          <tr>
            <th>Nome</td>
            <th>Valor Sugerido (R$)</td>
            <th>Duracao</td>
            <th>Observacao</td>
            <th>ID</td>
          </tr>
        </thead>
        <tbody>
          <?php while ($dado = $con->fetch_array()) { ?>
            <tr class="table-hover">
              <td><?php echo $dado["nome"]; ?></td>
              <td><?php echo $dado["valor"]; ?></td>
              <td><?php echo $dado["duracao"]; ?></td>
              <td><?php echo $dado["observacao"]; ?></td>

              <td><?php echo $dado["id"]; ?></td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
  </div>
</article>


