<?php

namespace Core\Controller;

use Core\Mvc\Controller\BaseController;
use Zend\View\Model\ViewModel;

/**
 * Classe Core\Controller$I18nController
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 28/02/2015 11:44:41
 */
class I18nController extends BaseController {
	
	/**
	 * Método setUp
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 28/02/2015 11:44:57
	 */
	private function setUp() {
		$this->layout('layout/js');
	
		$headers = $this->getResponse()->getHeaders();
		if($headers) {
			$headers->addHeaderLine('Content-Type', 'text/javascript; charset=utf-8');
		}
	}
	
	/**
	 * Método pageAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 14/03/2015 12:01:27
	 * @return \Zend\View\Model\ViewModel
	 */
	public function pageAction() {
		$this->setUp();
	
		$t = array();
			
		$t['pt-br'] = $this->_('pt-br');
	
		$view = new ViewModel(array(
			'output' => $this->generateDictionary($t)
		));
		$view->setTemplate('core/i18n/index.phtml');
	
		return $view;
	}
	
	/**
	 * Método datatableAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 28/02/2015 11:45:26
	 * @return \Zend\View\Model\ViewModel
	 */
	public function datatableAction() {
		$this->setUp();
	
		$t = array();
			
		$t['sEmptyTable'] = $this->_('sEmptyTable');
		$t['sInfo'] = $this->_('sInfo');
		$t['sInfoEmpty'] = $this->_('sInfoEmpty');
		$t['sInfoFiltered'] = $this->_('sInfoFiltered');
		$t['sInfoPostFix'] = $this->_('sInfoPostFix');
		$t['sInfoThousands'] = $this->_('sInfoThousands');
		$t['sLengthMenu'] = $this->_('sLengthMenu');
		$t['sLoadingRecords'] = $this->_('sLoadingRecords');
		$t['sZeroRecords'] = $this->_('sZeroRecords');
		$t['sSearch'] = $this->_('sSearch');
		$t['oPaginate_sNext'] = $this->_('oPaginate_sNext');
		$t['oPaginate_sPrevious'] = $this->_('oPaginate_sPrevious');
		$t['oPaginate_sFirst'] = $this->_('oPaginate_sFirst');
		$t['oPaginate_sLast'] = $this->_('oPaginate_sLast');
		$t['oAria_sSortAscending'] = $this->_('oAria_sSortAscending');
		$t['oAria_sSortDescending'] = $this->_('oAria_sSortDescending');
	
		$view = new ViewModel(array(
			'output' => $this->generateDictionary($t)
		));
		$view->setTemplate('core/i18n/index.phtml');
	
		return $view;
	}
	
	/**
	 * Método generateDictionary
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 28/02/2015 11:45:42
	 * @param unknown $t
	 * @return string
	 */
	private function generateDictionary($t) {
		$output = '(function() { $(document).ready = function() {};';
		$output .= 'var my_dictionary_' . $this->getEvent()->getRouteMatch()->getParam('action') . ' = {';
	
		$x = 0;
		foreach($t as $k => $v) {
			if($x > 0) {
				$output .= ',';
			}
			$output .= '"' . addslashes($k) . '"  : "' . addslashes($v) . '"';
			$x++;
		}
	
		$output .= '}; $.i18n.setDictionary(my_dictionary_' . $this->getEvent()->getRouteMatch()->getParam('action') . ');';
		$output .= '}).call(this);';
		return $output;
	}
}