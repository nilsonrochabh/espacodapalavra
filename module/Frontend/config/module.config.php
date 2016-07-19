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
			'Frontend\Controller\Proposicao' => 'Frontend\Controller\ProposicaoController',
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
						'controller' => 'Frontend\Controller\Usuario',
						'action'     => 'conta',
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
			),
		),
	),
);