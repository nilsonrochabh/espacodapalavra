<?php

namespace Util\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

/**
 * Classe Util\Form\View\Helper$FormHeader
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 04/03/2015 16:20:34
 */
class FormHeader extends AbstractHelper {
	
	/**
	 * Método render
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 30/06/2014 14:19:53
	 * @param ElementInterface $element
	 * @return string
	 */
	public function render(ElementInterface $element) {
		$attribs = $element->getAttributes();
		$tamanho = isset($attribs['h']) && $attribs['h'] > 1 && $attribs['h'] <= 6 ? $attribs['h'] : 1;
		return '<h' . $tamanho . '>' . $element->getLabel() . '</h' . $tamanho . '>';
	}
	
	/**
	 * Método __invoke
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 30/06/2014 14:19:58
	 * @param ElementInterface $element
	 * @return \Util\Form\View\Helper\FormHeader|string
	 */
	public function __invoke(ElementInterface $element = null) {
		if(!$element) {
			return $this;
		}
		
		return $this->render($element);
	}
}
