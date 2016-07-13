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
	
	// ------------------------- BO --------------------------------------------
	
	/**
	 * Método getLocalBO
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 04/09/2015 00:11:52
	 * @return \Core\BO\LocalBO
	 */
	protected function getLocalBO() {
	    return $this->getServiceLocator()->get('Core\BO\Local');
	}
	
	/**
	 * Método getIngredienteBO
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 23:21:39
	 * @return \Core\BO\IngredienteBO
	 */
	protected function getIngredienteBO() {
	    return $this->getServiceLocator()->get('Core\BO\Ingrediente');
	}
	
	/**
	 * Método getReceitaBO
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 23:51:55
	 * @return \Core\BO\ReceitaBO
	 */
	protected function getReceitaBO() {
	    return $this->getServiceLocator()->get('Core\BO\Receita');
	}
	
	/**
	 * Método getUnidadeBO
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 21/09/2015 23:46:07
	 * @return \Core\BO\UnidadeBO
	 */
	protected function getUnidadeBO() {
	    return $this->getServiceLocator()->get('Core\BO\Unidade');
	}
	
	// ------------------------- -- --------------------------------------------
}