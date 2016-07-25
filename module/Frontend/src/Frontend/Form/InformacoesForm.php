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
			'name' => 'start',
			'attributes' => array(
				'id'    => 'start',
				'type'  => 'textarea',
				'rows'  => 5,
			),
			'options' => array(
				'label' => _('Resumo da Atividade'),
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
			'name' => 'imagem',
			'attributes' => array(
				'id'     => 'imagem',
				'type'   => 'file',
				'accept' => 'image/*',
			),
			'options' => array(
				'label' => _('Imagem Capa'),
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
			'imagem' => array(
				'type' => 'Zend\InputFilter\FileInput',
				'required' => false,
				'allow_empty' => true,
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