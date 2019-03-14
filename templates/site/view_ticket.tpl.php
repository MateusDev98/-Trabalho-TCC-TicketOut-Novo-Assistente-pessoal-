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
<br><br><br><br><br><br><br>
 <a href="/<?php echo $link_ticket; ?>" target="_blank">Abrir Boleto </a>

