<?php

namespace Login\Authentication\Storage;

use Zend\Authentication\Storage;

/**
 * Classe Login\src\Login\Authentication\Storage$MyAuthStorage
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 10/03/2014 23:15:50
 */
class MyAuthStorage extends Storage\Session {
	
	/**
	 * Método setRememberMe
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:15:54
	 * @param number $rememberMe
	 * @param number $time
	 */
	public function setRememberMe($rememberMe = 0, $time = 1209600) {
		if($rememberMe == 1) {
			$this->session->getManager()->rememberMe($time);
		}
	}
	
	/**
	 * Método forgetMe
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:15:58
	 */
	public function forgetMe() {
		$this->session->getManager()->forgetMe();
	}
}
