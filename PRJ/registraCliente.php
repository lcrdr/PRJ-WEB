<?php

	require_once('db.class.php');

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$sexo = ($_POST['sexo']);
	$logradouro = ($_POST['logradouro']);
	$numero = ($_POST['numero']);
	$complemento = ($_POST['complemento']);
	$profissao = ($_POST['profissao']);
	$email = ($_POST['email']);

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$email_existe = false;

	//verificar se o e-mail já
	$sql = " select * from cliente where email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}


	if($email_existe){

		$retorno_get = '';

		if($email_existe){
			$retorno_get.= "erro_email=1&";
		}

		header('Location: CadastroCliente.html?'.$retorno_get);
		die();
	}

	$sql = " insert into cliente(nome, sobrenome, idade, sexo, logradouro, numero, complemento, profissao, email) values ('$nome', '$sobrenome', '$idade', '$sexo', '$logradouro', '$numero', '$complemento', '$profissao', '$email') ";

	//executar a query
	if(mysqli_query($link, $sql)){
		echo 'Usuário registrado com sucesso!';
	} else {
		echo 'Erro ao registrar o usuário!';
	}


?>