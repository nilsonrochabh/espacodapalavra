<?php
namespace Util\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Exception\BadMethodCallException;
use Propel\Runtime\Collection\ObjectCollection;
use Util\Util;

/**
 * Classe PropelMethods
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 13/09/2015 12:57:11
 */
class PropelMethods extends ClassMethods {
    
    public function hydrate(array $data, $object)
    {
        if (!is_object($object)) {
            throw new BadMethodCallException(sprintf(
                '%s expects the provided $object to be a PHP object)',
                __METHOD__
            ));
        }
    
        $objectClass = get_class($object);
    
        foreach ($data as $property => $value) {
            $propertyFqn = $objectClass . '::$' . $property;
    
            if (! isset($this->hydrationMethodsCache[$propertyFqn])) {
                $setterName = 'set' . ucfirst($this->hydrateName($property, $data));
    
                $this->hydrationMethodsCache[$propertyFqn] = is_callable([$object, $setterName])
                ? $setterName
                : false;
            }
    
            if ($this->hydrationMethodsCache[$propertyFqn]) {
                if(is_array($value)) {
                	$collection = new ObjectCollection();
                	
                	$i = 0;
                    foreach($value as $v) {
                    	if($i == 0) {
                    		$collection->setModel('\\' . get_class($v));
                    	}
                    	
                    	$collection->push($v);
                    	
                        $i++;
                    }
                    
                    $object->{$this->hydrationMethodsCache[$propertyFqn]}($this->hydrateValue($property, $collection, $data));
                } else {
                    if(Util::IsNullOrEmptyString($value)) {
                        $value = null;
                    }
                    
                    $object->{$this->hydrationMethodsCache[$propertyFqn]}($this->hydrateValue($property, $value, $data));
                }
            }
        }
    
        return $object;
    }
}