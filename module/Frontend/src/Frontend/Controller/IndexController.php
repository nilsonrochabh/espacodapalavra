<?php

namespace Frontend\Controller;

use Core\Mvc\Controller\BaseController;
use Frontend\Form\ComentarioForm;
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
			'lista' => $lista,
			'termoBusca' => $q,
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
		
		$form = new ComentarioForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$form->setData($request->getPost());
			
			try {
				if($form->isValid()) {
					$data = $form->getData();
					
					$this->getProposicaoBO()->adicionarComentario($proposicao, $this->getIdUsuarioLogado(), $data['comentario']);
					$this->flashMessenger()->addSuccessMessage('Comentário enviado com sucesso.');
					
					$form = new ComentarioForm();
				}
			} catch(EmailExistenteException $e) {
				$this->flashMessenger()->addErrorMessage($e->getMessage());
				$form->get('email')->setMessages(array($e->getMessage()));
			} catch(CoreException $e) {
				$this->flashMessenger()->addErrorMessage($e->getMessage());
			} catch(\Exception $e) {
				$this->handleException($e);
			}
		}
		
		$proposicao->calcularTempoTotal();
		
		return new ViewModel(array(
			'proposicao' => $proposicao,
			'form' => $form,
			'seguiu' => $proposicao->seguiu($this->getIdUsuarioLogado()),
			'curtiu' => $proposicao->curtiu($this->getIdUsuarioLogado()),
			'fez' => $proposicao->fez($this->getIdUsuarioLogado()),
		));
	}
	
	/**
	 * Método seguirAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function seguirAction() {
		$idProposicao = $this->params()->fromRoute('id', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
		}
		
		if($proposicao == null) {
			$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
			return $this->redirect()->toRoute('home');
		}
		
		try {
			$this->getProposicaoBO()->seguir($proposicao, $this->getIdUsuarioLogado());
		} catch(CoreException $e) {
			$this->flashMessenger()->addErrorMessage($e->getMessage());
		} catch(\Exception $e) {
			$this->handleException($e);
		}
		
		return $this->redirect()->toRoute('proposicao', array('id' => $idProposicao));
	}
	
	/**
	 * Método curtirAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function curtirAction() {
		$idProposicao = $this->params()->fromRoute('id', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
		}
		
		if($proposicao == null) {
			$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
			return $this->redirect()->toRoute('home');
		}
		
		try {
			$this->getProposicaoBO()->curtir($proposicao, $this->getIdUsuarioLogado());
		} catch(CoreException $e) {
			$this->flashMessenger()->addErrorMessage($e->getMessage());
		} catch(\Exception $e) {
			$this->handleException($e);
		}
		
		return $this->redirect()->toRoute('proposicao', array('id' => $idProposicao));
	}
	
	/**
	 * Método concluirAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function concluirAction() {
		$idProposicao = $this->params()->fromRoute('id', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
		}
		
		if($proposicao == null) {
			$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
			return $this->redirect()->toRoute('home');
		}
		
		try {
			$this->getProposicaoBO()->concluir($proposicao, $this->getIdUsuarioLogado());
		} catch(CoreException $e) {
			$this->flashMessenger()->addErrorMessage($e->getMessage());
		} catch(\Exception $e) {
			$this->handleException($e);
		}
		
		return $this->redirect()->toRoute('proposicao', array('id' => $idProposicao));
	}
}