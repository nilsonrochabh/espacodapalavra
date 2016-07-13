<?php
namespace Core\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Model\Ingrediente;
use Util\Hydrator\PropelMethods;

/**
 * Classe Core\Form$FieldsetIngrediente
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:32:53
 */
class FieldsetIngrediente extends Fieldset implements InputFilterProviderInterface {

    /**
     * Método __construct
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:33:46
     */
    public function __construct() {
        parent::__construct('ingrediente');
        
        $this->setHydrator(new PropelMethods())->setObject(new Ingrediente());
        
        $this->add(array(
            'name' => 'nome',
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
            )
        );
    }
}