<?php

namespace Login\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;

/**
 * Classe Login\Form$EsqueciSenhaForm
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 01/09/2014 19:24:41
 */
class EsqueciSenhaForm extends Form {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('role', 'form');
		$this->setAttribute('class', 'form-inline');
		
		$this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            	'class' => 'form-control',
            ),
            'options' => array(
                'label' => _('Email:'),
            ),
        ));
		
		$submitElement = new Button('submit');
		$submitElement
			->setLabel('Enviar')
			->setAttributes(array('type'  => 'submit', 'class' => 'btn btn-primary'));
		
		$this->add($submitElement, array(
			'priority' => -100,
		));
	}
}
