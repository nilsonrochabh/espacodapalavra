<?php
namespace Frontend;

use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

class Module {
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	function onBootstrap(EventInterface $e) {
		$application = $e->getApplication();
		$eventManager = $application->getEventManager();
		$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this,'onDispatchError'), 100);    
	}

	function onDispatchError(MvcEvent $e) {
		$viewModel = $e->getViewModel();
		$viewModel->setTemplate('frontend/layout/layout');
	}
}