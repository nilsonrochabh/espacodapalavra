<?php

namespace Login\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;

class Check extends AbstractHelper
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * __invoke
     *
     * @access public
     * @return bool
     */
    public function __invoke($code)
    {
        if ($this->getAuthService()->hasIdentity()) {
            $identity = $this->getAuthService()->getIdentity();
            
            if(isset($identity['permissoes'])) {
	            // Se for administrador retorna true
	            if(in_array('000', $identity['permissoes'])) {
	            	return true;
	            }
	            
	            if(!is_array($code)) {
		            if(in_array($code, $identity['permissoes'])) {
		            	return true;
		            }
	            } else {
	            	foreach($code as $c) {
		            	if(in_array($c, $identity['permissoes'])) {
		            		return true;
		            	}
	            	}
	            }
	        }
	
	        return false;
        }
        
        return true;
    }

    /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     * @return \ZfcUser\View\Helper\ZfcUserIdentity
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }
}
