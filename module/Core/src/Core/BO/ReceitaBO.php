<?php
namespace Core\BO;

use Core\BO\Base\BO;
use Propel\Runtime\Propel;
use Util\Util;
use Propel\Runtime\ActiveQuery\Criteria;
use Model\ReceitaQuery;
use Model\Map\ReceitaTableMap;
use Model\Receita;

/**
 * Classe Core\BO$ReceitaBO
 * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
 * @since 07/09/2015 23:52:21
 */
class ReceitaBO extends BO {
    
    /**
     * Método getByPK
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:19:29
     * @param int $id
     * @return \Model\Ingrediente
     */
    public function getByPK($id) {
        return ReceitaQuery::create()->findPk($id);
    }
    
    /**
     * Método save
     * @author <a href="mailto:bruno@flek.com.br">Bruno Saliba</a>
     * @since 07/09/2015 23:52:44
     * @param Receita $o
     * @throws Exception
     * @return boolean
     */
    public function save(Receita $o) {
        $con = Propel::getWriteConnection(ReceitaTableMap::DATABASE_NAME);
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
     * @since 07/09/2015 23:52:52
     * @param int $id
     * @return int
     */
    public function excluir($id) {
        return ReceitaQuery::create()->filterById($id)->delete();
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
        $query = ReceitaQuery::create();
        
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
