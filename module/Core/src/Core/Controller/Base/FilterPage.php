<?php

namespace Core\Controller\Base;

use Core\Form\Base\Form;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Util\Util;

/**
 * Classe Core\Controller\Base$FilterPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/08/2015 01:12:04
 */
abstract class FilterPage extends BasePage {
	
	/**
	 * Método getFiltroForm
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 15:13:24
	 * @return \Core\Form\Base\Form
	 */
	abstract protected function getFiltroForm();
	
	/**
	 * Método getGridRows
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 14:42:42
	 * @param Form $form
	 * @param int $start
	 * @param int $linhas
	 * @param string $orderBy
	 * @param string $orderType
	 * @return \Core\Model\DTO
	 */
	abstract protected function getGridRows(Form $form, $start, $linhas, $orderBy = null, $orderType = null);
	
	/**
	 * Método getGridHeaders
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 15:14:55
	 * @return array
	 */
	abstract protected function getGridHeaders();
	
	/**
	 * Método toArray
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 15:14:29
	 * @param array $list
	 * @return array
	 */
	abstract protected function toArray($list);
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
		$view = new ViewModel(array(
			'titulo' => $this->getPageTitle(),
			'imagemTitulo' => $this->getPageImage(),
			'form' => $this->getFiltroForm(),
			'gridHeaders' => $this->getGridHeaders()
		));
		
		$view->setTemplate('core/filter-page/index.phtml');
	
		$this->adicionarBreadcrumb($view, $this->getPageTitle());
		
		$this->addButtons($view);
	
		return $view;
	}
	
	/**
	 * Método buscarAction
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 13:19:41
	 * @return \Core\Controller\Base\JsonModel
	 */
	public function buscarAction() {
		$form = $this->getFiltroForm();
	
		$request = $this->getRequest();
		if($request->isXmlHttpRequest()) {
			$form->setData($request->getQuery());
	
			if($form->isValid()) {
				$dto = $this->getGridRows(
					$form,
					intval($request->getQuery('start')),
					intval($request->getQuery('length')),
					$request->getQuery('order')[0]['column'],
					$request->getQuery('order')[0]['dir']
				);
				
				$output = array(
					'draw' => intval($request->getQuery('draw')),
					'recordsTotal' => $dto->getRecordsTotal(),
					'recordsFiltered' => $dto->getRecordsFiltered(),
					'data' => $this->toArray($dto->getList()),
				);
	
				$result = new JsonModel($output);
	
				return $result;
			}
		}
	
		return new JsonModel();
	}
}