<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\TamanhoTurma as ChildTamanhoTurma;
use Model\TamanhoTurmaQuery as ChildTamanhoTurmaQuery;
use Model\Map\TamanhoTurmaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tamanho_turma' table.
 *
 *
 *
 * @method     ChildTamanhoTurmaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTamanhoTurmaQuery orderByDescricao($order = Criteria::ASC) Order by the descricao column
 *
 * @method     ChildTamanhoTurmaQuery groupById() Group by the id column
 * @method     ChildTamanhoTurmaQuery groupByDescricao() Group by the descricao column
 *
 * @method     ChildTamanhoTurmaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTamanhoTurmaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTamanhoTurmaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTamanhoTurmaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTamanhoTurmaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTamanhoTurmaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTamanhoTurmaQuery leftJoinTamanhoTurmaProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the TamanhoTurmaProposicao relation
 * @method     ChildTamanhoTurmaQuery rightJoinTamanhoTurmaProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TamanhoTurmaProposicao relation
 * @method     ChildTamanhoTurmaQuery innerJoinTamanhoTurmaProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the TamanhoTurmaProposicao relation
 *
 * @method     ChildTamanhoTurmaQuery joinWithTamanhoTurmaProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TamanhoTurmaProposicao relation
 *
 * @method     ChildTamanhoTurmaQuery leftJoinWithTamanhoTurmaProposicao() Adds a LEFT JOIN clause and with to the query using the TamanhoTurmaProposicao relation
 * @method     ChildTamanhoTurmaQuery rightJoinWithTamanhoTurmaProposicao() Adds a RIGHT JOIN clause and with to the query using the TamanhoTurmaProposicao relation
 * @method     ChildTamanhoTurmaQuery innerJoinWithTamanhoTurmaProposicao() Adds a INNER JOIN clause and with to the query using the TamanhoTurmaProposicao relation
 *
 * @method     \Model\TamanhoTurmaProposicaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTamanhoTurma findOne(ConnectionInterface $con = null) Return the first ChildTamanhoTurma matching the query
 * @method     ChildTamanhoTurma findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTamanhoTurma matching the query, or a new ChildTamanhoTurma object populated from the query conditions when no match is found
 *
 * @method     ChildTamanhoTurma findOneById(int $id) Return the first ChildTamanhoTurma filtered by the id column
 * @method     ChildTamanhoTurma findOneByDescricao(string $descricao) Return the first ChildTamanhoTurma filtered by the descricao column *

 * @method     ChildTamanhoTurma requirePk($key, ConnectionInterface $con = null) Return the ChildTamanhoTurma by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTamanhoTurma requireOne(ConnectionInterface $con = null) Return the first ChildTamanhoTurma matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTamanhoTurma requireOneById(int $id) Return the first ChildTamanhoTurma filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTamanhoTurma requireOneByDescricao(string $descricao) Return the first ChildTamanhoTurma filtered by the descricao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTamanhoTurma[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTamanhoTurma objects based on current ModelCriteria
 * @method     ChildTamanhoTurma[]|ObjectCollection findById(int $id) Return ChildTamanhoTurma objects filtered by the id column
 * @method     ChildTamanhoTurma[]|ObjectCollection findByDescricao(string $descricao) Return ChildTamanhoTurma objects filtered by the descricao column
 * @method     ChildTamanhoTurma[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TamanhoTurmaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\TamanhoTurmaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\TamanhoTurma', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTamanhoTurmaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTamanhoTurmaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTamanhoTurmaQuery) {
            return $criteria;
        }
        $query = new ChildTamanhoTurmaQuery();
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
     * @return ChildTamanhoTurma|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TamanhoTurmaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TamanhoTurmaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildTamanhoTurma A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, descricao FROM tamanho_turma WHERE id = :p0';
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
            /** @var ChildTamanhoTurma $obj */
            $obj = new ChildTamanhoTurma();
            $obj->hydrate($row);
            TamanhoTurmaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTamanhoTurma|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the descricao column
     *
     * Example usage:
     * <code>
     * $query->filterByDescricao('fooValue');   // WHERE descricao = 'fooValue'
     * $query->filterByDescricao('%fooValue%'); // WHERE descricao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descricao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function filterByDescricao($descricao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descricao)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TamanhoTurmaTableMap::COL_DESCRICAO, $descricao, $comparison);
    }

    /**
     * Filter the query by a related \Model\TamanhoTurmaProposicao object
     *
     * @param \Model\TamanhoTurmaProposicao|ObjectCollection $tamanhoTurmaProposicao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function filterByTamanhoTurmaProposicao($tamanhoTurmaProposicao, $comparison = null)
    {
        if ($tamanhoTurmaProposicao instanceof \Model\TamanhoTurmaProposicao) {
            return $this
                ->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $tamanhoTurmaProposicao->getIdTamanhoTurma(), $comparison);
        } elseif ($tamanhoTurmaProposicao instanceof ObjectCollection) {
            return $this
                ->useTamanhoTurmaProposicaoQuery()
                ->filterByPrimaryKeys($tamanhoTurmaProposicao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTamanhoTurmaProposicao() only accepts arguments of type \Model\TamanhoTurmaProposicao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TamanhoTurmaProposicao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function joinTamanhoTurmaProposicao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TamanhoTurmaProposicao');

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
            $this->addJoinObject($join, 'TamanhoTurmaProposicao');
        }

        return $this;
    }

    /**
     * Use the TamanhoTurmaProposicao relation TamanhoTurmaProposicao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\TamanhoTurmaProposicaoQuery A secondary query class using the current class as primary query
     */
    public function useTamanhoTurmaProposicaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTamanhoTurmaProposicao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TamanhoTurmaProposicao', '\Model\TamanhoTurmaProposicaoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTamanhoTurma $tamanhoTurma Object to remove from the list of results
     *
     * @return $this|ChildTamanhoTurmaQuery The current query, for fluid interface
     */
    public function prune($tamanhoTurma = null)
    {
        if ($tamanhoTurma) {
            $this->addUsingAlias(TamanhoTurmaTableMap::COL_ID, $tamanhoTurma->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tamanho_turma table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TamanhoTurmaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TamanhoTurmaTableMap::clearInstancePool();
            TamanhoTurmaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TamanhoTurmaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TamanhoTurmaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TamanhoTurmaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TamanhoTurmaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TamanhoTurmaQuery
