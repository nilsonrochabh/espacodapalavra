<?php
namespace Core\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Util\Hydrator\PropelMethods;
use Model\Unidade;

/**
 * Classe Core\Form$FieldsetUnidade
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/09/2015 23:49:03
 */
class FieldsetUnidade extends Fieldset implements InputFilterProviderInterface {

    /**
     * Método __construct
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:33:46
     */
    public function __construct() {
        parent::__construct('unidade');
        
        $this->setHydrator(new PropelMethods())->setObject(new Unidade());
        
        $this->add(array(
            'name' => 'nome',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'column-sm' => '8',
                'column-xs' => '10',
                'maxlength' => 45,
                'required' => 'required'
            ),
            'options' => array(
                'label' => _('Nome:')
            ),
        ));
        
        $this->add(array(
            'name' => 'sigla',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'column-sm' => '2',
                'column-xs' => '10',
                'maxlength' => 10,
                'required' => 'required'
            ),
            'options' => array(
                'label' => _('Sigla:')
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
            ),
        		
			'sigla' => array(
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
							'max'      => 10,
						),
					),
				),
			)
        );
    }
}