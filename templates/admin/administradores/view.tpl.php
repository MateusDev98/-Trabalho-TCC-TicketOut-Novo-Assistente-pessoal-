
<h3 class="mb-5">Datalhes <i class="fas fa-info-circle"></i></h3>
	<a href="/admin/administradores" class="btn btn-dark btn-sm mb-5"> <i class="fas fa-caret-left"></i> Voltar </a>

<div class="row">
	<div class="col-10">
		<dl class="row">
			<dt class="col-sm-3"><strong> Código de autenticação: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['admin']['code'];?></dd>

			<dt class="col-sm-3"><strong> Criado: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['admin']['created'];?>.</dd>

			<dt class="col-sm-3"><strong> Alterado: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['admin']['updated'];?>.</dd>
		</dl>
	</div>
</div>
	<a href="/admin/administradores/<?php echo $data['admin']['id'];?>/edit" class="btn btn-success btn-sm">Editar <i class="fas fa-user-edit"></i></a>	
	
	<a href="/admin/administradores/<?php echo $data['admin']['id'];?>/delete" class="btn btn-danger btn-sm confirm">Excluir <i class="fas fa-user-minus"></i></a>	