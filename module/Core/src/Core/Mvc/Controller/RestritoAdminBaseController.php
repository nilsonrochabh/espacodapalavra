<?php

namespace Core\src\Core\Mvc\Controller;

use Core\Mvc\Controller\BaseController;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Classe Core\src\Core\Mvc\Controller$RestritoAdminBaseController
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/02/2015 10:26:33
 */
class RestritoAdminBaseController extends BaseController {
	
	/**
	 * (non-PHPdoc)
	 * @see \Genograma\Mvc\Controller\BaseController::setEventManager()
	 */
	public function setEventManager(EventManagerInterface $events) {
		parent::setEventManager($events);
	
		$controller = $this;
	
		// Criamos um evento no dispatch
		$events->attach(
				MvcEvent::EVENT_DISPATCH,
				function($e) use ($controller) {
					// Verificando se o usuário tem acesso.
					if(!$controller->userAuthentication()->hasIdentity() || $this->userAuthentication()->getIdentity()['admin'] == false) {
						return $controller->redirect()->toRoute('login/entrar');
					}
				},
				100
		);
	
		return $this;
	}
}
