<?php

namespace Core\Form;

use Core\Form\Base\Form;

/**
 * Classe Core\Form$FilterReceitaForm
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:54:22
 */
class FilterReceitaForm extends Form {
	
    /**
     * Método __construct
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:54:25
     * @param string $name
     */
	public function __construct($name = null) {
		if($name == null) {
			$name = 'searchForm';
		}
		
		parent::__construct($name, null);
		
		$this->add(array(
		    'name' => 'nome',
		    'attributes' => array(
		        'type'  => 'text',
		        'id' => 'nome',
		        'class' => 'form-control',
		        'column-sm' => '10',
		        'column-xs' => '10',
		    ),
		    'options' => array(
		        'label' => _('Nome:'),
		    ),
		));
		
		parent::addSearchButton();
		parent::addResetButton();
	}
}
