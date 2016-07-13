<?php

namespace Util\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

/**
 * Classe Util\Form\View\Helper$FormPlainText
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 03/04/2014 17:00:09
 */
class FormPlainText extends AbstractHelper {
	
	/**
	 * Método render
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/04/2014 17:00:24
	 * @param ElementInterface $element
	 */
	public function render(ElementInterface $element) {
		return '<div class="plaintext">' . $element->getValue() . '</div>';
	}
	
	/**
	 * Método __invoke
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/04/2014 17:00:37
	 * @param ElementInterface $element
	 */
	public function __invoke(ElementInterface $element = null) {
		if(!$element) {
			return $this;
		}
		
		return $this->render($element);
	}
}
