<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Produto as ChildProduto;
use Model\ProdutoQuery as ChildProdutoQuery;
use Model\Map\ProdutoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'produto' table.
 *
 * 
 *
 * @method     ChildProdutoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProdutoQuery orderByIdProdutoBase($order = Criteria::ASC) Order by the id_produto_base column
 * @method     ChildProdutoQuery orderByIdLocal($order = Criteria::ASC) Order by the id_local column
 * @method     ChildProdutoQuery orderByPreco($order = Criteria::ASC) Order by the preco column
 * @method     ChildProdutoQuery orderByDataCadastro($order = Criteria::ASC) Order by the data_cadastro column
 *
 * @method     ChildProdutoQuery groupById() Group by the id column
 * @method     ChildProdutoQuery groupByIdProdutoBase() Group by the id_produto_base column
 * @method     ChildProdutoQuery groupByIdLocal() Group by the id_local column
 * @method     ChildProdutoQuery groupByPreco() Group by the preco column
 * @method     ChildProdutoQuery groupByDataCadastro() Group by the data_cadastro column
 *
 * @method     ChildProdutoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProdutoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProdutoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProdutoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProdutoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProdutoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProdutoQuery leftJoinLocal($relationAlias = null) Adds a LEFT JOIN clause to the query using the Local relation
 * @method     ChildProdutoQuery rightJoinLocal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Local relation
 * @method     ChildProdutoQuery innerJoinLocal($relationAlias = null) Adds a INNER JOIN clause to the query using the Local relation
 *
 * @method     ChildProdutoQuery joinWithLocal($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Local relation
 *
 * @method     ChildProdutoQuery leftJoinWithLocal() Adds a LEFT JOIN clause and with to the query using the Local relation
 * @method     ChildProdutoQuery rightJoinWithLocal() Adds a RIGHT JOIN clause and with to the query using the Local relation
 * @method     ChildProdutoQuery innerJoinWithLocal() Adds a INNER JOIN clause and with to the query using the Local relation
 *
 * @method     ChildProdutoQuery leftJoinProdutoBase($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProdutoBase relation
 * @method     ChildProdutoQuery rightJoinProdutoBase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProdutoBase relation
 * @method     ChildProdutoQuery innerJoinProdutoBase($relationAlias = null) Adds a INNER JOIN clause to the query using the ProdutoBase relation
 *
 * @method     ChildProdutoQuery joinWithProdutoBase($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProdutoBase relation
 *
 * @method     ChildProdutoQuery leftJoinWithProdutoBase() Adds a LEFT JOIN clause and with to the query using the ProdutoBase relation
 * @method     ChildProdutoQuery rightJoinWithProdutoBase() Adds a RIGHT JOIN clause and with to the query using the ProdutoBase relation
 * @method     ChildProdutoQuery innerJoinWithProdutoBase() Adds a INNER JOIN clause and with to the query using the ProdutoBase relation
 *
 * @method     ChildProdutoQuery leftJoinConsumo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Consumo relation
 * @method     ChildProdutoQuery rightJoinConsumo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Consumo relation
 * @method     ChildProdutoQuery innerJoinConsumo($relationAlias = null) Adds a INNER JOIN clause to the query using the Consumo relation
 *
 * @method     ChildProdutoQuery joinWithConsumo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Consumo relation
 *
 * @method     ChildProdutoQuery leftJoinWithConsumo() Adds a LEFT JOIN clause and with to the query using the Consumo relation
 * @method     ChildProdutoQuery rightJoinWithConsumo() Adds a RIGHT JOIN clause and with to the query using the Consumo relation
 * @method     ChildProdutoQuery innerJoinWithConsumo() Adds a INNER JOIN clause and with to the query using the Consumo relation
 *
 * @method     \Model\LocalQuery|\Model\ProdutoBaseQuery|\Model\ConsumoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduto findOne(ConnectionInterface $con = null) Return the first ChildProduto matching the query
 * @method     ChildProduto findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduto matching the query, or a new ChildProduto object populated from the query conditions when no match is found
 *
 * @method     ChildProduto findOneById(int $id) Return the first ChildProduto filtered by the id column
 * @method     ChildProduto findOneByIdProdutoBase(int $id_produto_base) Return the first ChildProduto filtered by the id_produto_base column
 * @method     ChildProduto findOneByIdLocal(int $id_local) Return the first ChildProduto filtered by the id_local column
 * @method     ChildProduto findOneByPreco(string $preco) Return the first ChildProduto filtered by the preco column
 * @method     ChildProduto findOneByDataCadastro(string $data_cadastro) Return the first ChildProduto filtered by the data_cadastro column *

 * @method     ChildProduto requirePk($key, ConnectionInterface $con = null) Return the ChildProduto by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOne(ConnectionInterface $con = null) Return the first ChildProduto matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduto requireOneById(int $id) Return the first ChildProduto filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByIdProdutoBase(int $id_produto_base) Return the first ChildProduto filtered by the id_produto_base column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByIdLocal(int $id_local) Return the first ChildProduto filtered by the id_local column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByPreco(string $preco) Return the first ChildProduto filtered by the preco column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByDataCadastro(string $data_cadastro) Return the first ChildProduto filtered by the data_cadastro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduto[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduto objects based on current ModelCriteria
 * @method     ChildProduto[]|ObjectCollection findById(int $id) Return ChildProduto objects filtered by the id column
 * @method     ChildProduto[]|ObjectCollection findByIdProdutoBase(int $id_produto_base) Return ChildProduto objects filtered by the id_produto_base column
 * @method     ChildProduto[]|ObjectCollection findByIdLocal(int $id_local) Return ChildProduto objects filtered by the id_local column
 * @method     ChildProduto[]|ObjectCollection findByPreco(string $preco) Return ChildProduto objects filtered by the preco column
 * @method     ChildProduto[]|ObjectCollection findByDataCadastro(string $data_cadastro) Return ChildProduto objects filtered by the data_cadastro column
 * @method     ChildProduto[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProdutoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ProdutoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Produto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProdutoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProdutoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProdutoQuery) {
            return $criteria;
        }
        $query = new ChildProdutoQuery();
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
     * @return ChildProduto|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProdutoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProdutoTableMap::DATABASE_NAME);
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
     * @return ChildProduto A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_produto_base, id_local, preco, data_cadastro FROM produto WHERE id = :p0';
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
            /** @var ChildProduto $obj */
            $obj = new ChildProduto();
            $obj->hydrate($row);
            ProdutoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProduto|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProdutoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProdutoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_produto_base column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProdutoBase(1234); // WHERE id_produto_base = 1234
     * $query->filterByIdProdutoBase(array(12, 34)); // WHERE id_produto_base IN (12, 34)
     * $query->filterByIdProdutoBase(array('min' => 12)); // WHERE id_produto_base > 12
     * </code>
     *
     * @see       filterByProdutoBase()
     *
     * @param     mixed $idProdutoBase The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByIdProdutoBase($idProdutoBase = null, $comparison = null)
    {
        if (is_array($idProdutoBase)) {
            $useMinMax = false;
            if (isset($idProdutoBase['min'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID_PRODUTO_BASE, $idProdutoBase['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProdutoBase['max'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID_PRODUTO_BASE, $idProdutoBase['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_ID_PRODUTO_BASE, $idProdutoBase, $comparison);
    }

    /**
     * Filter the query on the id_local column
     *
     * Example usage:
     * <code>
     * $query->filterByIdLocal(1234); // WHERE id_local = 1234
     * $query->filterByIdLocal(array(12, 34)); // WHERE id_local IN (12, 34)
     * $query->filterByIdLocal(array('min' => 12)); // WHERE id_local > 12
     * </code>
     *
     * @see       filterByLocal()
     *
     * @param     mixed $idLocal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByIdLocal($idLocal = null, $comparison = null)
    {
        if (is_array($idLocal)) {
            $useMinMax = false;
            if (isset($idLocal['min'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID_LOCAL, $idLocal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocal['max'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID_LOCAL, $idLocal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_ID_LOCAL, $idLocal, $comparison);
    }

    /**
     * Filter the query on the preco column
     *
     * Example usage:
     * <code>
     * $query->filterByPreco(1234); // WHERE preco = 1234
     * $query->filterByPreco(array(12, 34)); // WHERE preco IN (12, 34)
     * $query->filterByPreco(array('min' => 12)); // WHERE preco > 12
     * </code>
     *
     * @param     mixed $preco The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByPreco($preco = null, $comparison = null)
    {
        if (is_array($preco)) {
            $useMinMax = false;
            if (isset($preco['min'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_PRECO, $preco['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($preco['max'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_PRECO, $preco['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_PRECO, $preco, $comparison);
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByDataCadastro($dataCadastro = null, $comparison = null)
    {
        if (is_array($dataCadastro)) {
            $useMinMax = false;
            if (isset($dataCadastro['min'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_DATA_CADASTRO, $dataCadastro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataCadastro['max'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_DATA_CADASTRO, $dataCadastro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_DATA_CADASTRO, $dataCadastro, $comparison);
    }

    /**
     * Filter the query by a related \Model\Local object
     *
     * @param \Model\Local|ObjectCollection $local The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByLocal($local, $comparison = null)
    {
        if ($local instanceof \Model\Local) {
            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID_LOCAL, $local->getId(), $comparison);
        } elseif ($local instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID_LOCAL, $local->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLocal() only accepts arguments of type \Model\Local or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Local relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function joinLocal($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Local');

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
            $this->addJoinObject($join, 'Local');
        }

        return $this;
    }

    /**
     * Use the Local relation Local object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\LocalQuery A secondary query class using the current class as primary query
     */
    public function useLocalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Local', '\Model\LocalQuery');
    }

    /**
     * Filter the query by a related \Model\ProdutoBase object
     *
     * @param \Model\ProdutoBase|ObjectCollection $produtoBase The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByProdutoBase($produtoBase, $comparison = null)
    {
        if ($produtoBase instanceof \Model\ProdutoBase) {
            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID_PRODUTO_BASE, $produtoBase->getId(), $comparison);
        } elseif ($produtoBase instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID_PRODUTO_BASE, $produtoBase->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Consumo object
     *
     * @param \Model\Consumo|ObjectCollection $consumo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByConsumo($consumo, $comparison = null)
    {
        if ($consumo instanceof \Model\Consumo) {
            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID, $consumo->getIdProduto(), $comparison);
        } elseif ($consumo instanceof ObjectCollection) {
            return $this
                ->useConsumoQuery()
                ->filterByPrimaryKeys($consumo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByConsumo() only accepts arguments of type \Model\Consumo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Consumo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function joinConsumo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Consumo');

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
            $this->addJoinObject($join, 'Consumo');
        }

        return $this;
    }

    /**
     * Use the Consumo relation Consumo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ConsumoQuery A secondary query class using the current class as primary query
     */
    public function useConsumoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConsumo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Consumo', '\Model\ConsumoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduto $produto Object to remove from the list of results
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function prune($produto = null)
    {
        if ($produto) {
            $this->addUsingAlias(ProdutoTableMap::COL_ID, $produto->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the produto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProdutoTableMap::clearInstancePool();
            ProdutoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProdutoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ProdutoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ProdutoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProdutoQuery
