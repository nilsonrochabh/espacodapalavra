<?php

namespace Core\Controller;

use Zend\View\Model\JsonModel;
use Core\Mvc\Controller\RestritoBaseController;
use Core\Controller\Base\BasePage;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Core\Controller$Select2Controller
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 09/09/2015 00:27:09
 */
class Select2Controller extends BasePage {
    
    use RestritoBaseController;
    
    protected function addButtons(ViewModel $view) {}
    protected function getPageImage() {}
    protected function getPageTitle() {}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		return new JsonModel();
	}
}
