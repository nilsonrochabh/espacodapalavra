<?php

namespace Core\Model;

/**
 * Classe Core\Model$TableHeader
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 22/08/2015 01:06:16
 */
class TableHeader {
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var int
	 */
	protected $width;
	
	/**
	 * @var boolean
	 */
	protected $sort;
	
	/**
	 * @var boolean
	 */
	protected $defaultSort;
	
	/**
	 * @var string
	 */
	protected $defaultSortType;
	
	/**
	 * Método __construct
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:17:04
	 * @param string $name
	 * @param int $width
	 * @param boolean $sort
	 */
	function __construct($name, $width = null, $sort = true, $defaultSort = false, $defaultSortType = 'asc') {
		$this->name = $name;
		$this->width = $width;
		$this->sort = $sort;
		$this->defaultSort = $defaultSort;
		$this->defaultSortType = $defaultSortType;
	}
	
	/**
	 * Método getName
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:06:22
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Método setName
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:06:26
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Método getWidth
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:13:48
	 * @return int
	 */
	public function getWidth() {
		return $this->width;
	}
	
	/**
	 * Método setWidth
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:13:52
	 * @param int $width
	 */
	public function setWidth($width) {
		$this->width = $width;
	}
	
	/**
	 * Método getSort
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:13:58
	 * @return boolean
	 */
	public function getSort() {
		return $this->sort;
	}
	
	/**
	 * Método setSort
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 22/08/2015 01:14:03
	 * @param boolean $sort
	 */
	public function setSort($sort) {
		$this->sort = $sort;
	}
	
	/**
	 * Método getDefaultSort
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 11/11/2015 13:46:01
	 * @return boolean
	 */
	public function getDefaultSort() {
		return $this->defaultSort;
	}
	
	/**
	 * Método setDefaultSort
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 11/11/2015 13:46:07
	 * @param boolean $defaultSort
	 */
	public function setDefaultSort($defaultSort) {
		$this->defaultSort = $defaultSort;
	}
	
	/**
	 * Método getDefaultSortType
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 11/11/2015 13:48:01
	 * @return boolean
	 */
	public function getDefaultSortType() {
		return $this->defaultSortType;
	}
	
	/**
	 * Método setDefaultSortType
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 11/11/2015 13:48:07
	 * @param boolean $defaultSortType
	 */
	public function setDefaultSortType($defaultSortType) {
		$this->defaultSortType = $defaultSortType;
	}
	
}