<h2 class="mb-5">Administração de usuários <i class="fas fa-users"></i></h2>
<a href="/admin/users/create" class="btn btn-dark btn-sm mb-3">Novo usuário <i class="fas fa-plus"></i></a>

<table class="table table-hover">
	<thead>
		<tr>
			<th><i class="fas fa-list-ol"></i></th>
			<th>Email <i class="fas fa-at"></i></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['users'] as $user) :?>
		<tr>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['email'];?></td>
			<td>
				<a href="/admin/users/<?php echo $user['id'];?>" class="btn btn-sm btn-info">Ver <i class="fas fa-eye"></i></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
