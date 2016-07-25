<?php

namespace Frontend\Controller;

use Core\Exception\CoreException;
use Core\Exception\EmailExistenteException;
use Core\Mvc\Controller\BaseController;
use Frontend\Form\ContaForm;
use Frontend\Form\RegistrarForm;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Frontend\Controller$ContaController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 04/03/2016 10:53:17
 */
class ContaController extends BaseController {
	
	protected $authservice;
	protected $registrarForm;
	
	/**
	 * Método getAuthService
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:28:32
	 */
	public function getAuthService() {
		if(!$this->authservice) {
			$this->authservice = $this->getServiceLocator()->get('AuthService');
		}
		
		return $this->authservice;
	}
	
	/**
	 * Método getRegistrarForm
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 05/03/2016 17:09:01
	 * @return \Frontend\Form\RegistrarForm
	 */
	public function getRegistrarForm() {
		if(!$this->registrarForm) {
			$this->registrarForm = new RegistrarForm();
		}
		return $this->registrarForm;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		$form = new ContaForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$files = $request->getFiles()->toArray();
			if(isset($files['foto']['name']) &&
				!Util::IsNullOrEmptyString($files['foto']['name'])) {
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
					
					$usuario = $this->getUsuarioBO()->editar(
						$this->getIdUsuarioLogado(),
						$data['nome'],
						$data['email'],
						$data['atuacao'],
						$data['genero'],
						null,
						$data['sobre'],
						$data['foto'] ? $data['foto']['tmp_name'] : null
					);
					
					$identity = array(
						'id' => $usuario->getId(),
						'usuario' => $usuario,
					);
					
					$this->getAuthService()->getStorage()->write($identity);
					
					$this->flashMessenger()->addSuccessMessage('Dados salvos com sucesso.');
					return $this->redirect()->toRoute('conta');
				} catch(CoreException $e) {
					$this->flashMessenger()->addErrorMessage($e->getMessage());
				} catch(\Exception $e) {
					$this->handleException($e);
				}
			}
		} else {
			$form->get('nome')->setValue($this->getUsuarioLogado()->getNome());
			$form->get('email')->setValue($this->getUsuarioLogado()->getEmail());
			$form->get('atuacao')->setValue($this->getUsuarioLogado()->getAtuacao());
			$form->get('genero')->setValue($this->getUsuarioLogado()->getGenero());
			$form->get('sobre')->setValue($this->getUsuarioLogado()->getDescricaoContexto());
		}
		
		$lista = $this->getProposicaoBO()->minhaLista($this->getIdUsuarioLogado());
		
		return new ViewModel(array(
			'form' => $form,
			'lista' => $lista,
		));
	}
}