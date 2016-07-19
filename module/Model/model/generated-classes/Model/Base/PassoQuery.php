<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Passo as ChildPasso;
use Model\PassoQuery as ChildPassoQuery;
use Model\Map\PassoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'passo' table.
 *
 *
 *
 * @method     ChildPassoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPassoQuery orderByIdProposicao($order = Criteria::ASC) Order by the id_proposicao column
 * @method     ChildPassoQuery orderByPosicao($order = Criteria::ASC) Order by the posicao column
 * @method     ChildPassoQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildPassoQuery orderByLocal($order = Criteria::ASC) Order by the local column
 * @method     ChildPassoQuery orderByDuracao($order = Criteria::ASC) Order by the duracao column
 * @method     ChildPassoQuery orderByMateriaisNecessarios($order = Criteria::ASC) Order by the materiais_necessarios column
 * @method     ChildPassoQuery orderByTexto($order = Criteria::ASC) Order by the texto column
 *
 * @method     ChildPassoQuery groupById() Group by the id column
 * @method     ChildPassoQuery groupByIdProposicao() Group by the id_proposicao column
 * @method     ChildPassoQuery groupByPosicao() Group by the posicao column
 * @method     ChildPassoQuery groupByTitulo() Group by the titulo column
 * @method     ChildPassoQuery groupByLocal() Group by the local column
 * @method     ChildPassoQuery groupByDuracao() Group by the duracao column
 * @method     ChildPassoQuery groupByMateriaisNecessarios() Group by the materiais_necessarios column
 * @method     ChildPassoQuery groupByTexto() Group by the texto column
 *
 * @method     ChildPassoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPassoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPassoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPassoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPassoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPassoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPassoQuery leftJoinProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Proposicao relation
 * @method     ChildPassoQuery rightJoinProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Proposicao relation
 * @method     ChildPassoQuery innerJoinProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the Proposicao relation
 *
 * @method     ChildPassoQuery joinWithProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Proposicao relation
 *
 * @method     ChildPassoQuery leftJoinWithProposicao() Adds a LEFT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildPassoQuery rightJoinWithProposicao() Adds a RIGHT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildPassoQuery innerJoinWithProposicao() Adds a INNER JOIN clause and with to the query using the Proposicao relation
 *
 * @method     \Model\ProposicaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPasso findOne(ConnectionInterface $con = null) Return the first ChildPasso matching the query
 * @method     ChildPasso findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPasso matching the query, or a new ChildPasso object populated from the query conditions when no match is found
 *
 * @method     ChildPasso findOneById(int $id) Return the first ChildPasso filtered by the id column
 * @method     ChildPasso findOneByIdProposicao(int $id_proposicao) Return the first ChildPasso filtered by the id_proposicao column
 * @method     ChildPasso findOneByPosicao(int $posicao) Return the first ChildPasso filtered by the posicao column
 * @method     ChildPasso findOneByTitulo(string $titulo) Return the first ChildPasso filtered by the titulo column
 * @method     ChildPasso findOneByLocal(string $local) Return the first ChildPasso filtered by the local column
 * @method     ChildPasso findOneByDuracao(string $duracao) Return the first ChildPasso filtered by the duracao column
 * @method     ChildPasso findOneByMateriaisNecessarios(string $materiais_necessarios) Return the first ChildPasso filtered by the materiais_necessarios column
 * @method     ChildPasso findOneByTexto(string $texto) Return the first ChildPasso filtered by the texto column *

 * @method     ChildPasso requirePk($key, ConnectionInterface $con = null) Return the ChildPasso by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOne(ConnectionInterface $con = null) Return the first ChildPasso matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPasso requireOneById(int $id) Return the first ChildPasso filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByIdProposicao(int $id_proposicao) Return the first ChildPasso filtered by the id_proposicao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByPosicao(int $posicao) Return the first ChildPasso filtered by the posicao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByTitulo(string $titulo) Return the first ChildPasso filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByLocal(string $local) Return the first ChildPasso filtered by the local column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByDuracao(string $duracao) Return the first ChildPasso filtered by the duracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByMateriaisNecessarios(string $materiais_necessarios) Return the first ChildPasso filtered by the materiais_necessarios column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPasso requireOneByTexto(string $texto) Return the first ChildPasso filtered by the texto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPasso[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPasso objects based on current ModelCriteria
 * @method     ChildPasso[]|ObjectCollection findById(int $id) Return ChildPasso objects filtered by the id column
 * @method     ChildPasso[]|ObjectCollection findByIdProposicao(int $id_proposicao) Return ChildPasso objects filtered by the id_proposicao column
 * @method     ChildPasso[]|ObjectCollection findByPosicao(int $posicao) Return ChildPasso objects filtered by the posicao column
 * @method     ChildPasso[]|ObjectCollection findByTitulo(string $titulo) Return ChildPasso objects filtered by the titulo column
 * @method     ChildPasso[]|ObjectCollection findByLocal(string $local) Return ChildPasso objects filtered by the local column
 * @method     ChildPasso[]|ObjectCollection findByDuracao(string $duracao) Return ChildPasso objects filtered by the duracao column
 * @method     ChildPasso[]|ObjectCollection findByMateriaisNecessarios(string $materiais_necessarios) Return ChildPasso objects filtered by the materiais_necessarios column
 * @method     ChildPasso[]|ObjectCollection findByTexto(string $texto) Return ChildPasso objects filtered by the texto column
 * @method     ChildPasso[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PassoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\PassoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Passo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPassoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPassoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPassoQuery) {
            return $criteria;
        }
        $query = new ChildPassoQuery();
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
     * @return ChildPasso|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PassoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PassoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPasso A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_proposicao, posicao, titulo, local, duracao, materiais_necessarios, texto FROM passo WHERE id = :p0';
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
            /** @var ChildPasso $obj */
            $obj = new ChildPasso();
            $obj->hydrate($row);
            PassoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPasso|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PassoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PassoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PassoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PassoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByIdProposicao($idProposicao = null, $comparison = null)
    {
        if (is_array($idProposicao)) {
            $useMinMax = false;
            if (isset($idProposicao['min'])) {
                $this->addUsingAlias(PassoTableMap::COL_ID_PROPOSICAO, $idProposicao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProposicao['max'])) {
                $this->addUsingAlias(PassoTableMap::COL_ID_PROPOSICAO, $idProposicao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_ID_PROPOSICAO, $idProposicao, $comparison);
    }

    /**
     * Filter the query on the posicao column
     *
     * Example usage:
     * <code>
     * $query->filterByPosicao(1234); // WHERE posicao = 1234
     * $query->filterByPosicao(array(12, 34)); // WHERE posicao IN (12, 34)
     * $query->filterByPosicao(array('min' => 12)); // WHERE posicao > 12
     * </code>
     *
     * @param     mixed $posicao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByPosicao($posicao = null, $comparison = null)
    {
        if (is_array($posicao)) {
            $useMinMax = false;
            if (isset($posicao['min'])) {
                $this->addUsingAlias(PassoTableMap::COL_POSICAO, $posicao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($posicao['max'])) {
                $this->addUsingAlias(PassoTableMap::COL_POSICAO, $posicao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_POSICAO, $posicao, $comparison);
    }

    /**
     * Filter the query on the titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByTitulo('fooValue');   // WHERE titulo = 'fooValue'
     * $query->filterByTitulo('%fooValue%'); // WHERE titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titulo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByTitulo($titulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titulo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_TITULO, $titulo, $comparison);
    }

    /**
     * Filter the query on the local column
     *
     * Example usage:
     * <code>
     * $query->filterByLocal('fooValue');   // WHERE local = 'fooValue'
     * $query->filterByLocal('%fooValue%'); // WHERE local LIKE '%fooValue%'
     * </code>
     *
     * @param     string $local The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByLocal($local = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($local)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_LOCAL, $local, $comparison);
    }

    /**
     * Filter the query on the duracao column
     *
     * Example usage:
     * <code>
     * $query->filterByDuracao('fooValue');   // WHERE duracao = 'fooValue'
     * $query->filterByDuracao('%fooValue%'); // WHERE duracao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $duracao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByDuracao($duracao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($duracao)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_DURACAO, $duracao, $comparison);
    }

    /**
     * Filter the query on the materiais_necessarios column
     *
     * Example usage:
     * <code>
     * $query->filterByMateriaisNecessarios('fooValue');   // WHERE materiais_necessarios = 'fooValue'
     * $query->filterByMateriaisNecessarios('%fooValue%'); // WHERE materiais_necessarios LIKE '%fooValue%'
     * </code>
     *
     * @param     string $materiaisNecessarios The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByMateriaisNecessarios($materiaisNecessarios = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($materiaisNecessarios)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_MATERIAIS_NECESSARIOS, $materiaisNecessarios, $comparison);
    }

    /**
     * Filter the query on the texto column
     *
     * Example usage:
     * <code>
     * $query->filterByTexto('fooValue');   // WHERE texto = 'fooValue'
     * $query->filterByTexto('%fooValue%'); // WHERE texto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $texto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function filterByTexto($texto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($texto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PassoTableMap::COL_TEXTO, $texto, $comparison);
    }

    /**
     * Filter the query by a related \Model\Proposicao object
     *
     * @param \Model\Proposicao|ObjectCollection $proposicao The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPassoQuery The current query, for fluid interface
     */
    public function filterByProposicao($proposicao, $comparison = null)
    {
        if ($proposicao instanceof \Model\Proposicao) {
            return $this
                ->addUsingAlias(PassoTableMap::COL_ID_PROPOSICAO, $proposicao->getId(), $comparison);
        } elseif ($proposicao instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PassoTableMap::COL_ID_PROPOSICAO, $proposicao->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPassoQuery The current query, for fluid interface
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
     * @param   ChildPasso $passo Object to remove from the list of results
     *
     * @return $this|ChildPassoQuery The current query, for fluid interface
     */
    public function prune($passo = null)
    {
        if ($passo) {
            $this->addUsingAlias(PassoTableMap::COL_ID, $passo->getId(), Criteria::NOT_EQUAL);
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
        // aggregate_column_relation_aggregate_custo_producao behavior
        $this->findRelatedProposicaoTempoTotals($con);

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
        // aggregate_column_relation_aggregate_custo_producao behavior
        $this->updateRelatedProposicaoTempoTotals($con);

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
        // aggregate_column_relation_aggregate_custo_producao behavior
        $this->findRelatedProposicaoTempoTotals($con);

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
        // aggregate_column_relation_aggregate_custo_producao behavior
        $this->updateRelatedProposicaoTempoTotals($con);

        return $this->postUpdate($affectedRows, $con);
    }

    /**
     * Deletes all rows from the passo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PassoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PassoTableMap::clearInstancePool();
            PassoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PassoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PassoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PassoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PassoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // aggregate_column_relation_aggregate_custo_producao behavior

    /**
     * Finds the related Proposicao objects and keep them for later
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function findRelatedProposicaoTempoTotals($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->proposicaoTempoTotals = \Model\ProposicaoQuery::create()
            ->joinPasso($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedProposicaoTempoTotals($con)
    {
        foreach ($this->proposicaoTempoTotals as $proposicaoTempoTotal) {
            $proposicaoTempoTotal->updateTempoTotal($con);
        }
        $this->proposicaoTempoTotals = array();
    }

} // PassoQuery
