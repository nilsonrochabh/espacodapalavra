<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\IngredienteReceita as ChildIngredienteReceita;
use Model\IngredienteReceitaQuery as ChildIngredienteReceitaQuery;
use Model\Map\IngredienteReceitaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ingrediente_receita' table.
 *
 * 
 *
 * @method     ChildIngredienteReceitaQuery orderByIdIngrediente($order = Criteria::ASC) Order by the id_ingrediente column
 * @method     ChildIngredienteReceitaQuery orderByIdReceita($order = Criteria::ASC) Order by the id_receita column
 * @method     ChildIngredienteReceitaQuery orderByQuantidade($order = Criteria::ASC) Order by the quantidade column
 * @method     ChildIngredienteReceitaQuery orderByIdUnidade($order = Criteria::ASC) Order by the id_unidade column
 *
 * @method     ChildIngredienteReceitaQuery groupByIdIngrediente() Group by the id_ingrediente column
 * @method     ChildIngredienteReceitaQuery groupByIdReceita() Group by the id_receita column
 * @method     ChildIngredienteReceitaQuery groupByQuantidade() Group by the quantidade column
 * @method     ChildIngredienteReceitaQuery groupByIdUnidade() Group by the id_unidade column
 *
 * @method     ChildIngredienteReceitaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIngredienteReceitaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIngredienteReceitaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIngredienteReceitaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIngredienteReceitaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIngredienteReceitaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIngredienteReceitaQuery leftJoinIngrediente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingrediente relation
 * @method     ChildIngredienteReceitaQuery rightJoinIngrediente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingrediente relation
 * @method     ChildIngredienteReceitaQuery innerJoinIngrediente($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingrediente relation
 *
 * @method     ChildIngredienteReceitaQuery joinWithIngrediente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ingrediente relation
 *
 * @method     ChildIngredienteReceitaQuery leftJoinWithIngrediente() Adds a LEFT JOIN clause and with to the query using the Ingrediente relation
 * @method     ChildIngredienteReceitaQuery rightJoinWithIngrediente() Adds a RIGHT JOIN clause and with to the query using the Ingrediente relation
 * @method     ChildIngredienteReceitaQuery innerJoinWithIngrediente() Adds a INNER JOIN clause and with to the query using the Ingrediente relation
 *
 * @method     ChildIngredienteReceitaQuery leftJoinReceita($relationAlias = null) Adds a LEFT JOIN clause to the query using the Receita relation
 * @method     ChildIngredienteReceitaQuery rightJoinReceita($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Receita relation
 * @method     ChildIngredienteReceitaQuery innerJoinReceita($relationAlias = null) Adds a INNER JOIN clause to the query using the Receita relation
 *
 * @method     ChildIngredienteReceitaQuery joinWithReceita($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Receita relation
 *
 * @method     ChildIngredienteReceitaQuery leftJoinWithReceita() Adds a LEFT JOIN clause and with to the query using the Receita relation
 * @method     ChildIngredienteReceitaQuery rightJoinWithReceita() Adds a RIGHT JOIN clause and with to the query using the Receita relation
 * @method     ChildIngredienteReceitaQuery innerJoinWithReceita() Adds a INNER JOIN clause and with to the query using the Receita relation
 *
 * @method     ChildIngredienteReceitaQuery leftJoinUnidade($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unidade relation
 * @method     ChildIngredienteReceitaQuery rightJoinUnidade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unidade relation
 * @method     ChildIngredienteReceitaQuery innerJoinUnidade($relationAlias = null) Adds a INNER JOIN clause to the query using the Unidade relation
 *
 * @method     ChildIngredienteReceitaQuery joinWithUnidade($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unidade relation
 *
 * @method     ChildIngredienteReceitaQuery leftJoinWithUnidade() Adds a LEFT JOIN clause and with to the query using the Unidade relation
 * @method     ChildIngredienteReceitaQuery rightJoinWithUnidade() Adds a RIGHT JOIN clause and with to the query using the Unidade relation
 * @method     ChildIngredienteReceitaQuery innerJoinWithUnidade() Adds a INNER JOIN clause and with to the query using the Unidade relation
 *
 * @method     \Model\IngredienteQuery|\Model\ReceitaQuery|\Model\UnidadeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIngredienteReceita findOne(ConnectionInterface $con = null) Return the first ChildIngredienteReceita matching the query
 * @method     ChildIngredienteReceita findOneOrCreate(ConnectionInterface $con = null) Return the first ChildIngredienteReceita matching the query, or a new ChildIngredienteReceita object populated from the query conditions when no match is found
 *
 * @method     ChildIngredienteReceita findOneByIdIngrediente(int $id_ingrediente) Return the first ChildIngredienteReceita filtered by the id_ingrediente column
 * @method     ChildIngredienteReceita findOneByIdReceita(int $id_receita) Return the first ChildIngredienteReceita filtered by the id_receita column
 * @method     ChildIngredienteReceita findOneByQuantidade(string $quantidade) Return the first ChildIngredienteReceita filtered by the quantidade column
 * @method     ChildIngredienteReceita findOneByIdUnidade(int $id_unidade) Return the first ChildIngredienteReceita filtered by the id_unidade column *

 * @method     ChildIngredienteReceita requirePk($key, ConnectionInterface $con = null) Return the ChildIngredienteReceita by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredienteReceita requireOne(ConnectionInterface $con = null) Return the first ChildIngredienteReceita matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredienteReceita requireOneByIdIngrediente(int $id_ingrediente) Return the first ChildIngredienteReceita filtered by the id_ingrediente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredienteReceita requireOneByIdReceita(int $id_receita) Return the first ChildIngredienteReceita filtered by the id_receita column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredienteReceita requireOneByQuantidade(string $quantidade) Return the first ChildIngredienteReceita filtered by the quantidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIngredienteReceita requireOneByIdUnidade(int $id_unidade) Return the first ChildIngredienteReceita filtered by the id_unidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIngredienteReceita[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildIngredienteReceita objects based on current ModelCriteria
 * @method     ChildIngredienteReceita[]|ObjectCollection findByIdIngrediente(int $id_ingrediente) Return ChildIngredienteReceita objects filtered by the id_ingrediente column
 * @method     ChildIngredienteReceita[]|ObjectCollection findByIdReceita(int $id_receita) Return ChildIngredienteReceita objects filtered by the id_receita column
 * @method     ChildIngredienteReceita[]|ObjectCollection findByQuantidade(string $quantidade) Return ChildIngredienteReceita objects filtered by the quantidade column
 * @method     ChildIngredienteReceita[]|ObjectCollection findByIdUnidade(int $id_unidade) Return ChildIngredienteReceita objects filtered by the id_unidade column
 * @method     ChildIngredienteReceita[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class IngredienteReceitaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\IngredienteReceitaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\IngredienteReceita', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIngredienteReceitaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIngredienteReceitaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildIngredienteReceitaQuery) {
            return $criteria;
        }
        $query = new ChildIngredienteReceitaQuery();
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
     * @param array[$id_ingrediente, $id_receita] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildIngredienteReceita|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = IngredienteReceitaTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IngredienteReceitaTableMap::DATABASE_NAME);
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
     * @return ChildIngredienteReceita A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_ingrediente, id_receita, quantidade, id_unidade FROM ingrediente_receita WHERE id_ingrediente = :p0 AND id_receita = :p1';
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
            /** @var ChildIngredienteReceita $obj */
            $obj = new ChildIngredienteReceita();
            $obj->hydrate($row);
            IngredienteReceitaTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildIngredienteReceita|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_RECEITA, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(IngredienteReceitaTableMap::COL_ID_RECEITA, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id_ingrediente column
     *
     * Example usage:
     * <code>
     * $query->filterByIdIngrediente(1234); // WHERE id_ingrediente = 1234
     * $query->filterByIdIngrediente(array(12, 34)); // WHERE id_ingrediente IN (12, 34)
     * $query->filterByIdIngrediente(array('min' => 12)); // WHERE id_ingrediente > 12
     * </code>
     *
     * @see       filterByIngrediente()
     *
     * @param     mixed $idIngrediente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByIdIngrediente($idIngrediente = null, $comparison = null)
    {
        if (is_array($idIngrediente)) {
            $useMinMax = false;
            if (isset($idIngrediente['min'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $idIngrediente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idIngrediente['max'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $idIngrediente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $idIngrediente, $comparison);
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
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByIdReceita($idReceita = null, $comparison = null)
    {
        if (is_array($idReceita)) {
            $useMinMax = false;
            if (isset($idReceita['min'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_RECEITA, $idReceita['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idReceita['max'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_RECEITA, $idReceita['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_RECEITA, $idReceita, $comparison);
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
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByQuantidade($quantidade = null, $comparison = null)
    {
        if (is_array($quantidade)) {
            $useMinMax = false;
            if (isset($quantidade['min'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_QUANTIDADE, $quantidade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantidade['max'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_QUANTIDADE, $quantidade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredienteReceitaTableMap::COL_QUANTIDADE, $quantidade, $comparison);
    }

    /**
     * Filter the query on the id_unidade column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUnidade(1234); // WHERE id_unidade = 1234
     * $query->filterByIdUnidade(array(12, 34)); // WHERE id_unidade IN (12, 34)
     * $query->filterByIdUnidade(array('min' => 12)); // WHERE id_unidade > 12
     * </code>
     *
     * @see       filterByUnidade()
     *
     * @param     mixed $idUnidade The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByIdUnidade($idUnidade = null, $comparison = null)
    {
        if (is_array($idUnidade)) {
            $useMinMax = false;
            if (isset($idUnidade['min'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_UNIDADE, $idUnidade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUnidade['max'])) {
                $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_UNIDADE, $idUnidade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IngredienteReceitaTableMap::COL_ID_UNIDADE, $idUnidade, $comparison);
    }

    /**
     * Filter the query by a related \Model\Ingrediente object
     *
     * @param \Model\Ingrediente|ObjectCollection $ingrediente The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByIngrediente($ingrediente, $comparison = null)
    {
        if ($ingrediente instanceof \Model\Ingrediente) {
            return $this
                ->addUsingAlias(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $ingrediente->getId(), $comparison);
        } elseif ($ingrediente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $ingrediente->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByIngrediente() only accepts arguments of type \Model\Ingrediente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ingrediente relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function joinIngrediente($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ingrediente');

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
            $this->addJoinObject($join, 'Ingrediente');
        }

        return $this;
    }

    /**
     * Use the Ingrediente relation Ingrediente object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\IngredienteQuery A secondary query class using the current class as primary query
     */
    public function useIngredienteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIngrediente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ingrediente', '\Model\IngredienteQuery');
    }

    /**
     * Filter the query by a related \Model\Receita object
     *
     * @param \Model\Receita|ObjectCollection $receita The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByReceita($receita, $comparison = null)
    {
        if ($receita instanceof \Model\Receita) {
            return $this
                ->addUsingAlias(IngredienteReceitaTableMap::COL_ID_RECEITA, $receita->getId(), $comparison);
        } elseif ($receita instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredienteReceitaTableMap::COL_ID_RECEITA, $receita->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function joinReceita($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useReceitaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReceita($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Receita', '\Model\ReceitaQuery');
    }

    /**
     * Filter the query by a related \Model\Unidade object
     *
     * @param \Model\Unidade|ObjectCollection $unidade The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function filterByUnidade($unidade, $comparison = null)
    {
        if ($unidade instanceof \Model\Unidade) {
            return $this
                ->addUsingAlias(IngredienteReceitaTableMap::COL_ID_UNIDADE, $unidade->getId(), $comparison);
        } elseif ($unidade instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IngredienteReceitaTableMap::COL_ID_UNIDADE, $unidade->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUnidade() only accepts arguments of type \Model\Unidade or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unidade relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function joinUnidade($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unidade');

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
            $this->addJoinObject($join, 'Unidade');
        }

        return $this;
    }

    /**
     * Use the Unidade relation Unidade object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\UnidadeQuery A secondary query class using the current class as primary query
     */
    public function useUnidadeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnidade($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unidade', '\Model\UnidadeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildIngredienteReceita $ingredienteReceita Object to remove from the list of results
     *
     * @return $this|ChildIngredienteReceitaQuery The current query, for fluid interface
     */
    public function prune($ingredienteReceita = null)
    {
        if ($ingredienteReceita) {
            $this->addCond('pruneCond0', $this->getAliasedColName(IngredienteReceitaTableMap::COL_ID_INGREDIENTE), $ingredienteReceita->getIdIngrediente(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(IngredienteReceitaTableMap::COL_ID_RECEITA), $ingredienteReceita->getIdReceita(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ingrediente_receita table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredienteReceitaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IngredienteReceitaTableMap::clearInstancePool();
            IngredienteReceitaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IngredienteReceitaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IngredienteReceitaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            IngredienteReceitaTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            IngredienteReceitaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // IngredienteReceitaQuery
