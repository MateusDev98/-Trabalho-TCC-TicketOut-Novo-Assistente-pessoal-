<?php 
#Lista de rotas


protect_login();

require __DIR__.'/db.php';

//Verificando se as páginas existem
//Verificamos se foi solicitado a página inicial e exibimos 
if(resolved('/')){
	
	render('/site/home','site');

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		if($imap_cadas()){
			
			flash('Ativado','success');
			header('location: /view_tickets');

		}

	}
//Verficamos se foi solicitado a pagina contact e exibimos
}elseif(resolved('/into_contact')){

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		$from = filter_input(INPUT_POST, 'from');
		$subject = filter_input(INPUT_POST, 'subject');
		$message = filter_input(INPUT_POST, 'message');
		//Cria-se uma variavel para poder responder o email enviado para pessoa certa, também por a versão do php
		//Neste header especifico quem mandou o email pra quem eu vou responder e qual que foi a fonte, colocando a variavel como ultimo paremetro sendo ele opcional 
		$headers = 'From: ' . $from . "\r\n" . 
		"Reply-To: " . $from . "\r\n" . 
		"X-Mailer: PHP/" . phpversion(); 

		//Primeiro parametro é qual o emaill que vai receber este email é um email fixo sendo ele harcoded
		//
		if(mail('tiketout@outlook.com', $subject, $message, $headers)){
			flash('Obrigado por sua opnião!','success');
		}else{
			flash('Falha ao enviar','error');
		}
		return header("location: /site/auth/contact");

	}

	render('/site/into_contact','site');

}elseif(resolved('/view_tickets')){
	// require __DIR__ . '/../source/tickets.php';
	
	if (isset($_GET['id'])) {
		render('/site/view_ticket', 'site');
	} else {
		render('/site/view_tickets','site');
	}
}elseif(resolved('/get_tickets')){
	require __DIR__ . '/../source/get_tickets.php';
	
	//render('/site/get_tickets','site');

}
elseif(resolved('/edit')){

	render('/site/edit','site');

}elseif(resolved('/site/auth.*')){

	require __DIR__.'/auth/routes.php';
	
}else{
	http_response_code(404);
	echo "Página não econtrada";
}
