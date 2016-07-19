<?php

return array(
	'view_manager' => array(
		'template_path_stack' => array(
			'core' => __DIR__ . '/../view',
		),
	),
	
	'controllers' => array(
		'invokables' => array(
			// Controllers
			'Core\Controller\Index'      => 'Core\Controller\IndexController',
			'Core\Controller\I18n'       => 'Core\Controller\I18nController',
			'Core\Controller\Select2'    => 'Core\Controller\Select2Controller',
			
			'Core\Controller\UserFilter' => 'Core\Controller\UserFilterPage',
			'Core\Controller\UserManter' => 'Core\Controller\UserManterPage',
		),
	),
		
	'service_manager' => array(
		'invokables' => array(
			// BOs
		    'Core\BO\Usuario'        => 'Core\BO\UsuarioBO',
			'Core\BO\Proposicao'     => 'Core\BO\ProposicaoBO',
		),
		'factories' => array(
			// Forms
		),
	),
		
	'router' => array(
		'routes' => array(
			'select2' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/select2',
					'defaults' => array(
						'controller' => 'Core\Controller\Select2',
						'action'     => 'index',
					),
				),
				'priority' => 8010,
				'may_terminate' => true,
				'child_routes' => array(
				),
			),
			
			'user' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/user',
					'defaults' => array(
						'controller' => 'Core\Controller\UserFilter',
						'action'     => 'index',
					),
				),
				'priority' => 8100,
				'may_terminate' => true,
				'child_routes' => array(
					'search' => array(
						'type' => 'Literal',
						'options' => array(
							'route'    => '/search',
							'defaults' => array(
								'controller' => 'Core\Controller\UserFilter',
								'action'     => 'buscar',
							),
						),
					),
					'new' => array(
						'type' => 'Literal',
						'options' => array(
							'route'    => '/new',
							'defaults' => array(
								'controller' => 'Core\Controller\UserManter',
								'action'     => 'index',
							),
						),
					),
					'edit' => array(
						'type' => 'Segment',
						'options' => array(
							'route'    => '/edit/:id',
							'defaults' => array(
								'controller' => 'Core\Controller\UserManter',
								'action'     => 'index',
							),
						),
					),
					'delete' => array(
						'type' => 'Segment',
						'options' => array(
							'route'    => '/delete/:id',
							'defaults' => array(
								'controller' => 'Core\Controller\UserManter',
								'action'     => 'excluir',
							),
						),
					),
				),
			),
			
			'i18n' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/i18n',
					'defaults' => array(
						'controller' => 'Core\Controller\I18n',
						'action'     => 'index',
					),
				),
				'priority' => 12000,
				'may_terminate' => true,
				'child_routes' => array(
					'page' => array(
						'type' => 'Segment',
						'options' => array(
							'route'    => '/page',
							'defaults' => array(
								'controller' => 'Core\Controller\I18n',
								'action'     => 'page',
							),
						),
					),
					'datatable' => array(
						'type' => 'Segment',
						'options' => array(
							'route'    => '/datatable',
							'defaults' => array(
								'controller' => 'Core\Controller\I18n',
								'action'     => 'datatable',
							),
						),
					),
				),
			),
		),
	),
);