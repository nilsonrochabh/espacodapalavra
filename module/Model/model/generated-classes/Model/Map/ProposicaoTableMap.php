<?php

namespace Model\Map;

use Model\Proposicao;
use Model\ProposicaoQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'proposicao' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProposicaoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.ProposicaoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'proposicao';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Proposicao';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Proposicao';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id field
     */
    const COL_ID = 'proposicao.id';

    /**
     * the column name for the id_usuario field
     */
    const COL_ID_USUARIO = 'proposicao.id_usuario';

    /**
     * the column name for the nome field
     */
    const COL_NOME = 'proposicao.nome';

    /**
     * the column name for the objetivo field
     */
    const COL_OBJETIVO = 'proposicao.objetivo';

    /**
     * the column name for the start field
     */
    const COL_START = 'proposicao.start';

    /**
     * the column name for the imagem field
     */
    const COL_IMAGEM = 'proposicao.imagem';

    /**
     * the column name for the tempo_total field
     */
    const COL_TEMPO_TOTAL = 'proposicao.tempo_total';

    /**
     * the column name for the data_cadastro field
     */
    const COL_DATA_CADASTRO = 'proposicao.data_cadastro';

    /**
     * the column name for the is_rascunho field
     */
    const COL_IS_RASCUNHO = 'proposicao.is_rascunho';

    /**
     * the column name for the categoria field
     */
    const COL_CATEGORIA = 'proposicao.categoria';

    /**
     * the column name for the qte_comentarios field
     */
    const COL_QTE_COMENTARIOS = 'proposicao.qte_comentarios';

    /**
     * the column name for the qte_curtidas field
     */
    const COL_QTE_CURTIDAS = 'proposicao.qte_curtidas';

    /**
     * the column name for the qte_seguidores field
     */
    const COL_QTE_SEGUIDORES = 'proposicao.qte_seguidores';

    /**
     * the column name for the qte_concluidos field
     */
    const COL_QTE_CONCLUIDOS = 'proposicao.qte_concluidos';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdUsuario', 'Nome', 'Objetivo', 'Start', 'Imagem', 'TempoTotal', 'DataCadastro', 'IsRascunho', 'Categoria', 'QteComentarios', 'QteCurtidas', 'QteSeguidores', 'QteConcluidos', ),
        self::TYPE_CAMELNAME     => array('id', 'idUsuario', 'nome', 'objetivo', 'start', 'imagem', 'tempoTotal', 'dataCadastro', 'isRascunho', 'categoria', 'qteComentarios', 'qteCurtidas', 'qteSeguidores', 'qteConcluidos', ),
        self::TYPE_COLNAME       => array(ProposicaoTableMap::COL_ID, ProposicaoTableMap::COL_ID_USUARIO, ProposicaoTableMap::COL_NOME, ProposicaoTableMap::COL_OBJETIVO, ProposicaoTableMap::COL_START, ProposicaoTableMap::COL_IMAGEM, ProposicaoTableMap::COL_TEMPO_TOTAL, ProposicaoTableMap::COL_DATA_CADASTRO, ProposicaoTableMap::COL_IS_RASCUNHO, ProposicaoTableMap::COL_CATEGORIA, ProposicaoTableMap::COL_QTE_COMENTARIOS, ProposicaoTableMap::COL_QTE_CURTIDAS, ProposicaoTableMap::COL_QTE_SEGUIDORES, ProposicaoTableMap::COL_QTE_CONCLUIDOS, ),
        self::TYPE_FIELDNAME     => array('id', 'id_usuario', 'nome', 'objetivo', 'start', 'imagem', 'tempo_total', 'data_cadastro', 'is_rascunho', 'categoria', 'qte_comentarios', 'qte_curtidas', 'qte_seguidores', 'qte_concluidos', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUsuario' => 1, 'Nome' => 2, 'Objetivo' => 3, 'Start' => 4, 'Imagem' => 5, 'TempoTotal' => 6, 'DataCadastro' => 7, 'IsRascunho' => 8, 'Categoria' => 9, 'QteComentarios' => 10, 'QteCurtidas' => 11, 'QteSeguidores' => 12, 'QteConcluidos' => 13, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUsuario' => 1, 'nome' => 2, 'objetivo' => 3, 'start' => 4, 'imagem' => 5, 'tempoTotal' => 6, 'dataCadastro' => 7, 'isRascunho' => 8, 'categoria' => 9, 'qteComentarios' => 10, 'qteCurtidas' => 11, 'qteSeguidores' => 12, 'qteConcluidos' => 13, ),
        self::TYPE_COLNAME       => array(ProposicaoTableMap::COL_ID => 0, ProposicaoTableMap::COL_ID_USUARIO => 1, ProposicaoTableMap::COL_NOME => 2, ProposicaoTableMap::COL_OBJETIVO => 3, ProposicaoTableMap::COL_START => 4, ProposicaoTableMap::COL_IMAGEM => 5, ProposicaoTableMap::COL_TEMPO_TOTAL => 6, ProposicaoTableMap::COL_DATA_CADASTRO => 7, ProposicaoTableMap::COL_IS_RASCUNHO => 8, ProposicaoTableMap::COL_CATEGORIA => 9, ProposicaoTableMap::COL_QTE_COMENTARIOS => 10, ProposicaoTableMap::COL_QTE_CURTIDAS => 11, ProposicaoTableMap::COL_QTE_SEGUIDORES => 12, ProposicaoTableMap::COL_QTE_CONCLUIDOS => 13, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_usuario' => 1, 'nome' => 2, 'objetivo' => 3, 'start' => 4, 'imagem' => 5, 'tempo_total' => 6, 'data_cadastro' => 7, 'is_rascunho' => 8, 'categoria' => 9, 'qte_comentarios' => 10, 'qte_curtidas' => 11, 'qte_seguidores' => 12, 'qte_concluidos' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('proposicao');
        $this->setPhpName('Proposicao');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Proposicao');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_usuario', 'IdUsuario', 'INTEGER', 'usuario', 'id', true, 10, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', true, 250, null);
        $this->addColumn('objetivo', 'Objetivo', 'LONGVARCHAR', true, null, null);
        $this->addColumn('start', 'Start', 'LONGVARCHAR', false, null, null);
        $this->addColumn('imagem', 'Imagem', 'VARCHAR', false, 200, null);
        $this->addColumn('tempo_total', 'TempoTotal', 'VARCHAR', false, 255, null);
        $this->addColumn('data_cadastro', 'DataCadastro', 'TIMESTAMP', true, null, null);
        $this->addColumn('is_rascunho', 'IsRascunho', 'BOOLEAN', true, 1, true);
        $this->addColumn('categoria', 'Categoria', 'CHAR', true, null, null);
        $this->addColumn('qte_comentarios', 'QteComentarios', 'INTEGER', true, 10, 0);
        $this->addColumn('qte_curtidas', 'QteCurtidas', 'INTEGER', true, 10, 0);
        $this->addColumn('qte_seguidores', 'QteSeguidores', 'INTEGER', true, 10, 0);
        $this->addColumn('qte_concluidos', 'QteConcluidos', 'INTEGER', true, 10, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuario', '\\Model\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_usuario',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('AmbienteProposicao', '\\Model\\AmbienteProposicao', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'AmbienteProposicaos', false);
        $this->addRelation('Comentario', '\\Model\\Comentario', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Comentarios', false);
        $this->addRelation('Concluir', '\\Model\\Concluir', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), null, null, 'Concluirs', false);
        $this->addRelation('Curtir', '\\Model\\Curtir', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Curtirs', false);
        $this->addRelation('HabilidadeProposicao', '\\Model\\HabilidadeProposicao', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'HabilidadeProposicaos', false);
        $this->addRelation('Passo', '\\Model\\Passo', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Passos', false);
        $this->addRelation('RecursoProposicao', '\\Model\\RecursoProposicao', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'RecursoProposicaos', false);
        $this->addRelation('Seguir', '\\Model\\Seguir', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), null, null, 'Seguirs', false);
        $this->addRelation('TamanhoTurmaProposicao', '\\Model\\TamanhoTurmaProposicao', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'TamanhoTurmaProposicaos', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'aggregate_tempo_total' => array('name' => 'tempo_total', 'expression' => 'SUM(duracao)', 'condition' => '', 'foreign_table' => 'passo', 'foreign_schema' => '', ),
            'aggregate_comentarios' => array('name' => 'qte_comentarios', 'expression' => 'COUNT(id)', 'condition' => '', 'foreign_table' => 'comentario', 'foreign_schema' => '', ),
            'aggregate_curtir' => array('name' => 'qte_curtidas', 'expression' => 'COUNT(*)', 'condition' => '', 'foreign_table' => 'curtir', 'foreign_schema' => '', ),
            'aggregate_seguir' => array('name' => 'qte_seguidores', 'expression' => 'COUNT(*)', 'condition' => '', 'foreign_table' => 'seguir', 'foreign_schema' => '', ),
            'aggregate_concluir' => array('name' => 'qte_concluidos', 'expression' => 'COUNT(*)', 'condition' => '', 'foreign_table' => 'concluir', 'foreign_schema' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to proposicao     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AmbienteProposicaoTableMap::clearInstancePool();
        ComentarioTableMap::clearInstancePool();
        CurtirTableMap::clearInstancePool();
        HabilidadeProposicaoTableMap::clearInstancePool();
        PassoTableMap::clearInstancePool();
        RecursoProposicaoTableMap::clearInstancePool();
        TamanhoTurmaProposicaoTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ProposicaoTableMap::CLASS_DEFAULT : ProposicaoTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Proposicao object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProposicaoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProposicaoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProposicaoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProposicaoTableMap::OM_CLASS;
            /** @var Proposicao $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProposicaoTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ProposicaoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProposicaoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Proposicao $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProposicaoTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ProposicaoTableMap::COL_ID);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_ID_USUARIO);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_NOME);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_OBJETIVO);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_START);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_IMAGEM);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_TEMPO_TOTAL);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_DATA_CADASTRO);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_IS_RASCUNHO);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_CATEGORIA);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_QTE_COMENTARIOS);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_QTE_CURTIDAS);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_QTE_SEGUIDORES);
            $criteria->addSelectColumn(ProposicaoTableMap::COL_QTE_CONCLUIDOS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_usuario');
            $criteria->addSelectColumn($alias . '.nome');
            $criteria->addSelectColumn($alias . '.objetivo');
            $criteria->addSelectColumn($alias . '.start');
            $criteria->addSelectColumn($alias . '.imagem');
            $criteria->addSelectColumn($alias . '.tempo_total');
            $criteria->addSelectColumn($alias . '.data_cadastro');
            $criteria->addSelectColumn($alias . '.is_rascunho');
            $criteria->addSelectColumn($alias . '.categoria');
            $criteria->addSelectColumn($alias . '.qte_comentarios');
            $criteria->addSelectColumn($alias . '.qte_curtidas');
            $criteria->addSelectColumn($alias . '.qte_seguidores');
            $criteria->addSelectColumn($alias . '.qte_concluidos');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ProposicaoTableMap::DATABASE_NAME)->getTable(ProposicaoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProposicaoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProposicaoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProposicaoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Proposicao or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Proposicao object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Proposicao) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProposicaoTableMap::DATABASE_NAME);
            $criteria->add(ProposicaoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProposicaoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProposicaoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProposicaoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the proposicao table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProposicaoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Proposicao or Criteria object.
     *
     * @param mixed               $criteria Criteria or Proposicao object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Proposicao object
        }

        if ($criteria->containsKey(ProposicaoTableMap::COL_ID) && $criteria->keyContainsValue(ProposicaoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProposicaoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProposicaoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProposicaoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProposicaoTableMap::buildTableMap();
