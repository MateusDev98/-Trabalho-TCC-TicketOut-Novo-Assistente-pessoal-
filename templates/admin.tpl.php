<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="/resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="/resources/trix/trix.css">
    <link rel="stylesheet" href="/resources/pnotify/pnotify.custom.min.css">
	   <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/style.css">
    <title>Painel Administrativo</title>
  </head>
  <body class="d-flex flex-column">
  		<header>
 			<nav class="navbar navbar-dark bg-dark">
          <span> <!-- Encapisular tudo dentro do nav -->
      				<a class="navbar-brand font-weight-bold" href="/admin/home">AdminDev</a>
      				<span class="navbar-text">Painel Administrativo <i class="fas fa-tools"></i></span>		
          </span>
          <a href="/admin/auth/logout" class="btn btn-danger">Sair <i class="fas fa-sign-out-alt"></i></a>
			</nav>
  		</header>
  	<main>
  				<div class="row">
					<div class="col">
						<ul id="main-menu" class="nav nav-pills bg-dark flex-column p-3">
							<li class="nav-item">
								<span class="nav-link font-weight-bold text-uppercase text-secondary small"><i class="fas fa-ellipsis-v"></i> Menu</span>
							</li><br>
                <li class="nav-item">
                <a href="/admin/home" class="nav-link <?php if(resolved('/admin/home')):?> active <?php endif; ?>"><i class="fas fa-home"></i> Inicio </a>
              </li>
	 <li class="nav-item">
                <a href="/admin/users/home" class="nav-link <?php if(resolved('/admin/users.*')):?> active <?php endif; ?>"><i class="fas fa-users"></i> Usuários </a>
              </li>		
              <li class="nav-item">
								<a href="/admin/administradores/home" class="nav-link <?php if(resolved('/admin/administradores.*')):?> active <?php endif; ?>"><i class="fas fa-user-shield"></i> Admin </a>
							</li>
						</ul>
					</div>
				<div class="col-10 p-lg-3"><?php require $content; ?></div>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/node_modules/jquery/dist/jquery.js"></script>
    <script src="/node_modules/popper.js/dist/umd/popper.js"></script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->
    <script src="/resources/fontawesome/js/all.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/resources/trix/trix.js"></script>
    <script src="/resources/pnotify/pnotify.custom.min.js"></script>
    <script>
      //Configurando o editor de texto 
      //A partir daqui comecamos a cuidar um evento especifico
      //trix-attachment-add, este evento funciona quando arrastamos uma imagem para o editor de texto, podendo manipular o que vai acontecer quando soltamos a imagem no editor
     document.addEventListener('trix-attachment-add', function(){
          //Criamos uma variavel de valor fixo com o const
          const attachment = event.attachment;
          //Verificamos se o que queremos adicionar no editor de texto é um arquivo, se não existe e para a execução 
          if(!attachment.file){
            return;//Para a execuç~ao do método e não executa nada daqui para baixo 
          }
          //E se existir vamo preparar o envio do arquivo, fazendo o upload utilizando o FormData()
          const form = new FormData();
          form.append('file', attachment.file) //O método append insere conteúdo especificado no final dos elementos selecionados.
          //Fazemos a requisição do ajax, para uma página do meu servidor que ainda não existe
          
          $.ajax({
            url: '/admin/upload/image',
            method: 'POST',
            data: form, //Quando trablahmos com formdata dentro do jquery precisamos tomar cuidado, primeira coisa é que ele já vem com um contetType padrão que é o de formulário e por isso vamos desativar, para que a requisição passe a ser feita com o tipo certo, que o formData fornece e tbm falamos para ele não processar os dados, porque o JavaScript vai processar para mim com o formData, portanto vamos desativar tbm
            contentType: false,          
            processData: false,
            //Utilizamos um recurso nativo do JS, para passar a responsibilidade do Jquery para o JS nativo para isso vamos colocar um parametro chamado xhr: e iniciamos um método depois dos dois pontos
            xhr: function (){
              const xhr = $.ajaxSettings.xhr(); //Desta maneira pegamos o nosso recurso o xhr(X HTTP REQUEST), nativo do JS, agora podendo obrservar um upload de fato, para observarmos um evento com o JS, basta utilizar o addEventListener, um ouvinte de evento sendo o mesmo o 'progress'
             //Sempre que o 'upload tiver o 'progress' vai executar o códgio que está dentro da função, esta função recebe meu evento(e)
             xhr.upload.addEventListener('progress', function(e){
              //Aqui dentro utilizamos o let para criar a variavel porque o valor dela irá mudar
              let progress = e.loaded / e.total * 100; //Utilizamos a regra de três, para descobrir a porcantagem carregada na nossa barra de progresso 
              //Agora com o attachment o nosso aruivo original, com o setUploadProgress e dentro dela passando a porcentagem enviada
              attachment.setUploadProgress(progress);
             });     

              return xhr; //Utilizamos o return para ele devolver a alteração que fizemos para o Jquery           
            }
            //Testamos se o envio deu certo
          }).done(function(response){
              console.log(response); //Para vermos a saida
              // console.log('Enviou!');
              //Para informamos ao usuário ou o editor de texto que o processo/upload que deu certo, pagamos nosso attachment que é a nossa referencia do arquivo/imagem, concatenando com a função setAttributes e passar dentro do dele os atributos que foram salvos dentro do objeto, passando o valor 'url e href', desta maneira ele vai resolver, tambem passando no nosso .done dentro da função o 'response', que informa a resposta do servidor
              attachment.setAttributes({
                url: response,
                href: response
              });
          }).fail(function(){
              console.log('Não foi possivel fazer o envio!');
          });

     });

      <?php flash(); ?>
    //Pegamos o elemento e falamos para não executar a ação padrão de click, antes de ter certeza da execução
      const confirmEl = document.querySelector('.confirm');
      if(confirmEl){
        confirmEl.addEventListener('click', function(e){
        e.preventDefault();
        if(confirm('Tem certeza que deseja efetuar está ação?')){
          window.location = e.target.getAttribute('href');
        }
      });
      }
    </script>
  </body>
</html>
