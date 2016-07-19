<?php

namespace Frontend\Controller;

use Core\Mvc\Controller\BaseController;
use Model\Proposicao;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Frontend\Controller$IndexController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 23/02/2016 23:04:08
 */
class IndexController extends BaseController {
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		$categoriaParam = $this->params()->fromRoute('tipo', null);
		$categoria = $categoriaParam && array_key_exists($categoriaParam, Proposicao::$CATEGORIA) ? Proposicao::$CATEGORIA[$categoriaParam] : null;
		
		$q = $this->params()->fromQuery('q', null);
		
		$lista = $this->getProposicaoBO()->lista($categoria, $q);
		return new ViewModel(array(
			'lista' => $lista
		));
	}
	
	/**
	 * Método proposicaoAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function proposicaoAction() {
		$idProposicao = $this->params()->fromRoute('id', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
		}
		
		if($proposicao == null) {
			$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
			return $this->redirect()->toRoute('home');
		}
		
		$proposicao->calcularTempoTotal();
		
		return new ViewModel(array(
			'proposicao' => $proposicao
		));
	}
}