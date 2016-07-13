<?php
use Zend\Session\Config\SessionConfig;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    	'factories' => array(
    		'sessionconfig' => function ($sm) {
    			$config = $sm->get('Config');
    		
    			$sessionConfig = new SessionConfig(); //you can call this b/c of the use statements at the top
    			if(isset($config['session'])) { //from module.config.php
    				$sessionConfig->setOptions($config['session']);
    			}
    			return $sessionConfig;
    		},
    	),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        	array(
        		'type'     => 'phparray',
        		'base_dir' => __DIR__ . '/lang',
        		'pattern'  => '%s.php',
        		'text_domain' => __NAMESPACE__,
        	),
        ),
    ),
    
    'session' => array(
    	'use_cookies' => true,
    	'cookie_httponly' => true,
    	'name' => 'SkeletonSession',
    	'save_path' => __DIR__ . '/../../../data/sessions',
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        	'layout/login'            => __DIR__ . '/../view/layout/login.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        	'layout/head'             => __DIR__ . '/../view/layout/head.phtml',
        	'layout/scripts'          => __DIR__ . '/../view/layout/scripts.phtml',
        	'layout/messages'         => __DIR__ . '/../view/layout/messages.phtml',
        	'layout/form'             => __DIR__ . '/../view/layout/form.phtml',
        	'layout/js'               => __DIR__ . '/../view/layout/js.phtml',
        	'layout/header_controls'  => __DIR__ . '/../view/layout/header_controls.phtml',
        	'layout/breadcrumb'       => __DIR__ . '/../view/layout/breadcrumb.phtml',
        	'layout/menu'             => __DIR__ . '/../view/layout/menu.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    	'strategies' => array(
    		'ViewJsonStrategy',
    	),
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
