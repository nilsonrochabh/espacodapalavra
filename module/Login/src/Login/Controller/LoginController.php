<?php

namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Classe Login\Controller$LoginController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 10/03/2014 23:28:27
 */
class LoginController extends AbstractActionController {
	
	protected $form;
	protected $storage;
	protected $authservice;
	
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
	 * Método getSessionStorage
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:28:36
	 */
	public function getSessionStorage() {
		if(!$this->storage) {
			$this->storage = $this->getServiceLocator()->get('Login\Authentication\Storage\MyAuthStorage');
		}
		
		return $this->storage;
	}
	
	/**
	 * Método getForm
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:38:47
	 */
	public function getForm() {
		if(!$this->form) {
			$this->form = $this->getServiceLocator()->get('Login\Form\Login');
		}
		return $this->form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		return $this->redirect()->toRoute('login/entrar');
	}
	
	/**
	 * Método loginAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:39:13
	 */
	public function loginAction() {
		$this->layout('layout/login');
		
		if($this->getAuthService()->hasIdentity()) {
			return $this->redirect()->toRoute('login/sucesso');
		}
		
		$form = $this->getForm();
		
		return array(
			'form' => $form,
			'messages'  => $this->flashmessenger()->getMessages()
		);
	}
	
	/**
	 * Método authenticateAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:43:09
	 */
	public function authenticateAction() {
		$form = $this->getForm();
		$redirect = 'login/entrar';
		
		$translator = $this->getServiceLocator()->get('translator');
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$form->setData($request->getPost());
			
			if($form->isValid()) {
				$config = $this->getServiceLocator()->get('Config');
				$salt = $config['security']['salt'];
				
				$this->getAuthService()->getAdapter()
						->setUsuario($request->getPost('usuario'))
						->setSenha($request->getPost('senha'))
						->setSalt($salt);
				
				$result = $this->getAuthService()->authenticate();
				foreach($result->getMessages() as $message) {
					$this->flashmessenger()->addErrorMessage($translator->translate($message));
				}
				
				if($result->isValid()) {
					$redirect = 'login/sucesso';
					//check if it has rememberMe :
					if($request->getPost('rememberme') == 1 ) {
						$this->getSessionStorage()->setRememberMe(1);
						//set storage again
						$this->getAuthService()->setStorage($this->getSessionStorage());
					}
					$this->getAuthService()->getStorage()->write($result->getIdentity());
					
					$this->flashmessenger()->addSuccessMessage($translator->translate("Sessão iniciada com sucesso"));
				}
			} else {
				$this->flashmessenger()->addErrorMessage($translator->translate('Dados inválidos.'));
			}
		}
		
		return $this->redirect()->toRoute($redirect);
	}
	
	/**
	 * Método logoutAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:54:17
	 */
	public function logoutAction() {
		$this->getSessionStorage()->forgetMe();
		$this->getAuthService()->clearIdentity();
		
		$translator = $this->getServiceLocator()->get('translator');
		$this->flashmessenger()->addSuccessMessage($translator->translate("Sessão encerrada com sucesso"));
		return $this->redirect()->toRoute('login');
	}
	
	/**
	 * Método successAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 29/03/2014 13:02:16
	 */
	public function successAction() {
		return $this->redirect()->toRoute('home');
	}
}
