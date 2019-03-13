<?php 


function admins_get_data($redirectOnError){

	$code = filter_input(INPUT_POST, 'code');
	$pass = filter_input(INPUT_POST, 'pass');

	if(!$code){
		flash('Campos em branco!','error');
		header('location: ' . $redirectOnError);
		die();
	}
	return compact('code','pass');
}

//Criamos a função anonima para todos os usuários, a listagem de dados
$admin_all = function() use ($conn){

	$result = $conn->query('SELECT * FROM admin');

	return $result->fetch_all(MYSQLI_ASSOC);

};
//Visualização de datelhes do registro
$admin_view = function($id) use ($conn){

	$stmt = $conn->prepare('SELECT * FROM admin WHERE id = ?');
	$stmt->bind_param('i',$id);

	$stmt->execute();

	$result = $stmt->get_result();

	return $result->fetch_assoc();

};

//Criação de registros
$admin_create = function() use ($conn){

	$data = admins_get_data('/admin/administradores/create');

	$sql = 'INSERT INTO admin(code,pass,created,updated) VALUES(?,?, NOW(), NOW())';

	if(is_null($data['pass'])){
		flash('Preencha o campo da senha','error');
		header('location: /admin/users/create');
		die();
	}

	//Transformando a senha em hash, o hash é um valor que vai transformar a senha em uma valor que humanos não podem ler, podemos comparar os valores mas nunca saber qual é a senha do usuário, é um dos métodos de autenticação mais seguros ultimamente, não podendo voltar para a senha original depois de cadastrado no banco
	$data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $data['code'], $data['pass']);

	flash('Adicionado!','success');

	return $stmt->execute();


};

//Atualização/edição  de registro
$admin_edit = function($id) use ($conn){

	$data = admins_get_data('/admin/administradores/'. $id .'/edit');

	$sql = 'UPDATE admin SET code = ?, created = NOW(), updated = NOW() WHERE id = ?'; 

	if($data['pass']){
		$data['pass'] =  password_hash($data['pass'], PASSWORD_DEFAULT);
		$sql = 'UPDATE admin SET code = ?, pass = ?, created = NOW(), updated = NOW() WHERE id = ?'; 
	}

	$stmt = $conn->prepare($sql);

	if($data['pass']){
		$stmt->bind_param('ssi', $data['code'], $data['pass'], $id);
	}else{
		$stmt->bind_param('si', $data['code'], $id);
	}

	flash('Atualizado!','info');

	return $stmt->execute();

};
//Remoção
$admin_remove = function($id) use ($conn){

	$sql = 'DELETE FROM admin WHERE id = ?';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$id);

	flash('Removido!','info');

	return $stmt->execute();

};