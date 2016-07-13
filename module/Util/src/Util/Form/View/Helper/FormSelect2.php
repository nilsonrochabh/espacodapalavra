<?php

namespace Util\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormHidden;

/**
 * Classe Util\Form\View\Helper$FormSelect2
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 03/04/2014 18:52:11
 */
class FormSelect2 extends FormHidden {
	
	/**
	 * Método render
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/04/2014 18:52:37
	 * @param ElementInterface $element
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
		
		$url = $this->getView()->url($attribs['route']);
		
		$element->setAttribute('data-type', 'select2');
		$element->setAttribute('data-initialized', 'false');
		$element->setAttribute('data-url', $url);
		$element->setAttribute('data-minimum-input-length', isset($attribs['minimumInputLength']) ? (int) $attribs['minimumInputLength'] : '1');
		$element->setAttribute('data-placeholder', isset($attribs['placeholder']) ? $attribs['placeholder'] : ' ');
		$element->setAttribute('data-multiple', isset($attribs['multiple']) && $attribs['multiple'] ? 'true' : 'false');
		$element->setAttribute('data-maximum-selection-size', isset($attribs['maximumSelectionSize']) ? $attribs['maximumSelectionSize'] : '0');
		$element->setAttribute('data-querystring', isset($attribs['querystring']) && $attribs['querystring'] ? $attribs['querystring'] : '');
		$element->setAttribute('data-page-limit', isset($attribs['page_limit']) ? $attribs['page_limit'] : '10');
		$element->setAttribute('data-querystring-in-init', isset($attribs['querystring_in_init']) && $attribs['querystring_in_init'] ? 'true' : 'false');
		$element->setAttribute('data-sortable', isset($attribs['sortable']) && $attribs['sortable'] ? 'true' : 'false');
		
		return parent::render($element);
	}
	
	/**
	 * Método __invoke
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/04/2014 18:52:40
	 * @param ElementInterface $element
	 */
	public function __invoke(ElementInterface $element = null) {
		if(!$element) {
			return $this;
		}
		
		return $this->render($element);
	}
}
