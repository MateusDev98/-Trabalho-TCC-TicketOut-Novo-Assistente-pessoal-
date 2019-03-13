<?php 

require __DIR__ .'/db.php';

if(resolved('/admin/auth/login')){
	//Buscamos o usuário no banco
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($login()){

			 flash('Login aprovado','success');
			 return header('location: /admin/home');
		}
		
		flash('Usuário não existe!','error');
	}
	render('admin/auth/login','admin/login');

} elseif(resolved('/admin/auth/logout')){

	logout();

}	
