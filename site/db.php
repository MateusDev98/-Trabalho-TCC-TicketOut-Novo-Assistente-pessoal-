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

		$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $email, $pass, $phone);

	$stmt->execute();
	
	flash('ATIVADO','success');

	return;

};
