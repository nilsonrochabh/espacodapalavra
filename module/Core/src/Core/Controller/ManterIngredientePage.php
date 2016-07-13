<?php

namespace Core\Controller;

use Util\Util;
use Core\Controller\Base\ManterPage;
use Core\Form\ManterIngredienteForm;
use Zend\View\Model\ViewModel;
use Model\Ingrediente;

/**
 * Classe Core\Controller$ManterIngredientePage
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:15:29
 */
class ManterIngredientePage extends ManterPage {
	
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::getPageTitle()
     */
    protected function getPageTitle() {
        return _('Ingredientes');
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
    protected function getForm() {
        return new ManterIngredienteForm();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\FilterPage::addButtons()
     */
    protected function addButtons(ViewModel $view) {
        $this->adicionarHeaderControl($view, $this->_('Voltar'), $this->url()->fromRoute('ingrediente'));
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::getEntity()
     */
    protected function getEntity($id) {
        if($id > 0) {
            return $this->getIngredienteBO()->getByPK($id);
        }
        
        return new Ingrediente();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::saveEntity()
     */
    protected function saveEntity($o) {
        return $this->getIngredienteBO()->save($o);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::deleteEntity()
     */
    protected function deleteEntity($id) {
        return $this->getIngredienteBO()->excluir($id);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Core\Controller\Base\ManterPage::redirectAfterSave()
     */
    protected function redirectAfterSave($obj) {
        return $this->redirect()->toRoute('ingrediente');
    }
}
