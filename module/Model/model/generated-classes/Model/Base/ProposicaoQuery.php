<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Proposicao as ChildProposicao;
use Model\ProposicaoQuery as ChildProposicaoQuery;
use Model\Map\ProposicaoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'proposicao' table.
 *
 *
 *
 * @method     ChildProposicaoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProposicaoQuery orderByIdUsuario($order = Criteria::ASC) Order by the id_usuario column
 * @method     ChildProposicaoQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildProposicaoQuery orderByObjetivo($order = Criteria::ASC) Order by the objetivo column
 * @method     ChildProposicaoQuery orderByStart($order = Criteria::ASC) Order by the start column
 * @method     ChildProposicaoQuery orderByImagem($order = Criteria::ASC) Order by the imagem column
 * @method     ChildProposicaoQuery orderByTempoTotal($order = Criteria::ASC) Order by the tempo_total column
 * @method     ChildProposicaoQuery orderByDataCadastro($order = Criteria::ASC) Order by the data_cadastro column
 * @method     ChildProposicaoQuery orderByIsRascunho($order = Criteria::ASC) Order by the is_rascunho column
 * @method     ChildProposicaoQuery orderByCategoria($order = Criteria::ASC) Order by the categoria column
 *
 * @method     ChildProposicaoQuery groupById() Group by the id column
 * @method     ChildProposicaoQuery groupByIdUsuario() Group by the id_usuario column
 * @method     ChildProposicaoQuery groupByNome() Group by the nome column
 * @method     ChildProposicaoQuery groupByObjetivo() Group by the objetivo column
 * @method     ChildProposicaoQuery groupByStart() Group by the start column
 * @method     ChildProposicaoQuery groupByImagem() Group by the imagem column
 * @method     ChildProposicaoQuery groupByTempoTotal() Group by the tempo_total column
 * @method     ChildProposicaoQuery groupByDataCadastro() Group by the data_cadastro column
 * @method     ChildProposicaoQuery groupByIsRascunho() Group by the is_rascunho column
 * @method     ChildProposicaoQuery groupByCategoria() Group by the categoria column
 *
 * @method     ChildProposicaoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProposicaoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProposicaoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProposicaoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProposicaoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProposicaoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProposicaoQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildProposicaoQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildProposicaoQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildProposicaoQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildProposicaoQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildProposicaoQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildProposicaoQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildProposicaoQuery leftJoinAmbienteProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the AmbienteProposicao relation
 * @method     ChildProposicaoQuery rightJoinAmbienteProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AmbienteProposicao relation
 * @method     ChildProposicaoQuery innerJoinAmbienteProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the AmbienteProposicao relation
 *
 * @method     ChildProposicaoQuery joinWithAmbienteProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AmbienteProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinWithAmbienteProposicao() Adds a LEFT JOIN clause and with to the query using the AmbienteProposicao relation
 * @method     ChildProposicaoQuery rightJoinWithAmbienteProposicao() Adds a RIGHT JOIN clause and with to the query using the AmbienteProposicao relation
 * @method     ChildProposicaoQuery innerJoinWithAmbienteProposicao() Adds a INNER JOIN clause and with to the query using the AmbienteProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinComentario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comentario relation
 * @method     ChildProposicaoQuery rightJoinComentario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comentario relation
 * @method     ChildProposicaoQuery innerJoinComentario($relationAlias = null) Adds a INNER JOIN clause to the query using the Comentario relation
 *
 * @method     ChildProposicaoQuery joinWithComentario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Comentario relation
 *
 * @method     ChildProposicaoQuery leftJoinWithComentario() Adds a LEFT JOIN clause and with to the query using the Comentario relation
 * @method     ChildProposicaoQuery rightJoinWithComentario() Adds a RIGHT JOIN clause and with to the query using the Comentario relation
 * @method     ChildProposicaoQuery innerJoinWithComentario() Adds a INNER JOIN clause and with to the query using the Comentario relation
 *
 * @method     ChildProposicaoQuery leftJoinCurtir($relationAlias = null) Adds a LEFT JOIN clause to the query using the Curtir relation
 * @method     ChildProposicaoQuery rightJoinCurtir($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Curtir relation
 * @method     ChildProposicaoQuery innerJoinCurtir($relationAlias = null) Adds a INNER JOIN clause to the query using the Curtir relation
 *
 * @method     ChildProposicaoQuery joinWithCurtir($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Curtir relation
 *
 * @method     ChildProposicaoQuery leftJoinWithCurtir() Adds a LEFT JOIN clause and with to the query using the Curtir relation
 * @method     ChildProposicaoQuery rightJoinWithCurtir() Adds a RIGHT JOIN clause and with to the query using the Curtir relation
 * @method     ChildProposicaoQuery innerJoinWithCurtir() Adds a INNER JOIN clause and with to the query using the Curtir relation
 *
 * @method     ChildProposicaoQuery leftJoinHabilidadeProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the HabilidadeProposicao relation
 * @method     ChildProposicaoQuery rightJoinHabilidadeProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HabilidadeProposicao relation
 * @method     ChildProposicaoQuery innerJoinHabilidadeProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the HabilidadeProposicao relation
 *
 * @method     ChildProposicaoQuery joinWithHabilidadeProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HabilidadeProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinWithHabilidadeProposicao() Adds a LEFT JOIN clause and with to the query using the HabilidadeProposicao relation
 * @method     ChildProposicaoQuery rightJoinWithHabilidadeProposicao() Adds a RIGHT JOIN clause and with to the query using the HabilidadeProposicao relation
 * @method     ChildProposicaoQuery innerJoinWithHabilidadeProposicao() Adds a INNER JOIN clause and with to the query using the HabilidadeProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinPasso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Passo relation
 * @method     ChildProposicaoQuery rightJoinPasso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Passo relation
 * @method     ChildProposicaoQuery innerJoinPasso($relationAlias = null) Adds a INNER JOIN clause to the query using the Passo relation
 *
 * @method     ChildProposicaoQuery joinWithPasso($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Passo relation
 *
 * @method     ChildProposicaoQuery leftJoinWithPasso() Adds a LEFT JOIN clause and with to the query using the Passo relation
 * @method     ChildProposicaoQuery rightJoinWithPasso() Adds a RIGHT JOIN clause and with to the query using the Passo relation
 * @method     ChildProposicaoQuery innerJoinWithPasso() Adds a INNER JOIN clause and with to the query using the Passo relation
 *
 * @method     ChildProposicaoQuery leftJoinRecursoProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the RecursoProposicao relation
 * @method     ChildProposicaoQuery rightJoinRecursoProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RecursoProposicao relation
 * @method     ChildProposicaoQuery innerJoinRecursoProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the RecursoProposicao relation
 *
 * @method     ChildProposicaoQuery joinWithRecursoProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RecursoProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinWithRecursoProposicao() Adds a LEFT JOIN clause and with to the query using the RecursoProposicao relation
 * @method     ChildProposicaoQuery rightJoinWithRecursoProposicao() Adds a RIGHT JOIN clause and with to the query using the RecursoProposicao relation
 * @method     ChildProposicaoQuery innerJoinWithRecursoProposicao() Adds a INNER JOIN clause and with to the query using the RecursoProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinTamanhoTurmaProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the TamanhoTurmaProposicao relation
 * @method     ChildProposicaoQuery rightJoinTamanhoTurmaProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TamanhoTurmaProposicao relation
 * @method     ChildProposicaoQuery innerJoinTamanhoTurmaProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the TamanhoTurmaProposicao relation
 *
 * @method     ChildProposicaoQuery joinWithTamanhoTurmaProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TamanhoTurmaProposicao relation
 *
 * @method     ChildProposicaoQuery leftJoinWithTamanhoTurmaProposicao() Adds a LEFT JOIN clause and with to the query using the TamanhoTurmaProposicao relation
 * @method     ChildProposicaoQuery rightJoinWithTamanhoTurmaProposicao() Adds a RIGHT JOIN clause and with to the query using the TamanhoTurmaProposicao relation
 * @method     ChildProposicaoQuery innerJoinWithTamanhoTurmaProposicao() Adds a INNER JOIN clause and with to the query using the TamanhoTurmaProposicao relation
 *
 * @method     \Model\UsuarioQuery|\Model\AmbienteProposicaoQuery|\Model\ComentarioQuery|\Model\CurtirQuery|\Model\HabilidadeProposicaoQuery|\Model\PassoQuery|\Model\RecursoProposicaoQuery|\Model\TamanhoTurmaProposicaoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProposicao findOne(ConnectionInterface $con = null) Return the first ChildProposicao matching the query
 * @method     ChildProposicao findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProposicao matching the query, or a new ChildProposicao object populated from the query conditions when no match is found
 *
 * @method     ChildProposicao findOneById(int $id) Return the first ChildProposicao filtered by the id column
 * @method     ChildProposicao findOneByIdUsuario(int $id_usuario) Return the first ChildProposicao filtered by the id_usuario column
 * @method     ChildProposicao findOneByNome(string $nome) Return the first ChildProposicao filtered by the nome column
 * @method     ChildProposicao findOneByObjetivo(string $objetivo) Return the first ChildProposicao filtered by the objetivo column
 * @method     ChildProposicao findOneByStart(string $start) Return the first ChildProposicao filtered by the start column
 * @method     ChildProposicao findOneByImagem(resource $imagem) Return the first ChildProposicao filtered by the imagem column
 * @method     ChildProposicao findOneByTempoTotal(string $tempo_total) Return the first ChildProposicao filtered by the tempo_total column
 * @method     ChildProposicao findOneByDataCadastro(string $data_cadastro) Return the first ChildProposicao filtered by the data_cadastro column
 * @method     ChildProposicao findOneByIsRascunho(boolean $is_rascunho) Return the first ChildProposicao filtered by the is_rascunho column
 * @method     ChildProposicao findOneByCategoria(string $categoria) Return the first ChildProposicao filtered by the categoria column *

 * @method     ChildProposicao requirePk($key, ConnectionInterface $con = null) Return the ChildProposicao by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOne(ConnectionInterface $con = null) Return the first ChildProposicao matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProposicao requireOneById(int $id) Return the first ChildProposicao filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByIdUsuario(int $id_usuario) Return the first ChildProposicao filtered by the id_usuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByNome(string $nome) Return the first ChildProposicao filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByObjetivo(string $objetivo) Return the first ChildProposicao filtered by the objetivo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByStart(string $start) Return the first ChildProposicao filtered by the start column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByImagem(resource $imagem) Return the first ChildProposicao filtered by the imagem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByTempoTotal(string $tempo_total) Return the first ChildProposicao filtered by the tempo_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByDataCadastro(string $data_cadastro) Return the first ChildProposicao filtered by the data_cadastro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByIsRascunho(boolean $is_rascunho) Return the first ChildProposicao filtered by the is_rascunho column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProposicao requireOneByCategoria(string $categoria) Return the first ChildProposicao filtered by the categoria column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProposicao[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProposicao objects based on current ModelCriteria
 * @method     ChildProposicao[]|ObjectCollection findById(int $id) Return ChildProposicao objects filtered by the id column
 * @method     ChildProposicao[]|ObjectCollection findByIdUsuario(int $id_usuario) Return ChildProposicao objects filtered by the id_usuario column
 * @method     ChildProposicao[]|ObjectCollection findByNome(string $nome) Return ChildProposicao objects filtered by the nome column
 * @method     ChildProposicao[]|ObjectCollection findByObjetivo(string $objetivo) Return ChildProposicao objects filtered by the objetivo column
 * @method     ChildProposicao[]|ObjectCollection findByStart(string $start) Return ChildProposicao objects filtered by the start column
 * @method     ChildProposicao[]|ObjectCollection findByImagem(resource $imagem) Return ChildProposicao objects filtered by the imagem column
 * @method     ChildProposicao[]|ObjectCollection findByTempoTotal(string $tempo_total) Return ChildProposicao objects filtered by the tempo_total column
 * @method     ChildProposicao[]|ObjectCollection findByDataCadastro(string $data_cadastro) Return ChildProposicao objects filtered by the data_cadastro column
 * @method     ChildProposicao[]|ObjectCollection findByIsRascunho(boolean $is_rascunho) Return ChildProposicao objects filtered by the is_rascunho column
 * @method     ChildProposicao[]|ObjectCollection findByCategoria(string $categoria) Return ChildProposicao objects filtered by the categoria column
 * @method     ChildProposicao[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProposicaoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\ProposicaoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Proposicao', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProposicaoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProposicaoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProposicaoQuery) {
            return $criteria;
        }
        $query = new ChildProposicaoQuery();
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
     * @return ChildProposicao|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProposicaoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProposicao A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_usuario, nome, objetivo, start, imagem, tempo_total, data_cadastro, is_rascunho, categoria FROM proposicao WHERE id = :p0';
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
            /** @var ChildProposicao $obj */
            $obj = new ChildProposicao();
            $obj->hydrate($row);
            ProposicaoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProposicao|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProposicaoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProposicaoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProposicaoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProposicaoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByIdUsuario($idUsuario = null, $comparison = null)
    {
        if (is_array($idUsuario)) {
            $useMinMax = false;
            if (isset($idUsuario['min'])) {
                $this->addUsingAlias(ProposicaoTableMap::COL_ID_USUARIO, $idUsuario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUsuario['max'])) {
                $this->addUsingAlias(ProposicaoTableMap::COL_ID_USUARIO, $idUsuario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_ID_USUARIO, $idUsuario, $comparison);
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the objetivo column
     *
     * Example usage:
     * <code>
     * $query->filterByObjetivo('fooValue');   // WHERE objetivo = 'fooValue'
     * $query->filterByObjetivo('%fooValue%'); // WHERE objetivo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objetivo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByObjetivo($objetivo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objetivo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_OBJETIVO, $objetivo, $comparison);
    }

    /**
     * Filter the query on the start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart('fooValue');   // WHERE start = 'fooValue'
     * $query->filterByStart('%fooValue%'); // WHERE start LIKE '%fooValue%'
     * </code>
     *
     * @param     string $start The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($start)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_START, $start, $comparison);
    }

    /**
     * Filter the query on the imagem column
     *
     * @param     mixed $imagem The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByImagem($imagem = null, $comparison = null)
    {

        return $this->addUsingAlias(ProposicaoTableMap::COL_IMAGEM, $imagem, $comparison);
    }

    /**
     * Filter the query on the tempo_total column
     *
     * Example usage:
     * <code>
     * $query->filterByTempoTotal('fooValue');   // WHERE tempo_total = 'fooValue'
     * $query->filterByTempoTotal('%fooValue%'); // WHERE tempo_total LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tempoTotal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByTempoTotal($tempoTotal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tempoTotal)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_TEMPO_TOTAL, $tempoTotal, $comparison);
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByDataCadastro($dataCadastro = null, $comparison = null)
    {
        if (is_array($dataCadastro)) {
            $useMinMax = false;
            if (isset($dataCadastro['min'])) {
                $this->addUsingAlias(ProposicaoTableMap::COL_DATA_CADASTRO, $dataCadastro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataCadastro['max'])) {
                $this->addUsingAlias(ProposicaoTableMap::COL_DATA_CADASTRO, $dataCadastro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_DATA_CADASTRO, $dataCadastro, $comparison);
    }

    /**
     * Filter the query on the is_rascunho column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRascunho(true); // WHERE is_rascunho = true
     * $query->filterByIsRascunho('yes'); // WHERE is_rascunho = true
     * </code>
     *
     * @param     boolean|string $isRascunho The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByIsRascunho($isRascunho = null, $comparison = null)
    {
        if (is_string($isRascunho)) {
            $isRascunho = in_array(strtolower($isRascunho), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_IS_RASCUNHO, $isRascunho, $comparison);
    }

    /**
     * Filter the query on the categoria column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoria('fooValue');   // WHERE categoria = 'fooValue'
     * $query->filterByCategoria('%fooValue%'); // WHERE categoria LIKE '%fooValue%'
     * </code>
     *
     * @param     string $categoria The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByCategoria($categoria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoria)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProposicaoTableMap::COL_CATEGORIA, $categoria, $comparison);
    }

    /**
     * Filter the query by a related \Model\Usuario object
     *
     * @param \Model\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \Model\Usuario) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID_USUARIO, $usuario->getId(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID_USUARIO, $usuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\AmbienteProposicao object
     *
     * @param \Model\AmbienteProposicao|ObjectCollection $ambienteProposicao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByAmbienteProposicao($ambienteProposicao, $comparison = null)
    {
        if ($ambienteProposicao instanceof \Model\AmbienteProposicao) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $ambienteProposicao->getIdProposicao(), $comparison);
        } elseif ($ambienteProposicao instanceof ObjectCollection) {
            return $this
                ->useAmbienteProposicaoQuery()
                ->filterByPrimaryKeys($ambienteProposicao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAmbienteProposicao() only accepts arguments of type \Model\AmbienteProposicao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AmbienteProposicao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function joinAmbienteProposicao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AmbienteProposicao');

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
            $this->addJoinObject($join, 'AmbienteProposicao');
        }

        return $this;
    }

    /**
     * Use the AmbienteProposicao relation AmbienteProposicao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\AmbienteProposicaoQuery A secondary query class using the current class as primary query
     */
    public function useAmbienteProposicaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAmbienteProposicao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AmbienteProposicao', '\Model\AmbienteProposicaoQuery');
    }

    /**
     * Filter the query by a related \Model\Comentario object
     *
     * @param \Model\Comentario|ObjectCollection $comentario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByComentario($comentario, $comparison = null)
    {
        if ($comentario instanceof \Model\Comentario) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $comentario->getIdProposicao(), $comparison);
        } elseif ($comentario instanceof ObjectCollection) {
            return $this
                ->useComentarioQuery()
                ->filterByPrimaryKeys($comentario->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComentario() only accepts arguments of type \Model\Comentario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Comentario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function joinComentario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Comentario');

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
            $this->addJoinObject($join, 'Comentario');
        }

        return $this;
    }

    /**
     * Use the Comentario relation Comentario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ComentarioQuery A secondary query class using the current class as primary query
     */
    public function useComentarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComentario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Comentario', '\Model\ComentarioQuery');
    }

    /**
     * Filter the query by a related \Model\Curtir object
     *
     * @param \Model\Curtir|ObjectCollection $curtir the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByCurtir($curtir, $comparison = null)
    {
        if ($curtir instanceof \Model\Curtir) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $curtir->getIdProposicao(), $comparison);
        } elseif ($curtir instanceof ObjectCollection) {
            return $this
                ->useCurtirQuery()
                ->filterByPrimaryKeys($curtir->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCurtir() only accepts arguments of type \Model\Curtir or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Curtir relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function joinCurtir($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Curtir');

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
            $this->addJoinObject($join, 'Curtir');
        }

        return $this;
    }

    /**
     * Use the Curtir relation Curtir object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\CurtirQuery A secondary query class using the current class as primary query
     */
    public function useCurtirQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurtir($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Curtir', '\Model\CurtirQuery');
    }

    /**
     * Filter the query by a related \Model\HabilidadeProposicao object
     *
     * @param \Model\HabilidadeProposicao|ObjectCollection $habilidadeProposicao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByHabilidadeProposicao($habilidadeProposicao, $comparison = null)
    {
        if ($habilidadeProposicao instanceof \Model\HabilidadeProposicao) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $habilidadeProposicao->getIdProposicao(), $comparison);
        } elseif ($habilidadeProposicao instanceof ObjectCollection) {
            return $this
                ->useHabilidadeProposicaoQuery()
                ->filterByPrimaryKeys($habilidadeProposicao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHabilidadeProposicao() only accepts arguments of type \Model\HabilidadeProposicao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HabilidadeProposicao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function joinHabilidadeProposicao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HabilidadeProposicao');

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
            $this->addJoinObject($join, 'HabilidadeProposicao');
        }

        return $this;
    }

    /**
     * Use the HabilidadeProposicao relation HabilidadeProposicao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\HabilidadeProposicaoQuery A secondary query class using the current class as primary query
     */
    public function useHabilidadeProposicaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHabilidadeProposicao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HabilidadeProposicao', '\Model\HabilidadeProposicaoQuery');
    }

    /**
     * Filter the query by a related \Model\Passo object
     *
     * @param \Model\Passo|ObjectCollection $passo the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByPasso($passo, $comparison = null)
    {
        if ($passo instanceof \Model\Passo) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $passo->getIdProposicao(), $comparison);
        } elseif ($passo instanceof ObjectCollection) {
            return $this
                ->usePassoQuery()
                ->filterByPrimaryKeys($passo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPasso() only accepts arguments of type \Model\Passo or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Passo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function joinPasso($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Passo');

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
            $this->addJoinObject($join, 'Passo');
        }

        return $this;
    }

    /**
     * Use the Passo relation Passo object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\PassoQuery A secondary query class using the current class as primary query
     */
    public function usePassoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPasso($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Passo', '\Model\PassoQuery');
    }

    /**
     * Filter the query by a related \Model\RecursoProposicao object
     *
     * @param \Model\RecursoProposicao|ObjectCollection $recursoProposicao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByRecursoProposicao($recursoProposicao, $comparison = null)
    {
        if ($recursoProposicao instanceof \Model\RecursoProposicao) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $recursoProposicao->getIdProposicao(), $comparison);
        } elseif ($recursoProposicao instanceof ObjectCollection) {
            return $this
                ->useRecursoProposicaoQuery()
                ->filterByPrimaryKeys($recursoProposicao->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRecursoProposicao() only accepts arguments of type \Model\RecursoProposicao or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RecursoProposicao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function joinRecursoProposicao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RecursoProposicao');

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
            $this->addJoinObject($join, 'RecursoProposicao');
        }

        return $this;
    }

    /**
     * Use the RecursoProposicao relation RecursoProposicao object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\RecursoProposicaoQuery A secondary query class using the current class as primary query
     */
    public function useRecursoProposicaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRecursoProposicao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RecursoProposicao', '\Model\RecursoProposicaoQuery');
    }

    /**
     * Filter the query by a related \Model\TamanhoTurmaProposicao object
     *
     * @param \Model\TamanhoTurmaProposicao|ObjectCollection $tamanhoTurmaProposicao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProposicaoQuery The current query, for fluid interface
     */
    public function filterByTamanhoTurmaProposicao($tamanhoTurmaProposicao, $comparison = null)
    {
        if ($tamanhoTurmaProposicao instanceof \Model\TamanhoTurmaProposicao) {
            return $this
                ->addUsingAlias(ProposicaoTableMap::COL_ID, $tamanhoTurmaProposicao->getIdProposicao(), $comparison);
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
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
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
     * @param   ChildProposicao $proposicao Object to remove from the list of results
     *
     * @return $this|ChildProposicaoQuery The current query, for fluid interface
     */
    public function prune($proposicao = null)
    {
        if ($proposicao) {
            $this->addUsingAlias(ProposicaoTableMap::COL_ID, $proposicao->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the proposicao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProposicaoTableMap::clearInstancePool();
            ProposicaoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProposicaoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProposicaoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProposicaoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProposicaoQuery
