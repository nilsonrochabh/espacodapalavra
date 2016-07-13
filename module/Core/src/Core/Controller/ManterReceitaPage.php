<?php

namespace Core\Controller;

use Util\Util;
use Core\Controller\Base\ManterPage;
use Core\Form\ManterReceitaForm;
use Zend\View\Model\ViewModel;
use Model\Receita;

/**
 * Classe Core\Controller$ManterReceitaPage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 08/09/2015 00:00:19
 */
class ManterReceitaPage extends ManterPage {
	
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
    protected function getForm() {
        return new ManterReceitaForm();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::addButtons()
     */
    protected function addButtons(ViewModel $view) {
        $this->adicionarHeaderControl($view, $this->_('Voltar'), $this->url()->fromRoute('receita'));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::getEntity()
     */
    protected function getEntity($id) {
        if($id > 0) {
            return $this->getReceitaBO()->getByPK($id);
        }
        
        return new Receita();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::saveEntity()
     */
    protected function saveEntity($o) {
        return $this->getReceitaBO()->save($o);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::deleteEntity()
     */
    protected function deleteEntity($id) {
        return $this->getReceitaBO()->excluir($id);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::redirectAfterSave()
     */
    protected function redirectAfterSave($obj) {
        return $this->redirect()->toRoute('receita');
    }
}
