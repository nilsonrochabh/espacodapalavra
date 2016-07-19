<?php

namespace Frontend\Controller;

use Core\Exception\CoreException;
use Core\Exception\EmailExistenteException;
use Core\Mvc\Controller\BaseController;
use Frontend\Form\RegistrarForm;
use Zend\View\Model\ViewModel;

/**
 * Classe Frontend\Controller$UsuarioController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 04/03/2016 10:53:17
 */
class UsuarioController extends BaseController {
	
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
		$this->layout('frontend/layout/simple');
		
		$form = $this->getRegistrarForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$post = array_merge_recursive(
				$request->getPost()->toArray(),
				$request->getFiles()->toArray()
			);
			$form->setData($post);
			
			try {
				if($form->isValid()) {
					$data = $form->getData();
					
					$usuario = $this->getUsuarioBO()->registrar(
						$data['nome'],
						$data['email'],
						$data['atuacao'],
						$data['genero'],
						$data['senha'],
						$data['sobre'],
						$data['foto']['tmp_name']
					);
					
					$identity = array(
						'id' => $usuario->getId(),
						'usuario' => $usuario,
					);
					
					$this->getAuthService()->getStorage()->write($identity);
					
					return $this->redirect()->toRoute('conta');
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
		
		return new ViewModel(array(
			'form' => $form,
		));
	}
}