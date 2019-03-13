<?php
	$conn_remote = new mysqli('techincloud.app','admin_ticketout','TicketOut1234@','admin_ticketout');

	if($conn_remote->connect_errno){
		die ('Falha ao conectar: ('.$conn->connect_errno.')' .$conn->connect_error );
	}

	require __DIR__. '/boletosPHP.php';

	$tickets = $conn_remote->query("SELECT * FROM ticket_messages ORDER BY due_date ASC");

	$data = [];

	while($result = $tickets->fetch_assoc()) {
		$barras = new boletosPHP();
		$barras->setIpte($result['barcode']);
		$dued = $barras->getDtVencimento();
		$amount = $barras->getValorDocumento();

		$data['data'][] = [
			'subject' => $result['subject'],
			'barcode' => $result['barcode'],
			'dued' => $dued,
			'amount' => $amount
		];
	}

	$data['count'] = $tickets->num_rows;

	echo json_encode($data);
?>
