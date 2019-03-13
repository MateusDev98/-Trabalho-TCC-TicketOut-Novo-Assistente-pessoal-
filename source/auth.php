<?php 

//Pega os dados do usuário logado
function get_admin(){
	return $_SESSION['auth'] ?? null;
}


//Verifica se o usuário está logado
function protect_auth(){

	$admin = get_admin();


	//Verifica se o usuário está logado e verifica se estamos na página de autencação
	if(!$admin and !resolved('/admin/auth.*')){

		header("location: /admin/auth/login");
		die();
	}

}

function logout(){

	// session_destroy();
	unset($_SESSION['auth']);
	flash('Desconectado!','notice');
	header('location: /admin/home');
	die();

}



//FUNÇÕES DE LOGIN DO USUÁRIO

function get_user(){

	return $_SESSION['user'] ?? null;
}

function protect_login(){

	$user = get_user();

	if(!$user and !resolved('/site/auth.*')){

		header('location: /site/auth/cadas');
		die();

	}

}

function logout_user(){

	unset($_SESSION['user']);
	flash('Desconectado!','notice');
	header('location:/');
	die();
}
