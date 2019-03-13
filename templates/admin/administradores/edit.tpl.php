
<h3 class="mb-5">Edição <i class="fas fa-user-edit"></i></h3>
	<a href="/admin/administradores/<?php echo $data['admin']['id'];?>" class="btn btn-dark btn-sm mb-5"><i class="fas fa-caret-left"></i> Voltar</a>


<form method="POST">
	<div class="form-group">
		<label for="admin_code"><strong> Código de autenticação -</strong></label>
		<input type="text" name="code" class="form-control col-sm-5" id="admin_code" value="<?php echo $data['admin']['code'];?>">
	</div>
	<div class="form-group">
		<label for="admin_pass"><strong> Senha -</strong></label>
		<input type="password" name="pass" class="form-control col-sm-5" id="admin_pass">
	</div>	
	<button type="submit" class="btn btn-success btn-sm">Salvar <i class="fas fa-bookmark"></i></button>			
</form>