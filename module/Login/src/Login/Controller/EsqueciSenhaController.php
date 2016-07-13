<?php

namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Util\Util;
use Model\UsuarioQuery;
use Model\ResetSenhaQuery;
use Model\ResetSenha;
use Propel\Runtime\Propel;
use Model\Map\ResetSenhaTableMap;
use Model\Map\UsuarioTableMap;

/**
 * Classe Login\ControllerEsqueciSenhaController
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 01/09/2014 19:19:56
 */
class EsqueciSenhaController extends AbstractActionController {

	protected $form;
	protected $trocaForm;
	
	protected $authservice;
	
	/**
	 * Método getAuthService
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 01/09/2014 19:37:11
	 * @return Ambigous <object, multitype:, AuthService>
	 */
	public function getAuthService() {
		if(!$this->authservice) {
			$this->authservice = $this->getServiceLocator()->get('AuthService');
		}
	
		return $this->authservice;
	}
	
	/**
	 * Método getForm
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/03/2014 23:38:47
	 * @return \Login\Form\EsqueciSenhaForm
	 */
	public function getForm() {
		if(!$this->form) {
			$this->form = $this->getServiceLocator()->get('Login\Form\EsqueciSenha');
		}
		return $this->form;
	}
	
	/**
	 * Método getTrocaForm
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 23:20:49
	 * @return \Login\Form\TrocaSenhaForm
	 */
	public function getTrocaForm() {
		if(!$this->trocaForm) {
			$this->trocaForm = $this->getServiceLocator()->get('Login\Form\TrocaSenha');
		}
		return $this->trocaForm;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		$this->layout('layout/login');
		
		if($this->getAuthService()->hasIdentity()) {
			return $this->redirect()->toRoute('login/sucesso');
		}
		
		$form = $this->getForm();
		$translator = $this->getServiceLocator()->get('translator');
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$form->setData($request->getPost());
			if($form->isValid()) {
				$existente = UsuarioQuery::create()->filterByEmail($request->getPost('email'))->findOne();
				if($existente){
					$reset = new ResetSenha();
					$reset->setCodigo(Util::generateCodigo());
					$reset->setIdUsuario($existente->getId());
					$reset->setDataCadastro(Util::agora());
					
					$con = Propel::getConnection(ResetSenhaTableMap::DATABASE_NAME);
					try {
						$con->beginTransaction();
						
						ResetSenhaQuery::create()->filterByIdUsuario($existente->getId())->delete($con);
						$reset->save($con);
						
// 						$mail = new Mail("150.164.99.2", 587, "patrimonio", "5hasEHuqERAsWach");
						
// 						$remetente = new MailBox('Patrimônio', 'patrimonio@nescon.medicina.ufmg.br');
// 						$destinatario = new MailBox($existente->getNome(), $existente->getEmail());
// 						$responderPara = new MailBox('Not Reply', 'nao-responda@nescon.medicina.ufmg.br');
						
// 						$assunto = $translator->translate("Patrimônio - Esqueci minha senha");
						
// 						$event = $this->getEvent();
// 						$request = $event->getRequest();
// 						$router = $event->getRouter();
// 						$uri = $router->getRequestUri();
// 						$baseUrl = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
						
// 						$corpo = sprintf($translator->translate('Prezado(a) %1$s,<br /><br />Segue link para alterar sua senha do Patrimônio:<br /><a href="%2$s">Alterar Senha</a><br /><br />ou cole no browser (navegador web):<br />%2$s<br /><br />Esse link expira em 24 horas.<br /><br /><a href="https://www.nescon.medicina.ufmg.br/patrimonio">Patrimônio</a>'),
// 								$existente->getNome(),
// 								$baseUrl . $this->url()->fromRoute('login/codigo', array('codigo' => $reset->getCodigo())));
						
// 						$mail->enviaEmail($remetente, $destinatario, $responderPara, $assunto, $corpo);
						
						$con->commit();
					
						$this->flashmessenger()->addSuccessMessage($translator->translate("Um email foi enviado com as instruções para alteração da senha."));
						
						return $this->redirect()->toRoute('login/entrar');
						
					} catch(\Exception $e) {
						$con->rollback();
						$this->flashMessenger()->addErrorMessage($translator->translate('Não foi possível realizar a operação. Favor entrar em contato com o administrador.'));
					}
				} else {
					$this->flashMessenger()->addErrorMessage($translator->translate('Email inválido.'));
				}
			} else {
				$this->flashMessenger()->addErrorMessage($translator->translate('Email inválido.'));
			}
		}
		
		return array(
			'form' => $form,
			'messages'  => $this->flashmessenger()->getMessages()
		);
	}
	
	/**
	 * Método codigoAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/09/2014 23:02:03
	 * @return \Zend\View\Model\ViewModel
	 */
	public function codigoAction() {
		$this->layout('layout/login');
		
		$translator = $this->getServiceLocator()->get('translator');
		$codigo = $this->params()->fromRoute('codigo', false);
		if($codigo) {
			$reset = ResetSenhaQuery::create()->joinUsuario()->filterByCodigo($codigo)->findOne();
			
			if($reset == null) {
				$this->flashMessenger()->addErrorMessage($translator->translate('Código inválido.'));
				return $this->redirect()->toRoute('login/entrar');
			}
		
			$form = $this->getTrocaForm();
			
			$request = $this->getRequest();
			if($request->isPost()) {
				$form->setData($request->getPost());
				if($form->isValid()) {
					$novoPassword = $request->getPost('senha');
					$confirmPassword = $request->getPost('confirmaSenha');
					
					if($novoPassword != $confirmPassword) {
						$this->flashMessenger()->addErrorMessage($translator->translate('Senhas não conferem.'));
						return $this->redirect()->toRoute('login/codigo', array('codigo' => $codigo));
					}
					
					$con = Propel::getConnection(UsuarioTableMap::DATABASE_NAME);
					try {
						$con->beginTransaction();
						
						$config = $this->getServiceLocator()->get('Config');
						$salt = $config['security']['salt'];
						
						$usuario = $reset->getUsuario();
						$usuario->setSenha(Util::crypt($novoPassword, $salt));
						$usuario->save($con);
						ResetSenhaQuery::create()->filterByIdUsuario($usuario->getId())->delete($con);
						
						$con->commit();
						
						$this->flashmessenger()->addSuccessMessage($translator->translate("Registro salvo com sucesso."));
						
						return $this->redirect()->toRoute('login/entrar');
					} catch(\Exception $e) {
						$this->flashMessenger()->addErrorMessage($translator->translate('Não foi possível salvar. Favor entrar em contato com o administrador..'));
					}
				}
			}
		} else {
			$this->flashMessenger()->addErrorMessage($translator->translate('Código inválido.'));
			return $this->redirect()->toRoute('login/entrar');
		}
		
		return array(
				'form' => $form,
				'messages'  => $this->flashmessenger()->getMessages()
		);
	}
}