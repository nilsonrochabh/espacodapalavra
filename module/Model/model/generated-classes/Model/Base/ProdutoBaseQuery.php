<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\ProdutoBase as ChildProdutoBase;
use Model\ProdutoBaseQuery as ChildProdutoBaseQuery;
use Model\Map\ProdutoBaseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'produto_base' table.
 *
 * 
 *
 * @method     ChildProdutoBaseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProdutoBaseQuery orderByIdIngrediente($order = Criteria::ASC) Order by the id_ingrediente column
 * @method     ChildProdutoBaseQuery orderByIdMarca($order = Criteria::ASC) Order by the id_marca column
 * @method     ChildProdutoBaseQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildProdutoBaseQuery orderByQuantidade($order = Criteria::ASC) Order by the quantidade column
 * @method     ChildProdutoBaseQuery orderByIdUnidade($order = Criteria::ASC) Order by the id_unidade column
 *
 * @method     ChildProdutoBaseQuery groupById() Group by the id column
 * @method     ChildProdutoBaseQuery groupByIdIngrediente() Group by the id_ingrediente column
 * @method     ChildProdutoBaseQuery groupByIdMarca() Group by the id_marca column
 * @method     ChildProdutoBaseQuery groupByNome() Group by the nome column
 * @method     ChildProdutoBaseQuery groupByQuantidade() Group by the quantidade column
 * @method     ChildProdutoBaseQuery groupByIdUnidade() Group by the id_unidade column
 *
 * @method     ChildProdutoBaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProdutoBaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProdutoBaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProdutoBaseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProdutoBaseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProdutoBaseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProdutoBaseQuery leftJoinIngrediente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ingrediente relation
 * @method     ChildProdutoBaseQuery rightJoinIngrediente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ingrediente relation
 * @method     ChildProdutoBaseQuery innerJoinIngrediente($relationAlias = null) Adds a INNER JOIN clause to the query using the Ingrediente relation
 *
 * @method     ChildProdutoBaseQuery joinWithIngrediente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ingrediente relation
 *
 * @method     ChildProdutoBaseQuery leftJoinWithIngrediente() Adds a LEFT JOIN clause and with to the query using the Ingrediente relation
 * @method     ChildProdutoBaseQuery rightJoinWithIngrediente() Adds a RIGHT JOIN clause and with to the query using the Ingrediente relation
 * @method     ChildProdutoBaseQuery innerJoinWithIngrediente() Adds a INNER JOIN clause and with to the query using the Ingrediente relation
 *
 * @method     ChildProdutoBaseQuery leftJoinMarca($relationAlias = null) Adds a LEFT JOIN clause to the query using the Marca relation
 * @method     ChildProdutoBaseQuery rightJoinMarca($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Marca relation
 * @method     ChildProdutoBaseQuery innerJoinMarca($relationAlias = null) Adds a INNER JOIN clause to the query using the Marca relation
 *
 * @method     ChildProdutoBaseQuery joinWithMarca($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Marca relation
 *
 * @method     ChildProdutoBaseQuery leftJoinWithMarca() Adds a LEFT JOIN clause and with to the query using the Marca relation
 * @method     ChildProdutoBaseQuery rightJoinWithMarca() Adds a RIGHT JOIN clause and with to the query using the Marca relation
 * @method     ChildProdutoBaseQuery innerJoinWithMarca() Adds a INNER JOIN clause and with to the query using the Marca relation
 *
 * @method     ChildProdutoBaseQuery leftJoinUnidade($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unidade relation
 * @method     ChildProdutoBaseQuery rightJoinUnidade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unidade relation
 * @method     ChildProdutoBaseQuery innerJoinUnidade($relationAlias = null) Adds a INNER JOIN clause to the query using the Unidade relation
 *
 * @method     ChildProdutoBaseQuery joinWithUnidade($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unidade relation
 *
 * @method     ChildProdutoBaseQuery leftJoinWithUnidade() Adds a LEFT JOIN clause and with to the query using the Unidade relation
 * @method     ChildProdutoBaseQuery rightJoinWithUnidade() Adds a RIGHT JOIN clause and with to the query using the Unidade relation
 * @method     ChildProdutoBaseQuery innerJoinWithUnidade() Adds a INNER JOIN clause and with to the query using the Unidade relation
 *
 * @method     ChildProdutoBaseQuery leftJoinProduto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Produto relation
 * @method     ChildProdutoBaseQuery rightJoinProduto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Produto relation
 * @method     ChildProdutoBaseQuery innerJoinProduto($relationAlias = null) Adds a INNER JOIN clause to the query using the Produto relation
 *
 * @method     ChildProdutoBaseQuery joinWithProduto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Produto relation
 *
 * @method     ChildProdutoBaseQuery leftJoinWithProduto() Adds a LEFT JOIN clause and with to the query using the Produto relation
 * @method     ChildProdutoBaseQuery rightJoinWithProduto() Adds a RIGHT JOIN clause and with to the query using the Produto relation
 * @method     ChildProdutoBaseQuery innerJoinWithProduto() Adds a INNER JOIN clause and with to the query using the Produto relation
 *
 * @method     \Model\IngredienteQuery|\Model\MarcaQuery|\Model\UnidadeQuery|\Model\ProdutoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProdutoBase findOne(ConnectionInterface $con = null) Return the first ChildProdutoBase matching the query
 * @method     ChildProdutoBase findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProdutoBase matching the query, or a new ChildProdutoBase object populated from the query conditions when no match is found
 *
 * @method     ChildProdutoBase findOneById(int $id) Return the first ChildProdutoBase filtered by the id column
 * @method     ChildProdutoBase findOneByIdIngrediente(int $id_ingrediente) Return the first ChildProdutoBase filtered by the id_ingrediente column
 * @method     ChildProdutoBase findOneByIdMarca(int $id_marca) Return the first ChildProdutoBase filtered by the id_marca column
 * @method     ChildProdutoBase findOneByNome(string $nome) Return the first ChildProdutoBase filtered by the nome column
 * @method     ChildProdutoBase findOneByQuantidade(string $quantidade) Return the first ChildProdutoBase filtered by the quantidade column
 * @method     ChildProdutoBase findOneByIdUnidade(int $id_unidade) Return the first ChildProdutoBase filtered by the id_unidade column *

 * @method     ChildProdutoBase requirePk($key, ConnectionInterface $con = null) Return the ChildProdutoBase by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProdutoBase requireOne(ConnectionInterface $con = null) Return the first ChildProdutoBase matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProdutoBase requireOneById(int $id) Return the first ChildProdutoBase filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProdutoBase requireOneByIdIngrediente(int $id_ingrediente) Return the first ChildProdutoBase filtered by the id_ingrediente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProdutoBase requireOneByIdMarca(int $id_marca) Return the first ChildProdutoBase filtered by the id_marca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProdutoBase requireOneByNome(string $nome) Return the first ChildProdutoBase filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProdutoBase requireOneByQuantidade(string $quantidade) Return the first ChildProdutoBase filtered by the quantidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProdutoBase requireOneByIdUnidade(int $id_unidade) Return the first ChildProdutoBase filtered by the id_unidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProdutoBase[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProdutoBase objects based on current ModelCriteria
 * @method     ChildProdutoBase[]|ObjectCollection findById(int $id) Return ChildProdutoBase objects filtered by the id column
 * @method     ChildProdutoBase[]|ObjectCollection findByIdIngrediente(int $id_ingrediente) Return ChildProdutoBase objects filtered by the id_ingrediente column
 * @method     ChildProdutoBase[]|ObjectCollection findByIdMarca(int $id_marca) Return ChildProdutoBase objects filtered by the id_marca column
 * @method     ChildProdutoBase[]|ObjectCollection findByNome(string $nome) Return ChildProdutoBase objects filtered by the nome column
 * @method     ChildProdutoBase[]|ObjectCollection findByQuantidade(string $quantidade) Return ChildProdutoBase objects filtered by the quantidade column
 * @method     ChildProdutoBase[]|ObjectCollection findByIdUnidade(int $id_unidade) Return ChildProdutoBase objects filtered by the id_unidade column
 * @method     ChildProdutoBase[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProdutoBaseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ProdutoBaseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\ProdutoBase', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProdutoBaseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProdutoBaseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProdutoBaseQuery) {
            return $criteria;
        }
        $query = new ChildProdutoBaseQuery();
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
     * @return ChildProdutoBase|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProdutoBaseTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProdutoBaseTableMap::DATABASE_NAME);
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
     * @return ChildProdutoBase A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_ingrediente, id_marca, nome, quantidade, id_unidade FROM produto_base WHERE id = :p0';
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
            /** @var ChildProdutoBase $obj */
            $obj = new ChildProdutoBase();
            $obj->hydrate($row);
            ProdutoBaseTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProdutoBase|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByIdIngrediente($idIngrediente = null, $comparison = null)
    {
        if (is_array($idIngrediente)) {
            $useMinMax = false;
            if (isset($idIngrediente['min'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_INGREDIENTE, $idIngrediente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idIngrediente['max'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_INGREDIENTE, $idIngrediente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_INGREDIENTE, $idIngrediente, $comparison);
    }

    /**
     * Filter the query on the id_marca column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMarca(1234); // WHERE id_marca = 1234
     * $query->filterByIdMarca(array(12, 34)); // WHERE id_marca IN (12, 34)
     * $query->filterByIdMarca(array('min' => 12)); // WHERE id_marca > 12
     * </code>
     *
     * @see       filterByMarca()
     *
     * @param     mixed $idMarca The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByIdMarca($idMarca = null, $comparison = null)
    {
        if (is_array($idMarca)) {
            $useMinMax = false;
            if (isset($idMarca['min'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_MARCA, $idMarca['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMarca['max'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_MARCA, $idMarca['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_MARCA, $idMarca, $comparison);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_NOME, $nome, $comparison);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByQuantidade($quantidade = null, $comparison = null)
    {
        if (is_array($quantidade)) {
            $useMinMax = false;
            if (isset($quantidade['min'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_QUANTIDADE, $quantidade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantidade['max'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_QUANTIDADE, $quantidade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_QUANTIDADE, $quantidade, $comparison);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByIdUnidade($idUnidade = null, $comparison = null)
    {
        if (is_array($idUnidade)) {
            $useMinMax = false;
            if (isset($idUnidade['min'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_UNIDADE, $idUnidade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUnidade['max'])) {
                $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_UNIDADE, $idUnidade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoBaseTableMap::COL_ID_UNIDADE, $idUnidade, $comparison);
    }

    /**
     * Filter the query by a related \Model\Ingrediente object
     *
     * @param \Model\Ingrediente|ObjectCollection $ingrediente The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByIngrediente($ingrediente, $comparison = null)
    {
        if ($ingrediente instanceof \Model\Ingrediente) {
            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID_INGREDIENTE, $ingrediente->getId(), $comparison);
        } elseif ($ingrediente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID_INGREDIENTE, $ingrediente->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Marca object
     *
     * @param \Model\Marca|ObjectCollection $marca The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByMarca($marca, $comparison = null)
    {
        if ($marca instanceof \Model\Marca) {
            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID_MARCA, $marca->getId(), $comparison);
        } elseif ($marca instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID_MARCA, $marca->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMarca() only accepts arguments of type \Model\Marca or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Marca relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function joinMarca($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Marca');

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
            $this->addJoinObject($join, 'Marca');
        }

        return $this;
    }

    /**
     * Use the Marca relation Marca object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\MarcaQuery A secondary query class using the current class as primary query
     */
    public function useMarcaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMarca($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Marca', '\Model\MarcaQuery');
    }

    /**
     * Filter the query by a related \Model\Unidade object
     *
     * @param \Model\Unidade|ObjectCollection $unidade The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByUnidade($unidade, $comparison = null)
    {
        if ($unidade instanceof \Model\Unidade) {
            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID_UNIDADE, $unidade->getId(), $comparison);
        } elseif ($unidade instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID_UNIDADE, $unidade->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Produto object
     *
     * @param \Model\Produto|ObjectCollection $produto the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function filterByProduto($produto, $comparison = null)
    {
        if ($produto instanceof \Model\Produto) {
            return $this
                ->addUsingAlias(ProdutoBaseTableMap::COL_ID, $produto->getIdProdutoBase(), $comparison);
        } elseif ($produto instanceof ObjectCollection) {
            return $this
                ->useProdutoQuery()
                ->filterByPrimaryKeys($produto->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
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
     * @param   ChildProdutoBase $produtoBase Object to remove from the list of results
     *
     * @return $this|ChildProdutoBaseQuery The current query, for fluid interface
     */
    public function prune($produtoBase = null)
    {
        if ($produtoBase) {
            $this->addUsingAlias(ProdutoBaseTableMap::COL_ID, $produtoBase->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the produto_base table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoBaseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProdutoBaseTableMap::clearInstancePool();
            ProdutoBaseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoBaseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProdutoBaseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ProdutoBaseTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ProdutoBaseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProdutoBaseQuery
