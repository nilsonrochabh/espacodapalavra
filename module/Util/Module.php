<?php
namespace Util;

/**
 * Classe Util$Module
 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
 * @since 07/11/2013 16:58:58
 */
class Module {
	
	/**
	 * Método getAutoloaderConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 07/11/2013 16:59:09
	 */
	public function getAutoloaderConfig() {         
		return array(         
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}
	
	/**
	 * Método getViewHelperConfig
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 03/04/2014 17:04:37
	 * @return multitype:multitype:string
	 */
	public function getViewHelperConfig() {
		return array(
			'invokables' => array(
				'formelement'        => 'Util\Form\View\Helper\FormElement',
				'formSelect2'        => 'Util\Form\View\Helper\FormSelect2',
				'formPlainText'      => 'Util\Form\View\Helper\FormPlainText',
				'formDatepicker'     => 'Util\Form\View\Helper\FormDatepicker',
				'formSwitchCheckbox' => 'Util\Form\View\Helper\FormSwitchCheckbox',
				'formHr'             => 'Util\Form\View\Helper\FormHr',
				'formHeader'         => 'Util\Form\View\Helper\FormHeader',
				'formInputNumber'    => 'Util\Form\View\Helper\FormInputNumber',
				'formInputSpinner'   => 'Util\Form\View\Helper\FormInputSpinner',
			),
		);
	}
}