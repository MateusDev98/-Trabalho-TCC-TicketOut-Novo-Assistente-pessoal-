<?php 


function users_get_data($redirectOnError){

	$email = filter_input(INPUT_POST, 'email');
	$pass = filter_input(INPUT_POST, 'pass');
	$name = filter_input(INPUT_POST, 'name');

	if(!$name or !$email){
		flash('Campos em branco!','error');
		header('location: ' . $redirectOnError);
		die();
	}
	return compact('name','email','pass');
}

//Criamos a função anonima para todos os usuários, a listagem de dados
$users_all = function() use ($conn){

	$result = $conn->query('SELECT * FROM users');

	return $result->fetch_all(MYSQLI_ASSOC);

};
//Visualização de datelhes do registro
$users_view = function($id) use ($conn){

	$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
	$stmt->bind_param('i',$id);

	$stmt->execute();

	$result = $stmt->get_result();

	return $result->fetch_assoc();

};

//Criação de registros
$users_create = function() use ($conn){

	$data = users_get_data('/admin/users/create');

	$sql = 'INSERT INTO users(email,pass,name,created,updated) VALUES(?,?,?, NOW(), NOW())';

	if(is_null($data['pass'])){
		flash('Preencha o campo da senha','error');
		header('location: /admin/users/create');
		die();
	}

	//Transformando a senha em hash, o hash é um valor que vai transformar a senha em uma valor que humanos não podem ler, podemos comparar os valores mas nunca saber qual é a senha do usuário, é um dos métodos de autenticação mais seguros ultimamente, não podendo voltar para a senha original depois de cadastrado no banco
	$data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $data['email'], $data['pass'], $data['name']);

	flash('Usuário adicionado!','success');

	return $stmt->execute();


};

//Atualização/edição  de registro
$users_edit = function($id) use ($conn){

	$data = users_get_data('/admin/users/home'. $id .'/edit');

	$sql = 'UPDATE users SET email = ?, name = ?, created = NOW(), updated = NOW() WHERE id = ?'; 

	if($data['pass']){
		$data['pass'] =  password_hash($data['pass'], PASSWORD_DEFAULT);
		$sql = 'UPDATE users SET email = ?, pass = ?, name = ?, created = NOW(), updated = NOW() WHERE id = ?'; 
	}

	$stmt = $conn->prepare($sql);

	if($data['pass']){
		$stmt->bind_param('sssi', $data['email'], $data['pass'], $data['name'], $id);
	}else{
		$stmt->bind_param('ssi', $data['email'], $data['name'], $id);
	}

	flash('Usuário atualizado!','info');

	return $stmt->execute();

};
//Remoção
$users_remove = function($id) use ($conn){

	$sql = 'DELETE FROM users WHERE id = ?';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$id);

	flash('Usuário removido!','notice');

	return $stmt->execute();

};
