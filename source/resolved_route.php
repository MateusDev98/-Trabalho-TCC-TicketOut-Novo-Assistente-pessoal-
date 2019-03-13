<?php 

function resolved($route){

$path = $_SERVER['PATH_INFO'] ?? '/'; //Retorna informações sobre um caminho de arquivo
//Verificação de uma string dinâmica
//Criando uma regex
$route = '/^'. str_replace('/','\/',$route) .'$/'; //para substituirmos todas as barras que econtramos, utilizamos o str_replace
//preg_match, verifica uma expressão regular, inserindo dentro dos parenteses o padrão que desejamos buscar, posteriormente o valor que queremos buscar, se pusermos o '/' não vai encontrar nada porque não é composto de caracteres
if(preg_match($route, $path, $params)){

	return $params; 
}
return false;
}