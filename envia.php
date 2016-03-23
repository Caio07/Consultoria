<?php
if(!isset($_POST[Submit])) die("N&atilde;o recebi nenhum par&acitc;metro. Por favor volte ao formulario.html antes");
/* Medida preventiva para evitar que outros domínios sejam remetente da sua mensagem. */
if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
        $emailsender='contato@innovationtime.com.br';
        // Esta linha deve ser modificada usando um e-mail válido @dominio_do_site
} else {
        $emailsender = "contato@" . $_SERVER[HTTP_HOST];        
        // Esta linha deve ser modificada usando o mesmo e-mail válido @dominio_do_site escrito acima, entretanto apenas até o caractere "@" (conforme mostrado no código).
        // Precisa ser desta forma porque estamos concatenando o "Seuemail@" com a variável $_SERVER["HTTP_HOST"] do PHP, e esta variável já possui como valor o domínio do site.   
}
 
/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
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
 
 
/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
 
/* Mostrando na tela as informações enviadas por e-mail */
echo "<script>alert('Mensagem enviada com sucesso!');</script>";
echo "<script> window.location.href = 'http://www.innovationtime.com.br/'; </script>";
?>