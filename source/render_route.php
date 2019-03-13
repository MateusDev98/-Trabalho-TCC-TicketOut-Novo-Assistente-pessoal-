<?php 

#Renderização HTML, contendo 3 parametros, o primeiro é onde vai estar o HTML do conteúdo, onde vai estar o HTML do template ecom um array de variaveis que queremos passar para o template
function render($content, $template, array $data = []){
	$content = __DIR__ . '/../templates/' . $content . '.tpl.php';
	return require __DIR__ . '/../templates/' . $template . '.tpl.php'; //Desta forma organizada, falando que sempre que eu criar no diretório templates um arquivo .tpl.php vai redenrizar nesta função do contrário não acahara nada
}
