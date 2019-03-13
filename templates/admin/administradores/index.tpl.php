
<h2 class="mb-5">Administradores <i class="fas fa-users-cog"></i></h2>
	<a href="/admin/administradores/create" class="btn btn-dark btn-sm mb-3">Novo <i class="fas fa-plus"></i></a>

<table class="table table-hover">
	<thead>
		<tr>
			<th><i class="fas fa-list-ol"></i></th>
			<th>Código</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['admins'] as $admin) :?>
		<tr>
			<td><?php echo $admin['id'];?></td>
			<td><?php echo $admin['code'];?></td>
			<td>
				<a href="/admin/administradores/<?php echo $admin['id'];?>" class="btn btn-sm btn-info">Ver <i class="fas fa-eye"></i></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>