<?php 
#Rotas Admin
//ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
//error_reporting(E_ALL);

//Chamada a função da proteção das páginas

protect_auth();

//Verificando se as páginas existem
//Verificamos se foi solicitado a página inicial e exibimos 
if(resolved('/admin/home')){
	//Chamamos nossa função render(), como primeiro parametro é o que vamos renderizar, o segundo é o template não precisando ser .tpl.php, por ja ter sido definido o hardcoded forcando o tipo na engine
	render('/admin/home','admin');
//Verficamos se foi solicitado a pagina de controle de páginas e exibimos
}
elseif(resolved('/admin/auth.*')){ //A expressão '.*' o ponto casa qualquer caracter e o asterisco 1 ou +, ou seja qualuqer /admin/pages vai executar esse else if 
	require __DIR__.'/auth/routes.php';

}elseif(resolved('/admin/users.*')){ //A expressão '.*' o ponto casa qualquer caracter e o asterisco 0 ou +, ou seja qualquer /admin/pages vai executar esse else if 
	require __DIR__.'/users/routes.php';

}elseif(resolved('/admin/administradores.*')){ //A expressão '.*' o ponto casa qualquer caracter e o asterisco 0 ou +, ou seja qualuqer /admin/pages vai executar esse else if 
	require __DIR__.'/administradores/routes.php';

}elseif(resolved('/admin/upload/image')){ //Caminho do upload

	//Verificamos se realmente recebemos um arquivo, criamos uma variavel chamada file, demos o valor dela para o arry $_FILES, com o nome do item que configuramos no formulário que é o nosso FormData, com o nome do campo como file, se o arquivo não existir pego ele com o padrão nulo, depois verificamos se recebemos um arquivo ou um valor null, depois disso, podemos considerar uma boa prática verificar o tipo de arquivo, porque se for um arquivo php alguém pode tentar apagar nosso banco de dados ou alterar o nosso sistema, temos que evitar esse tipo de coisa, criamos uma variavel para por os tipos de arquivos permitidos  

	//pegamos o arquivo, armazenamos em uma variavel
	$file = $_FILES['file'] ?? null;

	//Verificação se foi recebido o arquivo
	if(!($file)){
		http_response_code(422); //Entidade improcessavel, um erro de validação
		echo 'Nenhum arquivo foi enviado';
		die();
	}


	//Verifica se é um tipo permitido de arquivo
	$allowedTypes = [
		'image/gif',
		'image/png',
		'image/jpg',
		'image/jpeg'
	];

	//Verifica se é um tipo permitido de arquivo
	//Verificamos se o tipo de arquivo está na nossa variavel $file que recebe o arquivo e no nosso array que filtra o tipo 
	//Se file['type'] nao estiver no allowedTypes 
	if(!in_array($file['type'], $allowedTypes)){
		http_response_code(422); //Entidade improcessavel, um erro de validação
		echo 'Arquivo não permitido';
		die();
	}

	//Processo para salvar o arquivo, pegando o nome dele ou criando um nome randomico
	//Gerar nome randomico
	$randomNameFile = uniqid(rand(), true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION); //Método usado para pegar um valor único 'uniqid', dentro vamos basear ele num valor randomico, com o boolean true, pagamos a string gerada com randomicamente com o uniqid e concatenamos com o pathinfo($file['name']), que dentro do parantes o parametro utilizado vai ser a variavel que armazene a o array com o nome do arquivo recebido, depois declaramos nossso PATHINFO_EXTENSION, para nos retornar a extensão do arquivo, portanto temos o nome do arquivo com a extensão correta, facilitando no salvamento do arquivo
	//Para salvarmos um arquivo localmente, utilizamos o método move_uploaded_file para mover ele de um lugar para outro
	//No primeiro parametro pagamos o local do arquivo, normalmente vai ser no 'tmp_name' e no segundo vai ser para onde ele vai, qual o novo local de destino do arquivo, utilizamos o __DIR__ para partimos do diretório atual até o local para armazenemto do arquivo, concatenando com o mesmo 
	//Salvar o arquivo no diretório escolhido com o nome randomico criado
	move_uploaded_file($file['tmp_name'], __DIR__.'/../public/upload/' . $randomNameFile);

	//Depois retornamos aonde o arquivo foi salvo
	//Retornamos o nome randomico, que vai ser utilizado no nosso script, no campo do formuçario chamado de 'file'
	
	echo '/upload/'. $randomNameFile;

	// echo json_encode($_FILES); //Faz com que o navegador receba o arquivo com um nome 
	// // echo "Upload feito com sucesso!";
}
else{
	http_response_code(404);
	echo "Página não econtrada";
}
