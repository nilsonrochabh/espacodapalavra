<?php
namespace Model;

use Zend\ModuleManager\ModuleManager;

/**
 * Classe Model$Module
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 07/11/2013 16:58:58
 */
class Module {
	
	/**
	 * Método init
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 07/11/2013 16:59:05
	 * @param ModuleManager $moduleManager
	 */
	public function init(ModuleManager $moduleManager) {
		require_once 'model/generated-conf/config.php';
	}
	
	/**
	 * Método getAutoloaderConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 07/11/2013 16:59:09
	 */
	public function getAutoloaderConfig() {         
		return array(         
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/model/generated-classes/' . __NAMESPACE__,
				),
			),
		);
	}
}