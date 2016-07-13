<?php

namespace Util;

/**
 * Classe Util$MailBox
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 01/09/2014 22:17:29
 */
class MailBox {
	
	private $nome;
	private $email;

	/**
	 * Método __construct
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 22:17:37
	 * @param string $nome
	 * @param string $email
	 */
	public function __construct($nome, $email) {
		$this->nome = $nome;
		$this->email = $email;
	}
	
	/**
	 * Método getNome
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 22:19:31
	 * @return string
	 */
	public function getNome() {
		return $this->nome;
	}
	
	/**
	 * Método getEmail
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 22:19:45
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
}