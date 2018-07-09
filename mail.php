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

// Define os dados do servidor e tipo de conex�o
$mail->IsSMTP();                   // Define que a mensagem ser� SMTP
$mail->Host = "smtp.gmail.com";    // Endere�o do servidor SMTP
$mail->Port = 587;                 // Porta TCP para a conex�o
$mail->SMTPAutoTLS = true;         // Utiliza TLS Automaticamente se dispon�vel
$mail->SMTPAuth = true;            // Usar autentica��o SMTP - Sim
$mail->Username = $quemManda;      // Usu�rio de e-mail
$mail->Password = $senha;          // Senha do usu�rio de e-mail

// Define o remetente (voc�)
$mail->From = $quemManda;      // Seu e-mail
$mail->FromName = $nomeManda;  // Seu nome

// Define os destinat�rio(s)
$mail->AddAddress($quemRecebe, $nomeRecebe);                  // Os campos podem ser substituidos por vari�veis
//$mail->AddAddress('webmaster@nomedoseudominio.com');        // Caso queira receber uma copia
//$mail->AddCC('ciclano@site.net', 'Ciclano');                // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva');  // C�pia Oculta

// Define os dados t�cnicos da Mensagem
$mail->IsHTML(true);         // Define que o e-mail ser� enviado como HTML
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

// Limpa os destinat�rios e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado 
if ($enviado) {
 echo "E-mail enviado com sucesso!";
} else {
 echo "N�o foi poss�vel enviar o e-mail.";
 echo "<b>Informa��es do erro:</b> " . $mail->ErrorInfo;
}

?>