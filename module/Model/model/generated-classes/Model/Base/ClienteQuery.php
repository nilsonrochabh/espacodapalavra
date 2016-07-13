<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Cliente as ChildCliente;
use Model\ClienteQuery as ChildClienteQuery;
use Model\Map\ClienteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'cliente' table.
 *
 * 
 *
 * @method     ChildClienteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildClienteQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildClienteQuery orderByEndereco($order = Criteria::ASC) Order by the endereco column
 * @method     ChildClienteQuery orderByTelefone($order = Criteria::ASC) Order by the telefone column
 * @method     ChildClienteQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildClienteQuery orderByDataCadastro($order = Criteria::ASC) Order by the data_cadastro column
 *
 * @method     ChildClienteQuery groupById() Group by the id column
 * @method     ChildClienteQuery groupByNome() Group by the nome column
 * @method     ChildClienteQuery groupByEndereco() Group by the endereco column
 * @method     ChildClienteQuery groupByTelefone() Group by the telefone column
 * @method     ChildClienteQuery groupByEmail() Group by the email column
 * @method     ChildClienteQuery groupByDataCadastro() Group by the data_cadastro column
 *
 * @method     ChildClienteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClienteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClienteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClienteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClienteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClienteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClienteQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method     ChildClienteQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method     ChildClienteQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method     ChildClienteQuery joinWithPedido($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedido relation
 *
 * @method     ChildClienteQuery leftJoinWithPedido() Adds a LEFT JOIN clause and with to the query using the Pedido relation
 * @method     ChildClienteQuery rightJoinWithPedido() Adds a RIGHT JOIN clause and with to the query using the Pedido relation
 * @method     ChildClienteQuery innerJoinWithPedido() Adds a INNER JOIN clause and with to the query using the Pedido relation
 *
 * @method     \Model\PedidoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCliente findOne(ConnectionInterface $con = null) Return the first ChildCliente matching the query
 * @method     ChildCliente findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCliente matching the query, or a new ChildCliente object populated from the query conditions when no match is found
 *
 * @method     ChildCliente findOneById(int $id) Return the first ChildCliente filtered by the id column
 * @method     ChildCliente findOneByNome(string $nome) Return the first ChildCliente filtered by the nome column
 * @method     ChildCliente findOneByEndereco(string $endereco) Return the first ChildCliente filtered by the endereco column
 * @method     ChildCliente findOneByTelefone(string $telefone) Return the first ChildCliente filtered by the telefone column
 * @method     ChildCliente findOneByEmail(string $email) Return the first ChildCliente filtered by the email column
 * @method     ChildCliente findOneByDataCadastro(string $data_cadastro) Return the first ChildCliente filtered by the data_cadastro column *

 * @method     ChildCliente requirePk($key, ConnectionInterface $con = null) Return the ChildCliente by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOne(ConnectionInterface $con = null) Return the first ChildCliente matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCliente requireOneById(int $id) Return the first ChildCliente filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByNome(string $nome) Return the first ChildCliente filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByEndereco(string $endereco) Return the first ChildCliente filtered by the endereco column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByTelefone(string $telefone) Return the first ChildCliente filtered by the telefone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByEmail(string $email) Return the first ChildCliente filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByDataCadastro(string $data_cadastro) Return the first ChildCliente filtered by the data_cadastro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCliente[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCliente objects based on current ModelCriteria
 * @method     ChildCliente[]|ObjectCollection findById(int $id) Return ChildCliente objects filtered by the id column
 * @method     ChildCliente[]|ObjectCollection findByNome(string $nome) Return ChildCliente objects filtered by the nome column
 * @method     ChildCliente[]|ObjectCollection findByEndereco(string $endereco) Return ChildCliente objects filtered by the endereco column
 * @method     ChildCliente[]|ObjectCollection findByTelefone(string $telefone) Return ChildCliente objects filtered by the telefone column
 * @method     ChildCliente[]|ObjectCollection findByEmail(string $email) Return ChildCliente objects filtered by the email column
 * @method     ChildCliente[]|ObjectCollection findByDataCadastro(string $data_cadastro) Return ChildCliente objects filtered by the data_cadastro column
 * @method     ChildCliente[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ClienteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ClienteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Cliente', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClienteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClienteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildClienteQuery) {
            return $criteria;
        }
        $query = new ChildClienteQuery();
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
     * @return ChildCliente|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ClienteTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClienteTableMap::DATABASE_NAME);
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
     * @return ChildCliente A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, endereco, telefone, email, data_cadastro FROM cliente WHERE id = :p0';
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
            /** @var ChildCliente $obj */
            $obj = new ChildCliente();
            $obj->hydrate($row);
            ClienteTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCliente|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClienteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClienteTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ClienteTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the endereco column
     *
     * Example usage:
     * <code>
     * $query->filterByEndereco('fooValue');   // WHERE endereco = 'fooValue'
     * $query->filterByEndereco('%fooValue%'); // WHERE endereco LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endereco The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByEndereco($endereco = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endereco)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endereco)) {
                $endereco = str_replace('*', '%', $endereco);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_ENDERECO, $endereco, $comparison);
    }

    /**
     * Filter the query on the telefone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefone('fooValue');   // WHERE telefone = 'fooValue'
     * $query->filterByTelefone('%fooValue%'); // WHERE telefone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByTelefone($telefone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefone)) {
                $telefone = str_replace('*', '%', $telefone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_TELEFONE, $telefone, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByDataCadastro($dataCadastro = null, $comparison = null)
    {
        if (is_array($dataCadastro)) {
            $useMinMax = false;
            if (isset($dataCadastro['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_DATA_CADASTRO, $dataCadastro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataCadastro['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_DATA_CADASTRO, $dataCadastro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_DATA_CADASTRO, $dataCadastro, $comparison);
    }

    /**
     * Filter the query by a related \Model\Pedido object
     *
     * @param \Model\Pedido|ObjectCollection $pedido the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClienteQuery The current query, for fluid interface
     */
    public function filterByPedido($pedido, $comparison = null)
    {
        if ($pedido instanceof \Model\Pedido) {
            return $this
                ->addUsingAlias(ClienteTableMap::COL_ID, $pedido->getIdCliente(), $comparison);
        } elseif ($pedido instanceof ObjectCollection) {
            return $this
                ->usePedidoQuery()
                ->filterByPrimaryKeys($pedido->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildCliente $cliente Object to remove from the list of results
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function prune($cliente = null)
    {
        if ($cliente) {
            $this->addUsingAlias(ClienteTableMap::COL_ID, $cliente->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cliente table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClienteTableMap::clearInstancePool();
            ClienteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClienteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ClienteTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ClienteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ClienteQuery
