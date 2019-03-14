<?php 

require __DIR__. '/boletosPHP.php';

$username = "admin_ticketout";
$password = "TicketOut1234@";
$hostname = "localhost";
$dbName = "admin_ticketout";

try {
        $connection = new \PDO("mysql:host={$hostname};dbname={$dbName}", $username, $password);
        $connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
} catch (\PDOException $e) {
        die('Error to connecting database');
}

$stmt = $connection->prepare("SELECT * FROM ticket_messages WHERE id = ".$_GET['id']." LIMIT 1");
$stmt->execute();
$ticket = $stmt->fetch();

$barras = new boletosPHP();
$barras->setIpte($ticket['barcode']);
$dued = $barras->getDtVencimento();
$amount = $barras->getValorDocumento();
$link_ticket = "attachments/" . $ticket['attachment'];
?>
<section>
	<main>
		<div class="container">
			<div class="row">
				<div class="panel" style="margin-top:10%">
					<div class="panel-body text-center">
						<h1> Fazer o dowload do boleto </h1>
						<p>  Este boleto está com a data e vencimento para: <?php echo $dued; ?><br> 
							Com o valor de: <?php echo $amount." R$";?> </p>
						<a href="/<?php echo $link_ticket; ?>" class="btn btn-primary" target="_blank"><i class="fas fa-file-download"></i> Download </a>
					</div>
				</div>
			</div>
		</div>
	</main>
</section>

