<?php

namespace Util;

use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\Smtp;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Message as MimeMessage;
use Zend\Mail\Message;

/**
 * Classe Util$Mail
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 01/09/2014 21:55:25
 */
class Mail {
	
	private $servidor;
	private $porta;
	private $usuario;
	private $senha;
	
	/**
	 * Método __construct
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 22:08:36
	 * @param string $servidor
	 * @param string $porta
	 * @param string $usuario
	 * @param string $senha
	 */
	public function __construct($servidor, $porta, $usuario, $senha) {
		$this->servidor = $servidor;
		$this->porta = $porta;
		$this->usuario = $usuario;
		$this->senha = $senha;
	}
	
	/**
	 * Método enviaEmail
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 22:13:01
	 * @param MailBox $remetente
	 * @param MailBox $destinatario
	 * @param MailBox $responderPara
	 * @param string $assunto
	 * @param string $corpo
	 */
	public function enviaEmail(MailBox $remetente, MailBox $destinatario, $responderPara, $assunto, $corpo) {
		$o = array(
				"name" => "localhost",
				"host" => $this->servidor,
				"port" => $this->porta,
		);
		
		if($this->usuario) {
			$o["connection_class"] = "login";
			$o["connection_config"] = array(
						"username" => $this->usuario,
						"password" => $this->senha,
						"ssl" => "tls"
			);
		}
		
		$options = new SmtpOptions($o);
		
		$html = new MimePart($corpo);
		$html->type = "text/html";
		
		$body = new MimeMessage();
		$body->addPart($html);
		
		$mail = new Message();
		$mail->setBody($body);
		$mail->setFrom($remetente->getEmail(), $remetente->getNome());
		$mail->setTo($destinatario->getEmail(), $destinatario->getNome());
		$mail->setSubject($assunto);
		$mail->setEncoding('UTF-8');
		
		if($responderPara) {
			$mail->setReplyTo($responderPara->getEmail(), $responderPara->getNome());
		}
		
		$transport = new Smtp($options);
		$transport->send($mail);
	}
}