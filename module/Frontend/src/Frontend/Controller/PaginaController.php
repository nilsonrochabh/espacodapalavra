<?php

namespace Frontend\Controller;

use Core\Mvc\Controller\BaseController;
use Frontend\Form\ComentarioForm;
use Model\Proposicao;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Frontend\Controller$PaginaController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 23/02/2016 23:04:08
 */
class PaginaController extends BaseController {
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		return new ViewModel();
	}
	
	/**
	 * Método metodologiasAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function metodologiasAction() {
		return new ViewModel();
	}
	
	/**
	 * Método artistasAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function artistasAction() {
		return new ViewModel();
	}
	
	/**
	 * Método leituraAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function leituraAction() {
		return new ViewModel();
	}
}