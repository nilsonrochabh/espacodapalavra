<?php
namespace Core\Form;

use Model\User;
use Util\Hydrator\PropelMethods;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Classe Core\Form$UserFieldset
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/05/2016 09:18:38
 */
class UserFieldset extends Fieldset implements InputFilterProviderInterface {

	/**
	 * Método __construct
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 25/05/2016 09:19:00
	 */
	public function __construct() {
		parent::__construct('user');
		
		$this->setHydrator(new PropelMethods())->setObject(new User());
		
		$this->add(array(
			'name' => 'name',
			'attributes' => array(
				'type'  => 'text',
				'class' => 'form-control',
				'column-sm' => '8',
				'column-xs' => '10',
				'maxlength' => 100,
				'required' => 'required'
			),
			'options' => array(
				'label' => _('Nome:')
			),
		));
		
		$this->add(array(
			'name' => 'paypal_email',
			'attributes' => array(
				'type'  => 'text',
				'class' => 'form-control',
				'column-sm' => '8',
				'column-xs' => '10',
				'maxlength' => 200,
				'required' => 'required'
			),
			'options' => array(
				'label' => _('Email:')
			),
		));
		
		$this->add(array(
			'name' => 'password',
			'attributes' => array(
				'type'  => 'password',
				'class' => 'form-control',
				'column-sm' => '8',
				'column-xs' => '10',
				'maxlength' => 50,
				'required' => 'required'
			),
			'options' => array(
				'label' => _('Senha:')
			),
		));
    }

	/**
	 * (non-PHPdoc)
	 * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
	 */
	public function getInputFilterSpecification() {
		return array(
			'name' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O nome não pode estar vazio.'
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
								'stringLengthTooLong' => 'Nome muito grande. (Máx. de 100)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'paypal_email' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O email não pode estar vazio.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 200,
							'messages' => array(
								'stringLengthTooLong' => 'Endereço de email muito grande. (Máx. de 200)'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'EmailAddress',
						'options' => array(
							'message' => 'Email inválido. Verifique se contém o símbolo @ e um domínio válido.',
						),
					),
				),
			),
			'password' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'A senha é obrigatória.'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 50,
							'messages' => array(
								'stringLengthTooLong' => 'Senha muito grande. (Máx. 50)'
							),
						),
					),
				),
			),
		);
	}
}