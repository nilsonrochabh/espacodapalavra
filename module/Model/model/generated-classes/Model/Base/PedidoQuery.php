<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Pedido as ChildPedido;
use Model\PedidoQuery as ChildPedidoQuery;
use Model\Map\PedidoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pedido' table.
 *
 * 
 *
 * @method     ChildPedidoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPedidoQuery orderByCodigo($order = Criteria::ASC) Order by the codigo column
 * @method     ChildPedidoQuery orderByIdCliente($order = Criteria::ASC) Order by the id_cliente column
 * @method     ChildPedidoQuery orderByDataPedido($order = Criteria::ASC) Order by the data_pedido column
 * @method     ChildPedidoQuery orderByDataEntrega($order = Criteria::ASC) Order by the data_entrega column
 * @method     ChildPedidoQuery orderByValorCobrado($order = Criteria::ASC) Order by the valor_cobrado column
 * @method     ChildPedidoQuery orderByCusto($order = Criteria::ASC) Order by the custo column
 * @method     ChildPedidoQuery orderByLucro($order = Criteria::ASC) Order by the lucro column
 *
 * @method     ChildPedidoQuery groupById() Group by the id column
 * @method     ChildPedidoQuery groupByCodigo() Group by the codigo column
 * @method     ChildPedidoQuery groupByIdCliente() Group by the id_cliente column
 * @method     ChildPedidoQuery groupByDataPedido() Group by the data_pedido column
 * @method     ChildPedidoQuery groupByDataEntrega() Group by the data_entrega column
 * @method     ChildPedidoQuery groupByValorCobrado() Group by the valor_cobrado column
 * @method     ChildPedidoQuery groupByCusto() Group by the custo column
 * @method     ChildPedidoQuery groupByLucro() Group by the lucro column
 *
 * @method     ChildPedidoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPedidoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPedidoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPedidoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPedidoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPedidoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPedidoQuery leftJoinCliente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cliente relation
 * @method     ChildPedidoQuery rightJoinCliente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cliente relation
 * @method     ChildPedidoQuery innerJoinCliente($relationAlias = null) Adds a INNER JOIN clause to the query using the Cliente relation
 *
 * @method     ChildPedidoQuery joinWithCliente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cliente relation
 *
 * @method     ChildPedidoQuery leftJoinWithCliente() Adds a LEFT JOIN clause and with to the query using the Cliente relation
 * @method     ChildPedidoQuery rightJoinWithCliente() Adds a RIGHT JOIN clause and with to the query using the Cliente relation
 * @method     ChildPedidoQuery innerJoinWithCliente() Adds a INNER JOIN clause and with to the query using the Cliente relation
 *
 * @method     ChildPedidoQuery leftJoinProducao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producao relation
 * @method     ChildPedidoQuery rightJoinProducao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producao relation
 * @method     ChildPedidoQuery innerJoinProducao($relationAlias = null) Adds a INNER JOIN clause to the query using the Producao relation
 *
 * @method     ChildPedidoQuery joinWithProducao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Producao relation
 *
 * @method     ChildPedidoQuery leftJoinWithProducao() Adds a LEFT JOIN clause and with to the query using the Producao relation
 * @method     ChildPedidoQuery rightJoinWithProducao() Adds a RIGHT JOIN clause and with to the query using the Producao relation
 * @method     ChildPedidoQuery innerJoinWithProducao() Adds a INNER JOIN clause and with to the query using the Producao relation
 *
 * @method     \Model\ClienteQuery|\Model\ProducaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPedido findOne(ConnectionInterface $con = null) Return the first ChildPedido matching the query
 * @method     ChildPedido findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPedido matching the query, or a new ChildPedido object populated from the query conditions when no match is found
 *
 * @method     ChildPedido findOneById(int $id) Return the first ChildPedido filtered by the id column
 * @method     ChildPedido findOneByCodigo(string $codigo) Return the first ChildPedido filtered by the codigo column
 * @method     ChildPedido findOneByIdCliente(int $id_cliente) Return the first ChildPedido filtered by the id_cliente column
 * @method     ChildPedido findOneByDataPedido(string $data_pedido) Return the first ChildPedido filtered by the data_pedido column
 * @method     ChildPedido findOneByDataEntrega(string $data_entrega) Return the first ChildPedido filtered by the data_entrega column
 * @method     ChildPedido findOneByValorCobrado(string $valor_cobrado) Return the first ChildPedido filtered by the valor_cobrado column
 * @method     ChildPedido findOneByCusto(string $custo) Return the first ChildPedido filtered by the custo column
 * @method     ChildPedido findOneByLucro(string $lucro) Return the first ChildPedido filtered by the lucro column *

 * @method     ChildPedido requirePk($key, ConnectionInterface $con = null) Return the ChildPedido by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOne(ConnectionInterface $con = null) Return the first ChildPedido matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedido requireOneById(int $id) Return the first ChildPedido filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByCodigo(string $codigo) Return the first ChildPedido filtered by the codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByIdCliente(int $id_cliente) Return the first ChildPedido filtered by the id_cliente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByDataPedido(string $data_pedido) Return the first ChildPedido filtered by the data_pedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByDataEntrega(string $data_entrega) Return the first ChildPedido filtered by the data_entrega column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByValorCobrado(string $valor_cobrado) Return the first ChildPedido filtered by the valor_cobrado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByCusto(string $custo) Return the first ChildPedido filtered by the custo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByLucro(string $lucro) Return the first ChildPedido filtered by the lucro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedido[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPedido objects based on current ModelCriteria
 * @method     ChildPedido[]|ObjectCollection findById(int $id) Return ChildPedido objects filtered by the id column
 * @method     ChildPedido[]|ObjectCollection findByCodigo(string $codigo) Return ChildPedido objects filtered by the codigo column
 * @method     ChildPedido[]|ObjectCollection findByIdCliente(int $id_cliente) Return ChildPedido objects filtered by the id_cliente column
 * @method     ChildPedido[]|ObjectCollection findByDataPedido(string $data_pedido) Return ChildPedido objects filtered by the data_pedido column
 * @method     ChildPedido[]|ObjectCollection findByDataEntrega(string $data_entrega) Return ChildPedido objects filtered by the data_entrega column
 * @method     ChildPedido[]|ObjectCollection findByValorCobrado(string $valor_cobrado) Return ChildPedido objects filtered by the valor_cobrado column
 * @method     ChildPedido[]|ObjectCollection findByCusto(string $custo) Return ChildPedido objects filtered by the custo column
 * @method     ChildPedido[]|ObjectCollection findByLucro(string $lucro) Return ChildPedido objects filtered by the lucro column
 * @method     ChildPedido[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PedidoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\PedidoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Pedido', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPedidoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPedidoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPedidoQuery) {
            return $criteria;
        }
        $query = new ChildPedidoQuery();
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
     * @return ChildPedido|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PedidoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PedidoTableMap::DATABASE_NAME);
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
     * @return ChildPedido A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, codigo, id_cliente, data_pedido, data_entrega, valor_cobrado, custo, lucro FROM pedido WHERE id = :p0';
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
            /** @var ChildPedido $obj */
            $obj = new ChildPedido();
            $obj->hydrate($row);
            PedidoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildPedido|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PedidoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PedidoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the codigo column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigo('fooValue');   // WHERE codigo = 'fooValue'
     * $query->filterByCodigo('%fooValue%'); // WHERE codigo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $codigo)) {
                $codigo = str_replace('*', '%', $codigo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_CODIGO, $codigo, $comparison);
    }

    /**
     * Filter the query on the id_cliente column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCliente(1234); // WHERE id_cliente = 1234
     * $query->filterByIdCliente(array(12, 34)); // WHERE id_cliente IN (12, 34)
     * $query->filterByIdCliente(array('min' => 12)); // WHERE id_cliente > 12
     * </code>
     *
     * @see       filterByCliente()
     *
     * @param     mixed $idCliente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByIdCliente($idCliente = null, $comparison = null)
    {
        if (is_array($idCliente)) {
            $useMinMax = false;
            if (isset($idCliente['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_ID_CLIENTE, $idCliente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCliente['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_ID_CLIENTE, $idCliente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_ID_CLIENTE, $idCliente, $comparison);
    }

    /**
     * Filter the query on the data_pedido column
     *
     * Example usage:
     * <code>
     * $query->filterByDataPedido('2011-03-14'); // WHERE data_pedido = '2011-03-14'
     * $query->filterByDataPedido('now'); // WHERE data_pedido = '2011-03-14'
     * $query->filterByDataPedido(array('max' => 'yesterday')); // WHERE data_pedido > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataPedido The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByDataPedido($dataPedido = null, $comparison = null)
    {
        if (is_array($dataPedido)) {
            $useMinMax = false;
            if (isset($dataPedido['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_DATA_PEDIDO, $dataPedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataPedido['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_DATA_PEDIDO, $dataPedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_DATA_PEDIDO, $dataPedido, $comparison);
    }

    /**
     * Filter the query on the data_entrega column
     *
     * Example usage:
     * <code>
     * $query->filterByDataEntrega('2011-03-14'); // WHERE data_entrega = '2011-03-14'
     * $query->filterByDataEntrega('now'); // WHERE data_entrega = '2011-03-14'
     * $query->filterByDataEntrega(array('max' => 'yesterday')); // WHERE data_entrega > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataEntrega The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByDataEntrega($dataEntrega = null, $comparison = null)
    {
        if (is_array($dataEntrega)) {
            $useMinMax = false;
            if (isset($dataEntrega['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_DATA_ENTREGA, $dataEntrega['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataEntrega['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_DATA_ENTREGA, $dataEntrega['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_DATA_ENTREGA, $dataEntrega, $comparison);
    }

    /**
     * Filter the query on the valor_cobrado column
     *
     * Example usage:
     * <code>
     * $query->filterByValorCobrado(1234); // WHERE valor_cobrado = 1234
     * $query->filterByValorCobrado(array(12, 34)); // WHERE valor_cobrado IN (12, 34)
     * $query->filterByValorCobrado(array('min' => 12)); // WHERE valor_cobrado > 12
     * </code>
     *
     * @param     mixed $valorCobrado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByValorCobrado($valorCobrado = null, $comparison = null)
    {
        if (is_array($valorCobrado)) {
            $useMinMax = false;
            if (isset($valorCobrado['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_VALOR_COBRADO, $valorCobrado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valorCobrado['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_VALOR_COBRADO, $valorCobrado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_VALOR_COBRADO, $valorCobrado, $comparison);
    }

    /**
     * Filter the query on the custo column
     *
     * Example usage:
     * <code>
     * $query->filterByCusto(1234); // WHERE custo = 1234
     * $query->filterByCusto(array(12, 34)); // WHERE custo IN (12, 34)
     * $query->filterByCusto(array('min' => 12)); // WHERE custo > 12
     * </code>
     *
     * @param     mixed $custo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByCusto($custo = null, $comparison = null)
    {
        if (is_array($custo)) {
            $useMinMax = false;
            if (isset($custo['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_CUSTO, $custo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($custo['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_CUSTO, $custo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_CUSTO, $custo, $comparison);
    }

    /**
     * Filter the query on the lucro column
     *
     * Example usage:
     * <code>
     * $query->filterByLucro(1234); // WHERE lucro = 1234
     * $query->filterByLucro(array(12, 34)); // WHERE lucro IN (12, 34)
     * $query->filterByLucro(array('min' => 12)); // WHERE lucro > 12
     * </code>
     *
     * @param     mixed $lucro The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByLucro($lucro = null, $comparison = null)
    {
        if (is_array($lucro)) {
            $useMinMax = false;
            if (isset($lucro['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_LUCRO, $lucro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lucro['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_LUCRO, $lucro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoTableMap::COL_LUCRO, $lucro, $comparison);
    }

    /**
     * Filter the query by a related \Model\Cliente object
     *
     * @param \Model\Cliente|ObjectCollection $cliente The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByCliente($cliente, $comparison = null)
    {
        if ($cliente instanceof \Model\Cliente) {
            return $this
                ->addUsingAlias(PedidoTableMap::COL_ID_CLIENTE, $cliente->getId(), $comparison);
        } elseif ($cliente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidoTableMap::COL_ID_CLIENTE, $cliente->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCliente() only accepts arguments of type \Model\Cliente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cliente relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function joinCliente($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cliente');

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
            $this->addJoinObject($join, 'Cliente');
        }

        return $this;
    }

    /**
     * Use the Cliente relation Cliente object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ClienteQuery A secondary query class using the current class as primary query
     */
    public function useClienteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCliente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cliente', '\Model\ClienteQuery');
    }

    /**
     * Filter the query by a related \Model\Producao object
     *
     * @param \Model\Producao|ObjectCollection $producao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPedidoQuery The current query, for fluid interface
     */
    public function filterByProducao($producao, $comparison = null)
    {
        if ($producao instanceof \Model\Producao) {
            return $this
                ->addUsingAlias(PedidoTableMap::COL_ID, $producao->getIdPedido(), $comparison);
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
     * @return $this|ChildPedidoQuery The current query, for fluid interface
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
     * @param   ChildPedido $pedido Object to remove from the list of results
     *
     * @return $this|ChildPedidoQuery The current query, for fluid interface
     */
    public function prune($pedido = null)
    {
        if ($pedido) {
            $this->addUsingAlias(PedidoTableMap::COL_ID, $pedido->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pedido table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PedidoTableMap::clearInstancePool();
            PedidoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PedidoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            PedidoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            PedidoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PedidoQuery
