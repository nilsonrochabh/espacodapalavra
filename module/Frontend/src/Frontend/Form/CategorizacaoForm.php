<?php

namespace Frontend\Form;

use Model\AmbienteQuery;
use Model\HabilidadeQuery;
use Model\RecursoQuery;
use Model\TamanhoTurmaQuery;
use Zend\Form\Form;
use Zend\Form\Element\Button;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Classe Frontend\Form$CategorizacaoForm
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 05/03/2016 17:04:21
 */
class CategorizacaoForm extends Form implements InputFilterProviderInterface {
	
	public function __construct($name = null) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype','multipart/form-data');
		
		$this->add(array(
			'type' => 'Zend\Form\Element\Select',
			'name' => 'categoria',
			'attributes' => array(
				'required' => true,
			),
			'options' => array(
				'label' => _('Categoria'),
				'id' => 'categoria',
				'empty_option' => '',
				'value_options' => array(
					array(
						'value' => 'S',
						'label' => _('Sensibilização'),
						'attributes' => array(
							'id' => 'categoria-S',
						),
					),
					array(
						'value' => 'J',
						'label' => _('Jogos'),
						'attributes' => array(
							'id' => 'categoria-J',
						),
					),
					array(
						'value' => 'P',
						'label' => _('Prática de escrita'),
						'attributes' => array(
							'id' => 'categoria-P',
						),
					),
				),
			),
		));
		
		$habilidades = HabilidadeQuery::create()->orderByDescricao()->find();
		$habilidadesOptions = array();
		foreach($habilidades as $o) {
			$temp = array(
				'value' => $o->getId(),
				'label' => $o->getDescricao(),
				'attributes' => array(
					'id' => 'habilidades-' . $o->getId(),
				),
			);
			
			$habilidadesOptions[] = $temp;
		}
		
		$this->add(array(
			'type' => 'Zend\Form\Element\MultiCheckbox',
			'name' => 'habilidade',
			'attributes' => array(
				'required' => true,
			),
			'options' => array(
				'label' => _('Por Habilidades Desenvolvidas'),
				'id' => 'habilidade',
				'multiple' => 'multiple',
				'value_options' => $habilidadesOptions,
			),
		));
		
		$ambientes = AmbienteQuery::create()->orderByDescricao()->find();
		$ambientesOptions = array();
		foreach($ambientes as $o) {
			$temp = array(
				'value' => $o->getId(),
				'label' => $o->getDescricao(),
				'attributes' => array(
					'id' => 'ambientes-' . $o->getId(),
				),
			);
			
			$ambientesOptions[] = $temp;
		}
		
		$this->add(array(
			'type' => 'Zend\Form\Element\MultiCheckbox',
			'name' => 'ambiente',
			'attributes' => array(
				'required' => true,
			),
			'options' => array(
				'label' => _('Por Ambiente'),
				'id' => 'ambiente',
				'multiple' => 'multiple',
				'value_options' => $ambientesOptions,
			),
		));
		
		$recursos = RecursoQuery::create()->orderByDescricao()->find();
		$recursosOptions = array();
		foreach($recursos as $o) {
			$temp = array(
				'value' => $o->getId(),
				'label' => $o->getDescricao(),
				'attributes' => array(
					'id' => 'recursos-' . $o->getId(),
				),
			);
			
			$recursosOptions[] = $temp;
		}
		
		$this->add(array(
			'type' => 'Zend\Form\Element\MultiCheckbox',
			'name' => 'recurso',
			'attributes' => array(
				'required' => true,
			),
			'options' => array(
				'label' => _('Por recursos necessários'),
				'id' => 'recurso',
				'multiple' => 'multiple',
				'value_options' => $recursosOptions,
			),
		));
		
		$tamanhos = TamanhoTurmaQuery::create()->find();
		$tamanhosOptions = array();
		foreach($tamanhos as $o) {
			$temp = array(
				'value' => $o->getId(),
				'label' => $o->getDescricao(),
				'attributes' => array(
					'id' => 'tamanhos-' . $o->getId(),
				),
			);
			
			$tamanhosOptions[] = $temp;
		}
		
		$this->add(array(
			'type' => 'Zend\Form\Element\MultiCheckbox',
			'name' => 'tamanho',
			'attributes' => array(
				'required' => true,
			),
			'options' => array(
				'label' => _('Por tamanho da turma'),
				'id' => 'tamanho',
				'multiple' => 'multiple',
				'value_options' => $tamanhosOptions,
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'class' => 'button-next',
				'value' => _('Visualizar Publicação'),
			),
		));
	}
	
	/**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification() {
		return array(
			'categoria' => array(
				'required' => true,
			),
			'habilidade' => array(
				'required' => true,
			),
			'ambiente' => array(
				'required' => true,
			),
			'recurso' => array(
				'required' => true,
			),
			'tamanho' => array(
				'required' => true,
			),
		);
	}
}