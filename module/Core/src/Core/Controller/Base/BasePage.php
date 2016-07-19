<?php

namespace Core\Controller\Base;

use Core\Mvc\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Util\Util;
use Core\Mvc\Controller\RestritoBaseController;

/**
 * Classe Core\Controller\Base$BasePage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 12:43:41
 */
abstract class BasePage extends BaseController {
    
    use RestritoBaseController;
	
	/**
	 * Método getPageTitle
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 15:13:43
	 * @return string
	 */
	abstract protected function getPageTitle();
	
	/**
	 * Método getPageImage
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 15:13:52
	 * @return string
	 */
	abstract protected function getPageImage();
	
	/**
	 * Método addButtons
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 15:14:00
	 */
	abstract protected function addButtons(ViewModel $view);
}