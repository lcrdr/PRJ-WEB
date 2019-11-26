<?php

include("conexao.php");

$consultaFuncRel = "SELECT nome, COUNT(*) as qtd FROM funcionario GROUP BY nome";
// $consultaQtd = "SELECT COUNT(*) as conta from cliente";

$conFunc = $mysqli->query($consultaFuncRel) or die ($mysqli->error);
// $conQTD = $mysqli->query($consultaQtd) or die ($mysqli->error);

$nomes = array();
$quantidades = array();

$quantidadeUsuarios = 0;

while ($dado = $conFunc->fetch_array()) {
  array_push($nomes, $dado["nome"]);
  array_push($quantidades, $dado["qtd"]);
  $quantidadeUsuarios++;

}



// while ($dado = $conQTD->fetch_array()) {
//   $quantidadeUsuarios = $dado["conta"];
// }



$value = sizeof($nomes);
$X = 80;
$Y = 40;

$consulta = "SELECT * FROM funcionario";

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

  $sql_code = "DELETE FROM funcionario WHERE funcionario.id ='$_SESSION[idexcluido]'";

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

    echo "<script> location.href='consultaFuncionario.php'; </script";

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

    // $sql_codeEdit = "SELECT *FROM cliente WHERE cliente.id ='$_SESSION[idEditarCliente]'";

    // $confirmaSelect = $mysqli->query($sql_codeEdit) or die ($mysqli->error);
    // $dadoFuncEdit = $_SESSION['idEditarFuncionario'];
    // if($confirmaSelect){
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

  echo "<script> location.href='editarFuncionario.php'; </script";

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
  <title>Procedimentos</title>

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
      doc.text('Total de funcionários:', 45, 50)
      doc.text('<?php echo $quantidadeUsuarios ?>', 105, 50)
      doc.text('Funcionários cadastrados no sistema', 55, 20)

      <?php for($i = 0; $i<$value;$i++){ ?>

        doc.text('<?php echo $nomes[$i] ?>', 40, <?php echo $X ?>)
        <?php $X = $X + 10; ?>
        <?php $Y = $Y + 10; ?>

      <?php  } ?>

      doc.addImage(img, 'png', 160, 0, 40, 40) 


      doc.save('RelatorioFunc.pdf')

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
      <h1>Funcionarios</h1>   
    </div>

    <label data-toggle="collapse" data-target="#div-relatorio">Relatório de funcionários cadastrados</label><br>
      <button onclick="geraRelatorio()">Gerar</button>
    
    <div class="article-inicio">
      <input id="myInput" onkeyup="myFunction()"  class="form-control" type="text" placeholder="Pesquise um cliente pelo seu nome" aria-label="Search" name="idexcluido"> <br>
      <table class="table table-striped  table-bordered table-hover table-condensed" id="myTable">
        <thead class="thead-light">
          <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>CPF</th>
            <th>Sexo</th>
            <th>Cargo</th>
            <th>Logradouro</th>
            <th>Numero</th>
            <th>Complemento</th>

            <th>Email</th>
            <th>ID</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($dado = $con->fetch_array()) { ?>
            <tr class="table-hover">
              <td><?php echo $dado["nome"]; ?></td>
              <td><?php echo $dado["sobrenome"]; ?></td>
              <td><?php echo $dado["cpf"]; ?></td>
              <td><?php echo $dado["sexo"]; ?></td>
              <td><?php echo $dado["cargo"]; ?></td>
              <td><?php echo $dado["logradouro"]; ?></td>
              <td><?php echo $dado["numero"]; ?></td>
              <td><?php echo $dado["complemento"]; ?></td>
              
              <td><?php echo $dado["email"]; ?></td>
              <td><?php echo $dado["id"]; ?></td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
  </div>
</article>


</body>
</html>