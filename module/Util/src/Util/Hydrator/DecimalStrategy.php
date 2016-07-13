<?php
namespace Util\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use Util\Util;

/**
 * Classe Util\Hydrator\Strategy$DecimalStrategy
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 24/10/2015 17:37:48
 */
final class DecimalStrategy implements StrategyInterface {

    /**
     * (non-PHPdoc)
     * @see \Zend\Stdlib\Hydrator\Strategy\StrategyInterface::extract()
     */
    public function extract($value) {
        if(Util::IsNullOrEmptyString($value)) {
            return null;
        }
        
        return Util::formataNumero($value);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\Stdlib\Hydrator\Strategy\StrategyInterface::hydrate()
     */
    public function hydrate($value)
    {
        if ($value === '' || $value === null) {
            return;
        }

        return Util::str2num($value);
    }
}
