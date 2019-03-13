<?php
	$conn_remote = new mysqli('techincloud.app','admin_ticketout','TicketOut1234@','admin_ticketout');

	if($conn_remote->connect_errno){
		die ('Falha ao conectar: ('.$conn->connect_errno.')' .$conn->connect_error );
	}

	require __DIR__. '/boletosPHP.php';

	$tickets = $conn_remote->query("SELECT * FROM ticket_messages ORDER BY due_date ASC");
?>

<section>
<div class="container">
	<div class="row">
		<div class="panel" style="margin-top: 5%;">
			<div class="panel-heading text-center">
					<h1><b>Meus boletos <i class="fas fa-money-check-alt"></i></b></h1>
			</div>
			<table class="table table-responsive">
				<thead>
					<tr>
						<th><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> Nome</th>
						<th><i class="fas fa-calendar-alt"></i> Data de vencimento</th>
						<th><i class="fas fa-barcode"></i> Linha digitável</th>
						<th>Valor R$</th>
						<th><i class="fas fa-search-plus"></i> Visualizar</th>
					</tr>
				</thead>
				<tbody>
					<?php while($result = $tickets->fetch_assoc()):?>
					<tr>
						<?php
							$barras = new boletosPHP();
							$barras->setIpte($result['barcode']);
						?>

						<td><?php echo $result['subject']; ?></td>
						<td><?php echo $barras->getDtVencimento();?></td>
						<td><?php echo $result['barcode'];?></td>
						<td>R$ <?php echo $barras->getValorDocumento();?> </td>
						<td><a href="/" class="btn btn-primary" style="width: 75px;" target="blank"><i class="fas fa-external-link-alt"></i></a></td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</section>

<script> 
	setInterval("updateTickets()", 2000); // Executa a cada 2 segundos (2000 ms) uma função

	// Função para atualizar tickets
	function updateTickets() {
		// Primeira coisa, verificar quantos tickets TEM ATUALMENTE na PÁGINA
		var tickets_current = $('tbody tr').length;

		// Cria requisição Ajax
		$.ajax({
	        url: "get_tickets",
	        type: "GET",
	        dataType: "json",
	        success:function(data) {
	        	var count_db = data.count;

	        	// Se o total de mensagens do banco for diferente do que tem na página
	        	// Tem mensagem nova
	        	if (tickets_current != count_db) {
	        		// Esvazia os boletos atuais
	        		$('tbody').empty();

	        		// Cria o HTML novo
	        		var html_add = "";

	        		$.each(data.data, function(index, value) {
					  	html_add += "<tr>";
					  	html_add += "<td>"+value.subject+"</td>";
					  	html_add += "<td>"+value.dued+"</td>";
					  	html_add += "<td>"+value.barcode+"</td>";
					  	html_add += "<td>R$ "+value.amount+"</td>";
					  	html_add += '<td><a href="/" class="btn btn-primary" style="width: 75px;" target="blank"><i class="fas fa-external-link-alt"></i></a></td>';
					  	html_add += "</tr>";
					});

	        		// Adiciona a nova coluna
					$('tbody').append(html_add);
	        	}
	        },
	        error: function(data) {
	        	alert('Ocorreu um erro, tente novamente');
	        }
		});
	}
</script>
