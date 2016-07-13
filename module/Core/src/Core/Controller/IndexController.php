<?php

namespace Core\Controller;

use Core\Mvc\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Core\Mvc\Controller\RestritoBaseController;

/**
 * Classe Core\Controller$IndexController
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/02/2015 10:19:27
 */
class IndexController extends BaseController {
	
	use RestritoBaseController;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		return new ViewModel();
	}
}
