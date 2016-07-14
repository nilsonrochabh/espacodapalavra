<?php
namespace Core\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Util\Hydrator\PropelMethods;

/**
 * Classe Core\Form$UserForm
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/05/2016 09:31:27
 */
class UserManterForm extends Form {

	/**
	 * Método __construct
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 25/05/2016 09:31:34
	 */
	public function __construct() {
		parent::__construct('manterForm');
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('role', 'form');
		$this->setAttribute('class', 'form-horizontal');
		
		$this->setHydrator(new PropelMethods(false))
			 ->setInputFilter(new InputFilter());
		
		$this->add(array(
			 'type' => 'Core\Form\UserFieldset',
			 'options' => array(
				 'use_as_base_fieldset' => true,
			 ),
		 ));
		
		$this->add(array(
			'type' => 'Zend\Form\Element\Csrf',
			'name' => 'csrf',
		));
		
		$this->add(array(
			'name' => 'submitbutton',
			'type' => 'Zend\Form\Element\Button',
			'attributes' => array(
				'type'  => 'submit',
				'id' => 'submitbutton',
				'class' => 'btn btn-primary',
			),
			'options' => array(
				'label' => _('Salvar'),
			)
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
	 */
	public function getInputFilterSpecification() {
		return array();
	}
}