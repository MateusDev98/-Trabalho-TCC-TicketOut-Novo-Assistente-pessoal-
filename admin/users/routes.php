<?php 

require __DIR__.'/db.php';

if(resolved('/admin/users')){
	$users = $users_all();
	render('/admin/users/index', 'admin', compact('users')); //por ultimo seria os dados de listagem, o campact gera um array com a chave chamada neste caso é a users e um valor de uma variavel chamda users tbm

}else if(resolved('/admin/users/create')){
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$users_create();
		return header('location: /admin/users');
	}
	render('/admin/users/create','admin');

}else if ($params = resolved('/admin/users/(\d+)')) { //(\d+)  a letra só aceita números e o sinal de mais significa ou ou mais digitos
	$user = $users_view($params[1]);
	render('/admin/users/view','admin', compact('user'));

}else if ($params = resolved('/admin/users/(\d+)/edit')) {
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$users_edit($params[1]);
		return header('location: /admin/users/' . $params[1]);	
	}
	$user = $users_view($params[1]);
	render('/admin/users/edit','admin',compact('user'));

}else if ($params = resolved('/admin/users/(\d+)/delete')) {
	$users_remove($params[1]);//O primeiro retorna o que foi digitado
	return header('location:/admin/users');
}
