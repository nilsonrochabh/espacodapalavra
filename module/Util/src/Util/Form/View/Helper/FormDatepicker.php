<?php

namespace Util\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormText;

/**
 * Classe Util\Form\View\Helper$FormDatepicker
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 18/05/2014 22:14:11
 */
class FormDatepicker extends FormText {
	
	/**
	 * Método render
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/04/2014 18:52:37
	 * @param ElementInterface $element
	 */
	public function render(ElementInterface $element) {
		$html = '<div class="input-group date" data-type="date-picker" data-initialized="false">';
		$html .= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
		$html .= parent::render($element);
		$html .= '</div>';
		
		return $html;
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
