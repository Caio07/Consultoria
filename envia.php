<?php
if(!isset($_POST[Submit])) die("N&atilde;o recebi nenhum par&acitc;metro. Por favor volte ao formulario.html antes");
/* Medida preventiva para evitar que outros dom�nios sejam remetente da sua mensagem. */
if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
        $emailsender='contato@innovationtime.com.br';
        // Esta linha deve ser modificada usando um e-mail v�lido @dominio_do_site
} else {
        $emailsender = "contato@" . $_SERVER[HTTP_HOST];        
        // Esta linha deve ser modificada usando o mesmo e-mail v�lido @dominio_do_site escrito acima, entretanto apenas at� o caractere "@" (conforme mostrado no c�digo).
        // Precisa ser desta forma porque estamos concatenando o "Seuemail@" com a vari�vel $_SERVER["HTTP_HOST"] do PHP, e esta vari�vel j� possui como valor o dom�nio do site.   
}
 
/* Verifica qual � o sistema operacional do servidor para ajustar o cabe�alho de forma correta. N�o alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formul�rio para as vari�veis abaixo
$nomeremetente     = $_POST['nome'];
$telefone          = $_POST['telefone'];
$emailremetente    = trim($_POST['email']);
$emaildestinatario = 'contato@innovationtime.com.br';/* E-mail que deseja receber a mensagem*/
$cidadeestado       = $_POST['cidade'];
$empresa          = $_POST['empresa'];
$mensagem          = $_POST['mensagem'];
$assunto         = 'Contato Site Innovation Time';
 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<strong> Nome: </strong><P>'.$nomeremetente.'</P><strong> Telefone: </strong><P>'.$telefone.'</P><strong> Email: </strong><P>'.$emailremetente.'</P><strong> Cidade/Estado </strong><P>'.$cidadeestado.'</P><strong> Empresa: </strong><P>'.$empresa.'</P><strong> Mensagem: </strong><P>'.$mensagem.'</P>';
 
 
/* Montando o cabe�alho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima cont�m "text/html", sem essa linha, a mensagem n�o chegar� formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente ser� usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
 
/* Mostrando na tela as informa��es enviadas por e-mail */
echo "<script>alert('Mensagem enviada com sucesso!');</script>";
echo "<script> window.location.href = 'http://www.innovationtime.com.br/'; </script>";
?>