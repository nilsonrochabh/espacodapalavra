<?php

namespace Core\Controller;

use Core\Controller\Base\FilterPage;
use Core\Form\Base\Form;
use Core\Form\UserFilterForm;
use Core\Model\TableHeader;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Core\Controller$UserFilterPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/05/2016 09:17:30
 */
class UserFilterPage extends FilterPage {

	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageTitle()
	 */
	protected function getPageTitle() {
		return $this->_('Usuários');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getPageImage()
	 */
	protected function getPageImage() {
		return 'fa-users';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getFiltroForm()
	 */
	protected function getFiltroForm() {
		$form = new UserFilterForm();
		$form->setActionBuscar($this->url()->fromRoute('user/search'));
		return $form;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::addButtons()
	 */
	protected function addButtons(ViewModel $view) {
		$this->adicionarHeaderControl($view, $this->_('Adicionar'), $this->url()->fromRoute('user/new'), 'fa-plus', 'btn-primary');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Core\Controller\Base\FilterPage::getGridRows()
	 */
	protected function getGridRows(Form $form, $start, $linhas, $orderBy = null, $orderType = null) {
		return $this->getUserBO()->listUsers($form->get('email')->getValue(), $start, $linhas, $orderBy, $orderType);
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
				'editar' => $this->url()->fromRoute('user/edit', array('id' => $l->getIdUser())),
				'excluir' => $this->url()->fromRoute('user/delete', array('id' => $l->getIdUser())),
			);
			
			$retorno[] = array(
				$l->getIdUser(),
				$l->getName(),
				$this->adicionarAcoesTable($acoes),
			);
		}
		
		return $retorno;
	}
}
