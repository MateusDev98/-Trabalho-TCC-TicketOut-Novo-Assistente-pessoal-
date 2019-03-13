<?php 

require __DIR__ .'/db.php';

if(resolved('/site/auth/cadas')){

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if($users_cadas()){

			return header('location: /');

	}elseif($login_user()){

			flash('Bem vindo!','success');
			return header('location: /');
	}elseif(!($login_user())){

		flash('Usuário incorreto','error');
		return header('location: /');
	}

}

	render('/site/auth/cadas','site/cadas');

} elseif(resolved('/site/auth/contact')){


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
	render('site/auth/contact','site/contact');

} elseif(resolved('/site/auth/how_to_work')){

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		if($login_user()){

				flash('Bem vindo!','success');
				return header('location: /');

		}elseif(!($login_user())){

			flash('Usuário incorreto','error');
			return header('location: /site/auth/how_to_work');
		}
	}

	render('site/auth/how_to_work','site/how_to_work');

} elseif(resolved('/site/auth/logout_user')){

	logout_user();

}	