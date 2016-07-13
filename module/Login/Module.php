<?php
namespace Login;

use Zend\Authentication\AuthenticationService;
use Login\Form\LoginForm;
use Login\Model\LoginInputFilter;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Login\Controller\Plugin\UserAuthentication;
use Login\View\Helper\UserIdentity;
use Login\View\Helper\Check;
use Login\Form\EsqueciSenhaForm;
use Login\Model\EsqueciSenhaInputFilter;
use Login\Form\TrocaSenhaForm;
use Login\Model\TrocaSenhaInputFilter;

/**
 * Classe Login$Module
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 04/03/2014 14:30:39
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface {
	
	/**
	 * Método getAutoloaderConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 04/03/2014 14:31:26
	 * @return multitype:multitype:string  multitype:multitype:string
	 */
	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}
	
	/**
	 * Método getConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 04/03/2014 14:31:58
	 */
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	/**
	 * Método getControllerPluginConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 04/03/2014 17:08:44
	 * @return multitype:multitype:NULL  |\Login\Controller\Plugin\UserAuthentication
	 */
	public function getControllerPluginConfig() {
		return array(
			'factories' => array(
				'userAuthentication' => function ($sm) {
                    $controllerPlugin = new UserAuthentication();
                    $controllerPlugin->setAuthService($sm->getServiceLocator()->get('AuthService'));
                    return $controllerPlugin;
				},
			),
		);
	}
	
	/**
	 * Método getViewHelperConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 04/03/2014 18:52:23
	 * @return multitype:multitype:NULL  |\Login\View\Helper\UserIdentity
	 */
	public function getViewHelperConfig() {
		return array(
			'factories' => array(
				'userIdentity' => function ($sm) {
					$locator = $sm->getServiceLocator();
					$viewHelper = new UserIdentity();
					$viewHelper->setAuthService($locator->get('AuthService'));
					return $viewHelper;
				},
				'check' => function ($sm) {
					$locator = $sm->getServiceLocator();
					$viewHelper = new Check();
					$viewHelper->setAuthService($locator->get('AuthService'));
					return $viewHelper;
				},
			),
		);
	}
	
	/**
	 * Método getServiceConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 04/03/2014 14:32:59
	 * @return multitype:multitype:NULL |\Zend\Session\Config\SessionConfig
	 */
	public function getServiceConfig() {
		return array(
			'invokables' => array(
				'Login\Authentication\Storage\MyAuthStorage' => 'Login\Authentication\Storage\MyAuthStorage',
				'Login\Authentication\Adapter\MyAuthAdapter' => 'Login\Authentication\Adapter\MyAuthAdapter'
			),
			'factories' => array(
				'AuthService' => function ($sm) {
					$authService = new AuthenticationService();
					$authService->setStorage($sm->get('Login\Authentication\Storage\MyAuthStorage'));
					$authService->setAdapter($sm->get('Login\Authentication\Adapter\MyAuthAdapter'));
					
					return $authService;
				},
				'Login\Form\Login' => function($sm) {
					$form = new LoginForm('login');
					$loginFilter = new LoginInputFilter();
					$form->setInputFilter($loginFilter->getInputFilter());
					return $form;
				},
				'Login\Form\EsqueciSenha' => function($sm) {
					$form = new EsqueciSenhaForm('esqueci');
					$loginFilter = new EsqueciSenhaInputFilter();
					$form->setInputFilter($loginFilter->getInputFilter());
					return $form;
				},
				'Login\Form\TrocaSenha' => function($sm) {
					$form = new TrocaSenhaForm('troca');
					$loginFilter = new TrocaSenhaInputFilter();
					$form->setInputFilter($loginFilter->getInputFilter());
					return $form;
				},
 			)
		);
	}
}