<?php

namespace Frontend\Form;

use Zend\Form\Form;
use Zend\Form\Element\Button;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Classe Frontend\Form$ContaForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 05/03/2016 17:04:21
 */
class ContaForm extends Form implements InputFilterProviderInterface {
	
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
				'label' => _('Nome:'),
			),
		));
		
		$this->add(array(
			'name' => 'email',
			'attributes' => array(
				'id'    => 'email',
				'type'  => 'text',
			),
			'options' => array(
				'label' => _('E-mail:'),
			),
		));
		
		$this->add(array(
			'name' => 'senha',
			'attributes' => array(
				'id'    => 'senha',
				'type'  => 'password',
			),
			'options' => array(
				'label' => _('Senha Atual:'),
			),
		));
		
		$this->add(array(
			'name' => 'nova-senha',
			'attributes' => array(
				'id'    => 'nova-senha',
				'type'  => 'password',
			),
			'options' => array(
				'label' => _('Nova Senha:'),
			),
		));
		
		$this->add(array(
			'name' => 'confirmarsenha',
			'attributes' => array(
				'id'    => 'confirmarsenha',
				'type'  => 'password',
			),
			'options' => array(
				'label' => _('Confirmar senha:'),
			),
		));
		
		$this->add(array(
			'name' => 'atuacao',
			'attributes' => array(
				'id'    => 'atuacao',
				'type'  => 'text',
			),
			'options' => array(
				'label' => _('Atuação:'),
			),
		));
		
		$this->add(array(
			'name' => 'genero',
			'attributes' => array(
				'id'    => 'genero',
				'type'  => 'text',
			),
			'options' => array(
				'label' => _('Gênero:'),
			),
		));
		
		$this->add(array(
			'name' => 'sobre',
			'attributes' => array(
				'id'    => 'sobre',
				'type'  => 'textarea',
			),
			'options' => array(
				'label' => _('O que é importante saberem de você neste contexto?'),
			),
		));
		
		$this->add(array(
			'name' => 'foto',
			'attributes' => array(
				'id'     => 'foto',
				'type'   => 'file',
				'accept' => 'image/*',
			),
			'options' => array(
				'label' => _('Foto:'),
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'value' => _('Salvar'),
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
							'max'      => 100,
							'messages' => array(
								'stringLengthTooLong' => 'Endereço de email muito grande. (Máx. de 100)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'email' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O e-mail é obrigatório.'
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
								'stringLengthTooLong' => 'Endereço de e-mail muito grande. (Máx. de 200)'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'EmailAddress',
						'options' => array(
							'message' => 'E-mail inválido. Verifique se contém o símbolo @ e um domínio válido.',
						),
					),
				),
			),
			'atuacao' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'A atuação é obrigatória.'
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
								'stringLengthTooLong' => 'Atuação muito grande. (Máx. de 100)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'genero' => array(
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
								\Zend\Validator\NotEmpty::IS_EMPTY => 'O gênero é obrigatório.'
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
								'stringLengthTooLong' => 'Gênero muito grande. (Máx. de 100)'
							),
							'break_chain_on_failure' => true,
						),
					),
				),
			),
			'senha' => array(
				'required' => false,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 0,
							'max'      => 45,
							'messages' => array(
								'stringLengthTooLong' => 'Senha muito grande. (Máx. 45)'
							),
						),
					),
				),
			),
			'confirmarsenha' => array(
				'required' => false,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 0,
							'max'      => 45,
							'messages' => array(
								'stringLengthTooLong' => 'Confirmação de senha muito grande. (Máx. 45)'
							),
							'break_chain_on_failure' => true,
						),
					),
					array(
						'name'    => 'Identical',
						'options' => array(
							'token' => 'nova-senha',
							'message' => 'As senhas não conferem.',
						),
					),
				),
			),
			'foto' => array(
				'type' => 'Zend\InputFilter\FileInput',
				'required' => false,
				'allow_empty' => false,
				'filters'  => array(
					array(
						'name' => 'File\RenameUpload',
						'options' => array(
							'target' => './public/uploads',
							'randomize' => true,
							'use_upload_extension' => true,
						),
					),
				),
				'validators' => array(
					array(
						'name' => '\Zend\Validator\File\IsImage',
						'options' => array(
							'messages' => array(
								\Zend\Validator\File\IsImage::FALSE_TYPE => 'O arquivo não é uma imagem.',
								\Zend\Validator\File\IsImage::NOT_DETECTED => 'Não foi possível identificar o tipo da imagem.',
								\Zend\Validator\File\IsImage::NOT_READABLE => 'Arquivo não pode ser lido ou não existe.',
							),
						),
					),
					array(
						'name' => '\Zend\Validator\File\FilesSize',
						'options' => array(
							'max' => 1 * 1024 * 1024, // 1MB
							'messages' => array(
								\Zend\Validator\File\FilesSize::TOO_BIG => 'O arquivo é muito grande. (Máx. 1MB)',
								\Zend\Validator\File\FilesSize::TOO_SMALL => 'O arquivo está vazio.',
								\Zend\Validator\File\FilesSize::NOT_READABLE => 'Arquivo não pode ser lido ou não existe.',
							),
						),
					),
				),
			),
		);
	}
}