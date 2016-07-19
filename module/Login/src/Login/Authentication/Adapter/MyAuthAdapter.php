<?php

namespace Login\Authentication\Adapter;

use Zend\Authentication;
use Zend\Authentication\Adapter\AdapterInterface;
use Model\Base\UsuarioQuery;
use Util\Util;
use Model\Usuario;

/**
 * Classe Login\Authentication\Adapter$MyAuthAdapter
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 11/03/2014 00:46:29
 */
class MyAuthAdapter implements AdapterInterface {
	
	protected $_usuario = null;
	protected $_senha = null;
	protected $_salt = null;
	
	/* (non-PHPdoc)
	 * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
	 */
	public function authenticate() {
		$usuario = filter_var($this->_usuario, FILTER_SANITIZE_SPECIAL_CHARS);
		$senha = filter_var($this->_senha, FILTER_SANITIZE_SPECIAL_CHARS);
		if($senha) {
			$senha = Util::crypt($senha, $this->_salt);
		}
		
		$query = UsuarioQuery::create()->filterByEmail($usuario)->filterBySenha(empty($senha) ? NULL : $senha);
		$user = $query->findOne();
		
		$code = Authentication\Result::FAILURE;
		$identity = array();
		$messages = array();
		
		if($user !== NULL) {
			$code = Authentication\Result::SUCCESS;
			$identity = array(
				'id' => $user->getId(),
				'usuario' => $user,
			);
		} else {
			$code = Authentication\Result::FAILURE_CREDENTIAL_INVALID;
			$messages[] = _('Email/Senha incorretos.');
		}
		
		return new Authentication\Result($code, $identity, $messages);
	}
	
	/**
	 * @return the $_usuario
	 */
	public function getUsuario() {
		return $this->_usuario;
	}

	/**
	 * @return the $_senha
	 */
	public function getSenha() {
		return $this->_senha;
	}
	
	/**
	 * @return the $_salt
	 */
	public function getSalt() {
		return $this->_salt;
	}

	/**
	 * @param field_type $_usuario
	 */
	public function setUsuario($_usuario) {
		$this->_usuario = $_usuario;
		return $this;
	}

	/**
	 * @param field_type $_senha
	 */
	public function setSenha($_senha) {
		$this->_senha = $_senha;
		return $this;
	}
	
	/**
	 * @param field_type $_salt
	 */
	public function setSalt($_salt) {
		$this->_salt = $_salt;
		return $this;
	}
}
