<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'login' => __DIR__ . '/../view',
        ),
    ),
		
    'controllers' => array(
        'invokables' => array(
            'Login\Controller\Login'        => 'Login\Controller\LoginController',
        	'Login\Controller\EsqueciSenha' => 'Login\Controller\EsqueciSenhaController',
        ),
    ),
		
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Literal',
                'priority' => 99999,
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'Login\Controller\Login',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'entrar' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/entrar',
                            'defaults' => array(
                                'controller' => 'Login\Controller\Login',
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'autenticar' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/autenticar',
                            'defaults' => array(
                                'controller' => 'Login\Controller\Login',
                                'action'     => 'authenticate',
                            ),
                        ),
                    ),
                    'sair' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/sair',
                            'defaults' => array(
                                'controller' => 'Login\Controller\Login',
                                'action'     => 'logout',
                            ),
                        ),
                    ),
                    'trocar_senha' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/trocar-senha',
                            'defaults' => array(
                                'controller' => 'Login\Controller\Login',
                                'action'     => 'changepassword',
                            ),
                        ),                        
                    ),
                	'sucesso' => array(
                		'type' => 'Literal',
                		'options' => array(
                			'route' => '/sucesso',
                			'defaults' => array(
                				'controller' => 'Login\Controller\Login',
                				'action'     => 'success',
                			),
                		),
                	),
                	'esqueci' => array(
                		'type' => 'Literal',
                		'options' => array(
                			'route' => '/esqueci',
                			'defaults' => array(
                				'controller' => 'Login\Controller\EsqueciSenha',
                				'action'     => 'index',
                			),
                		),
                	),
                	'codigo' => array(
                		'type' => 'segment',
                		'options' => array(
                			'route' => '/esqueci/:codigo',
                			'defaults' => array(
                				'controller' => 'Login\Controller\EsqueciSenha',
                				'action'     => 'codigo',
                			),
                		),
                	),
                ),
            ),
        ),
    ),
);
