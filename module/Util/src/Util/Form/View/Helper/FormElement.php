<?php
namespace Util\Form\View\Helper;

use Zend\Form\View\Helper\FormElement as BaseFormElement;
use Zend\Form\ElementInterface;
use Util\Form\Element\PlainText;
use Util\Form\Element\Select2;
use Util\Form\Element\Datepicker;
use Util\Form\Element\SwitchCheckbox;
use Util\Form\Element\Hr;
use Util\Form\Element\Header;
use Util\Form\Element\InputNumber;
use Util\Form\Element\InputSpinner;

/**
 * Classe Util\Form\View\Helper$FormElement
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 03/04/2014 17:02:15
 */
class FormElement extends BaseFormElement {
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormElement::render()
	 */
	public function render(ElementInterface $element) {
		$renderer = $this->getView();
		if(!method_exists($renderer, 'plugin')) {
			// Bail early if renderer is not pluggable
			return '';
		}
		
		if($element instanceof Select2) {
			$helper = $renderer->plugin('form_select2');
			return $helper($element);
		}
		
		if($element instanceof PlainText) {
			$helper = $renderer->plugin('form_plain_text');
			return $helper($element);
		}
		
		if($element instanceof Datepicker) {
			$helper = $renderer->plugin('form_datepicker');
			return $helper($element);
		}
		
		if($element instanceof SwitchCheckbox) {
			$helper = $renderer->plugin('form_switchcheckbox');
			return $helper($element);
		}
		
		if($element instanceof Hr) {
			$helper = $renderer->plugin('form_hr');
			return $helper($element);
		}
		
		if($element instanceof Header) {
			$helper = $renderer->plugin('form_header');
			return $helper($element);
		}
		
		if($element instanceof InputNumber) {
			$helper = $renderer->plugin('form_input_number');
			return $helper($element);
		}
		
		if($element instanceof InputSpinner) {
			$helper = $renderer->plugin('form_input_spinner');
			return $helper($element);
		}
		
		return parent::render($element);
	}
}