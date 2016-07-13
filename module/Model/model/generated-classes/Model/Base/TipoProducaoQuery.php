<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\TipoProducao as ChildTipoProducao;
use Model\TipoProducaoQuery as ChildTipoProducaoQuery;
use Model\Map\TipoProducaoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tipo_producao' table.
 *
 * 
 *
 * @method     ChildTipoProducaoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTipoProducaoQuery orderByIdReceita($order = Criteria::ASC) Order by the id_receita column
 * @method     ChildTipoProducaoQuery orderByNome($order = Criteria::ASC) Order by the nome column
 *
 * @method     ChildTipoProducaoQuery groupById() Group by the id column
 * @method     ChildTipoProducaoQuery groupByIdReceita() Group by the id_receita column
 * @method     ChildTipoProducaoQuery groupByNome() Group by the nome column
 *
 * @method     ChildTipoProducaoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTipoProducaoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTipoProducaoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTipoProducaoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTipoProducaoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTipoProducaoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTipoProducaoQuery leftJoinReceita($relationAlias = null) Adds a LEFT JOIN clause to the query using the Receita relation
 * @method     ChildTipoProducaoQuery rightJoinReceita($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Receita relation
 * @method     ChildTipoProducaoQuery innerJoinReceita($relationAlias = null) Adds a INNER JOIN clause to the query using the Receita relation
 *
 * @method     ChildTipoProducaoQuery joinWithReceita($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Receita relation
 *
 * @method     ChildTipoProducaoQuery leftJoinWithReceita() Adds a LEFT JOIN clause and with to the query using the Receita relation
 * @method     ChildTipoProducaoQuery rightJoinWithReceita() Adds a RIGHT JOIN clause and with to the query using the Receita relation
 * @method     ChildTipoProducaoQuery innerJoinWithReceita() Adds a INNER JOIN clause and with to the query using the Receita relation
 *
 * @method     ChildTipoProducaoQuery leftJoinProducao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producao relation
 * @method     ChildTipoProducaoQuery rightJoinProducao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producao relation
 * @method     ChildTipoProducaoQuery innerJoinProducao($relationAlias = null) Adds a INNER JOIN clause to the query using the Producao relation
 *
 * @method     ChildTipoProducaoQuery joinWithProducao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Producao relation
 *
 * @method     ChildTipoProducaoQuery leftJoinWithProducao() Adds a LEFT JOIN clause and with to the query using the Producao relation
 * @method     ChildTipoProducaoQuery rightJoinWithProducao() Adds a RIGHT JOIN clause and with to the query using the Producao relation
 * @method     ChildTipoProducaoQuery innerJoinWithProducao() Adds a INNER JOIN clause and with to the query using the Producao relation
 *
 * @method     \Model\ReceitaQuery|\Model\ProducaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTipoProducao findOne(ConnectionInterface $con = null) Return the first ChildTipoProducao matching the query
 * @method     ChildTipoProducao findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTipoProducao matching the query, or a new ChildTipoProducao object populated from the query conditions when no match is found
 *
 * @method     ChildTipoProducao findOneById(int $id) Return the first ChildTipoProducao filtered by the id column
 * @method     ChildTipoProducao findOneByIdReceita(int $id_receita) Return the first ChildTipoProducao filtered by the id_receita column
 * @method     ChildTipoProducao findOneByNome(string $nome) Return the first ChildTipoProducao filtered by the nome column *

 * @method     ChildTipoProducao requirePk($key, ConnectionInterface $con = null) Return the ChildTipoProducao by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTipoProducao requireOne(ConnectionInterface $con = null) Return the first ChildTipoProducao matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTipoProducao requireOneById(int $id) Return the first ChildTipoProducao filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTipoProducao requireOneByIdReceita(int $id_receita) Return the first ChildTipoProducao filtered by the id_receita column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTipoProducao requireOneByNome(string $nome) Return the first ChildTipoProducao filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTipoProducao[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTipoProducao objects based on current ModelCriteria
 * @method     ChildTipoProducao[]|ObjectCollection findById(int $id) Return ChildTipoProducao objects filtered by the id column
 * @method     ChildTipoProducao[]|ObjectCollection findByIdReceita(int $id_receita) Return ChildTipoProducao objects filtered by the id_receita column
 * @method     ChildTipoProducao[]|ObjectCollection findByNome(string $nome) Return ChildTipoProducao objects filtered by the nome column
 * @method     ChildTipoProducao[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TipoProducaoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\TipoProducaoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\TipoProducao', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTipoProducaoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTipoProducaoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTipoProducaoQuery) {
            return $criteria;
        }
        $query = new ChildTipoProducaoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTipoProducao|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TipoProducaoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TipoProducaoTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTipoProducao A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_receita, nome FROM tipo_producao WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTipoProducao $obj */
            $obj = new ChildTipoProducao();
            $obj->hydrate($row);
            TipoProducaoTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTipoProducao|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TipoProducaoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TipoProducaoTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TipoProducaoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TipoProducaoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoProducaoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_receita column
     *
     * Example usage:
     * <code>
     * $query->filterByIdReceita(1234); // WHERE id_receita = 1234
     * $query->filterByIdReceita(array(12, 34)); // WHERE id_receita IN (12, 34)
     * $query->filterByIdReceita(array('min' => 12)); // WHERE id_receita > 12
     * </code>
     *
     * @see       filterByReceita()
     *
     * @param     mixed $idReceita The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterByIdReceita($idReceita = null, $comparison = null)
    {
        if (is_array($idReceita)) {
            $useMinMax = false;
            if (isset($idReceita['min'])) {
                $this->addUsingAlias(TipoProducaoTableMap::COL_ID_RECEITA, $idReceita['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idReceita['max'])) {
                $this->addUsingAlias(TipoProducaoTableMap::COL_ID_RECEITA, $idReceita['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoProducaoTableMap::COL_ID_RECEITA, $idReceita, $comparison);
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%'); // WHERE nome LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nome The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nome)) {
                $nome = str_replace('*', '%', $nome);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TipoProducaoTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query by a related \Model\Receita object
     *
     * @param \Model\Receita|ObjectCollection $receita The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterByReceita($receita, $comparison = null)
    {
        if ($receita instanceof \Model\Receita) {
            return $this
                ->addUsingAlias(TipoProducaoTableMap::COL_ID_RECEITA, $receita->getId(), $comparison);
        } elseif ($receita instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TipoProducaoTableMap::COL_ID_RECEITA, $receita->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByReceita() only accepts arguments of type \Model\Receita or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Receita relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function joinReceita($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Receita');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Receita');
        }

        return $this;
    }

    /**
     * Use the Receita relation Receita object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ReceitaQuery A secondary query class using the current class as primary query
     */
    public function useReceitaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinReceita($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Receita', '\Model\ReceitaQuery');
    }

    /**
     * Filter the query by a related \Model\Producao object
     *
     * @param \Model\Producao|ObjectCollection $producao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function filterByProducao($producao, $comparison = null)
    {
        if ($producao instanceof \Model\Producao) {
            return $this
                ->addUsingAlias(TipoProducaoTableMap::COL_ID, $producao->getIdTipoProducao(), $comparison);
        } elseif ($producao instanceof ObjectCollection) {
            return $this
                ->useProducaoQuery()
                ->filterByPrimaryKeys($producao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProducao() only accepts arguments of type \Model\Producao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Producao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function joinProducao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Producao');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Producao');
        }

        return $this;
    }

    /**
     * Use the Producao relation Producao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ProducaoQuery A secondary query class using the current class as primary query
     */
    public function useProducaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Producao', '\Model\ProducaoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTipoProducao $tipoProducao Object to remove from the list of results
     *
     * @return $this|ChildTipoProducaoQuery The current query, for fluid interface
     */
    public function prune($tipoProducao = null)
    {
        if ($tipoProducao) {
            $this->addUsingAlias(TipoProducaoTableMap::COL_ID, $tipoProducao->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tipo_producao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TipoProducaoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TipoProducaoTableMap::clearInstancePool();
            TipoProducaoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TipoProducaoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TipoProducaoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            TipoProducaoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            TipoProducaoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TipoProducaoQuery
