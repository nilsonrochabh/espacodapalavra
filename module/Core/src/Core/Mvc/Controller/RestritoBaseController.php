<?php

namespace Core\Mvc\Controller;

use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Trait Core\src\Core\Mvc\Controller$RestritoBaseController
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/02/2015 10:25:43
 */
trait RestritoBaseController {
	
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
					if(!$controller->userAuthentication()->hasIdentity()) {
						return $controller->redirect()->toRoute('login/entrar');
					}
				},
				100
		);
	
		return $this;
	}
}
