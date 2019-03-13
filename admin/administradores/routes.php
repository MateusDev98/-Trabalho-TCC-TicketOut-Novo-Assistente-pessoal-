<?php 

require __DIR__.'/db.php';

if(resolved('/admin/administradores')){
	$admins = $admin_all();
	render('/admin/administradores/index', 'admin', compact('admins')); //por ultimo seria os dados de listagem, o campact gera um array com a chave chamada neste caso é a users e um valor de uma variavel chamda users tbm

}else if(resolved('/admin/administradores/create')){
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$admin_create();
		return header('location: /admin/administradores');
	}
	render('/admin/administradores/create','admin');

}elseif ($params = resolved('/admin/administradores/(\d+)')) { //(\d+)  a letra só aceita números e o sinal de mais significa ou ou mais digitos
	$admin = $admin_view($params[1]);
	render('/admin/administradores/view','admin', compact('admin'));

}elseif ($params = resolved('/admin/administradores/(\d+)/edit')) {
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$admin_edit($params[1]);
		return header('location: /admin/administradores/' . $params[1]);	
	}
	$admin = $admin_view($params[1]);
	render('/admin/administradores/edit','admin',compact('admin'));

}elseif ($params = resolved('/admin/administradores/(\d+)/delete')) {
	$admin_remove($params[1]);//O primeiro retorna o que foi digitado
	return header('location:/admin/administradores');
}
