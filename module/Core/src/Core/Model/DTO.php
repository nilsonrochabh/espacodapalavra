<?php

namespace Core\Model;

class DTO {
	
	protected $recordsTotal;
	protected $recordsFiltered;
	protected $list;
	
	public function getRecordsTotal() {
		return $this->recordsTotal;
	}
	
	public function setRecordsTotal($recordsTotal) {
		$this->recordsTotal = $recordsTotal;
	}
	
	public function getRecordsFiltered() {
		return $this->recordsFiltered;
	}
	
	public function setRecordsFiltered($recordsFiltered) {
		$this->recordsFiltered = $recordsFiltered;
	}
	
	public function getList() {
		return $this->list;
	}
	
	public function setList($list) {
		$this->list = $list;
	}
}