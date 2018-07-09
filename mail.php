<?php

// inclui os arquivos do phpmailer
include_once ('phpmailer/Exception.php');
include_once ('phpmailer/PHPMailer.php');
include_once ('phpmailer/SMTP.php');
include_once ('phpmailer/OAuth.php');
include_once ('phpmailer/POP3.php');

//----------------------------------------------------------------
// vars para fazer a vida mais facil
// soh mude aqui uma vez e seja feliz

$quemManda = 'pivatogabriel@gmail.com';  // seu email          
$nomeManda = 'eu';                       // seu nome
$senha = '';                             // sua senha
$quemRecebe = 'pivatogabriel@gmail.com'; // email de quem recebe
$nomeRecebe = 'alguem';                  // nome de quem recebe
$assuntoMsg = 'Eae cara como vai?' ;     // assunto do email
$corpoMsg = 'muito massa' ;              // corpo geral
$corpoAlt = 'pode botar <b>html</b>';    // soh texto

$dirAnex1 = 'img.jpg';                   // caminho do anexo
$nomeAnex1 = 'imagem.jpg';               // nome de seu anexo

$dirAnex2 = 'img.jpg';                   // caminho do anexo
$nomeAnex2 = 'imagem.jpg';               // nome de seu anexo

$dirAnex3 = 'img.jpg';                   // caminho do anexo
$nomeAnex3 = 'imagem.jpg';               // nome de seu anexo
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
//$mail->AddAddress('webmaster@nomedoseudominio.com');        // Caso queira receber uma copia
//$mail->AddCC('ciclano@site.net', 'Ciclano');                // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva');  // Cópia Oculta

// Define os dados técnicos da Mensagem
$mail->IsHTML(true);         // Define que o e-mail será enviado como HTML
$mail->CharSet = 'UTF-8';    // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
$mail->Subject = $assuntoMsg;  // Assunto da msg
$mail->Body = $corpoMsg;       // corpo da msg
$mail->AltBody = $corpoAlt;    // corpo (soh texto)

// Define os anexos (opcional)
$mail->AddAttachment($dirAnex1, $nomeAnex1);   // Insere um anexo
$mail->AddAttachment($dirAnex2, $nomeAnex2);   // Insere um anexo
$mail->AddAttachment($dirAnex3, $nomeAnex3);   // Insere um anexo
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