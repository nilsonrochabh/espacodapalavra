<?php

namespace Util\Form\Element;

use Zend\Form\Element\Checkbox;

/**
 * Classe Util\Form\Element$SwitchCheckbox
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 30/06/2014 07:43:22
 */
class SwitchCheckbox extends Checkbox {
	
	protected $attributes = array(
		'type' => 'switchcheckbox',
	);
}
