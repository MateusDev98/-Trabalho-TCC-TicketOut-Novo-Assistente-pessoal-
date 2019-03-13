<?php 

#Integração com o banco de dados, utilizando funções anonimas, básicamente são funções sem nome
#
#
//Criando o método pages_get_data(), que guarda os dados do formulário


function pages_get_data($redirectOnError){
	$title = filter_input(INPUT_POST, 'title'); //Filtramos o tipo de requisição a receber
	$url = filter_input(INPUT_POST, 'url');
	$body = filter_input(INPUT_POST, 'body');

	//Verificamos se as variaveis são nulas
	if(is_null($title) or is_null($url)){
		flash('Informe o título!', 'error');
		header('location:'. $redirectOnError);
		die();
	}
	return compact('title','url','body');
};

//Buscar todas as páginas
$pages_all = function() use ($conn){

	$result = $conn->query('SELECT * FROM pages');
	return $result->fetch_all(MYSQLI_ASSOC);

};
//Buscar uma única página
$pages_one = function($id) use ($conn){

	$sql = 'SELECT * FROM pages WHERE id = ?';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$result = $stmt->get_result();

	return $result->fetch_assoc();	

};
//Cadastra uma página
$pages_create = function() use ($conn){

	//Pagamos dados do formulário com este método
	$data = pages_get_data('/admin/pages/create');

	//Inserimos os dados no banco
	$sql = 'INSERT INTO pages(title, url, body, created, updated) VALUES(?,?,?, NOW(), NOW())';

	//Recebemos os tipos de dado de forma segura
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $data['title'], $data['url'], $data['body']);

	flash('Criada com sucesso!','success');
	
	return $stmt->execute();
};
//Altarações de uma página
$pages_edit = function($id) use ($conn){

	//Pagamos dados do formulário com este método
	$data = pages_get_data('/admin/pages/' . $id . '/edit');

	//Inserimos os dados no banco
	$sql = 'UPDATE pages SET title = ?, url = ?, body = ?, updated = NOW() WHERE id = ?';

	//Recebemos os tipos de dado de forma segura
	//Executamos a preparação dos dados, do meu método seguro que é o SQL
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sssi', $data['title'], $data['url'], $data['body'], $id);

	flash('O documento foi editado!','success');
	
	return $stmt->execute();

};
//Deleta uma página
$pages_delete = function($id) use ($conn){

	//DELETAMOS o registro no banco
	$sql = 'DELETE FROM pages WHERE id = ?';

	//Recebemos os tipos de dado de forma segura
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $id);

	flash('O documento foi removido!','info');
	
	return $stmt->execute();
	
};