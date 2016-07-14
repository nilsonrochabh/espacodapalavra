<?php

namespace Core\Controller;

use Core\Controller\Base\ManterPage;
use Core\Form\UserManterForm;
use Model\User;
use Util\Util;
use Zend\View\Model\ViewModel;

/**
 * Classe Core\Controller$UserManterPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 25/05/2016 09:34:57
 */
class UserManterPage extends ManterPage {
	
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
    protected function getForm() {
        return new UserManterForm();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::addButtons()
     */
    protected function addButtons(ViewModel $view) {
        $this->adicionarHeaderControl($view, $this->_('Voltar'), $this->url()->fromRoute('user'));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::getEntity()
     */
    protected function getEntity($id) {
		if($id > 0) {
			return $this->getUserBO()->getByPK($id);
		}
		
		$obj = new User();
		$obj->setIsBot(1);
		$obj->setIsAdmin(1);
		$obj->setDthCreation(Util::agora());
		
		return $obj;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::saveEntity()
     */
    protected function saveEntity($o) {
        return $this->getUserBO()->save($o);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::deleteEntity()
     */
    protected function deleteEntity($id) {
        return $this->getUserBO()->delete($id);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::redirectAfterSave()
     */
    protected function redirectAfterSave($obj) {
        return $this->redirect()->toRoute('user');
    }
}
