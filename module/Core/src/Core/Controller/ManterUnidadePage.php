<?php

namespace Core\Controller;

use Util\Util;
use Core\Controller\Base\ManterPage;
use Core\Form\ManterUnidadeForm;
use Zend\View\Model\ViewModel;
use Model\Unidade;

/**
 * Classe Core\Controller$ManterUnidadePage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/09/2015 23:58:19
 */
class ManterUnidadePage extends ManterPage {
	
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
        return 'fa-balance-scale';
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::getFiltroForm()
     */
    protected function getForm() {
        return new ManterUnidadeForm();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::addButtons()
     */
    protected function addButtons(ViewModel $view) {
        $this->adicionarHeaderControl($view, $this->_('Voltar'), $this->url()->fromRoute('unidade'));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::getEntity()
     */
    protected function getEntity($id) {
        if($id > 0) {
            return $this->getUnidadeBO()->getByPK($id);
        }
        
        return new Unidade();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::saveEntity()
     */
    protected function saveEntity($o) {
        return $this->getUnidadeBO()->save($o);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::deleteEntity()
     */
    protected function deleteEntity($id) {
        return $this->getUnidadeBO()->excluir($id);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::redirectAfterSave()
     */
    protected function redirectAfterSave($obj) {
        return $this->redirect()->toRoute('unidade');
    }
}
