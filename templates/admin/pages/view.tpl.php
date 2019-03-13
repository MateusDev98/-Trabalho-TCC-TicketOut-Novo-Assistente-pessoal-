<h2 class="mb-5">Detalhes da página <i class="fas fa-info-circle"></i></h2>
<a href="/admin/pages" class="btn btn-dark btn-sm mb-5"><i class="fas fa-caret-left"></i> Voltar </a>

<div class="row">
	<div class="col-3">
		<dl class="row">
			<dt class="col-sm-3"><strong> Título: </strong></dt>
			<dd class="col-sm-9"><?php echo $data['page']['title']; ?></dd>

			<dt class="col-sm-3"><strong> URL: </strong></dt>
			<dd class="col-sm-9">/<?php echo $data['page']['url']; ?>- <a href="/<?php echo $data['page']['title']; ?>" target="blank" class="btn btn-success btn-sm"> Visualizar <i class="fas fa-eye"></i></a></dd>

			<dt class="col-sm-5"><strong> Criado: </strong></dt>
			<dd><?php echo $data['page']['created']; ?>.</dd>

			<dt class="col-sm-5"><strong> Alterado: </strong></dt>
			<dd><?php echo $data['page']['updated']; ?>.</dd>
		</dl>
	</div>
	<div class="col-6 offset-2 bg-light p-3">
		<?php echo $data['page']['body']; ?>
	</div>
</div>
<a href="/admin/pages/<?php echo $data['page']['id']; ?>/edit" class="btn btn-success btn-sm">Editar <i class="fas fa-edit"></i></a>
<a href="/admin/pages/<?php echo $data['page']['id']; ?>/delete" class="btn btn-danger btn-sm confirm">Excluir <i class="fa fa-trash"></i> </a>