<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Receita as ChildReceita;
use Model\ReceitaQuery as ChildReceitaQuery;
use Model\Map\ReceitaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'receita' table.
 *
 * 
 *
 * @method     ChildReceitaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildReceitaQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildReceitaQuery orderByReceita($order = Criteria::ASC) Order by the receita column
 *
 * @method     ChildReceitaQuery groupById() Group by the id column
 * @method     ChildReceitaQuery groupByNome() Group by the nome column
 * @method     ChildReceitaQuery groupByReceita() Group by the receita column
 *
 * @method     ChildReceitaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReceitaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReceitaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReceitaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReceitaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReceitaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReceitaQuery leftJoinIngredienteReceita($relationAlias = null) Adds a LEFT JOIN clause to the query using the IngredienteReceita relation
 * @method     ChildReceitaQuery rightJoinIngredienteReceita($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IngredienteReceita relation
 * @method     ChildReceitaQuery innerJoinIngredienteReceita($relationAlias = null) Adds a INNER JOIN clause to the query using the IngredienteReceita relation
 *
 * @method     ChildReceitaQuery joinWithIngredienteReceita($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IngredienteReceita relation
 *
 * @method     ChildReceitaQuery leftJoinWithIngredienteReceita() Adds a LEFT JOIN clause and with to the query using the IngredienteReceita relation
 * @method     ChildReceitaQuery rightJoinWithIngredienteReceita() Adds a RIGHT JOIN clause and with to the query using the IngredienteReceita relation
 * @method     ChildReceitaQuery innerJoinWithIngredienteReceita() Adds a INNER JOIN clause and with to the query using the IngredienteReceita relation
 *
 * @method     ChildReceitaQuery leftJoinTipoProducao($relationAlias = null) Adds a LEFT JOIN clause to the query using the TipoProducao relation
 * @method     ChildReceitaQuery rightJoinTipoProducao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TipoProducao relation
 * @method     ChildReceitaQuery innerJoinTipoProducao($relationAlias = null) Adds a INNER JOIN clause to the query using the TipoProducao relation
 *
 * @method     ChildReceitaQuery joinWithTipoProducao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TipoProducao relation
 *
 * @method     ChildReceitaQuery leftJoinWithTipoProducao() Adds a LEFT JOIN clause and with to the query using the TipoProducao relation
 * @method     ChildReceitaQuery rightJoinWithTipoProducao() Adds a RIGHT JOIN clause and with to the query using the TipoProducao relation
 * @method     ChildReceitaQuery innerJoinWithTipoProducao() Adds a INNER JOIN clause and with to the query using the TipoProducao relation
 *
 * @method     \Model\IngredienteReceitaQuery|\Model\TipoProducaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReceita findOne(ConnectionInterface $con = null) Return the first ChildReceita matching the query
 * @method     ChildReceita findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReceita matching the query, or a new ChildReceita object populated from the query conditions when no match is found
 *
 * @method     ChildReceita findOneById(int $id) Return the first ChildReceita filtered by the id column
 * @method     ChildReceita findOneByNome(string $nome) Return the first ChildReceita filtered by the nome column
 * @method     ChildReceita findOneByReceita(string $receita) Return the first ChildReceita filtered by the receita column *

 * @method     ChildReceita requirePk($key, ConnectionInterface $con = null) Return the ChildReceita by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceita requireOne(ConnectionInterface $con = null) Return the first ChildReceita matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReceita requireOneById(int $id) Return the first ChildReceita filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceita requireOneByNome(string $nome) Return the first ChildReceita filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceita requireOneByReceita(string $receita) Return the first ChildReceita filtered by the receita column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReceita[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReceita objects based on current ModelCriteria
 * @method     ChildReceita[]|ObjectCollection findById(int $id) Return ChildReceita objects filtered by the id column
 * @method     ChildReceita[]|ObjectCollection findByNome(string $nome) Return ChildReceita objects filtered by the nome column
 * @method     ChildReceita[]|ObjectCollection findByReceita(string $receita) Return ChildReceita objects filtered by the receita column
 * @method     ChildReceita[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReceitaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ReceitaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Receita', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReceitaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReceitaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReceitaQuery) {
            return $criteria;
        }
        $query = new ChildReceitaQuery();
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
     * @return ChildReceita|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ReceitaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReceitaTableMap::DATABASE_NAME);
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
     * @return ChildReceita A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, receita FROM receita WHERE id = :p0';
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
            /** @var ChildReceita $obj */
            $obj = new ChildReceita();
            $obj->hydrate($row);
            ReceitaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildReceita|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReceitaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReceitaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ReceitaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ReceitaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReceitaTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildReceitaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ReceitaTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the receita column
     *
     * Example usage:
     * <code>
     * $query->filterByReceita('fooValue');   // WHERE receita = 'fooValue'
     * $query->filterByReceita('%fooValue%'); // WHERE receita LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receita The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function filterByReceita($receita = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receita)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $receita)) {
                $receita = str_replace('*', '%', $receita);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReceitaTableMap::COL_RECEITA, $receita, $comparison);
    }

    /**
     * Filter the query by a related \Model\IngredienteReceita object
     *
     * @param \Model\IngredienteReceita|ObjectCollection $ingredienteReceita the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReceitaQuery The current query, for fluid interface
     */
    public function filterByIngredienteReceita($ingredienteReceita, $comparison = null)
    {
        if ($ingredienteReceita instanceof \Model\IngredienteReceita) {
            return $this
                ->addUsingAlias(ReceitaTableMap::COL_ID, $ingredienteReceita->getIdReceita(), $comparison);
        } elseif ($ingredienteReceita instanceof ObjectCollection) {
            return $this
                ->useIngredienteReceitaQuery()
                ->filterByPrimaryKeys($ingredienteReceita->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByIngredienteReceita() only accepts arguments of type \Model\IngredienteReceita or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IngredienteReceita relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function joinIngredienteReceita($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IngredienteReceita');

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
            $this->addJoinObject($join, 'IngredienteReceita');
        }

        return $this;
    }

    /**
     * Use the IngredienteReceita relation IngredienteReceita object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\IngredienteReceitaQuery A secondary query class using the current class as primary query
     */
    public function useIngredienteReceitaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngredienteReceita($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IngredienteReceita', '\Model\IngredienteReceitaQuery');
    }

    /**
     * Filter the query by a related \Model\TipoProducao object
     *
     * @param \Model\TipoProducao|ObjectCollection $tipoProducao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReceitaQuery The current query, for fluid interface
     */
    public function filterByTipoProducao($tipoProducao, $comparison = null)
    {
        if ($tipoProducao instanceof \Model\TipoProducao) {
            return $this
                ->addUsingAlias(ReceitaTableMap::COL_ID, $tipoProducao->getIdReceita(), $comparison);
        } elseif ($tipoProducao instanceof ObjectCollection) {
            return $this
                ->useTipoProducaoQuery()
                ->filterByPrimaryKeys($tipoProducao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTipoProducao() only accepts arguments of type \Model\TipoProducao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TipoProducao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function joinTipoProducao($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TipoProducao');

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
            $this->addJoinObject($join, 'TipoProducao');
        }

        return $this;
    }

    /**
     * Use the TipoProducao relation TipoProducao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\TipoProducaoQuery A secondary query class using the current class as primary query
     */
    public function useTipoProducaoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTipoProducao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TipoProducao', '\Model\TipoProducaoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReceita $receita Object to remove from the list of results
     *
     * @return $this|ChildReceitaQuery The current query, for fluid interface
     */
    public function prune($receita = null)
    {
        if ($receita) {
            $this->addUsingAlias(ReceitaTableMap::COL_ID, $receita->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the receita table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReceitaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReceitaTableMap::clearInstancePool();
            ReceitaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReceitaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReceitaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ReceitaTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ReceitaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReceitaQuery
