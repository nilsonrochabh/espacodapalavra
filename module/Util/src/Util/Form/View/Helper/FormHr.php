<?php

namespace Util\Form\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;

/**
 * Classe Util\Form\View\Helper$FormHr
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 30/06/2014 14:19:20
 */
class FormHr extends AbstractHelper {
	
	/**
	 * Método render
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 30/06/2014 14:19:53
	 * @param ElementInterface $element
	 * @return string
	 */
	public function render(ElementInterface $element) {
		$attribs = $element->getAttributes();
		$clazz = isset($attribs['class']) ? $attribs['class'] : 'hr-line-dashed';
		return '<div class="' . $clazz . '"></div>';
	}
	
	/**
	 * Método __invoke
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 30/06/2014 14:19:58
	 * @param ElementInterface $element
	 * @return \Util\Form\View\Helper\FormHr|string
	 */
	public function __invoke(ElementInterface $element = null) {
		if(!$element) {
			return $this;
		}
		
		return $this->render($element);
	}
}
