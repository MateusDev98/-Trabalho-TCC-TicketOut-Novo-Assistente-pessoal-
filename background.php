<?php

// Atributos da configuração PHP (Depende do servidor)
// Seta uma memória limit e timeout infinito
ini_set('memory_limit', '1048M');
set_time_limit(0);

require 'vendor/autoload.php'; // Arquivo do composer
//require 'connection.php'; // Arquivo da conexão ao banco de dados


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

// Inclui o objeto do TotalVoice (Classe)
use TotalVoice\Client as TotalVoiceClient;

// Inicia conexão com o IMAP E-mail
$mbox = imap_open("{outlook.office365.com:993/imap/ssl/novalidate-cert}", 'tiketout@outlook.com', 'tiket1424') or die ( imap_last_error());

// While infinito - Para sempre executar uma nova busca ao servidor IMAP
while(true) {
    // Buscar a última mensagem salva
    $consult = $connection->prepare('SELECT * FROM ticket_messages ORDER BY id DESC LIMIT 1');
    $consult->execute();
    $last_message = $consult->fetch(PDO::FETCH_ASSOC);

    // Reabre a conexão IMAP para buscar nova quantidade de mensagens (atualizado)
    imap_reopen($mbox, "{outlook.office365.com:993}INBOX") or die(implode(", ", imap_errors()));

    $number = imap_num_msg($mbox);

    // Verifica se tem mensagem nova
    if (empty($last_message) == true or $last_message['id_message'] != $number) {
	    //Pega o número de mensagens mais as suas informações
        $message_imap = imap_headerinfo($mbox, $number);
 
        // Apartir daqui realiza o download dos anexos no FORMATO PDF - PROVAVEL BOLETO
        // Realiza validações conforme o conteúdo do anexo
        $structure = imap_fetchstructure($mbox, $number);
 
        $attachments = array();
 
        if(isset($structure->parts) && count($structure->parts)) 
        {
            for($i = 0; $i < count($structure->parts); $i++) 
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );
 
                if($structure->parts[$i]->ifdparameters) 
                {
                    foreach($structure->parts[$i]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }
 
                if($structure->parts[$i]->ifparameters) 
                {
                    foreach($structure->parts[$i]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }
 
                if($attachments[$i]['is_attachment']) 
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($mbox, $number, $i+1);
 
                    if($structure->parts[$i]->encoding == 3) 
                    { 
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    elseif($structure->parts[$i]->encoding == 4) 
                    { 
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        // Percorre os anexos após validações
        $i_attachment = 1;
        $is_ticket = false;

        $barcode = null;
        $attachment_name = null;
 
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                // Caputra o nome original do arquivo
                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];

                // Captura a extensão do anexo
                $info = new SplFileInfo($filename);
                $extension = $info->getExtension();

                // Verifica se a extensão do anexo é um PDF
                if (strpos($extension, 'pdf') !== false) {
                    $extension = ".pdf";

                    $fp = fopen("attachments/" . $number . "-" . $i_attachment . $extension, "w+");
                    fwrite($fp, $attachment['attachment']);
                    fclose($fp);

                    // Converte o PDF (Anexo) em TEXTO usando um pacote
                    $text = (new \Spatie\PdfToText\Pdf())
                        ->setPdf("attachments/" . $number . "-" . $i_attachment . $extension)
                        ->text();

                    // Aplica expressão regular para capturar a região do código de barras
                    $matches = [];
                    preg_match('/\d{5}\W\d{5} \d{5}\W\d{6} \d{5}\W\d{6} \d \d{14}/', $text, $matches);

                    // Se não encontrou, o anexo é qualquer coisa menos BOLETO
                    if (empty($matches)) {
                        // Apaga o arquivo para não ficar armazenado
                        unlink("attachments/" . $number . "-" . $i_attachment . $extension);

                        continue; // Continue => Ignora o que vem depois e passa para o próximo item do loop (Caso tiver mais arquivos anexo)
                    }

                    // Caso contrário, é um arquivo .pdf e é um boleto :D
                    $is_ticket = true; // Pode salvar no banco

                    // Seta o código + nome do arquivo para salvar no DB posteriormente
                    $barcode = $matches[0];
                    $attachment_name = $number . "-" . $i_attachment . $extension;

                    // Incrementa a variavel contador de anexos
                    $i_attachment++;
                }
            }
 
	}

        // Se tiver algum anexo PDF (is_ticket recebe true)
        // Nesse caso é uma mensagem de boleto :D
        if ($is_ticket == true) {
            //Insere no banco
            $stmt = $connection->prepare('INSERT INTO ticket_messages (id_message, subject, content, attachment, created_at, barcode, due_date) VALUES(:idMessage, :subject, :content, :attachment, :created, :barcode, :due_date)');

	    require_once 'boletosPHP.php';
            $barras = new boletosPHP();

            $barras->setIpte($barcode);
	    $msg_sms = "NOVO BOLETO: Você tem um novo boleto com a data de vencimento dia: ".$barras->getDtVencimento()." com valor de R$" . $barras->getValorDocumento();

	    $stmt->execute(array(
                ':idMessage' => $number,
                ':subject' => $message_imap->subject,
                ':content' => nl2br(imap_fetchbody($mbox, $number, "1")),
                ':barcode' => $barcode,
                ':attachment' => $attachment_name,
		':created' => date('Y-m-d H:i:s'),
		':due_date' => date("Y-m-d", strtotime($barras->getDtVencimento()))
	    ));

            // Após salvar no banco, notificar via SMS
            $client = new TotalVoiceClient('7483aef8c044ff32ac2e0c9113f2ef6e');
            $response = $client->sms->enviar('51992653936', $msg_sms);
        }
	}
}
