<?php

namespace Core\Controller;

use Util\Util;
use Core\Controller\Base\ManterPage;
use Core\Form\ManterLocalForm;
use Zend\View\Model\ViewModel;
use Model\Local;

/**
 * Classe Core\Controller$ManterLocalPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 02/09/2015 01:12:20
 */
class ManterLocalPage extends ManterPage {
	
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::getPageTitle()
     */
    protected function getPageTitle() {
        return _('Locais');
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::getPageImage()
     */
    protected function getPageImage() {
        return 'fa-map-marker';
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::getFiltroForm()
     */
    protected function getForm() {
        return new ManterLocalForm();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::addButtons()
     */
    protected function addButtons(ViewModel $view) {
        $this->adicionarHeaderControl($view, $this->_('Voltar'), $this->url()->fromRoute('local'));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::getEntity()
     */
    protected function getEntity($id) {
        if($id > 0) {
            return $this->getLocalBO()->getByPK($id);
        }
        
        return new Local();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::saveEntity()
     */
    protected function saveEntity($o) {
        return $this->getLocalBO()->save($o);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::deleteEntity()
     */
    protected function deleteEntity($id) {
        return $this->getLocalBO()->excluir($id);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::redirectAfterSave()
     */
    protected function redirectAfterSave($obj) {
        return $this->redirect()->toRoute('local');
    }
}
