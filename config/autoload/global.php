<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'module_layouts' => array(
        'Core' => 'layout/layout',
        'Frontend' => 'frontend/layout/layout',
		'Login' => 'frontend/layout/simple',
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Logger' => function($sm) {
                $logger = new \Zend\Log\Logger;
                $writer = new \Zend\Log\Writer\Stream(ROOT_PATH . '/data/logs/' . date('Y-m-d') . '-error.log');
                $logger->addWriter($writer);
                return $logger;
            },
            'LogBO' => function($sm) {
                $logger = new \Zend\Log\Logger;
                $writer = new \Zend\Log\Writer\Stream(ROOT_PATH . '/data/logs/' . date('Y-m-d') . '-alert-bo.log');
                $logger->addWriter($writer);
                return $logger;
            },
        ),
    ),
);