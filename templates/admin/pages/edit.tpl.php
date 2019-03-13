<h2 class="mb-5">Editar página <i class="fas fa-edit"></i></h2>

<a href="/admin/pages/<?php echo $data['page']['id'];?>" class="btn btn-sm btn-dark mb-5"><i class="fas fa-caret-left"></i> Voltar</a>

<form method="POST">
	<div class="form-group">
		<label for="pages_title">Título</label>
		<input name="title" id="pages_title" type="text" class="form-control" placeholder="Título da página..." value="<?php echo $data['page']['title'];?>">
	</div>	
	<div class="form-group">
		<label for="pages_url">URL</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">/</span>
				</div>
					<input name="url" id="pages_url" type="text" class="form-control" placeholder="URL amigável, deixe em branco para informar a página inicial..." value="<?php echo $data['page']['url'];?>">
			</div>
	</div>
	<div class="form-group">
		<input id="pages_body" type="hidden" name="body" value="<?php echo htmlentities($data['page']['body']);?>">	
		<trix-editor input="pages_body">
		</trix-editor>		
		<button type="submit" class="btn btn-success btn-sm mt-3">Salvar <i class="fas fa-bookmark"></i></button>
	</div>
		
</form>

