<?php

namespace Util\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormText;

/**
 * Classe Util\Form\View\Helper$FormInputNumber
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/09/2015 17:18:24
 */
class FormInputNumber extends FormText {
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Form\View\Helper\FormInput::render()
	 */
	public function render(ElementInterface $element) {
		$element->setAttribute('data-type', 'input-number');
		$element->setAttribute('data-initialized', 'false');
		$element->setAttribute('data-mask', $this->getTranslator()->translate('#.##0,00'));
		$element->setAttribute('data-mask-reverse', 'true');
		
		$html = '';
		
		if($element->getAttribute('prefix') || $element->getAttribute('prefix')) {
            $html .= '<div class="input-group">';
		}
		
		if($element->getAttribute('prefix')) {
            $html .= '<span class="input-group-addon">' . $element->getAttribute('prefix') . '</span> ';
		}
		
		$html .= parent::render($element);
		
		if($element->getAttribute('sufix')) {
		    $html .= '<span class="input-group-addon">' . $element->getAttribute('sufix') . '</span> ';
		}
		
		if($element->getAttribute('prefix') || $element->getAttribute('prefix')) {
            $html .= '</div>';
		}
		
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
