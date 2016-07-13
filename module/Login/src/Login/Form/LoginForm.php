<?php

namespace Login\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;

/**
 * Classe Login\Form$LoginForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 17/03/2014 23:39:54
 */
class LoginForm extends Form {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('role', 'form');
		$this->setAttribute('class', 'form-inline');
		
		$this->add(array(
            'name' => 'usuario',
            'attributes' => array(
                'type'  => 'text',
            	'class' => 'form-control',
            ),
            'options' => array(
                'label' => _('Email'),
            ),
        ));
		
		$this->add(array(
			'name' => 'senha',
			'attributes' => array(
				'type'  => 'password',
				'class' => 'form-control',
			),
			'options' => array(
				'label' => _('Senha'),
			),
		));
		
		$this->add(array(
				'name' => 'rememberme',
				'attributes' => array(
					'type'  => 'checkbox',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => _('Manter Conectado'),
				),
		));
		
		$submitElement = new Button('submit');
		$submitElement
			->setLabel('Entrar')
			->setAttributes(array('type'  => 'submit', 'class' => 'btn btn-primary'));
		
		$this->add($submitElement, array(
			'priority' => -100,
		));
	}
}
