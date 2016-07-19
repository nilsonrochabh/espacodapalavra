<?php

namespace Core\BO\Base;

use Core\Model\DTO;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Util\Util;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Classe Core\BO\Base$BO
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/08/2015 14:04:52
 */
class BO implements ServiceLocatorAwareInterface {
	
	use ServiceLocatorAwareTrait;
	
	/**
	 * Método createDTO
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 21/08/2015 14:34:31
	 * @param ModelCriteria $query
	 * @param unknown $start
	 * @param unknown $linhas
	 * @return \Core\Model\DTO
	 */
	protected function createDTO(ModelCriteria $query, $start, $linhas) {
		$pagina = $start / $linhas + 1;
		
		$paginator = $query->paginate($pagina, $linhas);
		
		$dto = new DTO();
		$dto->setRecordsTotal($paginator->count());
		$dto->setRecordsFiltered($paginator->getNbResults());
		$dto->setList($paginator->getResults());
		
		return $dto;
	}
	
	/**
	 * Método _ - Méodo para tradução de textos
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 10/11/2015 17:35:28
	 * @param string $key
	 * @return string
	 */
	protected function _($key) {
		$translator = $this->getServiceLocator()->get('translator');
		return $translator->translate($key);
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
			$this->getServiceLocator()->get('LogBO')->debug($e->getMessage());
			$this->getServiceLocator()->get('LogBO')->debug($e->getTraceAsString());
		} while($e = $e->getPrevious());
	}
}