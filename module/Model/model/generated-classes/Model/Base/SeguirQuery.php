<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Seguir as ChildSeguir;
use Model\SeguirQuery as ChildSeguirQuery;
use Model\Map\SeguirTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'seguir' table.
 *
 *
 *
 * @method     ChildSeguirQuery orderByIdProposicao($order = Criteria::ASC) Order by the id_proposicao column
 * @method     ChildSeguirQuery orderByIdUsuario($order = Criteria::ASC) Order by the id_usuario column
 * @method     ChildSeguirQuery orderByDataCadastro($order = Criteria::ASC) Order by the data_cadastro column
 *
 * @method     ChildSeguirQuery groupByIdProposicao() Group by the id_proposicao column
 * @method     ChildSeguirQuery groupByIdUsuario() Group by the id_usuario column
 * @method     ChildSeguirQuery groupByDataCadastro() Group by the data_cadastro column
 *
 * @method     ChildSeguirQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSeguirQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSeguirQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSeguirQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSeguirQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSeguirQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSeguirQuery leftJoinProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Proposicao relation
 * @method     ChildSeguirQuery rightJoinProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Proposicao relation
 * @method     ChildSeguirQuery innerJoinProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the Proposicao relation
 *
 * @method     ChildSeguirQuery joinWithProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Proposicao relation
 *
 * @method     ChildSeguirQuery leftJoinWithProposicao() Adds a LEFT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildSeguirQuery rightJoinWithProposicao() Adds a RIGHT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildSeguirQuery innerJoinWithProposicao() Adds a INNER JOIN clause and with to the query using the Proposicao relation
 *
 * @method     ChildSeguirQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildSeguirQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildSeguirQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildSeguirQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildSeguirQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildSeguirQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildSeguirQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     \Model\ProposicaoQuery|\Model\UsuarioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSeguir findOne(ConnectionInterface $con = null) Return the first ChildSeguir matching the query
 * @method     ChildSeguir findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSeguir matching the query, or a new ChildSeguir object populated from the query conditions when no match is found
 *
 * @method     ChildSeguir findOneByIdProposicao(int $id_proposicao) Return the first ChildSeguir filtered by the id_proposicao column
 * @method     ChildSeguir findOneByIdUsuario(int $id_usuario) Return the first ChildSeguir filtered by the id_usuario column
 * @method     ChildSeguir findOneByDataCadastro(string $data_cadastro) Return the first ChildSeguir filtered by the data_cadastro column *

 * @method     ChildSeguir requirePk($key, ConnectionInterface $con = null) Return the ChildSeguir by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSeguir requireOne(ConnectionInterface $con = null) Return the first ChildSeguir matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSeguir requireOneByIdProposicao(int $id_proposicao) Return the first ChildSeguir filtered by the id_proposicao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSeguir requireOneByIdUsuario(int $id_usuario) Return the first ChildSeguir filtered by the id_usuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSeguir requireOneByDataCadastro(string $data_cadastro) Return the first ChildSeguir filtered by the data_cadastro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSeguir[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSeguir objects based on current ModelCriteria
 * @method     ChildSeguir[]|ObjectCollection findByIdProposicao(int $id_proposicao) Return ChildSeguir objects filtered by the id_proposicao column
 * @method     ChildSeguir[]|ObjectCollection findByIdUsuario(int $id_usuario) Return ChildSeguir objects filtered by the id_usuario column
 * @method     ChildSeguir[]|ObjectCollection findByDataCadastro(string $data_cadastro) Return ChildSeguir objects filtered by the data_cadastro column
 * @method     ChildSeguir[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SeguirQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\SeguirQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Seguir', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSeguirQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSeguirQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSeguirQuery) {
            return $criteria;
        }
        $query = new ChildSeguirQuery();
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
     * @param array[$id_proposicao, $id_usuario] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSeguir|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SeguirTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SeguirTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildSeguir A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_proposicao, id_usuario, data_cadastro FROM seguir WHERE id_proposicao = :p0 AND id_usuario = :p1';
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
            /** @var ChildSeguir $obj */
            $obj = new ChildSeguir();
            $obj->hydrate($row);
            SeguirTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSeguir|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SeguirTableMap::COL_ID_PROPOSICAO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SeguirTableMap::COL_ID_USUARIO, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SeguirTableMap::COL_ID_PROPOSICAO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SeguirTableMap::COL_ID_USUARIO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByIdProposicao($idProposicao = null, $comparison = null)
    {
        if (is_array($idProposicao)) {
            $useMinMax = false;
            if (isset($idProposicao['min'])) {
                $this->addUsingAlias(SeguirTableMap::COL_ID_PROPOSICAO, $idProposicao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProposicao['max'])) {
                $this->addUsingAlias(SeguirTableMap::COL_ID_PROPOSICAO, $idProposicao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SeguirTableMap::COL_ID_PROPOSICAO, $idProposicao, $comparison);
    }

    /**
     * Filter the query on the id_usuario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUsuario(1234); // WHERE id_usuario = 1234
     * $query->filterByIdUsuario(array(12, 34)); // WHERE id_usuario IN (12, 34)
     * $query->filterByIdUsuario(array('min' => 12)); // WHERE id_usuario > 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $idUsuario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByIdUsuario($idUsuario = null, $comparison = null)
    {
        if (is_array($idUsuario)) {
            $useMinMax = false;
            if (isset($idUsuario['min'])) {
                $this->addUsingAlias(SeguirTableMap::COL_ID_USUARIO, $idUsuario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUsuario['max'])) {
                $this->addUsingAlias(SeguirTableMap::COL_ID_USUARIO, $idUsuario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SeguirTableMap::COL_ID_USUARIO, $idUsuario, $comparison);
    }

    /**
     * Filter the query on the data_cadastro column
     *
     * Example usage:
     * <code>
     * $query->filterByDataCadastro('2011-03-14'); // WHERE data_cadastro = '2011-03-14'
     * $query->filterByDataCadastro('now'); // WHERE data_cadastro = '2011-03-14'
     * $query->filterByDataCadastro(array('max' => 'yesterday')); // WHERE data_cadastro > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataCadastro The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByDataCadastro($dataCadastro = null, $comparison = null)
    {
        if (is_array($dataCadastro)) {
            $useMinMax = false;
            if (isset($dataCadastro['min'])) {
                $this->addUsingAlias(SeguirTableMap::COL_DATA_CADASTRO, $dataCadastro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataCadastro['max'])) {
                $this->addUsingAlias(SeguirTableMap::COL_DATA_CADASTRO, $dataCadastro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SeguirTableMap::COL_DATA_CADASTRO, $dataCadastro, $comparison);
    }

    /**
     * Filter the query by a related \Model\Proposicao object
     *
     * @param \Model\Proposicao|ObjectCollection $proposicao The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByProposicao($proposicao, $comparison = null)
    {
        if ($proposicao instanceof \Model\Proposicao) {
            return $this
                ->addUsingAlias(SeguirTableMap::COL_ID_PROPOSICAO, $proposicao->getId(), $comparison);
        } elseif ($proposicao instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SeguirTableMap::COL_ID_PROPOSICAO, $proposicao->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSeguirQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Usuario object
     *
     * @param \Model\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSeguirQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Model\Usuario) {
            return $this
                ->addUsingAlias(SeguirTableMap::COL_ID_USUARIO, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SeguirTableMap::COL_ID_USUARIO, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \Model\Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\Model\UsuarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSeguir $seguir Object to remove from the list of results
     *
     * @return $this|ChildSeguirQuery The current query, for fluid interface
     */
    public function prune($seguir = null)
    {
        if ($seguir) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SeguirTableMap::COL_ID_PROPOSICAO), $seguir->getIdProposicao(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SeguirTableMap::COL_ID_USUARIO), $seguir->getIdUsuario(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePreDelete(ConnectionInterface $con)
    {
        // aggregate_column_relation_aggregate_seguir behavior
        $this->findRelatedProposicaoQteSeguidoress($con);

        return $this->preDelete($con);
    }

    /**
     * Code to execute after every DELETE statement
     *
     * @param     int $affectedRows the number of deleted rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostDelete($affectedRows, ConnectionInterface $con)
    {
        // aggregate_column_relation_aggregate_seguir behavior
        $this->updateRelatedProposicaoQteSeguidoress($con);

        return $this->postDelete($affectedRows, $con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param     array $values The associative array of columns and values for the update
     * @param     ConnectionInterface $con The connection object used by the query
     * @param     boolean $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false)
    {
        // aggregate_column_relation_aggregate_seguir behavior
        $this->findRelatedProposicaoQteSeguidoress($con);

        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Code to execute after every UPDATE statement
     *
     * @param     int $affectedRows the number of updated rows
     * @param     ConnectionInterface $con The connection object used by the query
     */
    protected function basePostUpdate($affectedRows, ConnectionInterface $con)
    {
        // aggregate_column_relation_aggregate_seguir behavior
        $this->updateRelatedProposicaoQteSeguidoress($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the seguir table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SeguirTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SeguirTableMap::clearInstancePool();
            SeguirTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SeguirTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SeguirTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SeguirTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SeguirTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // aggregate_column_relation_aggregate_seguir behavior

    /**
     * Finds the related Proposicao objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProposicaoQteSeguidoress($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->proposicaoQteSeguidoress = \Model\ProposicaoQuery::create()
            ->joinSeguir($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProposicaoQteSeguidoress($con)
    {
        foreach ($this->proposicaoQteSeguidoress as $proposicaoQteSeguidores) {
            $proposicaoQteSeguidores->updateQteSeguidores($con);
        }
        $this->proposicaoQteSeguidoress = array();
    }

} // SeguirQuery
