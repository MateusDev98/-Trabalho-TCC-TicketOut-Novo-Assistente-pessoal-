<?php


$login_user = function() use ($conn){

	$email = filter_input(INPUT_POST, 'email');
	$pass = filter_input(INPUT_POST, 'pass');

	if(is_null($email) or is_null($pass)){

		// flash('Preencha os campoos corretamente!','info');
		// header('location: /admin/auth/login');
		return false;
	}

	$sql = 'SELECT * FROM users WHERE email = ?';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $email);

 	$stmt->execute();

 	$result = $stmt->get_result();
 	//Armazenamos o usuário
 	$user = $result->fetch_assoc();

 	if(!$user){
 		return false;
 	}

 	// compara a senha criptografada a senha digitada pelo usuário e se for armazenar na sessão
 	if(password_verify($pass, $user['pass'])){
 		unset($user['pass']);//removemos do array admin o hash de senha para que ele não seja armazenado em sessão
 		$_SESSION['user'] = $user; //Sessão igual ao usuário atutenticado
 		return true;
 	}

 	return false;
};

$users_cadas = function() use ($conn){

	$email = filter_input(INPUT_POST, 'email');
	$pass = filter_input(INPUT_POST, 'pass');
	$name = filter_input(INPUT_POST, 'name');
	$phone = filter_input(INPUT_POST, 'phone');

	$sql = 'INSERT INTO users(email,pass,name,phone,created,updated) VALUES(?,?,?,?, NOW(), NOW())';

	if(is_null($pass)){
		flash('Preencha o campo da senha','error');
		header('location: /cadas');
		die();
	}

	//Transformando a senha em hash, o hash é um valor que vai transformar a senha em uma valor que humanos não podem ler, podemos comparar os valores mas nunca saber qual é a senha do usuário, é um dos métodos de autenticação mais seguros ultimamente, não podendo voltar para a senha original depois de cadastrado no banco
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssss', $email, $pass, $name, $phone);

	// $stmt->execute();

	$_SESSION['user'] = $stmt->execute();

	if($_SESSION['user']){

		$user = $_SESSION['user'];
		header('location: /');
	}

};
