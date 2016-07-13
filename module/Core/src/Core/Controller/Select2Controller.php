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
	
	/**
	 * Método ingredienteAction
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 09/09/2015 00:32:08
	 * @return \Zend\View\Model\JsonModel
	 */
    public function ingredienteAction() {
		$request = $this->getRequest();
		if($request->isXmlHttpRequest()) {
			$retorno = array();
	
			$id = $this->params()->fromRoute('id', false);
			if($id) {
				$ids = explode(",", $this->params()->fromRoute('id'));
				$objs = $this->getIngredienteBO()->getByIds($ids);
			} else {
				$pageLimit = $this->params()->fromQuery('page_limit', Util::LIMITE_REGISTROS_AUTOCOMPLETE);
				$qs = explode(" ", trim($this->params()->fromQuery('q', '')));
	
				$objs = $this->getIngredienteBO()->getByNome($qs, $pageLimit);
			}
	
			$retorno['total'] = count($objs);
			$retorno['result'] = array();
	
			foreach($objs as $o) {
				$retorno['result'][] = array('id' => $o->getId(), 'text' => $o->getNome());
			}
	
			return new JsonModel($retorno);
		}
	
		return new JsonModel();
	}
	
	/**
	 * Método unidadeAction
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 22/09/2015 00:43:06
	 */
    public function unidadeAction() {
		$request = $this->getRequest();
		if($request->isXmlHttpRequest()) {
			$retorno = array();
	
			$id = $this->params()->fromRoute('id', false);
			if($id) {
				$ids = explode(",", $this->params()->fromRoute('id'));
				$objs = $this->getUnidadeBO()->getByIds($ids);
			} else {
				$pageLimit = $this->params()->fromQuery('page_limit', Util::LIMITE_REGISTROS_AUTOCOMPLETE);
				$qs = explode(" ", trim($this->params()->fromQuery('q', '')));
	
				$objs = $this->getUnidadeBO()->getBySigla($qs, $pageLimit);
			}
	
			$retorno['total'] = count($objs);
			$retorno['result'] = array();
	
			foreach($objs as $o) {
				$retorno['result'][] = array('id' => $o->getId(), 'text' => $o->getSigla());
			}
	
			return new JsonModel($retorno);
		}
	
		return new JsonModel();
	}
}
