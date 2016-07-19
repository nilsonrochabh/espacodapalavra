<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\AmbienteProposicao as ChildAmbienteProposicao;
use Model\AmbienteProposicaoQuery as ChildAmbienteProposicaoQuery;
use Model\Map\AmbienteProposicaoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ambiente_proposicao' table.
 *
 *
 *
 * @method     ChildAmbienteProposicaoQuery orderByIdAmbiente($order = Criteria::ASC) Order by the id_ambiente column
 * @method     ChildAmbienteProposicaoQuery orderByIdProposicao($order = Criteria::ASC) Order by the id_proposicao column
 *
 * @method     ChildAmbienteProposicaoQuery groupByIdAmbiente() Group by the id_ambiente column
 * @method     ChildAmbienteProposicaoQuery groupByIdProposicao() Group by the id_proposicao column
 *
 * @method     ChildAmbienteProposicaoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAmbienteProposicaoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAmbienteProposicaoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAmbienteProposicaoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAmbienteProposicaoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAmbienteProposicaoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAmbienteProposicaoQuery leftJoinAmbiente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ambiente relation
 * @method     ChildAmbienteProposicaoQuery rightJoinAmbiente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ambiente relation
 * @method     ChildAmbienteProposicaoQuery innerJoinAmbiente($relationAlias = null) Adds a INNER JOIN clause to the query using the Ambiente relation
 *
 * @method     ChildAmbienteProposicaoQuery joinWithAmbiente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ambiente relation
 *
 * @method     ChildAmbienteProposicaoQuery leftJoinWithAmbiente() Adds a LEFT JOIN clause and with to the query using the Ambiente relation
 * @method     ChildAmbienteProposicaoQuery rightJoinWithAmbiente() Adds a RIGHT JOIN clause and with to the query using the Ambiente relation
 * @method     ChildAmbienteProposicaoQuery innerJoinWithAmbiente() Adds a INNER JOIN clause and with to the query using the Ambiente relation
 *
 * @method     ChildAmbienteProposicaoQuery leftJoinProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Proposicao relation
 * @method     ChildAmbienteProposicaoQuery rightJoinProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Proposicao relation
 * @method     ChildAmbienteProposicaoQuery innerJoinProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the Proposicao relation
 *
 * @method     ChildAmbienteProposicaoQuery joinWithProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Proposicao relation
 *
 * @method     ChildAmbienteProposicaoQuery leftJoinWithProposicao() Adds a LEFT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildAmbienteProposicaoQuery rightJoinWithProposicao() Adds a RIGHT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildAmbienteProposicaoQuery innerJoinWithProposicao() Adds a INNER JOIN clause and with to the query using the Proposicao relation
 *
 * @method     \Model\AmbienteQuery|\Model\ProposicaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAmbienteProposicao findOne(ConnectionInterface $con = null) Return the first ChildAmbienteProposicao matching the query
 * @method     ChildAmbienteProposicao findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAmbienteProposicao matching the query, or a new ChildAmbienteProposicao object populated from the query conditions when no match is found
 *
 * @method     ChildAmbienteProposicao findOneByIdAmbiente(int $id_ambiente) Return the first ChildAmbienteProposicao filtered by the id_ambiente column
 * @method     ChildAmbienteProposicao findOneByIdProposicao(int $id_proposicao) Return the first ChildAmbienteProposicao filtered by the id_proposicao column *

 * @method     ChildAmbienteProposicao requirePk($key, ConnectionInterface $con = null) Return the ChildAmbienteProposicao by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAmbienteProposicao requireOne(ConnectionInterface $con = null) Return the first ChildAmbienteProposicao matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAmbienteProposicao requireOneByIdAmbiente(int $id_ambiente) Return the first ChildAmbienteProposicao filtered by the id_ambiente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAmbienteProposicao requireOneByIdProposicao(int $id_proposicao) Return the first ChildAmbienteProposicao filtered by the id_proposicao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAmbienteProposicao[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAmbienteProposicao objects based on current ModelCriteria
 * @method     ChildAmbienteProposicao[]|ObjectCollection findByIdAmbiente(int $id_ambiente) Return ChildAmbienteProposicao objects filtered by the id_ambiente column
 * @method     ChildAmbienteProposicao[]|ObjectCollection findByIdProposicao(int $id_proposicao) Return ChildAmbienteProposicao objects filtered by the id_proposicao column
 * @method     ChildAmbienteProposicao[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AmbienteProposicaoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\AmbienteProposicaoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\AmbienteProposicao', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAmbienteProposicaoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAmbienteProposicaoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAmbienteProposicaoQuery) {
            return $criteria;
        }
        $query = new ChildAmbienteProposicaoQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id_ambiente, $id_proposicao] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildAmbienteProposicao|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AmbienteProposicaoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AmbienteProposicaoTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildAmbienteProposicao A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_ambiente, id_proposicao FROM ambiente_proposicao WHERE id_ambiente = :p0 AND id_proposicao = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildAmbienteProposicao $obj */
            $obj = new ChildAmbienteProposicao();
            $obj->hydrate($row);
            AmbienteProposicaoTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildAmbienteProposicao|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id_ambiente column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAmbiente(1234); // WHERE id_ambiente = 1234
     * $query->filterByIdAmbiente(array(12, 34)); // WHERE id_ambiente IN (12, 34)
     * $query->filterByIdAmbiente(array('min' => 12)); // WHERE id_ambiente > 12
     * </code>
     *
     * @see       filterByAmbiente()
     *
     * @param     mixed $idAmbiente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function filterByIdAmbiente($idAmbiente = null, $comparison = null)
    {
        if (is_array($idAmbiente)) {
            $useMinMax = false;
            if (isset($idAmbiente['min'])) {
                $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $idAmbiente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAmbiente['max'])) {
                $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $idAmbiente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $idAmbiente, $comparison);
    }

    /**
     * Filter the query on the id_proposicao column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProposicao(1234); // WHERE id_proposicao = 1234
     * $query->filterByIdProposicao(array(12, 34)); // WHERE id_proposicao IN (12, 34)
     * $query->filterByIdProposicao(array('min' => 12)); // WHERE id_proposicao > 12
     * </code>
     *
     * @see       filterByProposicao()
     *
     * @param     mixed $idProposicao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function filterByIdProposicao($idProposicao = null, $comparison = null)
    {
        if (is_array($idProposicao)) {
            $useMinMax = false;
            if (isset($idProposicao['min'])) {
                $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $idProposicao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProposicao['max'])) {
                $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $idProposicao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $idProposicao, $comparison);
    }

    /**
     * Filter the query by a related \Model\Ambiente object
     *
     * @param \Model\Ambiente|ObjectCollection $ambiente The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function filterByAmbiente($ambiente, $comparison = null)
    {
        if ($ambiente instanceof \Model\Ambiente) {
            return $this
                ->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $ambiente->getId(), $comparison);
        } elseif ($ambiente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_AMBIENTE, $ambiente->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAmbiente() only accepts arguments of type \Model\Ambiente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ambiente relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function joinAmbiente($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ambiente');

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
            $this->addJoinObject($join, 'Ambiente');
        }

        return $this;
    }

    /**
     * Use the Ambiente relation Ambiente object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\AmbienteQuery A secondary query class using the current class as primary query
     */
    public function useAmbienteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAmbiente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ambiente', '\Model\AmbienteQuery');
    }

    /**
     * Filter the query by a related \Model\Proposicao object
     *
     * @param \Model\Proposicao|ObjectCollection $proposicao The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function filterByProposicao($proposicao, $comparison = null)
    {
        if ($proposicao instanceof \Model\Proposicao) {
            return $this
                ->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $proposicao->getId(), $comparison);
        } elseif ($proposicao instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO, $proposicao->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProposicao() only accepts arguments of type \Model\Proposicao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Proposicao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function joinProposicao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Proposicao');

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
            $this->addJoinObject($join, 'Proposicao');
        }

        return $this;
    }

    /**
     * Use the Proposicao relation Proposicao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ProposicaoQuery A secondary query class using the current class as primary query
     */
    public function useProposicaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProposicao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Proposicao', '\Model\ProposicaoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAmbienteProposicao $ambienteProposicao Object to remove from the list of results
     *
     * @return $this|ChildAmbienteProposicaoQuery The current query, for fluid interface
     */
    public function prune($ambienteProposicao = null)
    {
        if ($ambienteProposicao) {
            $this->addCond('pruneCond0', $this->getAliasedColName(AmbienteProposicaoTableMap::COL_ID_AMBIENTE), $ambienteProposicao->getIdAmbiente(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(AmbienteProposicaoTableMap::COL_ID_PROPOSICAO), $ambienteProposicao->getIdProposicao(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ambiente_proposicao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AmbienteProposicaoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AmbienteProposicaoTableMap::clearInstancePool();
            AmbienteProposicaoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AmbienteProposicaoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AmbienteProposicaoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AmbienteProposicaoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AmbienteProposicaoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AmbienteProposicaoQuery
