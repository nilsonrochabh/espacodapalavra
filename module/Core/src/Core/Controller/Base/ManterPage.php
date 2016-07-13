<?php

namespace Core\Controller\Base;

use Core\Exception\CoreException;
use Zend\View\Model\ViewModel;
use Util\Util;

/**
 * Classe Core\Controller\Base$ManterPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 12:45:33
 */
abstract class ManterPage extends BasePage {
	
	/**
	 * Método getForm
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 07/09/2015 12:45:54
	 * @return \Core\Form\Base\Form
	 */
	abstract protected function getForm();
	
	/**
	 * Método getEntity
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 12:50:31
	 * @param int $id
	 */
	abstract protected function getEntity($id);

	/**
	 * Método saveEntity
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 12:51:45
	 * @param unknown $o
	 */
	abstract protected function saveEntity($o);
	
	/**
	 * Método deleteEntity
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 13:16:02
	 * @param int $id
	 */
	abstract protected function deleteEntity($id);
	
	/**
	 * Método redirectAfterSave
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 13:02:22
	 * @param model $obj
	 * @return \Zend\Http\Response
	 */
	abstract protected function redirectAfterSave($obj);
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
	public function indexAction() {
	    $form = $this->getForm();
	    
	    $id = $this->params()->fromRoute('id', 0);
	    $obj = $this->getEntity($id);
	    
	    $form->bind($obj);
	
	    $request = $this->getRequest();
	    if ($request->isPost()) {
	        $form->setData($request->getPost());

	        if($form->isValid()) {
				try {
					if($this->saveEntity($obj)) {
						$this->flashMessenger()->addSuccessMessage($this->_('Registro salvo com sucesso.'));
						return $this->redirectAfterSave($obj);
					} else {
						$this->flashMessenger()->addErrorMessage($this->_('Ocorreu um erro ao salvar o registro.'));
					}
				} catch(CoreException $ex) {
					$this->flashMessenger()->addErrorMessage($this->_($ex->getMessage()));
				}
	        } else {
	            $this->flashMessenger()->addErrorMessage($this->_('Ocorreu um erro ao salvar o registro.'));
	        }
	    }
	    
	    $view = new ViewModel(array(
	        'titulo' => $this->getPageTitle(),
	        'imagemTitulo' => $this->getPageImage(),
	        'form' => $form,
	    ));
	     
	    $view->setTemplate('core/manter-page/index.phtml');
	    
	    $this->adicionarBreadcrumb($view, $this->getPageTitle());
	    
	    $this->addButtons($view);
	
	    return $view;
	}
	
	/**
	 * Método excluirAction
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 07/09/2015 13:13:11
	 * @return \Zend\Http\Response
	 */
	public function excluirAction() {
	    $id = $this->params()->fromRoute('id', 0);
	    if($id > 0) {
	        if($this->deleteEntity($id)) {
	            $this->flashMessenger()->addSuccessMessage($this->_('Registro excluído com sucesso.'));
	        } else {
	            $this->flashMessenger()->addErrorMessage($this->_('Ocorreu um erro ao excluir o registro.'));
	        }
	    }
	    return $this->redirectAfterSave();
	}
	
}