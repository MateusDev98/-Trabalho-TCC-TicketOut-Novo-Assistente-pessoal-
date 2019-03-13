<?php 
#Motor do site, estrutura de navegação

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

session_start();

//Chamando as funções dos arquivos

//Define se a aplicação mostrará erros ou não
//require __DIR__.'/config.php';

//Manipulador de erros
require __DIR__.'/source/error_handler.php';

//Rota das páginas
require __DIR__ .'/source/resolved_route.php';

//Renderização das páginas
require __DIR__ .'/source/render_route.php';

//Conexão com o banco
require __DIR__.'/source/connection.php';

//Exibição de mensagens
require __DIR__.'/source/flash.php';

//Manipular login
require __DIR__.'/source/auth.php';

//Chama o arquivo tickets
// require __DIR__ . '/source/tickets.php';

// require __DIR__. '/source/boletosPHP.php';


//Verificando se as páginas existem e exibimos

if(resolved('/admin/?(.*)')){
	require __DIR__.'/admin/routes.php';

//Verficcamos se foi solicitado a pagina contact e exibimos
}elseif(resolved('/(.*)')){ 

	require __DIR__.'/site/routes.php';
}

// https://www.devmedia.com.br/iniciando-expressoes-regulares/6557

