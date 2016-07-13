<?php

namespace Core\Controller;

use Core\Controller\Base\FilterPage;
use Core\Form\Base\Form;
use Core\Form\FilterUnidadeForm;
use Zend\View\Model\ViewModel;
use Core\Model\TableHeader;
use Util\Util;

/**
 * Classe Core\Controller$FilterUnidadePage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/09/2015 23:43:20
 */
class FilterUnidadePage extends FilterPage {
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageTitle()
	 */
	protected function getPageTitle() {
		return _('Unidades');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageImage()
	 */
	protected function getPageImage() {
		return 'fa-balance-scale';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getFiltroForm()
	 */
	protected function getFiltroForm() {
		$form = new FilterUnidadeForm();
		$form->setActionBuscar($this->url()->fromRoute('unidade/buscar'));
		return $form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::addButtons()
	 */
	protected function addButtons(ViewModel $view) {
		$this->adicionarHeaderControl($view, $this->_('Adicionar'), $this->url()->fromRoute('unidade/novo'), 'fa-plus', 'btn-primary');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridRows()
	 */
	protected function getGridRows(Form $form, $start, $linhas, $orderBy = null, $orderType = null) {
		return $this->getUnidadeBO()->listAll($form->get('nome')->getValue(), $start, $linhas, $orderBy, $orderType);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridHeaders()
	 */
	protected function getGridHeaders() {
		return array(
			new TableHeader('#'),
			new TableHeader('Nome'),
			new TableHeader('Sigla'),
			new TableHeader('', 24, false)
		);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::toArray()
	 */
	protected function toArray($list) {
		$retorno = array();
		foreach($list as $l) {
			$acoes = array(
			    'editar' => $this->url()->fromRoute('unidade/editar', array('id' => $l->getId())),
			    'excluir' => $this->url()->fromRoute('unidade/excluir', array('id' => $l->getId())),
			);
			
			$retorno[] = array(
				$l->getId(),
				$l->getNome(),
				$l->getSigla(),
				$this->adicionarAcoesTable($acoes),
			);
		}

		return $retorno;
	}
}
