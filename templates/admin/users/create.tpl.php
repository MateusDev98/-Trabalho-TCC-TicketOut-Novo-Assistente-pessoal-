<h3 class="mb-5">Novo usuário.</h3>
<a href="/admin/users/home" class="btn btn-dark btn-sm mb-5"><i class="fas fa-caret-left"></i> Voltar </a>

<form method="POST">
	<div class="form-group">
		<label for="users_name"><strong><i class="fas fa-file-signature"></i> Nome -</strong></label>
		<input type="text" name="name" class="form-control col-sm-5" id="users_name" placeholder="Seu nome...">
	</div>	
	<div class="form-group">
		<label for="users_email"><strong><i class="fas fa-at"></i> Email -</strong></label>
		<input type="email" name="email" class="form-control col-sm-5" id="users_email" placeholder="Seu email..." >
	</div>  
	 <div class="form-group">
                <label for="users_phone"><strong><i class="fas fa-phone"></i> Telefone -</strong></label>
                <input type="text" name="phone" class="form-control col-sm-5" id="users_phone" placeholder="Sua telefone...">
        </div>	
	<div class="form-group">
		<label for="users_pass"><strong><i class="fas fa-unlock-alt"></i> Senha -</strong></label>
		<input type="password" name="pass" class="form-control col-sm-5" id="users_pass" placeholder="Sua senha...">
	</div>

	<button type="submit" class="btn btn-success btn-sm"> Salvar <i class="far fa-save"></i></button>	
</form>

