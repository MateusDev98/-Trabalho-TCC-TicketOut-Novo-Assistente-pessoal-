<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="/resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="/resources/pnotify/pnotify.custom.min.css">
	   <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/style.css">
    <title>Painel Administrativo</title>
  </head>
  <body class="d-flex flex-column bg-info">
  		<header>
 			<nav class="navbar navbar-dark bg-dark">
          <span> <!-- Encapisular tudo dentro do nav -->
      				<a class="navbar-brand font-weight-bold" href="/admin">AdminDev</a>
      				<span class="navbar-text">Painel Administrativo <i class="fas fa-tools"></i></span>		
          </span>
			</nav>
  		</header>
  	<main>
  				<div class="row">
					<div class="col">
					
					</div>
				<div class="col-10 p-lg-3"><?php require $content ?></div>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/node_modules/jquery/dist/jquery.js"></script>
    <script src="/node_modules/popper.js/dist/umd/popper.js"></script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->
    <script src="/resources/fontawesome/js/all.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/resources/pnotify/pnotify.custom.min.js"></script>
    <script>
      <?php flash(); ?>
    </script>
  </body>
</html>
