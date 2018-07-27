<?php

session_start();

$dif = $_SESSION['dif'];
//var_dump($dif);

function geraHtml($dif){
	
	$finalHtml = '';
	if (empty($_SESSION['carrinho'])) {
		$_SESSION['carrinho'] = [];
	}else{                
		$arquivo = fopen('produtos.txt', 'r');
		while (!feof($arquivo)) {
			$linha = fgets($arquivo, 1024);
			$produto = explode("|", $linha);
			if (!in_array($produto[0], $_SESSION['carrinho'])) {}
			
		}
		fclose($arquivo);
	}
		
	$c = 0;
		
	foreach ($_SESSION['carrinho'] as $key => $value) {
		$produtoHtml = "
						<tr>
							<td>
								<figure>
									<figcaption name='produto'>{$value['nome']}</figcaption>
								</figure>
							</td>
							<td><p>{$value['descricao']}</p></td>
							<td><p>Preço: {$value['preco']} Reais</p></td>
							<td>
								Tamanho: {$dif[$c]}
								<br>
								Quantidade: {$dif[++$c]},
								<b>Subtotal: <u>{$dif[++$c]} Reais</u> </b>
								<hr>
							</td>
						</tr>
		";
		$finalHtml .= $produtoHtml;
		$c++;	
	}
	
	$dadosCompradorHtml = "
		<hr>
		<div>
			<h1>Nome: </h1>
			<p>{$_POST['nome']}</p>
			<hr>
			<h1>E-mail: </h1>
			<p>{$_POST['email']}</p>
			<hr>
			<h1>Cidade: </h1>
			<p>{$_POST['cidade']}</p>
			<hr>
			<h1>Endereço: </h1>
			<p>{$_POST['endereco']}</p>
			<hr>
			<h1>CEP: </h1>
			<p>{$_POST['cep']}</p>
			<hr>
			<h1>Operadora: </h1>
			<p>{$_POST['oper']}</p>
			<hr>
			<h1>Cartão: </h1>
			<p>{$_POST['cartao']}</p>
			<hr>
			<h1>Código: </h1>
			<p>{$_POST['number']}</p>
			<hr>
			<h1>Preço total: </h1>
			<h2>{$_SESSION['totalCompra']} Reais</h2>
		</div>
		<hr>
	";

	return '<table>' . $finalHtml . '</table>' . $dadosCompradorHtml;
}
/*
echo '<pre>';
echo '<hr>';
var_dump($_SESSION);
echo '<hr>';
var_dump($_POST);
echo '<hr>';
echo '</pre>';
*/
// inclui os arquivos do phpmailer
include_once ('phpmailer/Exception.php');
include_once ('phpmailer/PHPMailer.php');
include_once ('phpmailer/SMTP.php');
include_once ('phpmailer/OAuth.php');
include_once ('phpmailer/POP3.php');

//----------------------------------------------------------------
// vars para fazer a vida mais facil

// ****adicione os dados do seu email para funcionar, (email e senha)****

$quemManda = '';                         // seu email          
$nomeManda = 'IFRS BG Compras';          // seu nome
$senha = '';                             // sua senha
$quemRecebe = $_POST['email'];           // email de quem recebe
$nomeRecebe = $_POST['nome'];            // nome de quem recebe
$assuntoMsg = 'Compra efetuada com sucesso!' ;     // assunto do email
$corpoMsg = geraHtml($dif);              // corpo geral
//----------------------------------------------------------------

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
$mail->IsSMTP();                   // Define que a mensagem será SMTP
$mail->Host = "smtp.gmail.com";    // Endereço do servidor SMTP
$mail->Port = 587;                 // Porta TCP para a conexão
$mail->SMTPAutoTLS = true;         // Utiliza TLS Automaticamente se disponível
$mail->SMTPAuth = true;            // Usar autenticação SMTP - Sim
$mail->Username = $quemManda;      // Usuário de e-mail
$mail->Password = $senha;          // Senha do usuário de e-mail

// Define o remetente (você)
$mail->From = $quemManda;      // Seu e-mail
$mail->FromName = $nomeManda;  // Seu nome

// Define os destinatário(s)
$mail->AddAddress($quemRecebe, $nomeRecebe);                  // Os campos podem ser substituidos por variáveis

// Define os dados técnicos da Mensagem
$mail->IsHTML(true);         // Define que o e-mail será enviado como HTML
$mail->CharSet = 'UTF-8';    // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
$mail->Subject = $assuntoMsg;  // Assunto da msg
$mail->Body = $corpoMsg;       // corpo da msg	

// Define os anexos
foreach ($_SESSION['carrinho'] as $key => $value) {
	$nomeAnex =  'imagem' . rand(0, 10) . '.img';
	$mail->AddAttachment($value['imagem'], $nomeAnex);
}
//$mail->AddAttachment($dirAnex1, $nomeAnex1);   // Insere um anexo
// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado 
if ($enviado) {
 echo "E-mail enviado com sucesso!";
} else {
 echo "Não foi possível enviar o e-mail.";
 echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
}

?>