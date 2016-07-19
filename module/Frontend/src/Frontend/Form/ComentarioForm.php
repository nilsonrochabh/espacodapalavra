<?php

namespace Frontend\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Classe Frontend\Form$ComentarioForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 05/03/2016 17:04:21
 */
class ComentarioForm extends Form implements InputFilterProviderInterface {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'comentario',
			'attributes' => array(
				'id'    => 'comentario',
				'type'  => 'textarea',
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'value' => _('Enviar'),
			),
		));
	}
	
	/**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification() {
		return array(
			'comentario' => array(
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'NotEmpty',
						'options' => array(
							'messages' => array(
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O comentário é obrigatório.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 500,
							'messages' => array(
								'stringLengthTooLong' => 'Comentário muito grande. (Máx. de 500)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
		);
	}
}