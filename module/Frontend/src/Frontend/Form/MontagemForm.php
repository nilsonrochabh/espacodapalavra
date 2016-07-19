<?php

namespace Frontend\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Classe Frontend\Form$MontagemForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 05/03/2016 17:04:21
 */
class MontagemForm extends Form implements InputFilterProviderInterface {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype','multipart/form-data');
		
		$this->add(array(
			'name' => 'titulo',
			'attributes' => array(
				'id'    => 'titulo',
				'type'  => 'text',
				'class' => 'proposicao-titulo-form',
			),
			'options' => array(
				'label' => _('Título'),
			),
		));
		
		$this->add(array(
			'name' => 'duracao',
			'attributes' => array(
				'id'    => 'duracao',
				'type'  => 'text',
				'data-inputmask' => "'mask': '9{2,3}:99'",
			),
			'options' => array(
				'label' => _('Duração'),
			),
		));
		
		$this->add(array(
			'name' => 'proposicao-conteudo',
			'attributes' => array(
				'id'    => 'proposicao-conteudo',
				'type'  => 'textarea',
				'class' => 'proposicao-conteudo',
			),
		));
		
		$this->add(array(
			'name' => 'materiais',
			'attributes' => array(
				'id'    => 'materiais',
				'type'  => 'text',
			),
			'options' => array(
				'label' => _('Materiais Necessários'),
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'class' => 'button-next alternate-color',
				'value' => _('Adicionar Passo'),
			),
		));
	}
	
	/**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification() {
		return array(
			'titulo' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O título é obrigatório.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 100,
							'messages' => array(
								'stringLengthTooLong' => 'Título muito grande. (Máx. de 100)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'duracao' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'A duração é obrigatória.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'Regex',
						'options' => array(
							'pattern' => '/^[0-9]?[0-9]{2}:[0-9]{2}$/',
							'messages' => array(
								\Zend\Validator\Regex::INVALID => 'Duração inválida. Formato HHH:MM',
								\Zend\Validator\Regex::NOT_MATCH => 'Duração inválida. Formato HHH:MM',
								\Zend\Validator\Regex::ERROROUS => 'Duração inválida. Formato HHH:MM',
							),
						),
					),
				),
			),
			'proposicao-conteudo' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O conteúdo é obrigatório.'
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
								'stringLengthTooLong' => 'Conteúdo muito grande. (Máx. de 4000)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'materiais' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O campo Materiais é obrigatório.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 100,
							'messages' => array(
								'stringLengthTooLong' => 'Materiais muito grande. (Máx. de 100)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
		);
	}
}