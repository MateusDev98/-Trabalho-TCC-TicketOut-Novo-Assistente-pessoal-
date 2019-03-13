<h2 class="mb-5">Nova página.</h2>
<a href="/admin/pages" class="btn btn-sm btn-dark mb-5"><i class="fas fa-caret-left"></i> Voltar </a>

<form action="" method="POST">
	<div class="form-group">
		<label for="pages_title"><strong> Título -</strong></label>
		<input name="title" id="pages_title" type="text" class="form-control" placeholder="Título da página...">
	</div>	
	<div class="form-group">
		<label for="pages_url"><strong><i class="fas fa-link"></i> URL -</strong></label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">/</span>
				</div>
					<input name="url" id="pages_url" type="text" class="form-control" placeholder="URL amigável, deixe em branco para informar a página inicial...">
			</div>
	</div>
	<div class="form-group">
		<input id="pages_body" type="hidden" name="body">	
		<trix-editor input="pages_body">
		</trix-editor>		
	</div>
		<button type="submit" class="btn btn-success btn-sm"> Salvar <i class="far fa-save"></i></button>
</form>
