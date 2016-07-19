<?php

namespace Frontend\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Classe Frontend\Form$InformacoesForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 05/03/2016 17:04:21
 */
class InformacoesForm extends Form implements InputFilterProviderInterface {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype','multipart/form-data');
		
		$this->add(array(
			'name' => 'nome',
			'attributes' => array(
				'id'    => 'nome',
				'type'  => 'text',
			),
			'options' => array(
				'label' => _('Nome'),
			),
		));
		
		$this->add(array(
			'name' => 'objetivo',
			'attributes' => array(
				'id'    => 'objetivo',
				'type'  => 'textarea',
				'rows'  => 5,
			),
			'options' => array(
				'label' => _('Objetivo'),
			),
		));
		
		$this->add(array(
			'name' => 'start',
			'attributes' => array(
				'id'    => 'start',
				'type'  => 'textarea',
				'rows'  => 5,
			),
			'options' => array(
				'label' => _('Start'),
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'class' => 'button-next',
				'value' => _('Próximo'),
			),
		));
	}
	
	/**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification() {
		return array(
			'nome' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O nome é obrigatório.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 250,
							'messages' => array(
								'stringLengthTooLong' => 'Endereço de email muito grande. (Máx. de 250)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'objetivo' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O objetivo é obrigatório.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 4000,
							'messages' => array(
								'stringLengthTooLong' => 'Objetivo muito grande. (Máx. de 4000)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'start' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O start é obrigatório.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 4000,
							'messages' => array(
								'stringLengthTooLong' => 'Start muito grande. (Máx. de 4000)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
		);
	}
}