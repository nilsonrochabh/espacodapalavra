<?php
namespace Core\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Util\Hydrator\PropelMethods;
use Model\Local;

/**
 * Classe Core\Form$FieldsetLocal
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 02/09/2015 01:08:19
 */
class FieldsetLocal extends Fieldset implements InputFilterProviderInterface {

    /**
     * Método __construct
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 02/09/2015 01:08:24
     */
    public function __construct() {
        parent::__construct('local');
        
        $this->setHydrator(new PropelMethods())->setObject(new Local());
        
        $this->add(array(
            'name' => 'nome',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'column-sm' => '8',
                'column-xs' => '10',
                'maxlength' => 45,
                'required' => 'required',
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
							'max'      => 45,
						),
					),
				),
            )
        );
    }
}