<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Consumo as ChildConsumo;
use Model\ConsumoQuery as ChildConsumoQuery;
use Model\Map\ConsumoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'consumo' table.
 *
 * 
 *
 * @method     ChildConsumoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildConsumoQuery orderByIdProducao($order = Criteria::ASC) Order by the id_producao column
 * @method     ChildConsumoQuery orderByIdProduto($order = Criteria::ASC) Order by the id_produto column
 * @method     ChildConsumoQuery orderByQuantidade($order = Criteria::ASC) Order by the quantidade column
 *
 * @method     ChildConsumoQuery groupById() Group by the id column
 * @method     ChildConsumoQuery groupByIdProducao() Group by the id_producao column
 * @method     ChildConsumoQuery groupByIdProduto() Group by the id_produto column
 * @method     ChildConsumoQuery groupByQuantidade() Group by the quantidade column
 *
 * @method     ChildConsumoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConsumoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConsumoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConsumoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConsumoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConsumoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConsumoQuery leftJoinProducao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producao relation
 * @method     ChildConsumoQuery rightJoinProducao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producao relation
 * @method     ChildConsumoQuery innerJoinProducao($relationAlias = null) Adds a INNER JOIN clause to the query using the Producao relation
 *
 * @method     ChildConsumoQuery joinWithProducao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Producao relation
 *
 * @method     ChildConsumoQuery leftJoinWithProducao() Adds a LEFT JOIN clause and with to the query using the Producao relation
 * @method     ChildConsumoQuery rightJoinWithProducao() Adds a RIGHT JOIN clause and with to the query using the Producao relation
 * @method     ChildConsumoQuery innerJoinWithProducao() Adds a INNER JOIN clause and with to the query using the Producao relation
 *
 * @method     ChildConsumoQuery leftJoinProduto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Produto relation
 * @method     ChildConsumoQuery rightJoinProduto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Produto relation
 * @method     ChildConsumoQuery innerJoinProduto($relationAlias = null) Adds a INNER JOIN clause to the query using the Produto relation
 *
 * @method     ChildConsumoQuery joinWithProduto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Produto relation
 *
 * @method     ChildConsumoQuery leftJoinWithProduto() Adds a LEFT JOIN clause and with to the query using the Produto relation
 * @method     ChildConsumoQuery rightJoinWithProduto() Adds a RIGHT JOIN clause and with to the query using the Produto relation
 * @method     ChildConsumoQuery innerJoinWithProduto() Adds a INNER JOIN clause and with to the query using the Produto relation
 *
 * @method     \Model\ProducaoQuery|\Model\ProdutoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildConsumo findOne(ConnectionInterface $con = null) Return the first ChildConsumo matching the query
 * @method     ChildConsumo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildConsumo matching the query, or a new ChildConsumo object populated from the query conditions when no match is found
 *
 * @method     ChildConsumo findOneById(int $id) Return the first ChildConsumo filtered by the id column
 * @method     ChildConsumo findOneByIdProducao(int $id_producao) Return the first ChildConsumo filtered by the id_producao column
 * @method     ChildConsumo findOneByIdProduto(int $id_produto) Return the first ChildConsumo filtered by the id_produto column
 * @method     ChildConsumo findOneByQuantidade(string $quantidade) Return the first ChildConsumo filtered by the quantidade column *

 * @method     ChildConsumo requirePk($key, ConnectionInterface $con = null) Return the ChildConsumo by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConsumo requireOne(ConnectionInterface $con = null) Return the first ChildConsumo matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConsumo requireOneById(int $id) Return the first ChildConsumo filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConsumo requireOneByIdProducao(int $id_producao) Return the first ChildConsumo filtered by the id_producao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConsumo requireOneByIdProduto(int $id_produto) Return the first ChildConsumo filtered by the id_produto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConsumo requireOneByQuantidade(string $quantidade) Return the first ChildConsumo filtered by the quantidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConsumo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildConsumo objects based on current ModelCriteria
 * @method     ChildConsumo[]|ObjectCollection findById(int $id) Return ChildConsumo objects filtered by the id column
 * @method     ChildConsumo[]|ObjectCollection findByIdProducao(int $id_producao) Return ChildConsumo objects filtered by the id_producao column
 * @method     ChildConsumo[]|ObjectCollection findByIdProduto(int $id_produto) Return ChildConsumo objects filtered by the id_produto column
 * @method     ChildConsumo[]|ObjectCollection findByQuantidade(string $quantidade) Return ChildConsumo objects filtered by the quantidade column
 * @method     ChildConsumo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ConsumoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ConsumoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Consumo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConsumoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConsumoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildConsumoQuery) {
            return $criteria;
        }
        $query = new ChildConsumoQuery();
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
     * @return ChildConsumo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ConsumoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConsumoTableMap::DATABASE_NAME);
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
     * @return ChildConsumo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_producao, id_produto, quantidade FROM consumo WHERE id = :p0';
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
            /** @var ChildConsumo $obj */
            $obj = new ChildConsumo();
            $obj->hydrate($row);
            ConsumoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildConsumo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ConsumoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ConsumoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConsumoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_producao column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProducao(1234); // WHERE id_producao = 1234
     * $query->filterByIdProducao(array(12, 34)); // WHERE id_producao IN (12, 34)
     * $query->filterByIdProducao(array('min' => 12)); // WHERE id_producao > 12
     * </code>
     *
     * @see       filterByProducao()
     *
     * @param     mixed $idProducao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByIdProducao($idProducao = null, $comparison = null)
    {
        if (is_array($idProducao)) {
            $useMinMax = false;
            if (isset($idProducao['min'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_ID_PRODUCAO, $idProducao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProducao['max'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_ID_PRODUCAO, $idProducao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConsumoTableMap::COL_ID_PRODUCAO, $idProducao, $comparison);
    }

    /**
     * Filter the query on the id_produto column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProduto(1234); // WHERE id_produto = 1234
     * $query->filterByIdProduto(array(12, 34)); // WHERE id_produto IN (12, 34)
     * $query->filterByIdProduto(array('min' => 12)); // WHERE id_produto > 12
     * </code>
     *
     * @see       filterByProduto()
     *
     * @param     mixed $idProduto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByIdProduto($idProduto = null, $comparison = null)
    {
        if (is_array($idProduto)) {
            $useMinMax = false;
            if (isset($idProduto['min'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_ID_PRODUTO, $idProduto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProduto['max'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_ID_PRODUTO, $idProduto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConsumoTableMap::COL_ID_PRODUTO, $idProduto, $comparison);
    }

    /**
     * Filter the query on the quantidade column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantidade(1234); // WHERE quantidade = 1234
     * $query->filterByQuantidade(array(12, 34)); // WHERE quantidade IN (12, 34)
     * $query->filterByQuantidade(array('min' => 12)); // WHERE quantidade > 12
     * </code>
     *
     * @param     mixed $quantidade The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByQuantidade($quantidade = null, $comparison = null)
    {
        if (is_array($quantidade)) {
            $useMinMax = false;
            if (isset($quantidade['min'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_QUANTIDADE, $quantidade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantidade['max'])) {
                $this->addUsingAlias(ConsumoTableMap::COL_QUANTIDADE, $quantidade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConsumoTableMap::COL_QUANTIDADE, $quantidade, $comparison);
    }

    /**
     * Filter the query by a related \Model\Producao object
     *
     * @param \Model\Producao|ObjectCollection $producao The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByProducao($producao, $comparison = null)
    {
        if ($producao instanceof \Model\Producao) {
            return $this
                ->addUsingAlias(ConsumoTableMap::COL_ID_PRODUCAO, $producao->getId(), $comparison);
        } elseif ($producao instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ConsumoTableMap::COL_ID_PRODUCAO, $producao->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildConsumoQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Produto object
     *
     * @param \Model\Produto|ObjectCollection $produto The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConsumoQuery The current query, for fluid interface
     */
    public function filterByProduto($produto, $comparison = null)
    {
        if ($produto instanceof \Model\Produto) {
            return $this
                ->addUsingAlias(ConsumoTableMap::COL_ID_PRODUTO, $produto->getId(), $comparison);
        } elseif ($produto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ConsumoTableMap::COL_ID_PRODUTO, $produto->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduto() only accepts arguments of type \Model\Produto or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Produto relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function joinProduto($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Produto');

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
            $this->addJoinObject($join, 'Produto');
        }

        return $this;
    }

    /**
     * Use the Produto relation Produto object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ProdutoQuery A secondary query class using the current class as primary query
     */
    public function useProdutoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Produto', '\Model\ProdutoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildConsumo $consumo Object to remove from the list of results
     *
     * @return $this|ChildConsumoQuery The current query, for fluid interface
     */
    public function prune($consumo = null)
    {
        if ($consumo) {
            $this->addUsingAlias(ConsumoTableMap::COL_ID, $consumo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the consumo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConsumoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConsumoTableMap::clearInstancePool();
            ConsumoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ConsumoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConsumoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ConsumoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ConsumoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ConsumoQuery
