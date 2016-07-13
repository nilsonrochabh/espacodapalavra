<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Unidade as ChildUnidade;
use Model\UnidadeQuery as ChildUnidadeQuery;
use Model\Map\UnidadeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'unidade' table.
 *
 * 
 *
 * @method     ChildUnidadeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUnidadeQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildUnidadeQuery orderBySigla($order = Criteria::ASC) Order by the sigla column
 *
 * @method     ChildUnidadeQuery groupById() Group by the id column
 * @method     ChildUnidadeQuery groupByNome() Group by the nome column
 * @method     ChildUnidadeQuery groupBySigla() Group by the sigla column
 *
 * @method     ChildUnidadeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUnidadeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUnidadeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUnidadeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUnidadeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUnidadeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUnidadeQuery leftJoinIngredienteReceita($relationAlias = null) Adds a LEFT JOIN clause to the query using the IngredienteReceita relation
 * @method     ChildUnidadeQuery rightJoinIngredienteReceita($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IngredienteReceita relation
 * @method     ChildUnidadeQuery innerJoinIngredienteReceita($relationAlias = null) Adds a INNER JOIN clause to the query using the IngredienteReceita relation
 *
 * @method     ChildUnidadeQuery joinWithIngredienteReceita($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IngredienteReceita relation
 *
 * @method     ChildUnidadeQuery leftJoinWithIngredienteReceita() Adds a LEFT JOIN clause and with to the query using the IngredienteReceita relation
 * @method     ChildUnidadeQuery rightJoinWithIngredienteReceita() Adds a RIGHT JOIN clause and with to the query using the IngredienteReceita relation
 * @method     ChildUnidadeQuery innerJoinWithIngredienteReceita() Adds a INNER JOIN clause and with to the query using the IngredienteReceita relation
 *
 * @method     ChildUnidadeQuery leftJoinProdutoBase($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProdutoBase relation
 * @method     ChildUnidadeQuery rightJoinProdutoBase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProdutoBase relation
 * @method     ChildUnidadeQuery innerJoinProdutoBase($relationAlias = null) Adds a INNER JOIN clause to the query using the ProdutoBase relation
 *
 * @method     ChildUnidadeQuery joinWithProdutoBase($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProdutoBase relation
 *
 * @method     ChildUnidadeQuery leftJoinWithProdutoBase() Adds a LEFT JOIN clause and with to the query using the ProdutoBase relation
 * @method     ChildUnidadeQuery rightJoinWithProdutoBase() Adds a RIGHT JOIN clause and with to the query using the ProdutoBase relation
 * @method     ChildUnidadeQuery innerJoinWithProdutoBase() Adds a INNER JOIN clause and with to the query using the ProdutoBase relation
 *
 * @method     \Model\IngredienteReceitaQuery|\Model\ProdutoBaseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUnidade findOne(ConnectionInterface $con = null) Return the first ChildUnidade matching the query
 * @method     ChildUnidade findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUnidade matching the query, or a new ChildUnidade object populated from the query conditions when no match is found
 *
 * @method     ChildUnidade findOneById(int $id) Return the first ChildUnidade filtered by the id column
 * @method     ChildUnidade findOneByNome(string $nome) Return the first ChildUnidade filtered by the nome column
 * @method     ChildUnidade findOneBySigla(string $sigla) Return the first ChildUnidade filtered by the sigla column *

 * @method     ChildUnidade requirePk($key, ConnectionInterface $con = null) Return the ChildUnidade by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnidade requireOne(ConnectionInterface $con = null) Return the first ChildUnidade matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnidade requireOneById(int $id) Return the first ChildUnidade filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnidade requireOneByNome(string $nome) Return the first ChildUnidade filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnidade requireOneBySigla(string $sigla) Return the first ChildUnidade filtered by the sigla column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnidade[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUnidade objects based on current ModelCriteria
 * @method     ChildUnidade[]|ObjectCollection findById(int $id) Return ChildUnidade objects filtered by the id column
 * @method     ChildUnidade[]|ObjectCollection findByNome(string $nome) Return ChildUnidade objects filtered by the nome column
 * @method     ChildUnidade[]|ObjectCollection findBySigla(string $sigla) Return ChildUnidade objects filtered by the sigla column
 * @method     ChildUnidade[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UnidadeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\UnidadeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Unidade', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUnidadeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUnidadeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUnidadeQuery) {
            return $criteria;
        }
        $query = new ChildUnidadeQuery();
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
     * @return ChildUnidade|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UnidadeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UnidadeTableMap::DATABASE_NAME);
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
     * @return ChildUnidade A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, sigla FROM unidade WHERE id = :p0';
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
            /** @var ChildUnidade $obj */
            $obj = new ChildUnidade();
            $obj->hydrate($row);
            UnidadeTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUnidade|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UnidadeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UnidadeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UnidadeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UnidadeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnidadeTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UnidadeTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the sigla column
     *
     * Example usage:
     * <code>
     * $query->filterBySigla('fooValue');   // WHERE sigla = 'fooValue'
     * $query->filterBySigla('%fooValue%'); // WHERE sigla LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sigla The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
     */
    public function filterBySigla($sigla = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sigla)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sigla)) {
                $sigla = str_replace('*', '%', $sigla);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UnidadeTableMap::COL_SIGLA, $sigla, $comparison);
    }

    /**
     * Filter the query by a related \Model\IngredienteReceita object
     *
     * @param \Model\IngredienteReceita|ObjectCollection $ingredienteReceita the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUnidadeQuery The current query, for fluid interface
     */
    public function filterByIngredienteReceita($ingredienteReceita, $comparison = null)
    {
        if ($ingredienteReceita instanceof \Model\IngredienteReceita) {
            return $this
                ->addUsingAlias(UnidadeTableMap::COL_ID, $ingredienteReceita->getIdUnidade(), $comparison);
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
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\ProdutoBase object
     *
     * @param \Model\ProdutoBase|ObjectCollection $produtoBase the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUnidadeQuery The current query, for fluid interface
     */
    public function filterByProdutoBase($produtoBase, $comparison = null)
    {
        if ($produtoBase instanceof \Model\ProdutoBase) {
            return $this
                ->addUsingAlias(UnidadeTableMap::COL_ID, $produtoBase->getIdUnidade(), $comparison);
        } elseif ($produtoBase instanceof ObjectCollection) {
            return $this
                ->useProdutoBaseQuery()
                ->filterByPrimaryKeys($produtoBase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProdutoBase() only accepts arguments of type \Model\ProdutoBase or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProdutoBase relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
     */
    public function joinProdutoBase($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProdutoBase');

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
            $this->addJoinObject($join, 'ProdutoBase');
        }

        return $this;
    }

    /**
     * Use the ProdutoBase relation ProdutoBase object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ProdutoBaseQuery A secondary query class using the current class as primary query
     */
    public function useProdutoBaseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProdutoBase($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProdutoBase', '\Model\ProdutoBaseQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUnidade $unidade Object to remove from the list of results
     *
     * @return $this|ChildUnidadeQuery The current query, for fluid interface
     */
    public function prune($unidade = null)
    {
        if ($unidade) {
            $this->addUsingAlias(UnidadeTableMap::COL_ID, $unidade->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the unidade table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UnidadeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UnidadeTableMap::clearInstancePool();
            UnidadeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UnidadeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UnidadeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            UnidadeTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            UnidadeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UnidadeQuery
