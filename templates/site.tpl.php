<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> TicketOut </title>
<!-- Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/resources/fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="/resources/pnotify/pnotify.custom.min.css">
<link rel="stylesheet" href="/css/site.css"><!--formatação da página-->
</head>
<body>
	<header>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
					<a href="/" class="navbar-brand"> <img src="/img/3.png" class="img-responsive"> </a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav menu">
						<li class="<?php if(resolved('/')):?> active <?php endif; ?>"><a href="/"> Inicio </a></li>
						<li class="<?php if(resolved('/view_tickets')):?> active <?php endif; ?>"><a href="/view_tickets"> Meus boletos </a></li>
						<li class="<?php if(resolved('/into_contact')):?> active <?php endif; ?>"><a href="/into_contact"> Contato </a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle " data-toggle="dropdown" rate="button" 
								aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['user']['name'];?> <span class="caret"></span></a>
								<ul class="dropdown-menu" style="text-align: center">
									<li>
										<a href="/edit">Dados Pessoais</a>
									</li>
									<li class="divider" role="separator"></li>
									<a href="/site/auth/logout_user" class="btn btn-danger text-center"> Sair <i class="fas fa-sign-out-alt"></i></a>
								</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header> 

<?php require $content; ?>
	<footer class='col-sm-18'>
		<label class="footer_content">Copyright
		<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true" style="color: #fff; font-size: 10px"></span>
<?php echo date('Y');?> TicketOut. Todos os direitos reservados</label>
	</footer>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><!--linkando com o JS externo-->
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><!--linkando com o JS externo-->
		<script src="/js/bootstrap.min.js"></script>
		<script src="/resources/pnotify/pnotify.custom.min.js"></script>
	<script>
	  <?php flash(); ?>
	</script>
</body>
</html>
