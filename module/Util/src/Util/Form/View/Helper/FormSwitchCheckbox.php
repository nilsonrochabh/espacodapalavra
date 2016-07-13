<?php

namespace Util\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormCheckbox;

/**
 * Classe Util\Form\View\Helper$FormSwitchCheckbox
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 30/06/2014 07:44:49
 */
class FormSwitchCheckbox extends FormCheckbox {
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormCheckbox::render()
	 */
	public function render(ElementInterface $element) {
		$name = $element->getName();
		$element->setAttribute('id', $name);
		
		if ($name === null || $name === '') {
			throw new \DomainException(sprintf(
				'%s requires that the element has an assigned name; none discovered',
				__METHOD__
			));
		}
		
		$attribs = $element->getAttributes();
		$cor = isset($attribs['cor']) ? $attribs['cor'] : '#1AB394';
		
		$element->setAttribute('data-type', 'switch-checkbox');
		$element->setAttribute('data-initialized', 'false');
		$element->setAttribute('data-cor', $cor);
		
		return parent::render($element);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormInput::__invoke()
	 */
	public function __invoke(ElementInterface $element = null) {
		if(!$element) {
			return $this;
		}
		
		return $this->render($element);
	}
}
