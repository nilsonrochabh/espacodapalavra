<?php

namespace Util\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormText;

/**
 * Classe Util\Form\View\Helper$FormInputSpinner
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 16/11/2015 14:04:49
 */
class FormInputSpinner extends FormText {
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormInput::render()
	 */
	public function render(ElementInterface $element) {
		$element->setAttribute('data-type', 'input-spinner');
		$element->setAttribute('data-initialized', 'false');
		
		$element->setAttribute('data-rule', $element->getAttribute('rule'));
		
		$html = '<div class="input-group spinner" data-trigger="spinner">';
		$html .= parent::render($element);
		$html .= '	<span class="input-group-addon">';
		$html .= '		<a href="javascript:;" class="spin-up" data-spin="up"><i class="fa fa-caret-up"></i></a>';
		$html .= '		<a href="javascript:;" class="spin-down" data-spin="down"><i class="fa fa-caret-down"></i></a>';
		$html .= '	</span>';
		$html .= '</div>';
		
		return $html;
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
