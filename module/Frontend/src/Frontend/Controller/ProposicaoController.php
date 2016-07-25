<?php

namespace Frontend\Controller;

use Core\Exception\CoreException;
use Core\Mvc\Controller\BaseController;
use Core\Mvc\Controller\RestritoBaseController;
use Frontend\Form\CategorizacaoForm;
use Frontend\Form\InformacoesForm;
use Frontend\Form\MontagemForm;
use Model\Passo;
use Model\Proposicao;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Frontend\Controller$ProposicaoController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 17/07/2016 14:10:27
 */
class ProposicaoController extends BaseController {
	
	use RestritoBaseController;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		$idProposicao = $this->params()->fromRoute('idProposicao', null);
		
		if($idProposicao !== null) {
			return $this->redirect()->toRoute('publique', array('action' => 'informacoes', 'idProposicao' => $idProposicao));
		}
		
		return $this->redirect()->toRoute('publique', array('action' => 'informacoes'));
	}
	
	/**
	 * Método informacoesAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function informacoesAction() {
		$idProposicao = $this->params()->fromRoute('idProposicao', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
			
			if($proposicao == null || (!$this->getUsuarioLogado()->getIsAdmin() && $proposicao->getIdUsuario() != $this->getIdUsuarioLogado())) {
				$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
				return $this->redirect()->toRoute('publique');
			}
		}
		
		$form = new InformacoesForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			
			$files = $request->getFiles()->toArray();
			if(isset($files['imagem']['name']) &&
				!Util::IsNullOrEmptyString($files['imagem']['name'])) {
				$post = array_merge_recursive(
					$request->getPost()->toArray(),
					$files
				);
			} else {
				$post = $request->getPost();
			}
			
			$form->setData($post);
			
			if($form->isValid()) {
				try {
					$data = $form->getData();
					
					if($proposicao == null) {
						$proposicao = new Proposicao();
						$proposicao->setIdUsuario($this->getIdUsuarioLogado());
						$proposicao->setIsRascunho(1);
						$proposicao->setDataCadastro(Util::agora());
					}
					
					$proposicao->setNome($data['nome']);
					$proposicao->setObjetivo($data['objetivo']);
					$proposicao->setStart($data['start']);
					
					$this->getProposicaoBO()->save($proposicao, $data['imagem'] ? $data['imagem']['tmp_name'] : null);
					
					return $this->redirect()->toRoute('publique', array('action' => 'montagem', 'idProposicao' => $proposicao->getId()));
				} catch(CoreException $e) {
					$this->flashMessenger()->addErrorMessage($e->getMessage());
				} catch(\Exception $e) {
					$this->handleException($e);
				}
			}
		} elseif($idProposicao > 0) {
			$form->get('nome')->setValue($proposicao->getNome());
			$form->get('objetivo')->setValue($proposicao->getObjetivo());
			$form->get('start')->setValue($proposicao->getStart());
		}
		
		return new ViewModel(array(
			'form' => $form,
			'proposicao' => $proposicao,
		));
	}

	/**
	 * Método montagemAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function montagemAction() {
		$idProposicao = $this->params()->fromRoute('idProposicao', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
			
			if($proposicao == null || (!$this->getUsuarioLogado()->getIsAdmin() && $proposicao->getIdUsuario() != $this->getIdUsuarioLogado())) {
				$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
				return $this->redirect()->toRoute('publique');
			}
		} else {
			$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
			return $this->redirect()->toRoute('publique');
		}
		
		$idPasso = $this->params()->fromRoute('passo', 0);
		
		$passo = null;
		if($idPasso > 0) {
			$passo = $this->getProposicaoBO()->getPasso($idPasso, $proposicao->getId());
			
			if($passo == null || (!$this->getUsuarioLogado()->getIsAdmin() && $proposicao->getIdUsuario() != $this->getIdUsuarioLogado())) {
				$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
				return $this->redirect()->toRoute('publique');
			}
		}
		
		$form = new MontagemForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$form->setData($request->getPost());
			
			if($form->isValid()) {
				try {
					if($passo == null) {
						$passo = new Passo();
					}
					
					$passo->setTitulo($form->get('titulo')->getValue());
					$passo->setPosicao(1);
					$passo->setTexto($form->get('proposicao-conteudo')->getValue());
					$passo->setDuracao($form->get('duracao')->getValue());
					$passo->setMateriaisNecessarios($form->get('materiais')->getValue());
					
					$this->getProposicaoBO()->savePasso($passo, $proposicao);
					
					return $this->redirect()->toRoute('publique', array('action' => 'montagem', 'idProposicao' => $proposicao->getId()));
				} catch(CoreException $e) {
					$this->flashMessenger()->addErrorMessage($e->getMessage());
				} catch(\Exception $e) {
					$this->handleException($e);
				}
			}
		} elseif($idPasso > 0) {
			$form->get('titulo')->setValue($passo->getTitulo());
			$form->get('proposicao-conteudo')->setValue($passo->getTexto());
			$form->get('duracao')->setValue($passo->getDuracao());
			$form->get('materiais')->setValue($passo->getMateriaisNecessarios());
			$form->get('submit')->setValue($this->_('Salvar Passo'));
		}
		
		$passos = $proposicao->getPassos()->getData();
		
		return new ViewModel(array(
			'form' => $form,
			'proposicao' => $proposicao,
			'passos' => $passos,
		));
	}
	
	/**
	 * Método deletePassoAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function deletePassoAction() {
		$idProposicao = $this->params()->fromRoute('idProposicao', 0);
		$idPasso = $this->params()->fromRoute('passo', 0);
		
		try {
			$this->getProposicaoBO()->deletePasso($idPasso, $idProposicao);
			$this->flashMessenger()->addSuccessMessage($this->_('Passo excluído com sucesso.'));
		} catch(CoreException $e) {
			$this->flashMessenger()->addErrorMessage($e->getMessage());
		} catch(\Exception $e) {
			$this->handleException($e);
		}
		
		return $this->redirect()->toRoute('publique', array('action' => 'montagem', 'idProposicao' => $idProposicao));
	}
	
	/**
	 * Método montagemAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 23/03/2016 16:14:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function categorizacaoAction() {
		$idProposicao = $this->params()->fromRoute('idProposicao', 0);
		
		$proposicao = null;
		if($idProposicao > 0) {
			$proposicao = $this->getProposicaoBO()->getByPK($idProposicao);
			
			if($proposicao == null || (!$this->getUsuarioLogado()->getIsAdmin() && $proposicao->getIdUsuario() != $this->getIdUsuarioLogado())) {
				$this->flashMessenger()->addErrorMessage($this->_('Proposição não encontrada.'));
				return $this->redirect()->toRoute('publique');
			}
		}
		
		$form = new CategorizacaoForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$form->setData($request->getPost());
			
			if($form->isValid()) {
				try {
					$this->getProposicaoBO()->salvarCategorizacao(
						$proposicao,
						$form->get('categoria')->getValue(),
						$form->get('habilidade')->getValue(),
						$form->get('ambiente')->getValue(),
						$form->get('recurso')->getValue(),
						$form->get('tamanho')->getValue()
					);
					
					return $this->redirect()->toRoute('proposicao', array('id' => $proposicao->getId()));
				} catch(CoreException $e) {
					$this->flashMessenger()->addErrorMessage($e->getMessage());
				} catch(\Exception $e) {
					$this->handleException($e);
				}
			}
		} elseif($idProposicao > 0) {
			$habilidades = $proposicao->getHabilidadeProposicaos();
			$habilidadesId = array();
			foreach($habilidades as $o) {
				$habilidadesId[] = $o->getIdHabilidade();
			}
			
			$form->get('habilidade')->setValue($habilidadesId);
			
			$ambientes = $proposicao->getAmbienteProposicaos();
			$ambientesId = array();
			foreach($ambientes as $o) {
				$ambientesId[] = $o->getIdAmbiente();
			}
			
			$form->get('ambiente')->setValue($ambientesId);
			
			$recursos = $proposicao->getRecursoProposicaos();
			$recursosId = array();
			foreach($recursos as $o) {
				$recursosId[] = $o->getIdRecurso();
			}
			
			$form->get('recurso')->setValue($recursosId);
			
			$tamanhos = $proposicao->getTamanhoTurmaProposicaos();
			$tamanhosId = array();
			foreach($tamanhos as $o) {
				$tamanhosId[] = $o->getIdTamanhoTurma();
			}
			
			$form->get('tamanho')->setValue($tamanhosId);
		}
		
		return new ViewModel(array(
			'form' => $form,
			'proposicao' => $proposicao,
		));
	}
}