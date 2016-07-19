<?php

namespace Core\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

/**
 * Classe Patrimonio\Mvc\Controller$BaseController
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 03/03/2014 10:07:45
 */
class BaseController extends AbstractActionController {
	
	protected $_breadcrumb = null;
	
	// ------------------------- BO --------------------------------------------
	
	/**
	 * Método getUsuarioBO
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 04/09/2015 00:11:52
	 * @return \Core\BO\UsuarioBO
	 */
	protected function getUsuarioBO() {
	    return $this->getServiceLocator()->get('Core\BO\Usuario');
	}
	
	/**
	 * Método getProposicaoBO
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 04/09/2015 00:11:52
	 * @return \Core\BO\ProposicaoBO
	 */
	protected function getProposicaoBO() {
	    return $this->getServiceLocator()->get('Core\BO\Proposicao');
	}
	
	// ------------------------- -- --------------------------------------------
	
	/**
	 * Método _
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 31/03/2014 22:32:40
	 * @param unknown $key
	 * @return string
	 */
	protected function _($key) {
		$translator = $this->getServiceLocator()->get('translator');
		return $translator->translate($key);
	}
	
	/**
	 * Método preAdicionarBreadcrumb
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 25/02/2015 17:01:42
	 * @param unknown $label
	 * @param string $link
	 * @param string $image
	 */
	protected function preAdicionarBreadcrumb($label, $link = null, $image = null) {
		if($this->_breadcrumb === null || !is_array($this->_breadcrumb)) {
			$this->_breadcrumb = array();
		}
		if($image != null) {
			$this->_breadcrumb[] = array($label, $link, $image);
		} else {
			$this->_breadcrumb[] = array($label, $link);
		}
	}
	
	/**
	 * Método adicionarBreadcrumb - Adiciona o item no breadcrumb
	 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
	 * @since 20/11/2013 11:17:18
	 * @param string $label
	 * @param string $link
	 * @param string $image
	 * @param bool $inicio
	 */
	protected function adicionarBreadcrumb(ViewModel &$view, $label, $link = null, $image = null, $inicio = false) {
		if($this->_breadcrumb != null && count($this->_breadcrumb) > 0) {
			$temp = $this->_breadcrumb;
			$this->_breadcrumb = null;
			
			foreach($temp as $b) {
				$this->adicionarBreadcrumb($view, $b[0], $b[1], isset($b[2]) ? $b : null);
			}
		}
		
		$breadcrumb = $view->getVariable('breadcrumb');
		if($breadcrumb === null || !is_array($breadcrumb)) {
			$breadcrumb = array();
		}
		if($inicio) {
			if($image != null) {
				array_unshift($breadcrumb, array($label, $link, $image));
			} else {
				array_unshift($breadcrumb, array($label, $link));
			}
		} else {
			if($image != null) {
				$breadcrumb[] = array($label, $link, $image);
			} else {
				$breadcrumb[] = array($label, $link);
			}
		}
		$view->setVariables(array('breadcrumb' => $breadcrumb));
	}
	
	/**
	 * Método adicionarHeaderControl
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 01/04/2014 22:25:16
	 * @param ViewModel $view
	 * @param string $label
	 * @param string $link
	 * @param string $image
	 * @param string $class
	 */
	protected function adicionarHeaderControl(ViewModel &$view, $label, $link, $image = null, $class = 'btn-white', $onclick = null) {
		$headerControls = $view->getVariable('headerControls');
		if($headerControls === null || !is_array($headerControls)) {
			$headerControls = array();
		}
		$headerControls[] = array($label, $link, $image, $class, $onclick);
		$view->setVariables(array('headerControls' => $headerControls));
	}
	
	/**
	 * Método jsonSuccess
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/04/2014 00:06:34
	 * @param unknown $url
	 * @param string $msg
	 * @return \Patrimonio\Mvc\Controller\JsonModel
	 */
	protected function jsonSuccess($url, $msg = null) {
		if ($msg != null)
		{
			$this->flashmessenger()->addSuccessMessage($msg);
		}
	
		$json = array(array('success', array('url' => $url)));
	
		return new JsonModel($json);
	}
	
	/**
	 * Método adicionarAcoesTable
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/04/2014 10:34:45
	 * @param array $opcoes
	 * @return string
	 */
	protected function adicionarAcoesTable($opcoes) {
		$retorno = '<span class="preventWrap">';
		
		if(isset($opcoes['ver'])) {
			$retorno .= ' <a class="btn btn-primary btn-xs" href="' . $opcoes['ver']['url'] . '" title="' . $this->_('Ver') . '"><i class="fa fa-' . $opcoes['ver']['icon'] . '"></i></a> ';
			if(isset($opcoes['editar']) || isset($opcoes['excluir']) || isset($opcoes['copiar'])) {
				$retorno .= ' | ';
			}
		}
		
		if(isset($opcoes['copiar'])) {
			$retorno .= ' <a class="btn btn-info btn-xs" href="' . $opcoes['copiar'] . '" title="' . $this->_('Copiar') . '"><i class="fa fa-files-o"></i></a> ';
		}
		
		if(isset($opcoes['editar'])) {
			$retorno .= ' <a class="btn btn-warning btn-xs"' . (isset($opcoes['disable']) && in_array('editar', $opcoes['disable']) ? ' disabled="disabled"' : '') . ' href="' . (isset($opcoes['disable']) && in_array('editar', $opcoes['disable']) ? '#' : $opcoes['editar']) . '" title="' . $this->_('Editar') . '"><i class="fa fa-pencil-square-o"></i></a> ';		}
		
		if(isset($opcoes['excluir'])) {
			$retorno .= ' <button class="btn btn-danger btn-xs"' . (isset($opcoes['disable']) && in_array('excluir', $opcoes['disable']) ? ' disabled="disabled"' : '') . ' onclick="confirmExclusao(\'' . $this->_('Tem certeza que deseja excluir o registro?') . '\', \'' . $opcoes['excluir'] . '\');" title="' . $this->_('Excluir') . '"><i class="fa fa-trash-o"></i></button> ';
		}
		
		$retorno .= '</span>';
		
		return $retorno;
	}
	
	/**
	 * Método getIdUsuarioLogado
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/04/2014 22:56:49
	 * @return int
	 */
	protected function getIdUsuarioLogado() {
		$identity = $this->userAuthentication()->getIdentity();
		if($identity) {
			return $identity['id'];
		}
		
		return null;
	}
	
	/**
	 * Método getUsuarioLogado
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 25/02/2015 16:56:29
	 * @return \Model\Usuario
	 */
	protected function getUsuarioLogado() {
		$identity = $this->userAuthentication()->getIdentity();
		if($identity) {
			return $identity['usuario'];
		}
	
		return null;
	}
	
	/**
	 * Método traduzBoolean
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 29/06/2014 18:41:01
	 * @param unknown $v
	 * @return Ambigous <string, string, NULL, boolean, \Zend\EventManager\mixed, mixed>
	 */
	protected function traduzBoolean($v) {
		if($v) {
			return $this->_('Sim');
		}
		
		return $this->_('Não');
	}
	
	/**
	 * Método imageBoolean
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/03/2015 00:25:19
	 * @param unknown $v
	 * @return string
	 */
	protected function imageBoolean($v) {
		if($v) {
			return '<i class="fa fa-check"></i>';
		}
		
		return '<i class="fa fa-close"></i>';
	}
	
	/**
	 * Método imageColorBoolean
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 02/03/2015 00:26:19
	 * @param unknown $v
	 * @return string
	 */
	protected function imageColorBoolean($v) {
		if($v) {
			return '<i class="fa fa-check app-green"></i>';
		}
	
		return '<i class="fa fa-close app-red"></i>';
	}
	
	/**
	 * Método check
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 30/06/2014 16:38:53
	 * @param unknown $code
	 * @return boolean
	 */
	protected function check($code) {
		$identity = $this->userAuthentication()->getIdentity();
		
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
		
		return false;
	}
	
	/**
	 * Método getBasePath
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 06/01/2015 14:44:49
	 * @return string
	 */
	protected function getBasePath()
	{
		$uri = $this->getRequest()->getUri();
		$base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
		return $base;
	}
	
	/**
	 * Método getLocale
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 19/01/2015 18:49:31
	 * @return string
	 */
	protected function getLocale() {
		$locale = $this->getServiceLocator()->get('translator')->getLocale();
		$idiomas = array('pt_BR', 'es', 'en');
		if(in_array($locale, $idiomas)) {
			$locale = $idiomas[0];
		}
		return $locale;
	}
	
	/**
	 * Método handleException
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 05/03/2016 23:10:58
	 * @param Exception $e
	 * @param bool $addErrorMessage
	 */
	protected function handleException(\Exception $e, $addErrorMessage = true) {
		do {
			$this->getServiceLocator()->get('Logger')->debug($e->getMessage());
			$this->getServiceLocator()->get('Logger')->debug($e->getTraceAsString());
		} while($e = $e->getPrevious());
		
		if($addErrorMessage) {
			$this->flashMessenger()->addErrorMessage($this->_('Ocorreu um erro inesperado. Caso persista, entre em contato conosco.'));
		}
	}
}
