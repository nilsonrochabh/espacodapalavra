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
			'Core\Controller\Index'             => 'Core\Controller\IndexController',
			'Core\Controller\I18n'              => 'Core\Controller\I18nController',
		    'Core\Controller\Select2'           => 'Core\Controller\Select2Controller',
		    
			'Core\Controller\FilterLocal'       => 'Core\Controller\FilterLocalPage',
			'Core\Controller\ManterLocal'       => 'Core\Controller\ManterLocalPage',
		    
		    'Core\Controller\FilterIngrediente' => 'Core\Controller\FilterIngredientePage',
			'Core\Controller\ManterIngrediente' => 'Core\Controller\ManterIngredientePage',
		    
		    'Core\Controller\FilterReceita'     => 'Core\Controller\FilterReceitaPage',
			'Core\Controller\ManterReceita'     => 'Core\Controller\ManterReceitaPage',

		    'Core\Controller\FilterUnidade'     => 'Core\Controller\FilterUnidadePage',
			'Core\Controller\ManterUnidade'     => 'Core\Controller\ManterUnidadePage',
		),
	),
		
	'service_manager' => array(
		'invokables' => array(
			// BOs
		    'Core\BO\Local'       => 'Core\BO\LocalBO',
		    'Core\BO\Ingrediente' => 'Core\BO\IngredienteBO',
		    'Core\BO\Receita'     => 'Core\BO\ReceitaBO',
		    'Core\BO\Unidade'     => 'Core\BO\UnidadeBO',
		),
		'factories' => array(
			// Forms
		),
	),
		
	'router' => array(
		'routes' => array(
			'home' => array(
				'type' => 'Literal',
				'options' => array(
					'route'    => '/',
					'defaults' => array(
						'controller' => 'Core\Controller\Index',
						'action'     => 'index',
					),
				),
			),
		    
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
		            'ingrediente' => array(
		                'type' => 'segment',
		                'options' => array(
		                    'route'    => '/ingrediente[/][:id]',
		                    'defaults' => array(
		                        'controller' => 'Core\Controller\Select2',
		                        'action'     => 'ingrediente',
		                    ),
		                ),
		            ),
		            'unidade' => array(
		                'type' => 'segment',
		                'options' => array(
		                    'route'    => '/unidade[/][:id]',
		                    'defaults' => array(
		                        'controller' => 'Core\Controller\Select2',
		                        'action'     => 'unidade',
		                    ),
		                ),
		            ),
		        ),
		    ),
				
			'local' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/local',
					'defaults' => array(
						'controller' => 'Core\Controller\FilterLocal',
						'action'     => 'index',
					),
				),
				'priority' => 8100,
				'may_terminate' => true,
				'child_routes' => array(
					'buscar' => array(
						'type' => 'Literal',
						'options' => array(
							'route'    => '/buscar',
							'defaults' => array(
								'controller' => 'Core\Controller\FilterLocal',
								'action'     => 'buscar',
							),
						),
					),
				    'novo' => array(
				        'type' => 'Literal',
				        'options' => array(
				            'route'    => '/novo',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterLocal',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'editar' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/editar/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterLocal',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'excluir' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/excluir/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterLocal',
				                'action'     => 'excluir',
				            ),
				        ),
				    ),
				),
			),
				
			'ingrediente' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/ingrediente',
					'defaults' => array(
						'controller' => 'Core\Controller\FilterIngrediente',
						'action'     => 'index',
					),
				),
				'priority' => 8101,
				'may_terminate' => true,
				'child_routes' => array(
					'buscar' => array(
						'type' => 'Literal',
						'options' => array(
							'route'    => '/buscar',
							'defaults' => array(
								'controller' => 'Core\Controller\FilterIngrediente',
								'action'     => 'buscar',
							),
						),
					),
				    'novo' => array(
				        'type' => 'Literal',
				        'options' => array(
				            'route'    => '/novo',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterIngrediente',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'editar' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/editar/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterIngrediente',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'excluir' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/excluir/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterIngrediente',
				                'action'     => 'excluir',
				            ),
				        ),
				    ),
				),
			),
		    
			'receita' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/receita',
					'defaults' => array(
						'controller' => 'Core\Controller\FilterReceita',
						'action'     => 'index',
					),
				),
				'priority' => 8102,
				'may_terminate' => true,
				'child_routes' => array(
					'buscar' => array(
						'type' => 'Literal',
						'options' => array(
							'route'    => '/buscar',
							'defaults' => array(
								'controller' => 'Core\Controller\FilterReceita',
								'action'     => 'buscar',
							),
						),
					),
				    'novo' => array(
				        'type' => 'Literal',
				        'options' => array(
				            'route'    => '/novo',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterReceita',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'editar' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/editar/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterReceita',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'excluir' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/excluir/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterReceita',
				                'action'     => 'excluir',
				            ),
				        ),
				    ),
				),
			),
		    
			'unidade' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/unidade',
					'defaults' => array(
						'controller' => 'Core\Controller\FilterUnidade',
						'action'     => 'index',
					),
				),
				'priority' => 8103,
				'may_terminate' => true,
				'child_routes' => array(
					'buscar' => array(
						'type' => 'Literal',
						'options' => array(
							'route'    => '/buscar',
							'defaults' => array(
								'controller' => 'Core\Controller\FilterUnidade',
								'action'     => 'buscar',
							),
						),
					),
				    'novo' => array(
				        'type' => 'Literal',
				        'options' => array(
				            'route'    => '/novo',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterUnidade',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'editar' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/editar/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterUnidade',
				                'action'     => 'index',
				            ),
				        ),
				    ),
				    'excluir' => array(
				        'type' => 'Segment',
				        'options' => array(
				            'route'    => '/excluir/:id',
				            'defaults' => array(
				                'controller' => 'Core\Controller\ManterUnidade',
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