<?php

namespace Core\Controller;

use Core\Controller\Base\FilterPage;
use Core\Form\FilterIngredienteForm;
use Core\Form\Base\Form;
use Zend\View\Model\ViewModel;
use Core\Model\TableHeader;
use Util\Util;

/**
 * Classe Core\Controller$FilterIngredientePage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:25:06
 */
class FilterIngredientePage extends FilterPage {
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageTitle()
	 */
	protected function getPageTitle() {
		return $this->_('Ingredientes');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageImage()
	 */
	protected function getPageImage() {
		return 'fa-cutlery';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getFiltroForm()
	 */
	protected function getFiltroForm() {
		$form = new FilterIngredienteForm();
		$form->setActionBuscar($this->url()->fromRoute('ingrediente/buscar'));
		return $form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::addButtons()
	 */
	protected function addButtons(ViewModel $view) {
		$this->adicionarHeaderControl($view, $this->_('Adicionar'), $this->url()->fromRoute('ingrediente/novo'), 'fa-plus', 'btn-primary');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridRows()
	 */
	protected function getGridRows(Form $form, $start, $linhas, $orderBy = null, $orderType = null) {
		return $this->getIngredienteBO()->listAll($form->get('nome')->getValue(), $start, $linhas, $orderBy, $orderType);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridHeaders()
	 */
	protected function getGridHeaders() {
		return array(
			new TableHeader('#'),
			new TableHeader($this->_('Nome')),
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
			    'editar' => $this->url()->fromRoute('ingrediente/editar', array('id' => $l->getId())),
			    'excluir' => $this->url()->fromRoute('ingrediente/excluir', array('id' => $l->getId())),
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
