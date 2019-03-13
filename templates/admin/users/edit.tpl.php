<h3 class="mb-5">Edição de usuários <i class="fas fa-user-edit"></i></h3>
<a href="/admin/users/<?php echo $data['user']['id'];?>" class="btn btn-dark btn-sm mb-5"><i class="fas fa-caret-left"></i> Voltar</a>
<form method="POST">
	<div class="form-group">
		<label for="users_name"><strong> Nome -</strong></label>
		<input type="text" name="name" class="form-control col-sm-5" id="users_name" value="<?php echo $data['user']['name'];?>">
	</div>
	<div class="form-group">
		<label for="users_email"><strong> Email -</strong></label>
		<input type="email" name="email" class="form-control col-sm-5" id="users_email" value="<?php echo $data['user']['email'];?>">
	</div>	
	<div class="form-group">
		<label for="users_pass"><strong> Senha -</strong></label>
		<input type="password" name="pass" class="form-control col-sm-5" id="users_pass">
	</div>	
	<button type="submit" class="btn btn-success btn-sm">Salvar <i class="fas fa-bookmark"></i></button>			
</form>


