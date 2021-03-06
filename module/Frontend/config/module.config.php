<?php

return array(
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
	
	'controllers' => array(
		'invokables' => array(
			// Controllers
			'Frontend\Controller\Index'      => 'Frontend\Controller\IndexController',
			'Frontend\Controller\Usuario'    => 'Frontend\Controller\UsuarioController',
			'Frontend\Controller\Conta'      => 'Frontend\Controller\ContaController',
			'Frontend\Controller\Proposicao' => 'Frontend\Controller\ProposicaoController',
			'Frontend\Controller\Pagina'     => 'Frontend\Controller\PaginaController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'home' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Index',
						'action'     => 'index',
					),
				),
			),
			
			'categoria' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/categoria/:tipo',
					'constraints' => array(
						'tipo' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'Frontend\Controller\Index',
						'action'     => 'index',
					),
				),
			),
			
			'busca' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/busca',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Index',
						'action'     => 'index',
					),
				),
			),
			
			'cadastre' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/cadastre',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Usuario',
						'action'     => 'index',
					),
				),
			),
	
			'conta' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/conta',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Conta',
						'action'     => 'index',
					),
				),
			),
			
			'publique' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/publique[/:idProposicao][/:action][/:passo]',
					'constraints' => array(
						'idProposicao' => '[0-9]+',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'passo' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Frontend\Controller\Proposicao',
						'action'     => 'index',
					),
				),
			),
			
			'passo_delete' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/publique/:idProposicao/montagem/:passo/excluir',
					'constraints' => array(
						'idProposicao' => '[0-9]+',
						'passo' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Frontend\Controller\Proposicao',
						'action'     => 'deletePasso',
					),
				),
			),
			
			'proposicao' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/proposicao/:id',
					'constraints' => array(
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Frontend\Controller\Index',
						'action'     => 'proposicao',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'seguir' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/seguir',
							'defaults' => array(
								'controller' => 'Frontend\Controller\Index',
								'action'     => 'seguir',
							),
						),
					),
					'curtir' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/curtir',
							'defaults' => array(
								'controller' => 'Frontend\Controller\Index',
								'action'     => 'curtir',
							),
						),
					),
					'concluir' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/concluir',
							'defaults' => array(
								'controller' => 'Frontend\Controller\Index',
								'action'     => 'concluir',
							),
						),
					),
				),
			),
			
			'metodologias' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/metodologias',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Pagina',
						'action'     => 'metodologias',
					),
				),
			),
			
			'artistas' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/artistas',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Pagina',
						'action'     => 'artistas',
					),
				),
			),
			
			'leitura' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/leitura',
					'defaults' => array(
						'controller' => 'Frontend\Controller\Pagina',
						'action'     => 'leitura',
					),
				),
			),
		),
	),
);