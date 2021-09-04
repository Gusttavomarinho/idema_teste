<?php

namespace Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ServiceMail
{
  private $mail;
  private $host;
  private $username;
  private $smptauth;
  private $smpsecure;
  private $password;
  private $port;
  private $emailfrom;

  public function __construct()
  {
    $this->mail = new PHPMailer();
    // $this->host = 'smtp.mailtrap.io';
    // $this->username = 'fd6599afb69dbc';
    // $this->password = 'b490c495432105';
    // $this->smptauth = true;
    // $this->smpsecure = '';
    // $this->port = 2525;
    // $this->emailfrom = 'teste@gusttavodev.com';

    $this->host = 'smtp.gmail.com';
    $this->username = 'testegusttavodev@gmail.com';
    $this->password = 'gustavo10!';
    $this->smptauth = true;
    $this->smpsecure = 'tls';
    $this->port = 587;
    $this->emailfrom = 'testegusttavodev@gmail.com';
  }

  public function enviarEmail($email_usuario, $assunto_email, $email_corpo)
  {
    $mail = $this->mail;
    $mail->isSMTP();
    $mail->Host = $this->host;
    $mail->SMTPAuth = $this->smptauth;
    $mail->SMTPSecure = $this->smpsecure;
    $mail->Port = $this->port;
    $mail->Username = $this->username;
    $mail->Password = $this->password;

    //dados mokado de teste
    // $email_usuario = 'gustavo@gusttavodev.com';
    // $assunto_email = 'Aprovação da solicitação { Idema } #';
    // $email_corpo = 'Sua Solicitação foi aprovada , <p>segue o link para acesso dos documentos<p> <a href="http://acessar_documentos.com.br">Acessar documentos</a>';

    //montando o email para envio
    $mail->Charset = "UTF-8";
    $mail->setFrom($this->emailfrom);
    $mail->addAddress($email_usuario);
    $mail->isHTML(true);
    $mail->Subject = utf8_decode($assunto_email);
    $mail->Body = utf8_decode($email_corpo);
    if (!$mail->send()) {
      echo 'Erro: ' . $mail->ErrorInfo;
      return 'Erro: ' . $mail->ErrorInfo;
    } else {
      return true;
    }
  }
}
