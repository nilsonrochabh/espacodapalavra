<?php

namespace Core\Controller;

use Core\Controller\Base\FilterPage;
use Core\Form\Base\Form;
use Core\Form\FilterReceitaForm;
use Zend\View\Model\ViewModel;
use Core\Model\TableHeader;
use Util\Util;

/**
 * Classe Core\Controller$FilterReceitaPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:50:43
 */
class FilterReceitaPage extends FilterPage {
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageTitle()
	 */
	protected function getPageTitle() {
		return _('Receitas');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageImage()
	 */
	protected function getPageImage() {
		return 'fa-book';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getFiltroForm()
	 */
	protected function getFiltroForm() {
		$form = new FilterReceitaForm();
		$form->setActionBuscar($this->url()->fromRoute('receita/buscar'));
		return $form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::addButtons()
	 */
	protected function addButtons(ViewModel $view) {
		$this->adicionarHeaderControl($view, $this->_('Adicionar'), $this->url()->fromRoute('receita/novo'), 'fa-plus', 'btn-primary');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridRows()
	 */
	protected function getGridRows(Form $form, $start, $linhas, $orderBy = null, $orderType = null) {
		return $this->getReceitaBO()->listAll($form->get('nome')->getValue(), $start, $linhas, $orderBy, $orderType);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridHeaders()
	 */
	protected function getGridHeaders() {
		return array(
			new TableHeader('#'),
			new TableHeader('Nome'),
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
			    'editar' => $this->url()->fromRoute('receita/editar', array('id' => $l->getId())),
			    'excluir' => $this->url()->fromRoute('receita/excluir', array('id' => $l->getId())),
			);
			
			$retorno[] = array(
				$l->getId(),
				$l->getNome(),
				$this->adicionarAcoesTable($acoes),
			);
		}

		return $retorno;
	}
}
