<h2 class="mb-5">Administração de páginas <i class="far fa-file"></i></h2>
<a href="/admin/pages/create" class="btn btn-dark btn-sm mb-3">Nova página <i class="fas fa-plus"></i></a>


<table class="table table-hover">
	<thead>
		<tr>
			<th><i class="fas fa-list-ol"></i></th>
			<th>Título</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data['pages'] as $page) : ?>
		<tr>
			<td><?php echo $page['id']; ?></td>
			<td>
				<p><?php echo $page['title']; ?><p>
			</td>
			<td>
				<a href="/admin/pages/<?php echo $page['id']; ?>" class="btn btn-info btn-sm">Ver <i class="fas fa-eye"></i></a>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
