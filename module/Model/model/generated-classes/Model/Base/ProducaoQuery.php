<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Producao as ChildProducao;
use Model\ProducaoQuery as ChildProducaoQuery;
use Model\Map\ProducaoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'producao' table.
 *
 * 
 *
 * @method     ChildProducaoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProducaoQuery orderByIdPedido($order = Criteria::ASC) Order by the id_pedido column
 * @method     ChildProducaoQuery orderByDescricao($order = Criteria::ASC) Order by the descricao column
 * @method     ChildProducaoQuery orderByIdTipoProducao($order = Criteria::ASC) Order by the id_tipo_producao column
 * @method     ChildProducaoQuery orderByQuantidadeProduzida($order = Criteria::ASC) Order by the quantidade_produzida column
 * @method     ChildProducaoQuery orderByDataProducao($order = Criteria::ASC) Order by the data_producao column
 *
 * @method     ChildProducaoQuery groupById() Group by the id column
 * @method     ChildProducaoQuery groupByIdPedido() Group by the id_pedido column
 * @method     ChildProducaoQuery groupByDescricao() Group by the descricao column
 * @method     ChildProducaoQuery groupByIdTipoProducao() Group by the id_tipo_producao column
 * @method     ChildProducaoQuery groupByQuantidadeProduzida() Group by the quantidade_produzida column
 * @method     ChildProducaoQuery groupByDataProducao() Group by the data_producao column
 *
 * @method     ChildProducaoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProducaoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProducaoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProducaoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProducaoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProducaoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProducaoQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method     ChildProducaoQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method     ChildProducaoQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method     ChildProducaoQuery joinWithPedido($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedido relation
 *
 * @method     ChildProducaoQuery leftJoinWithPedido() Adds a LEFT JOIN clause and with to the query using the Pedido relation
 * @method     ChildProducaoQuery rightJoinWithPedido() Adds a RIGHT JOIN clause and with to the query using the Pedido relation
 * @method     ChildProducaoQuery innerJoinWithPedido() Adds a INNER JOIN clause and with to the query using the Pedido relation
 *
 * @method     ChildProducaoQuery leftJoinTipoProducao($relationAlias = null) Adds a LEFT JOIN clause to the query using the TipoProducao relation
 * @method     ChildProducaoQuery rightJoinTipoProducao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TipoProducao relation
 * @method     ChildProducaoQuery innerJoinTipoProducao($relationAlias = null) Adds a INNER JOIN clause to the query using the TipoProducao relation
 *
 * @method     ChildProducaoQuery joinWithTipoProducao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TipoProducao relation
 *
 * @method     ChildProducaoQuery leftJoinWithTipoProducao() Adds a LEFT JOIN clause and with to the query using the TipoProducao relation
 * @method     ChildProducaoQuery rightJoinWithTipoProducao() Adds a RIGHT JOIN clause and with to the query using the TipoProducao relation
 * @method     ChildProducaoQuery innerJoinWithTipoProducao() Adds a INNER JOIN clause and with to the query using the TipoProducao relation
 *
 * @method     ChildProducaoQuery leftJoinConsumo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Consumo relation
 * @method     ChildProducaoQuery rightJoinConsumo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Consumo relation
 * @method     ChildProducaoQuery innerJoinConsumo($relationAlias = null) Adds a INNER JOIN clause to the query using the Consumo relation
 *
 * @method     ChildProducaoQuery joinWithConsumo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Consumo relation
 *
 * @method     ChildProducaoQuery leftJoinWithConsumo() Adds a LEFT JOIN clause and with to the query using the Consumo relation
 * @method     ChildProducaoQuery rightJoinWithConsumo() Adds a RIGHT JOIN clause and with to the query using the Consumo relation
 * @method     ChildProducaoQuery innerJoinWithConsumo() Adds a INNER JOIN clause and with to the query using the Consumo relation
 *
 * @method     \Model\PedidoQuery|\Model\TipoProducaoQuery|\Model\ConsumoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProducao findOne(ConnectionInterface $con = null) Return the first ChildProducao matching the query
 * @method     ChildProducao findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProducao matching the query, or a new ChildProducao object populated from the query conditions when no match is found
 *
 * @method     ChildProducao findOneById(int $id) Return the first ChildProducao filtered by the id column
 * @method     ChildProducao findOneByIdPedido(int $id_pedido) Return the first ChildProducao filtered by the id_pedido column
 * @method     ChildProducao findOneByDescricao(string $descricao) Return the first ChildProducao filtered by the descricao column
 * @method     ChildProducao findOneByIdTipoProducao(int $id_tipo_producao) Return the first ChildProducao filtered by the id_tipo_producao column
 * @method     ChildProducao findOneByQuantidadeProduzida(string $quantidade_produzida) Return the first ChildProducao filtered by the quantidade_produzida column
 * @method     ChildProducao findOneByDataProducao(string $data_producao) Return the first ChildProducao filtered by the data_producao column *

 * @method     ChildProducao requirePk($key, ConnectionInterface $con = null) Return the ChildProducao by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducao requireOne(ConnectionInterface $con = null) Return the first ChildProducao matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducao requireOneById(int $id) Return the first ChildProducao filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducao requireOneByIdPedido(int $id_pedido) Return the first ChildProducao filtered by the id_pedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducao requireOneByDescricao(string $descricao) Return the first ChildProducao filtered by the descricao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducao requireOneByIdTipoProducao(int $id_tipo_producao) Return the first ChildProducao filtered by the id_tipo_producao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducao requireOneByQuantidadeProduzida(string $quantidade_produzida) Return the first ChildProducao filtered by the quantidade_produzida column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducao requireOneByDataProducao(string $data_producao) Return the first ChildProducao filtered by the data_producao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducao[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProducao objects based on current ModelCriteria
 * @method     ChildProducao[]|ObjectCollection findById(int $id) Return ChildProducao objects filtered by the id column
 * @method     ChildProducao[]|ObjectCollection findByIdPedido(int $id_pedido) Return ChildProducao objects filtered by the id_pedido column
 * @method     ChildProducao[]|ObjectCollection findByDescricao(string $descricao) Return ChildProducao objects filtered by the descricao column
 * @method     ChildProducao[]|ObjectCollection findByIdTipoProducao(int $id_tipo_producao) Return ChildProducao objects filtered by the id_tipo_producao column
 * @method     ChildProducao[]|ObjectCollection findByQuantidadeProduzida(string $quantidade_produzida) Return ChildProducao objects filtered by the quantidade_produzida column
 * @method     ChildProducao[]|ObjectCollection findByDataProducao(string $data_producao) Return ChildProducao objects filtered by the data_producao column
 * @method     ChildProducao[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProducaoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ProducaoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Producao', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProducaoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProducaoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProducaoQuery) {
            return $criteria;
        }
        $query = new ChildProducaoQuery();
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
     * @return ChildProducao|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProducaoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProducaoTableMap::DATABASE_NAME);
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
     * @return ChildProducao A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_pedido, descricao, id_tipo_producao, quantidade_produzida, data_producao FROM producao WHERE id = :p0';
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
            /** @var ChildProducao $obj */
            $obj = new ChildProducao();
            $obj->hydrate($row);
            ProducaoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProducao|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProducaoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProducaoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProducaoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_pedido column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPedido(1234); // WHERE id_pedido = 1234
     * $query->filterByIdPedido(array(12, 34)); // WHERE id_pedido IN (12, 34)
     * $query->filterByIdPedido(array('min' => 12)); // WHERE id_pedido > 12
     * </code>
     *
     * @see       filterByPedido()
     *
     * @param     mixed $idPedido The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByIdPedido($idPedido = null, $comparison = null)
    {
        if (is_array($idPedido)) {
            $useMinMax = false;
            if (isset($idPedido['min'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_ID_PEDIDO, $idPedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPedido['max'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_ID_PEDIDO, $idPedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProducaoTableMap::COL_ID_PEDIDO, $idPedido, $comparison);
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
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByDescricao($descricao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descricao)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descricao)) {
                $descricao = str_replace('*', '%', $descricao);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProducaoTableMap::COL_DESCRICAO, $descricao, $comparison);
    }

    /**
     * Filter the query on the id_tipo_producao column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTipoProducao(1234); // WHERE id_tipo_producao = 1234
     * $query->filterByIdTipoProducao(array(12, 34)); // WHERE id_tipo_producao IN (12, 34)
     * $query->filterByIdTipoProducao(array('min' => 12)); // WHERE id_tipo_producao > 12
     * </code>
     *
     * @see       filterByTipoProducao()
     *
     * @param     mixed $idTipoProducao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByIdTipoProducao($idTipoProducao = null, $comparison = null)
    {
        if (is_array($idTipoProducao)) {
            $useMinMax = false;
            if (isset($idTipoProducao['min'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_ID_TIPO_PRODUCAO, $idTipoProducao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTipoProducao['max'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_ID_TIPO_PRODUCAO, $idTipoProducao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProducaoTableMap::COL_ID_TIPO_PRODUCAO, $idTipoProducao, $comparison);
    }

    /**
     * Filter the query on the quantidade_produzida column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantidadeProduzida(1234); // WHERE quantidade_produzida = 1234
     * $query->filterByQuantidadeProduzida(array(12, 34)); // WHERE quantidade_produzida IN (12, 34)
     * $query->filterByQuantidadeProduzida(array('min' => 12)); // WHERE quantidade_produzida > 12
     * </code>
     *
     * @param     mixed $quantidadeProduzida The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByQuantidadeProduzida($quantidadeProduzida = null, $comparison = null)
    {
        if (is_array($quantidadeProduzida)) {
            $useMinMax = false;
            if (isset($quantidadeProduzida['min'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_QUANTIDADE_PRODUZIDA, $quantidadeProduzida['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantidadeProduzida['max'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_QUANTIDADE_PRODUZIDA, $quantidadeProduzida['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProducaoTableMap::COL_QUANTIDADE_PRODUZIDA, $quantidadeProduzida, $comparison);
    }

    /**
     * Filter the query on the data_producao column
     *
     * Example usage:
     * <code>
     * $query->filterByDataProducao('2011-03-14'); // WHERE data_producao = '2011-03-14'
     * $query->filterByDataProducao('now'); // WHERE data_producao = '2011-03-14'
     * $query->filterByDataProducao(array('max' => 'yesterday')); // WHERE data_producao > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataProducao The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByDataProducao($dataProducao = null, $comparison = null)
    {
        if (is_array($dataProducao)) {
            $useMinMax = false;
            if (isset($dataProducao['min'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_DATA_PRODUCAO, $dataProducao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataProducao['max'])) {
                $this->addUsingAlias(ProducaoTableMap::COL_DATA_PRODUCAO, $dataProducao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProducaoTableMap::COL_DATA_PRODUCAO, $dataProducao, $comparison);
    }

    /**
     * Filter the query by a related \Model\Pedido object
     *
     * @param \Model\Pedido|ObjectCollection $pedido The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByPedido($pedido, $comparison = null)
    {
        if ($pedido instanceof \Model\Pedido) {
            return $this
                ->addUsingAlias(ProducaoTableMap::COL_ID_PEDIDO, $pedido->getId(), $comparison);
        } elseif ($pedido instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProducaoTableMap::COL_ID_PEDIDO, $pedido->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPedido() only accepts arguments of type \Model\Pedido or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pedido relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function joinPedido($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pedido');

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
            $this->addJoinObject($join, 'Pedido');
        }

        return $this;
    }

    /**
     * Use the Pedido relation Pedido object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\PedidoQuery A secondary query class using the current class as primary query
     */
    public function usePedidoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPedido($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pedido', '\Model\PedidoQuery');
    }

    /**
     * Filter the query by a related \Model\TipoProducao object
     *
     * @param \Model\TipoProducao|ObjectCollection $tipoProducao The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByTipoProducao($tipoProducao, $comparison = null)
    {
        if ($tipoProducao instanceof \Model\TipoProducao) {
            return $this
                ->addUsingAlias(ProducaoTableMap::COL_ID_TIPO_PRODUCAO, $tipoProducao->getId(), $comparison);
        } elseif ($tipoProducao instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProducaoTableMap::COL_ID_TIPO_PRODUCAO, $tipoProducao->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function joinTipoProducao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTipoProducaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTipoProducao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TipoProducao', '\Model\TipoProducaoQuery');
    }

    /**
     * Filter the query by a related \Model\Consumo object
     *
     * @param \Model\Consumo|ObjectCollection $consumo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProducaoQuery The current query, for fluid interface
     */
    public function filterByConsumo($consumo, $comparison = null)
    {
        if ($consumo instanceof \Model\Consumo) {
            return $this
                ->addUsingAlias(ProducaoTableMap::COL_ID, $consumo->getIdProducao(), $comparison);
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
     * @return $this|ChildProducaoQuery The current query, for fluid interface
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
     * @param   ChildProducao $producao Object to remove from the list of results
     *
     * @return $this|ChildProducaoQuery The current query, for fluid interface
     */
    public function prune($producao = null)
    {
        if ($producao) {
            $this->addUsingAlias(ProducaoTableMap::COL_ID, $producao->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the producao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProducaoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProducaoTableMap::clearInstancePool();
            ProducaoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProducaoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProducaoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ProducaoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ProducaoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProducaoQuery
