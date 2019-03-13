<h3 class="mb-5">Datalhes do usuário <i class="fas fa-info-circle"></i></h3>
<a href="/admin/users" class="btn btn-dark btn-sm mb-5"> <i class="fas fa-caret-left"></i> Voltar </a>

<div class="row">
	<div class="col-md-4">
		<dl class="row">
			<dt class="col-sm-3"><strong> Nome: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['user']['name'];?></dd>

			<dt class="col-sm-3"><strong> Email: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['user']['email'];?></dd>

			<dt class="col-sm-3"><strong> Criado: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['user']['created'];?>.</dd>

			<dt class="col-sm-3"><strong> Alterado: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['user']['updated'];?>.</dd>
		</dl>
	</div>
</div>
<a href="/admin/users/<?php echo $data['user']['id'];?>/edit" class="btn btn-success btn-sm">Editar <i class="fas fa-user-edit"></i></a>	
<a href="/admin/users/<?php echo $data['user']['id'];?>/delete" class="btn btn-danger btn-sm confirm">Excluir <i class="fas fa-user-minus"></i></a>	

