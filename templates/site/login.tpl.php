<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> TicketOut </title>
<!-- Bootstrap -->
		<link href="/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="/resources/pnotify/pnotify.custom.min.css">
		<link href="/resources/fontawesome/css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/form.css"><!--formatação da página-->
	</head>
<body>
  <header>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
         <a href="/site/auth/cadas" class="navbar-brand"> <img src="/img/3.png" class="img-responsive"> </a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        </div>
      </div>
    </nav>
  </header>
<main>
  <?php require $content; ?>
</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><!--linkando com o JS externo-->
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><!--linkando com o JS externo-->
	<script src="/js/bootstrap.min.js"></script>
	<script src="/resources/pnotify/pnotify.custom.min.js"></script>
	<script>
  		<?php flash(); ?>
	</script>
</body>
</html>