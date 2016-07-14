<?php

namespace Core\Form;

use Core\Form\Base\Form;

/**
 * Classe Core\Form$UserFilterForm
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/05/2016 09:29:53
 */
class UserFilterForm extends Form {

	/**
	 * Método __construct
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 25/05/2016 09:30:03
	 * @param string $name
	 */
	public function __construct($name = null) {
		if($name == null) {
			$name = 'searchForm';
		}
		
		parent::__construct($name, null);
		
		$this->add(array(
			'name' => 'email',
			'attributes' => array(
				'type'  => 'text',
				'id' => 'email',
				'class' => 'form-control',
				'column-sm' => '10',
				'column-xs' => '10',
			),
			'options' => array(
				'label' => _('Email:'),
			),
		));
		
		parent::addSearchButton();
		parent::addResetButton();
	}
}
