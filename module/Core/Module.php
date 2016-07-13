<?php
namespace Core;

/**
 * Classe Core$Module
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 07/11/2013 15:27:54
 */
class Module {
	
// 	/**
// 	 * Método onBootstrap
// 	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
// 	 * @since 29/03/2014 14:41:02
// 	 * @param MvcEvent $e
// 	 */
// 	public function onBootstrap(MvcEvent $e) {
// 		$event = $e->getApplication()->getEventManager();
// 		$event->attach('render', function($e) {
// 			$children = $e->getViewModel()->getChildren();
// 			foreach($children as $child) {
// 			if ($child->captureTo() == 'content') {
// 					$child->setVariable('navigation', 'test');
// 					break;
// 				}
// 			}
//         });
// 	}
	
	/**
	 * Método getAutoloaderConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 07/11/2013 15:28:14
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
	 * @since 07/11/2013 15:28:33
	 */
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
	/**
	 * Método getViewHelperConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 25/02/2015 09:36:40
	 */
	public function getViewHelperConfig() {
		return array(
			'invokables' => array(
				'customformmulticheckbox' => 'Core\View\Helper\CustomFormMultiCheckbox'
			),
		);
	}
}