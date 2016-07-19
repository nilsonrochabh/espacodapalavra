<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Usuario as ChildUsuario;
use Model\UsuarioQuery as ChildUsuarioQuery;
use Model\Map\UsuarioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'usuario' table.
 *
 *
 *
 * @method     ChildUsuarioQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsuarioQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildUsuarioQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsuarioQuery orderByAtuacao($order = Criteria::ASC) Order by the atuacao column
 * @method     ChildUsuarioQuery orderByGenero($order = Criteria::ASC) Order by the genero column
 * @method     ChildUsuarioQuery orderBySenha($order = Criteria::ASC) Order by the senha column
 * @method     ChildUsuarioQuery orderByDescricaoContexto($order = Criteria::ASC) Order by the descricao_contexto column
 * @method     ChildUsuarioQuery orderByDataCadastro($order = Criteria::ASC) Order by the data_cadastro column
 * @method     ChildUsuarioQuery orderByIsAdmin($order = Criteria::ASC) Order by the is_admin column
 * @method     ChildUsuarioQuery orderByImagemProfile($order = Criteria::ASC) Order by the imagem_profile column
 *
 * @method     ChildUsuarioQuery groupById() Group by the id column
 * @method     ChildUsuarioQuery groupByNome() Group by the nome column
 * @method     ChildUsuarioQuery groupByEmail() Group by the email column
 * @method     ChildUsuarioQuery groupByAtuacao() Group by the atuacao column
 * @method     ChildUsuarioQuery groupByGenero() Group by the genero column
 * @method     ChildUsuarioQuery groupBySenha() Group by the senha column
 * @method     ChildUsuarioQuery groupByDescricaoContexto() Group by the descricao_contexto column
 * @method     ChildUsuarioQuery groupByDataCadastro() Group by the data_cadastro column
 * @method     ChildUsuarioQuery groupByIsAdmin() Group by the is_admin column
 * @method     ChildUsuarioQuery groupByImagemProfile() Group by the imagem_profile column
 *
 * @method     ChildUsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuarioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuarioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuarioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuarioQuery leftJoinComentario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comentario relation
 * @method     ChildUsuarioQuery rightJoinComentario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comentario relation
 * @method     ChildUsuarioQuery innerJoinComentario($relationAlias = null) Adds a INNER JOIN clause to the query using the Comentario relation
 *
 * @method     ChildUsuarioQuery joinWithComentario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Comentario relation
 *
 * @method     ChildUsuarioQuery leftJoinWithComentario() Adds a LEFT JOIN clause and with to the query using the Comentario relation
 * @method     ChildUsuarioQuery rightJoinWithComentario() Adds a RIGHT JOIN clause and with to the query using the Comentario relation
 * @method     ChildUsuarioQuery innerJoinWithComentario() Adds a INNER JOIN clause and with to the query using the Comentario relation
 *
 * @method     ChildUsuarioQuery leftJoinConcluir($relationAlias = null) Adds a LEFT JOIN clause to the query using the Concluir relation
 * @method     ChildUsuarioQuery rightJoinConcluir($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Concluir relation
 * @method     ChildUsuarioQuery innerJoinConcluir($relationAlias = null) Adds a INNER JOIN clause to the query using the Concluir relation
 *
 * @method     ChildUsuarioQuery joinWithConcluir($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Concluir relation
 *
 * @method     ChildUsuarioQuery leftJoinWithConcluir() Adds a LEFT JOIN clause and with to the query using the Concluir relation
 * @method     ChildUsuarioQuery rightJoinWithConcluir() Adds a RIGHT JOIN clause and with to the query using the Concluir relation
 * @method     ChildUsuarioQuery innerJoinWithConcluir() Adds a INNER JOIN clause and with to the query using the Concluir relation
 *
 * @method     ChildUsuarioQuery leftJoinCurtir($relationAlias = null) Adds a LEFT JOIN clause to the query using the Curtir relation
 * @method     ChildUsuarioQuery rightJoinCurtir($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Curtir relation
 * @method     ChildUsuarioQuery innerJoinCurtir($relationAlias = null) Adds a INNER JOIN clause to the query using the Curtir relation
 *
 * @method     ChildUsuarioQuery joinWithCurtir($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Curtir relation
 *
 * @method     ChildUsuarioQuery leftJoinWithCurtir() Adds a LEFT JOIN clause and with to the query using the Curtir relation
 * @method     ChildUsuarioQuery rightJoinWithCurtir() Adds a RIGHT JOIN clause and with to the query using the Curtir relation
 * @method     ChildUsuarioQuery innerJoinWithCurtir() Adds a INNER JOIN clause and with to the query using the Curtir relation
 *
 * @method     ChildUsuarioQuery leftJoinProposicao($relationAlias = null) Adds a LEFT JOIN clause to the query using the Proposicao relation
 * @method     ChildUsuarioQuery rightJoinProposicao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Proposicao relation
 * @method     ChildUsuarioQuery innerJoinProposicao($relationAlias = null) Adds a INNER JOIN clause to the query using the Proposicao relation
 *
 * @method     ChildUsuarioQuery joinWithProposicao($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Proposicao relation
 *
 * @method     ChildUsuarioQuery leftJoinWithProposicao() Adds a LEFT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildUsuarioQuery rightJoinWithProposicao() Adds a RIGHT JOIN clause and with to the query using the Proposicao relation
 * @method     ChildUsuarioQuery innerJoinWithProposicao() Adds a INNER JOIN clause and with to the query using the Proposicao relation
 *
 * @method     ChildUsuarioQuery leftJoinResetSenha($relationAlias = null) Adds a LEFT JOIN clause to the query using the ResetSenha relation
 * @method     ChildUsuarioQuery rightJoinResetSenha($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ResetSenha relation
 * @method     ChildUsuarioQuery innerJoinResetSenha($relationAlias = null) Adds a INNER JOIN clause to the query using the ResetSenha relation
 *
 * @method     ChildUsuarioQuery joinWithResetSenha($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ResetSenha relation
 *
 * @method     ChildUsuarioQuery leftJoinWithResetSenha() Adds a LEFT JOIN clause and with to the query using the ResetSenha relation
 * @method     ChildUsuarioQuery rightJoinWithResetSenha() Adds a RIGHT JOIN clause and with to the query using the ResetSenha relation
 * @method     ChildUsuarioQuery innerJoinWithResetSenha() Adds a INNER JOIN clause and with to the query using the ResetSenha relation
 *
 * @method     ChildUsuarioQuery leftJoinSeguir($relationAlias = null) Adds a LEFT JOIN clause to the query using the Seguir relation
 * @method     ChildUsuarioQuery rightJoinSeguir($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Seguir relation
 * @method     ChildUsuarioQuery innerJoinSeguir($relationAlias = null) Adds a INNER JOIN clause to the query using the Seguir relation
 *
 * @method     ChildUsuarioQuery joinWithSeguir($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Seguir relation
 *
 * @method     ChildUsuarioQuery leftJoinWithSeguir() Adds a LEFT JOIN clause and with to the query using the Seguir relation
 * @method     ChildUsuarioQuery rightJoinWithSeguir() Adds a RIGHT JOIN clause and with to the query using the Seguir relation
 * @method     ChildUsuarioQuery innerJoinWithSeguir() Adds a INNER JOIN clause and with to the query using the Seguir relation
 *
 * @method     \Model\ComentarioQuery|\Model\ConcluirQuery|\Model\CurtirQuery|\Model\ProposicaoQuery|\Model\ResetSenhaQuery|\Model\SeguirQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuario findOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query
 * @method     ChildUsuario findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuario matching the query, or a new ChildUsuario object populated from the query conditions when no match is found
 *
 * @method     ChildUsuario findOneById(int $id) Return the first ChildUsuario filtered by the id column
 * @method     ChildUsuario findOneByNome(string $nome) Return the first ChildUsuario filtered by the nome column
 * @method     ChildUsuario findOneByEmail(string $email) Return the first ChildUsuario filtered by the email column
 * @method     ChildUsuario findOneByAtuacao(string $atuacao) Return the first ChildUsuario filtered by the atuacao column
 * @method     ChildUsuario findOneByGenero(string $genero) Return the first ChildUsuario filtered by the genero column
 * @method     ChildUsuario findOneBySenha(string $senha) Return the first ChildUsuario filtered by the senha column
 * @method     ChildUsuario findOneByDescricaoContexto(string $descricao_contexto) Return the first ChildUsuario filtered by the descricao_contexto column
 * @method     ChildUsuario findOneByDataCadastro(string $data_cadastro) Return the first ChildUsuario filtered by the data_cadastro column
 * @method     ChildUsuario findOneByIsAdmin(boolean $is_admin) Return the first ChildUsuario filtered by the is_admin column
 * @method     ChildUsuario findOneByImagemProfile(string $imagem_profile) Return the first ChildUsuario filtered by the imagem_profile column *

 * @method     ChildUsuario requirePk($key, ConnectionInterface $con = null) Return the ChildUsuario by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOne(ConnectionInterface $con = null) Return the first ChildUsuario matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario requireOneById(int $id) Return the first ChildUsuario filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByNome(string $nome) Return the first ChildUsuario filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByEmail(string $email) Return the first ChildUsuario filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByAtuacao(string $atuacao) Return the first ChildUsuario filtered by the atuacao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByGenero(string $genero) Return the first ChildUsuario filtered by the genero column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneBySenha(string $senha) Return the first ChildUsuario filtered by the senha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByDescricaoContexto(string $descricao_contexto) Return the first ChildUsuario filtered by the descricao_contexto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByDataCadastro(string $data_cadastro) Return the first ChildUsuario filtered by the data_cadastro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByIsAdmin(boolean $is_admin) Return the first ChildUsuario filtered by the is_admin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuario requireOneByImagemProfile(string $imagem_profile) Return the first ChildUsuario filtered by the imagem_profile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuario[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuario objects based on current ModelCriteria
 * @method     ChildUsuario[]|ObjectCollection findById(int $id) Return ChildUsuario objects filtered by the id column
 * @method     ChildUsuario[]|ObjectCollection findByNome(string $nome) Return ChildUsuario objects filtered by the nome column
 * @method     ChildUsuario[]|ObjectCollection findByEmail(string $email) Return ChildUsuario objects filtered by the email column
 * @method     ChildUsuario[]|ObjectCollection findByAtuacao(string $atuacao) Return ChildUsuario objects filtered by the atuacao column
 * @method     ChildUsuario[]|ObjectCollection findByGenero(string $genero) Return ChildUsuario objects filtered by the genero column
 * @method     ChildUsuario[]|ObjectCollection findBySenha(string $senha) Return ChildUsuario objects filtered by the senha column
 * @method     ChildUsuario[]|ObjectCollection findByDescricaoContexto(string $descricao_contexto) Return ChildUsuario objects filtered by the descricao_contexto column
 * @method     ChildUsuario[]|ObjectCollection findByDataCadastro(string $data_cadastro) Return ChildUsuario objects filtered by the data_cadastro column
 * @method     ChildUsuario[]|ObjectCollection findByIsAdmin(boolean $is_admin) Return ChildUsuario objects filtered by the is_admin column
 * @method     ChildUsuario[]|ObjectCollection findByImagemProfile(string $imagem_profile) Return ChildUsuario objects filtered by the imagem_profile column
 * @method     ChildUsuario[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuarioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Model\Base\UsuarioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Model\\Usuario', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuarioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuarioQuery) {
            return $criteria;
        }
        $query = new ChildUsuarioQuery();
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
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuarioTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsuario A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, email, atuacao, genero, senha, descricao_contexto, data_cadastro, is_admin, imagem_profile FROM usuario WHERE id = :p0';
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
            /** @var ChildUsuario $obj */
            $obj = new ChildUsuario();
            $obj->hydrate($row);
            UsuarioTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsuario|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_NOME, $nome, $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the atuacao column
     *
     * Example usage:
     * <code>
     * $query->filterByAtuacao('fooValue');   // WHERE atuacao = 'fooValue'
     * $query->filterByAtuacao('%fooValue%'); // WHERE atuacao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $atuacao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByAtuacao($atuacao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($atuacao)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_ATUACAO, $atuacao, $comparison);
    }

    /**
     * Filter the query on the genero column
     *
     * Example usage:
     * <code>
     * $query->filterByGenero('fooValue');   // WHERE genero = 'fooValue'
     * $query->filterByGenero('%fooValue%'); // WHERE genero LIKE '%fooValue%'
     * </code>
     *
     * @param     string $genero The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByGenero($genero = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($genero)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_GENERO, $genero, $comparison);
    }

    /**
     * Filter the query on the senha column
     *
     * Example usage:
     * <code>
     * $query->filterBySenha('fooValue');   // WHERE senha = 'fooValue'
     * $query->filterBySenha('%fooValue%'); // WHERE senha LIKE '%fooValue%'
     * </code>
     *
     * @param     string $senha The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterBySenha($senha = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($senha)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_SENHA, $senha, $comparison);
    }

    /**
     * Filter the query on the descricao_contexto column
     *
     * Example usage:
     * <code>
     * $query->filterByDescricaoContexto('fooValue');   // WHERE descricao_contexto = 'fooValue'
     * $query->filterByDescricaoContexto('%fooValue%'); // WHERE descricao_contexto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descricaoContexto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByDescricaoContexto($descricaoContexto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descricaoContexto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_DESCRICAO_CONTEXTO, $descricaoContexto, $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByDataCadastro($dataCadastro = null, $comparison = null)
    {
        if (is_array($dataCadastro)) {
            $useMinMax = false;
            if (isset($dataCadastro['min'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_DATA_CADASTRO, $dataCadastro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataCadastro['max'])) {
                $this->addUsingAlias(UsuarioTableMap::COL_DATA_CADASTRO, $dataCadastro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_DATA_CADASTRO, $dataCadastro, $comparison);
    }

    /**
     * Filter the query on the is_admin column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAdmin(true); // WHERE is_admin = true
     * $query->filterByIsAdmin('yes'); // WHERE is_admin = true
     * </code>
     *
     * @param     boolean|string $isAdmin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByIsAdmin($isAdmin = null, $comparison = null)
    {
        if (is_string($isAdmin)) {
            $isAdmin = in_array(strtolower($isAdmin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_IS_ADMIN, $isAdmin, $comparison);
    }

    /**
     * Filter the query on the imagem_profile column
     *
     * Example usage:
     * <code>
     * $query->filterByImagemProfile('fooValue');   // WHERE imagem_profile = 'fooValue'
     * $query->filterByImagemProfile('%fooValue%'); // WHERE imagem_profile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imagemProfile The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByImagemProfile($imagemProfile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imagemProfile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioTableMap::COL_IMAGEM_PROFILE, $imagemProfile, $comparison);
    }

    /**
     * Filter the query by a related \Model\Comentario object
     *
     * @param \Model\Comentario|ObjectCollection $comentario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByComentario($comentario, $comparison = null)
    {
        if ($comentario instanceof \Model\Comentario) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $comentario->getIdUsuario(), $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Concluir object
     *
     * @param \Model\Concluir|ObjectCollection $concluir the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByConcluir($concluir, $comparison = null)
    {
        if ($concluir instanceof \Model\Concluir) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $concluir->getIdUsuario(), $comparison);
        } elseif ($concluir instanceof ObjectCollection) {
            return $this
                ->useConcluirQuery()
                ->filterByPrimaryKeys($concluir->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByConcluir() only accepts arguments of type \Model\Concluir or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Concluir relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinConcluir($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Concluir');

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
            $this->addJoinObject($join, 'Concluir');
        }

        return $this;
    }

    /**
     * Use the Concluir relation Concluir object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ConcluirQuery A secondary query class using the current class as primary query
     */
    public function useConcluirQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConcluir($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Concluir', '\Model\ConcluirQuery');
    }

    /**
     * Filter the query by a related \Model\Curtir object
     *
     * @param \Model\Curtir|ObjectCollection $curtir the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByCurtir($curtir, $comparison = null)
    {
        if ($curtir instanceof \Model\Curtir) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $curtir->getIdUsuario(), $comparison);
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\Proposicao object
     *
     * @param \Model\Proposicao|ObjectCollection $proposicao the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByProposicao($proposicao, $comparison = null)
    {
        if ($proposicao instanceof \Model\Proposicao) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $proposicao->getIdUsuario(), $comparison);
        } elseif ($proposicao instanceof ObjectCollection) {
            return $this
                ->useProposicaoQuery()
                ->filterByPrimaryKeys($proposicao->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
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
     * Filter the query by a related \Model\ResetSenha object
     *
     * @param \Model\ResetSenha|ObjectCollection $resetSenha the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterByResetSenha($resetSenha, $comparison = null)
    {
        if ($resetSenha instanceof \Model\ResetSenha) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $resetSenha->getIdUsuario(), $comparison);
        } elseif ($resetSenha instanceof ObjectCollection) {
            return $this
                ->useResetSenhaQuery()
                ->filterByPrimaryKeys($resetSenha->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByResetSenha() only accepts arguments of type \Model\ResetSenha or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ResetSenha relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinResetSenha($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ResetSenha');

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
            $this->addJoinObject($join, 'ResetSenha');
        }

        return $this;
    }

    /**
     * Use the ResetSenha relation ResetSenha object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\ResetSenhaQuery A secondary query class using the current class as primary query
     */
    public function useResetSenhaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinResetSenha($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResetSenha', '\Model\ResetSenhaQuery');
    }

    /**
     * Filter the query by a related \Model\Seguir object
     *
     * @param \Model\Seguir|ObjectCollection $seguir the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuarioQuery The current query, for fluid interface
     */
    public function filterBySeguir($seguir, $comparison = null)
    {
        if ($seguir instanceof \Model\Seguir) {
            return $this
                ->addUsingAlias(UsuarioTableMap::COL_ID, $seguir->getIdUsuario(), $comparison);
        } elseif ($seguir instanceof ObjectCollection) {
            return $this
                ->useSeguirQuery()
                ->filterByPrimaryKeys($seguir->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySeguir() only accepts arguments of type \Model\Seguir or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Seguir relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function joinSeguir($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Seguir');

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
            $this->addJoinObject($join, 'Seguir');
        }

        return $this;
    }

    /**
     * Use the Seguir relation Seguir object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Model\SeguirQuery A secondary query class using the current class as primary query
     */
    public function useSeguirQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSeguir($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Seguir', '\Model\SeguirQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsuario $usuario Object to remove from the list of results
     *
     * @return $this|ChildUsuarioQuery The current query, for fluid interface
     */
    public function prune($usuario = null)
    {
        if ($usuario) {
            $this->addUsingAlias(UsuarioTableMap::COL_ID, $usuario->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the usuario table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuarioTableMap::clearInstancePool();
            UsuarioTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuarioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsuarioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsuarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuarioQuery
