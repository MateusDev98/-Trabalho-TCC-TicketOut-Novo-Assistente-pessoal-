<?php 

#Rotas Admin
#
#
//ini_set('display_errors',1);
//ni_set('display_startup_erros',1);
//error_reporting(E_ALL);

require __DIR__.'/db.php';


//Verificando se as páginas existem
//Verificamos se foi solicitado a página inicial e exibimos 
if(resolved('/admin/pages/')){
		$pages = $pages_all();
		render('/admin/pages/index','admin', ['pages' => $pages]);

//Criação de páginas
}elseif(resolved('/admin/pages/create')){
	//Verificando se a reuisição é do tipo post e criando uma nova página
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$pages_create();
		return header("location:/admin/pages");	//Paramos a execução do redirecionamento e não o executamos
	}	
	render('/admin/pages/create','admin');

//Visualização
//Passando o valor da variavel $params com a função resolved()
}elseif($params = resolved('/admin/pages/(\d+)')){ //O \d aceita somente números
		$page = $pages_one($params[1]);
	render('/admin/pages/view','admin', ['page' => $page]);

//Edição
}elseif($params = resolved('/admin/pages/(\d+)/edit')){
	//Verificando o tipo da requisição e editando
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$pages_edit($params[1]);
		return header("location:/admin/pages/" . $params[1]);	
	}
	$page = $pages_one($params[1]);
	render('/admin/pages/edit','admin', ['page' => $page]);

//Deletar
}elseif($params = resolved('/admin/pages/(\d+)/delete')){
	//Verificando o tipo da requisição e deletando
		$pages_delete($params[1]);
		return header("location:/admin/pages");	
}
