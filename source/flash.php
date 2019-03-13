<?php 
#Mensagens de tarefas concluidas

function flash($message = null, $type = null){

	if($message){
		//Guardamos a mensagem
		$_SESSION['flash'][] = compact('message','type');//Quando utilizamos o compact ele cria um array com o nome dos parametros que passamos dentro dos paranteses dele e atribui a uma variavel com o mesmo nome o valor passado nos parametros//Para cada um dos parâmetros passados, compact() procura uma variável com o nome especificado na tabela de símbolos e a adiciona no array de saída de forma que o nome da variável será a chave e o seu conteúdo será o valor para esta chave. 
	}else{ //count: conta o número de elementos de uma variável, ou propriedades de um objeto
		$flash = $_SESSION['flash'] ?? []; //Desta forma mesmo se a varivavel $flash for vazia, não tiver sido passado nenhum dado me retorna um  array vazio, podendo trabalhar com ele, então se ele dar um count zero, dou um return e não se é executado mais nada, utilizamos o foreach porque não estamos armazenando nenhum dado direto na session flash temos um outro item que é um array, então quando utilizamos um foreach estamos acrescentando itens no array, então sempre que utilizarmos o flash posso acrescentar um item e armazenar varias mensagens e exibir varias mensagens
		if(!count($flash)){
			return;
		}
		foreach ($flash as $key => $message) {
			//Renderizamos um template
				render('flash','ajax',$message); //Dentro do foreach pegamos nosso método de renderização, dentro dele nosso arquivo de conteudo e depois nosso template vazio 
				//Atraves da chave removemos os dados da sessão
				unset($_SESSION['flash'][$key]);
			}	
	}

}