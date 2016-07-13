<?php
namespace Core\BO;

use Model\LocalQuery;
use Core\BO\Base\BO;
use Model\Local;
use Model\Map\LocalTableMap;
use Propel\Runtime\Propel;
use Util\Util;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Classe Core\BO$LocalBO
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 04/09/2015 00:09:35
 */
class LocalBO extends BO {
    
    /**
     * Método getByPK
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 04/09/2015 00:09:39
     * @param unknown $id
     * @return Ambigous <\Model\Local, \Model\Base\array, \Model\Base\mixed>
     */
    public function getByPK($id) {
        return LocalQuery::create()->findPk($id);
    }
    
    /**
     * Método save
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 04/09/2015 00:14:34
     * @param Local $o
     * @throws Exception
     * @return boolean
     */
    public function save(Local $o) {
        $con = Propel::getWriteConnection(LocalTableMap::DATABASE_NAME);
        $con->beginTransaction();
        
        try {
            $o->save($con);
            $con->commit();
            return true;
        } catch (\Exception $e) {
            $con->rollback();
            throw $e;
        }
        
        return false;
    }
    
    /**
     * Método excluir
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 13:20:53
     * @param int $id
     * @return int
     */
    public function excluir($id) {
        return LocalQuery::create()->filterById($id)->delete();
    }
    
    /**
     * Método listAll
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 04/09/2015 00:25:02
     * @param string $nome
     * @param int $start
     * @param int $linhas
     * @param string $orderBy
     * @param string $orderType
     * @return \Core\Model\DTO
     */
    public function listAll($nome, $start, $linhas, $orderBy = null, $orderType = null) {
        $query = LocalQuery::create();
        
        if(!Util::IsNullOrEmptyString($nome)) {
            $query->filterByNome('%' . $nome . '%');
        }
        
        $orderType = $orderType == 'desc' ? Criteria::DESC : Criteria::ASC;
        
        if($orderBy == 0) {
            $query->orderById($orderType);
        } elseif($orderBy == 1) {
            $query->orderByNome($orderType);
        }
        
        return $this->createDTO($query, $start, $linhas);
    }
}
