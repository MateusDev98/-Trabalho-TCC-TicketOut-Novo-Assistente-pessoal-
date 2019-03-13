<?php 

function setInternalServerError($errno = null, $errstr = null, $errfile = null, $errline = null) {
    http_response_code(500);
    echo '<div style="margin-top: 100px;">';
    echo '<h1>&#9746; Opá, algo está errado!</h1>';
    //if (!DEBUG) {
      //  exit;
    //}
    //is_object informa se a variável é um objeto
    if (is_object($errno)) {
        $err = $errno;
        $errno = $err->getCode();//Número do erro
        $errstr = $err->getMessage();//Mensagem do erro
        $errfile = $err->getFile();//O arquivo que deu erro
        $errline = $err->getLine();//Linha do erro
    }
    echo '<span style="font-weigth: bold; color: #fff">';
    switch ($errno) {
        case E_USER_ERROR:
            echo '<strong>ERROR</strong> [' . $errno . '] ' . $errstr . "<br>\n";
            echo 'Fatal error on line ' . $errline . ' in file ' . $errfile;
            break;
        case E_USER_WARNING:
            echo '<strong>WARNING</strong> [' . $errno . '] ' . $errstr . "<br>\n";
            break;
        case E_USER_NOTICE:
            echo '<strong>NOTICE</strong> [' . $errno . '] ' . $errstr . "<br>\n";
            break;
        default:
            echo 'Unknow error type: [' . $errno . '] ' . $errstr . "<br>\n";
            echo 'On line ' . $errline . ' in file ' . $errfile;
            break;
    }
    echo '</span>';
    echo '<ul>';
    foreach (debug_backtrace() as $error) {
        if (!empty($error['file'])) {
            echo '<li>';
            echo $error['file'] . ':';
            echo $error['line'];
            echo '</li>';
        }
    }
    echo '</ul>';
    echo '</div>';
    exit;
}
set_error_handler('setInternalServerError');
set_exception_handler('setInternalServerError');
//Criamos uma função que podemos manipular os erros, como primeiro parametros temos o numero do erro 
// //depois o nome do erro(mensagem do erro), também o arquivo que veio a dar erro e a linha do erro.
// function setInternalServerError($errno, $errstr, $errfile, $errline){

#como estamos trabalhando com o protocolo HTTP, precisamos respeitar algumas regras, quando entramos no console do navegador e ele nos retorna o status code 200 significa que está tudo OK, mas precisamos informar que quando não der certo, quando nada foi executado, quando temos um página não encontrada o status code deveria ser 404(O erro 404 é um código de resposta HTTP que indica que o cliente pôde comunicar com o servidor, mas ou o servidor não pôde encontrar o que foi pedido, ou foi configurado para não cumprir o pedido e não revelar a razão, ou a página não existe mais) e quando temos um erro interno deve-se ser mostrado no status code o erro 500

//http_response_code(code)Obtém ou define o código de status da resposta HTTP.
// 	http_response_code(500);//Definimos nosso erro interno

// 	echo "<center><div style='margin-top:100px;'>";

// 	echo "<h1>&#9746; Opá, algo está errado!</h1>";
// 	// echo "<p>Retorne a página anterior <a href='/home'>Voltar.<a/></p>";
// //Verificamos se a constante DEBUG está ativa
// 	if(!DEBUG){
// 		die();	
// 	}

//Definindo os tipos de erro
	// switch ($errno) {
	// 	case E_USER_ERROR: //Caso for um erro grave do usuário
	// 		echo "<strong>ERROR</strong> [" . $errno . "]" . $errstr . "<br>\n";
	// 		echo "Fatal error on line: [" . $errline . "]" . "in file: " . $errfile;
	// 		break;
	// 	case E_USER_WARNING: //Caso for um erro do tipo warning do usuário
	// 		echo "<strong>WARNING</strong> [" . $errno . "]" . $errstr . "<br>\n";			
	// 		break;
	// 	case E_USER_NOTICE: //Caso for um erro do tipo notice para o usuário
	// 		echo "<strong>NOTICE</strong> [" . $errno . "]" . $errstr . "<br>\n";
	// 		break;
	// 	default:
	// 		echo "UNKNOW ERROR [" . $errno . "]" . $errstr . "<br>\n";
	// 		break;
	// }

//Testando o xdebug
// echo "<ul>";
// foreach (debug_backtrace() as $error) {
// 	if(!empty($error['file'])){
// 		echo "<li>";
// 		echo $error['file'] . ":";
// 		echo $error['line'];
// 		echo "</li>";
// 	}
// }
// echo "</ul>";

// echo "</div></center>";
// // 	die();
// }

//Adicionando a função para adicionar o manipulador de erro, utilizando dentro do paranteses o nome do método utilizado
// set_error_handler('setInternalServerError');

// //Tratando execeções
// set_exception_handler('setInternalServerError');


