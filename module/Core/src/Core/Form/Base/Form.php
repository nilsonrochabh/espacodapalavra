<?php

namespace Core\Form\Base;

use Zend\Form\Form as Zend_Form;

/**
 * Classe Core\Form\Base$Form
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/08/2015 13:09:20
 */
class Form extends Zend_Form {
	
	private $actionBuscar;
	
	/**
	 * Método __construct
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 13:12:42
	 * @param string $name
	 * @param unknown $options
	 */
	public function __construct($name = 'bform', $options = array()) {
		parent::__construct($name, $options);
		
		$this->setAttribute('method', 'get');
		$this->setAttribute('role', 'form');
		$this->setAttribute('class', 'form-horizontal');
	}
	
	/**
	 * Método addResetButton
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 13:11:29
	 * @param string $label
	 */
	protected function addResetButton($label = null) {
		$this->add(array(
			'name' => 'limpar',
			'type' => 'Zend\Form\Element\Button',
			'attributes' => array(
				'type'  => 'button',
				'id' => 'submitbutton',
				'class' => 'btn btn-white',
				'onclick' => 'clearForm(\'' . $this->getName() . '\');$(\'#' . $this->getName() . '\').submit();',
			),
			'options' => array(
				'label' => $label ? $label : _('Limpar'),
			)
		));
	}
	
	/**
	 * Método addSearchButton
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 13:11:47
	 * @param string $label
	 */
	protected function addSearchButton($label = null) {
		$this->add(array(
			'name' => 'submit',
			'type' => 'Zend\Form\Element\Button',
			'attributes' => array(
				'type'  => 'submit',
				'id' => 'submitbutton',
				'class' => 'btn btn-primary',
			),
			'options' => array(
				'label' => $label ? $label : _('Pesquisar'),
			)
		));
	}
	
	/**
	 * Método getActionBuscar
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 00:02:44
	 */
	public function getActionBuscar() {
		return $this->actionBuscar;
	}
	
	/**
	 * Método setActionBuscar
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 00:03:08
	 * @param unknown $actionBuscar
	 */
	public function setActionBuscar($actionBuscar) {
		$this->actionBuscar = $actionBuscar;
	}
}
