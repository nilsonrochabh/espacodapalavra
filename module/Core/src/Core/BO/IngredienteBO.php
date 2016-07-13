<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Propel\Runtime\Propel;
use Util\Util;
use Propel\Runtime\ActiveQuery\Criteria;
use Model\IngredienteQuery;
use Model\Map\IngredienteTableMap;
use Model\Ingrediente;

/**
 * Classe Core\BO$IngredienteBO
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:19:17
 */
class IngredienteBO extends BO {
    
    /**
     * Método getByPK
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:19:29
     * @param unknown $id
     * @return \Model\Ingrediente
     */
    public function getByPK($id) {
        return IngredienteQuery::create()->findPk($id);
    }
    
    /**
     * Método getByIds
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 09/09/2015 00:33:18
     * @param multitype:int $ids
     * @return multitype:\Model\Ingrediente
     */
    public function getByIds($ids) {
        return IngredienteQuery::create()
            ->filterById($ids, Criteria::IN)
            ->find();
    }
    
    /**
     * Método getByNome
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 09/09/2015 00:35:12
     * @param multitype:string $qs
     * @param int $pageLimit
     * @return multitype:\Model\Ingrediente
     */
    public function getByNome($qs, $pageLimit) {
        $query = IngredienteQuery::create()->limit($pageLimit);
    
        foreach($qs as $q) {
            if(!Util::IsNullOrEmptyString($q)) {
                $query->filterByNome('%' . trim($q) . '%');
            }
        }
    
        return $query->find();
    }
    
    /**
     * Método save
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:20:05
     * @param Ingrediente $o
     * @throws Exception
     * @return boolean
     */
    public function save(Ingrediente $o) {
        $con = Propel::getWriteConnection(IngredienteTableMap::DATABASE_NAME);
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
     * @since 07/09/2015 23:20:17
     * @param int $id
     * @return int
     */
    public function excluir($id) {
        return IngredienteQuery::create()->filterById($id)->delete();
    }
    
    /**
     * Método listAll
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:20:31
     * @param string $nome
     * @param int $start
     * @param int $linhas
     * @param string $orderBy
     * @param string $orderType
     * @return \Core\Model\DTO
     */
    public function listAll($nome, $start, $linhas, $orderBy = null, $orderType = null) {
        $query = IngredienteQuery::create();
        
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
