<?php

// Voltamos um nível e adicionamos o documento bootstrap.php, utilizando o require __DIR__ para que quando ele for buscar um arquivo e não achar o mesmo ele pare de executar a constante __DIR__ que vai percorer o caminha completo do diretório atual até o arquivo rquisitado. Mas se o require encontrar pegamos os dados do arquivo buscado e inserirmos no nosso documento.
require __DIR__ . '/engine.php';
