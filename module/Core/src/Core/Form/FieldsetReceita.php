<?php
namespace Core\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Util\Hydrator\PropelMethods;
use Model\Receita;

/**
 * Classe Core\Form$FieldsetReceita
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:55:35
 */
class FieldsetReceita extends Fieldset implements InputFilterProviderInterface {

    /**
     * Método __construct
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:33:46
     */
    public function __construct() {
        parent::__construct('receita');
        
        $this->setHydrator(new PropelMethods())->setObject(new Receita());
        
        $this->add(array(
            'name' => 'nome',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'column-sm' => '10',
                'column-xs' => '10',
                'maxlength' => 100,
                'required' => 'required'
            ),
            'options' => array(
                'label' => _('Nome:')
            ),
        ));
        
        $this->add(array(
            'name' => 'receita',
            'attributes' => array(
                'type'  => 'textarea',
                'class' => 'form-control',
                'column-sm' => '10',
                'column-xs' => '10',
                'maxlength' => 4000,
                'rows' => 10,
                'required' => 'required'
            ),
            'options' => array(
                'label' => _('Receita:')
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'ingrediente_receitas',
            'options' => array(
                'label' => _('Ingredientes da receita'),
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'template_placeholder' => '__placeholder__',
                'target_element' => array(
                    'type' => 'Core\Form\FieldsetIngredienteReceita',
                ),
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
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 100,
						),
					),
				),
            ),
        		
			'receita' => array(
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 4000,
						),
					),
				),
			)
        );
    }
}