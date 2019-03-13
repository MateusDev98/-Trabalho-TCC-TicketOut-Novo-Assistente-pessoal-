<?php 

$conn = require __DIR__.'/../../source/connection.php';

$email = $_SESSION['user']['email'];
$name = $_SESSION['user']['name'];
$phone = $_SESSION['user']['phone'];
$id = $_SESSION['user']['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name = filter_input(INPUT_POST, 'name');
	$email = filter_input(INPUT_POST, 'email');
	$phone = filter_input(INPUT_POST, 'phone');
	$pass = filter_input(INPUT_POST, 'pass');


	$sql = 'UPDATE users SET email = ?, name = ?, phone = ?, created = NOW(), updated = NOW() WHERE id = ?';

	if($pass){
		$pass =  password_hash($pass, PASSWORD_DEFAULT);
		$sql = 'UPDATE users SET email = ?, pass = ?, name = ?, phone = ?, created = NOW(), updated = NOW() WHERE id = ?'; 
	}

	$stmt = $conn->prepare($sql);


	if($pass){
		$stmt->bind_param('ssssi', $email, $pass, $name, $phone, $id);
	}else{
		$stmt->bind_param('sssi', $email, $name, $phone, $id);
	}

	if($_SESSION['user']){

		$stmt->execute();

		unset($_SESSION['user']);

		flash('Alterado, faça o login novamente!','info');

		header('location: /');

		die();

	}

}

?>
<main>
	<section>
		<div class="container">
			<div class="row edit">
				<div class="col-md-2" style="margin-top: 10%">
				<a href="" class="thumbnail text-center user_icon">
					<span class="glyphicon glyphicon-user" style="font-size: 130px; color: #ccc;"></span>
					<p>Alterar sua foto</p>
				<!-- <img src="/img/cy.png" alt="...">  -->
				</a>
				</div>
				<div class="col-md-4" style="margin-top: 10%;">
					<h1 style="color: #fff;">Altere seus dados <i class="fas fa-user-edit"></i></h1>
					<hr style="width: 350px;">
					<br>
					<form action="" method="POST">
						<div class="form-group">
							<label for="name"><i class="fas fa-signature"></i> Nome: <input type="text" class="form-control" value="<?php echo $name;?>" id="name" name="name" style=" border: none; color: #000; outline: none;">
							</label>
						</div>
						<div class="form-group">
							<label for="email"><i class="fas fa-envelope"></i> Email: <input type="text" class="form-control" value="<?php echo $email;?>" id="email" name="email" style=" border: none; color: #000; outline: none;">
							</label>
						</div>	
						<div class="form-group">
							<label for="phone"><i class="fas fa-phone"></i> Telefone: <input type="text" class="form-control" value="<?php echo $phone;?>" id="phone" name="phone" style=" border: none; color: #000;  outline: none;">
							</label>
						</div>
						<div class="form-group">
							<label for="pass"><i class="fas fa-unlock-alt"></i> Senha: <input type="password" class="form-control" value="" id="pass" name="pass" style=" border: none; color: #000; outline: none;" placeholder="*Dados omitidos por segurança*" size="28">
							</label>
						</div>
						<button type="submit" class="btn btn-success">Alterar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>

