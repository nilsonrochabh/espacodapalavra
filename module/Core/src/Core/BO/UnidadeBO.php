<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Propel\Runtime\Propel;
use Util\Util;
use Propel\Runtime\ActiveQuery\Criteria;
use Model\UnidadeQuery;
use Model\Map\UnidadeTableMap;
use Model\Unidade;

/**
 * Classe Core\BO$UnidadeBO
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 21/09/2015 23:37:35
 */
class UnidadeBO extends BO {
    
    /**
     * Método getByPK
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 21/09/2015 23:39:20
     * @param int $id
     * @return \Model\Unidade
     */
    public function getByPK($id) {
        return UnidadeQuery::create()->findPk($id);
    }
    
    /**
     * Método getByIds
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 22/09/2015 00:41:04
     * @param unknown $ids
     */
    public function getByIds($ids) {
        return UnidadeQuery::create()
            ->filterById($ids, Criteria::IN)
            ->find();
    }
    
    /**
     * Método getBySigla
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 22/09/2015 00:42:19
     * @param unknown $qs
     * @param unknown $pageLimit
     * @return Ambigous <\Propel\Runtime\Collection\ObjectCollection, multitype:\Propel\Runtime\ActiveRecord\ActiveRecordInterface , multitype:, mixed>
     */
    public function getBySigla($qs, $pageLimit) {
        $query = UnidadeQuery::create()->limit($pageLimit);
    
        foreach($qs as $q) {
            if(!Util::IsNullOrEmptyString($q)) {
                $query->filterBySigla('%' . trim($q) . '%');
            }
        }
    
        return $query->find();
    }
    
    /**
     * Método save
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 21/09/2015 23:39:27
     * @param Unidade $o
     * @throws Exception
     * @return boolean
     */
    public function save(Unidade $o) {
        $con = Propel::getWriteConnection(UnidadeTableMap::DATABASE_NAME);
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
     * @since 21/09/2015 23:39:54
     * @param int $id
     * @return number
     */
    public function excluir($id) {
        return 0;
    }
    
    /**
     * Método listAll
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:53:18
     * @param string $nome
     * @param int $start
     * @param int $linhas
     * @param string $orderBy
     * @param string $orderType
     * @return \Core\Model\DTO
     */
    public function listAll($nome, $start, $linhas, $orderBy = null, $orderType = null) {
        $query = UnidadeQuery::create();
        
        if(!Util::IsNullOrEmptyString($nome)) {
            $query->filterByNome('%' . $nome . '%');
            $query->_or();
            $query->filterBySigla('%' . $nome . '%');
        }
        
        $orderType = $orderType == 'desc' ? Criteria::DESC : Criteria::ASC;
        
        if($orderBy == 0) {
            $query->orderById($orderType);
        } elseif($orderBy == 1) {
            $query->orderByNome($orderType);
        } elseif($orderBy == 2) {
            $query->orderBySigla($orderType);
        }
        
        return $this->createDTO($query, $start, $linhas);
    }
}
