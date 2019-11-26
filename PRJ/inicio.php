<?php

include("conexao.php");

if(!isset($_SESSION))
  session_start();

$consulta = "SELECT * FROM agendamento";
$con = $mysqli->query($consulta) or die ($mysqli->error);

$result=mysqli_query($mysqli, "SELECT count(*) as total from funcionario");
$data=mysqli_fetch_assoc($result);

$resultCliente=mysqli_query($mysqli, "SELECT count(*) as total from cliente");
$dataCliente=mysqli_fetch_assoc($resultCliente);

$resultProcedimento=mysqli_query($mysqli, "SELECT count(*) as total from agendamento");
$dataProcedimento=mysqli_fetch_assoc($resultProcedimento);

$resultReceita=mysqli_query($mysqli, "SELECT count(*) as total from funcionario");
$dataReceita=mysqli_fetch_assoc($resultReceita);

$resultSoma = mysqli_query($mysqli, 'SELECT SUM(valorPago) AS soma FROM recebimento'); 
$row = mysqli_fetch_assoc($resultSoma); 
$sum = $row['soma'];
//validação dos dados

//Inserção no BD


$consultaNomeFunc = $_SESSION['usernameFunc'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Início</title>


  <!-- <link href='packages/core/main.css' rel='stylesheet' />
  <link href='packages/daygrid/main.css' rel='stylesheet' />
  <link href='packages/timegrid/main.css' rel='stylesheet' />
  <script src='packages/core/main.js'></script>
  <script src='packages/interaction/main.js'></script>
  <script src='packages/daygrid/main.js'></script>
  <script src='packages/timegrid/main.js'></script> -->
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</script>

<!-- <script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      defaultDate: '2019-08-12',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: function(arg) {
        var title = prompt('Event Title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          })
        }
        calendar.unselect()
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
      {
        title: 'Evento 1',
        start: '2019-08-01'
      },
      {
        title: 'Evento 2',
        start: '2019-08-07',
        end: '2019-08-10'
      },
      {
        groupId: 999,
        title: 'Evento 3',
        start: '2019-08-09T16:00:00'
      },
      {
        groupId: 999,
        title: 'Evento 4',
        start: '2019-08-16T16:00:00'
      },
      {
        title: 'Evento 5',
        start: '2019-08-11',
        end: '2019-08-13'
      },
      {
        title: 'Evento 6',
        start: '2019-08-12T10:30:00',
        end: '2019-08-12T12:30:00'
      },
      {
        title: 'Evento 7',
        start: '2019-08-12T12:00:00'
      },
      {
        title: 'Evento 8',
        start: '2019-08-12T14:30:00'
      },
      {
        title: 'Evento 9',
        start: '2019-08-12T17:30:00'
      },
      {
        title: 'Evento 10',
        start: '2019-08-12T20:00:00'
      }
      ]
    });

    calendar.render();
  });

</script> -->


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

<!-- <article>
  <section>
    <div id='calendar' class="fc fc-ltr fc-unthemed" style="max-width: 900px; background-color: white;"></div>
 </section>
</article> -->
<article>
 <h3 style="text-align: center; color: black; padding-top: 2rem"> Seja bem vindo(a), <?php echo $consultaNomeFunc; ?></h3>
 <div class="container article-inicio">

  <div class="pb-2 mt-4 mb-2">

   
    <div>
      <h1>Sumário</h1>
    </div>
    <div class="row mb-3">
      <div class="col-xl-3 col-sm-6 py-2 cardInicio" onclick="window.location='consultaClientes.php'">
        <div class="card bg-success text-white h-100">
          <div class="card-body bg-success">
            <div class="rotate">
              <i class="fa fa-user fa-4x"></i>
            </div>
            <h6 class="text-uppercase text-center">Total de clientes cadastrados</h6>
            <h1 class="display-4 text-center"><?php echo $dataCliente['total']; ?></h1>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 py-2 cardInicio" onclick="window.location='inicio.php'">
        <div class="card text-white bg-danger h-100">
          <div class="card-body bg-danger">
            <div class="rotate">
              <i class="fa fa-list fa-4x"></i>
            </div>
            <h6 class="text-uppercase text-center">Agendamentos realizados</h6>
            <h1 class="display-4 text-center"><?php echo $dataProcedimento['total']; ?></h1>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 py-2 cardInicio" onclick="window.location='ConsultaFuncionario.php'">
        <div class="card text-white bg-info h-100">
          <div class="card-body bg-info">
            <div class="rotate">
              <i class="fa fa-twitter fa-4x"></i>
            </div>
            <h6 class="text-uppercase text-center">Funcionários cadastrados</h6>
            <h1 class="display-4 text-center"> <?php echo $data['total']; ?></h1>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 py-2 cardInicio" onclick="window.location='ConsultaHistorico.php'">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <div class="rotate">
              <i class="fa fa-share fa-4x"></i>
            </div>
            <h6 class="text-uppercase text-center">Receita no mês atual</h6>
            <h1 class="display-4 text-center">R$ <?php echo $sum; ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
</article>

<article>
  <div class="container article-inicio rounded">

    <div class="pb-2 mt-4 mb-2 border-bottom rounded">

      <h1>Próximos horários marcados:</h1>
    </div>
    <table class="table table-striped  table-bordered table-hover table-condensed ">
      <thead class="thead-dark">
        <tr>
          <td>Nome</td>
          <td>Cliente</td>
          <td>Procedimento</td>
          <td>Funcionario</td>
          <td>Data</td>
          <td>Hora</td>
        </tr>
      </thead>
      <tbody>
        <?php while ($dado = $con->fetch_array()) { ?>
          <tr class="table-hover">
            <td><?php echo $dado["nome"]; ?></td>
            <td><?php echo $dado["cliente"]; ?></td>
            <td><?php echo $dado["procedimento"]; ?></td>
            <td><?php echo $dado["funcionario"]; ?></td>
            <td><?php echo $dado["data"]; ?></td>
            <td><?php echo $dado["hora"]; ?></td>
          </tr>
        <?php  } ?>
      </tbody>
    </table>
  </div>
</article>
</body>
</html>