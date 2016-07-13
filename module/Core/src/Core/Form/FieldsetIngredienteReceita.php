<?php
namespace Core\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Model\IngredienteReceita;
use Util\Hydrator\PropelMethods;
use Util\Hydrator\Strategy\DecimalStrategy;

/**
 * Classe Core\Form$FieldsetIngredienteReceita
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 08/09/2015 09:44:18
 */
class FieldsetIngredienteReceita extends Fieldset implements InputFilterProviderInterface {

    /**
     * Método __construct
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 08/09/2015 09:44:23
     */
    public function __construct() {
        parent::__construct('ingrediente_receita');
        
        $hydrator = new PropelMethods();
        $hydrator->addStrategy('quantidade', new DecimalStrategy());
        
        $this->setHydrator($hydrator)->setObject(new IngredienteReceita());
        
        $this->add(array(
			'name' => 'id_ingrediente',
			'type' => 'Util\Form\Element\Select2',
			'attributes' => array(
				'route' => 'select2/ingrediente',
				'minimumInputLength' => 0,
				'class' => 'form-control',
				'column-sm' => '10',
				'column-xs' => '10',
				'required' => true,
			),
			'options' => array(
				'label' => _('Ingrediente:'),
			)
		));
        
        $this->add(array(
            'name' => 'quantidade',
            'type' => 'Util\Form\Element\InputNumber',
            'attributes' => array(
                'id' => 'quantidade',
                'class' => 'form-control',
                'column-sm' => '4',
                'column-xs' => '5',
                'required' => true,
            ),
            'options' => array(
                'label' => _('Quantidade:'),
            ),
        ));
        
        $this->add(array(
            'name' => 'id_unidade',
            'type' => 'Util\Form\Element\Select2',
            'attributes' => array(
                'route' => 'select2/unidade',
                'minimumInputLength' => 0,
                'class' => 'form-control',
                'column-sm' => '2',
                'column-xs' => '10',
                'required' => true,
            ),
            'options' => array(
                'label' => _('Unidade:'),
            )
        ));
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification() {
        return array(
            'id_ingrediente' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'   => 'Int',
                    ),
                ),
            ),
        		
            'quantidade' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'   => 'IsFloat',
                    ),
                ),
            ),
        		
        	'id_unidade' => array(
        		'required' => true,
        		'filters'  => array(
        			array('name' => 'StripTags'),
        			array('name' => 'StringTrim'),
        		),
        		'validators' => array(
        			array(
        				'name'   => 'Int',
        			),
        		),
        	),
        );
    }
}