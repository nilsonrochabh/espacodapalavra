<?php
namespace Application;

use Locale;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Validator\AbstractValidator;
use Util\Util;

/**
 * Classe Application$Module
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 11/03/2015 13:46:02
 */
class Module {
	
	/**
	 * Método onBootstrap
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 11/03/2015 13:45:52
	 * @param MvcEvent $e
	 */
    public function onBootstrap(MvcEvent $e) {
    	$app = $e->getApplication();
    	
        $eventManager        = $app->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $logger = new Logger();
        $writer = new Stream(__DIR__ . '/../../data/logs/system.log');
        $logger->addWriter($writer);
        Logger::registerErrorHandler($logger);
        
        $sm = $app->getServiceManager();
        
        $config = $sm->get('session_config');
        $sessionManager = new SessionManager($config);
        Container::setDefaultManager($sessionManager);
        
        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'translate'));
    }
    
    /**
     * Método translate
     * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
     * @since 11/03/2015 14:02:41
     * @param MvcEvent $e
     */
    public function translate(MvcEvent $e) {
     	$lang = $e->getRouteMatch()->getParam('lang', '');
    	
    	$app = $e->getApplication();
    	
    	$translator = $app->getServiceManager()->get('MvcTranslator');
    	
    	if(!Util::IsNullOrEmptyString($lang)) {
    		$ex = explode('-', $lang);
    		if(count($ex) == 2) {
    			Locale::setDefault($ex[0] . '-' . strtoupper($ex[1]));
    		} else {
	    		Locale::setDefault($lang);
    		}
    	} else {
	    	$default = 'pt-BR';
	    	$supported = array('pt-BR');
	    	$headers   = $app->getRequest()->getHeaders();
	    	
	        if($headers->has('Accept-Language')) {
	        	$locales = $headers->get('Accept-Language')->getPrioritized();
	        	 
	        	// Loop through all locales, highest priority first
	        	foreach ($locales as $locale) {
	        		if(!!($match = Locale::lookup($supported, $locale->getRaw()))) {
	        			// The locale is one of our supported list
	        			Locale::setDefault($match);
	        			break;
	        		}
	        	}
	        	 
	        	if(!$match) {
	        		// Nothing from the supported list is a match
	        		Locale::setDefault($default);
	        	}
	        } else {
	        	Locale::setDefault($default);
	        }
    	}
        
        $translator->setLocale(str_replace('-', '_', Locale::getDefault()));
        
        if(Locale::getPrimaryLanguage(Locale::getDefault()) == 'es') {
        	$translator->addTranslationFile(
        			'phpArray',
        			'vendor/zendframework/zend-i18n-resources/languages/es/Zend_Validate.php'
        	);
        } elseif(Locale::getPrimaryLanguage(Locale::getDefault()) == 'pt') {
        	$translator->addTranslationFile(
        			'phpArray',
        			'vendor/zendframework/zend-i18n-resources/languages/pt_BR/Zend_Validate.php'
        	);
        } else {
        	$translator->addTranslationFile(
        			'phpArray',
        			'vendor/zendframework/zend-i18n-resources/languages/en/Zend_Validate.php'
        	);
        }
        
        AbstractValidator::setDefaultTranslator($translator);
    }

    /**
     * Método getConfig
     * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
     * @since 11/03/2015 13:45:47
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Método getAutoloaderConfig
     * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
     * @since 11/03/2015 13:45:45
     * @return multitype:multitype:multitype:string
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
