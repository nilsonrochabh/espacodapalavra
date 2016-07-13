<?php

namespace Login\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;

/**
 * Classe Login\Form$TrocaSenhaForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 01/09/2014 23:18:09
 */
class TrocaSenhaForm extends Form {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('role', 'form');
		
		$this->add(array(
			'name' => 'senha',
			'attributes' => array(
				'type'  => 'password',
				'id' => 'senha',
				'class' => 'form-control',
				'column-sm' => '3',
				'column-xs' => '10',
			),
			'options' => array(
				'label' => _('Senha'),
			),
		));
		
		$this->add(array(
			'name' => 'confirmaSenha',
			'attributes' => array(
				'type'  => 'password',
				'id' => 'confirmaSenha',
				'class' => 'form-control',
				'column-sm' => '3',
				'column-xs' => '10',
			),
			'options' => array(
				'label' => _('Confirma Senha'),
			),
		));
		
		$submitElement = new Button('submit');
		$submitElement
			->setLabel('Cadastrar')
			->setAttributes(array('type'  => 'submit', 'class' => 'btn btn-block btn-primary'));
		
		$this->add($submitElement, array(
			'priority' => -100,
		));
	}
}
