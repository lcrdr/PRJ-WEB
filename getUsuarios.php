<?php

	require_once('db_laroza.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = "SELECT * FROM 'funcionario' ";


	// $l representará o número de linhas que existem

		$sqlkit = $con->query("SELECT * FROM funcionario");

		$numCols = 5; 
		$c = 0;
		$countCol = 0;

		while($rowskit = $con->fetch_object($sqlkit)){

			if($c % 2 == 0){
				if($countCol % 2 == 0){
					echo"<tr class='tançe=hover'>";
				}else{
					echo"<tr class='odd'>";
				}
				$countCol++;
			}

		?>			
			<td><?php echo $rowskit->nome;?></td>
			<td><?php echo $rowskit->sobrenome;?></td>
			<td><?php echo $rowskit->idade;?></td>
			<? echo($c%$numCols==$numCols-1) ? "</tr>\n" : null;

			$c++; 

		} 
		?>

