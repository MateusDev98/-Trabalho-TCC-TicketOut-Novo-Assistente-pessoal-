<?php

$conn = require __DIR__ .'../../../connection.php';

$login = function() use ($conn){

	$code = filter_input(INPUT_POST, 'code');
	$pass = filter_input(INPUT_POST, 'pass');

	if(is_null($code) or is_null($pass)){

		// flash('Preencha os campoos corretamente!','info');
		// header('location: /admin/auth/login');
		return false;
	}

	$sql = 'SELECT * FROM admin WHERE code = ?';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $code);

 	$stmt->execute();

 	$result = $stmt->get_result();
 	//Armazenamos o usuário
 	$admin = $result->fetch_assoc();

 	if(!$admin){
 		return false;
 	}

 	// compara a senha criptografada a senha digitada pelo usuário e se for armazenar na sessão
 	if(password_verify($pass, $admin['pass'])){
 		unset($admin['pass']);//removemos do array admin o hash de senha para que ele não seja armazenado em sessão
 		$_SESSION['auth'] = $admin; //Sessão igual ao usuário atutenticado
 		return true;
 	}

 	return false;
};
