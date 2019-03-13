<?php 

$conn = require __DIR__.'../../connection.php';


$imap_cadas = function() use ($conn){

	$email = filter_input(INPUT_POST, 'email');
	$pass = filter_input(INPUT_POST, 'pass');
	$phone = filter_input(INPUT_POST, 'phone');

	$sql = 'INSERT INTO imap(imap_email,imap_pass,phone) VALUES(?,?,?)';

	if(is_null($pass)){
		flash('Preencha o campo da senha','error');
		header('location: /cadas');
		die();
	}

	//Transformando a senha em hash, o hash é um valor que vai transformar a senha em uma valor que humanos não podem ler, podemos comparar os valores mas nunca saber qual é a senha do usuário, é um dos métodos de autenticação mais seguros ultimamente, não podendo voltar para a senha original depois de cadastrado no banco
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $email, $pass, $phone);

	$stmt->execute();

	flash('ATIVADO','success');

	return;

};
