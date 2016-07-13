<?php

namespace Login\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Classe Login\Model$EsqueciSenhaInputFilter
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 01/09/2014 19:27:39
 */
class EsqueciSenhaInputFilter implements InputFilterAwareInterface {
	
	public $email;
	
	protected $inputFilter;
	
	/**
	 * Método exchangeArray
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 18/03/2014 00:20:06
	 * @param unknown $data
	 */
	public function exchangeArray($data) {
		$this->email = (isset($data['email'])) ? $data['email'] : null;
	}
	
	/**
	 * Método setInputFilter
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 18/03/2014 00:21:54
	 * @param InputFilterInterface $inputFilter
	 * @throws \Exception
	 */
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	/**
	 * Método getInputFilter
	 * @author <a href="mailto:bsaliba@gmail.com">Bruno Saliba</a>
	 * @since 18/03/2014 00:21:59
	 */
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
	
			$inputFilter->add($factory->createInput(array(
				'name'     => 'email',
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 200,
						),
					),
					array(
						'name'    => 'EmailAddress',
					),
				),
			)));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}
