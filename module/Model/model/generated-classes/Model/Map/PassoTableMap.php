<?php

namespace Model\Map;

use Model\Passo;
use Model\PassoQuery;
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
 * This class defines the structure of the 'passo' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PassoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.PassoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'passo';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Passo';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Passo';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'passo.id';

    /**
     * the column name for the id_proposicao field
     */
    const COL_ID_PROPOSICAO = 'passo.id_proposicao';

    /**
     * the column name for the posicao field
     */
    const COL_POSICAO = 'passo.posicao';

    /**
     * the column name for the titulo field
     */
    const COL_TITULO = 'passo.titulo';

    /**
     * the column name for the local field
     */
    const COL_LOCAL = 'passo.local';

    /**
     * the column name for the duracao field
     */
    const COL_DURACAO = 'passo.duracao';

    /**
     * the column name for the materiais_necessarios field
     */
    const COL_MATERIAIS_NECESSARIOS = 'passo.materiais_necessarios';

    /**
     * the column name for the texto field
     */
    const COL_TEXTO = 'passo.texto';

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
        self::TYPE_PHPNAME       => array('Id', 'IdProposicao', 'Posicao', 'Titulo', 'Local', 'Duracao', 'MateriaisNecessarios', 'Texto', ),
        self::TYPE_CAMELNAME     => array('id', 'idProposicao', 'posicao', 'titulo', 'local', 'duracao', 'materiaisNecessarios', 'texto', ),
        self::TYPE_COLNAME       => array(PassoTableMap::COL_ID, PassoTableMap::COL_ID_PROPOSICAO, PassoTableMap::COL_POSICAO, PassoTableMap::COL_TITULO, PassoTableMap::COL_LOCAL, PassoTableMap::COL_DURACAO, PassoTableMap::COL_MATERIAIS_NECESSARIOS, PassoTableMap::COL_TEXTO, ),
        self::TYPE_FIELDNAME     => array('id', 'id_proposicao', 'posicao', 'titulo', 'local', 'duracao', 'materiais_necessarios', 'texto', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdProposicao' => 1, 'Posicao' => 2, 'Titulo' => 3, 'Local' => 4, 'Duracao' => 5, 'MateriaisNecessarios' => 6, 'Texto' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idProposicao' => 1, 'posicao' => 2, 'titulo' => 3, 'local' => 4, 'duracao' => 5, 'materiaisNecessarios' => 6, 'texto' => 7, ),
        self::TYPE_COLNAME       => array(PassoTableMap::COL_ID => 0, PassoTableMap::COL_ID_PROPOSICAO => 1, PassoTableMap::COL_POSICAO => 2, PassoTableMap::COL_TITULO => 3, PassoTableMap::COL_LOCAL => 4, PassoTableMap::COL_DURACAO => 5, PassoTableMap::COL_MATERIAIS_NECESSARIOS => 6, PassoTableMap::COL_TEXTO => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_proposicao' => 1, 'posicao' => 2, 'titulo' => 3, 'local' => 4, 'duracao' => 5, 'materiais_necessarios' => 6, 'texto' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('passo');
        $this->setPhpName('Passo');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Passo');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_proposicao', 'IdProposicao', 'INTEGER', 'proposicao', 'id', true, 10, null);
        $this->addColumn('posicao', 'Posicao', 'TINYINT', true, 3, null);
        $this->addColumn('titulo', 'Titulo', 'VARCHAR', true, 100, null);
        $this->addColumn('local', 'Local', 'VARCHAR', false, 100, null);
        $this->addColumn('duracao', 'Duracao', 'VARCHAR', true, 255, null);
        $this->addColumn('materiais_necessarios', 'MateriaisNecessarios', 'VARCHAR', false, 100, null);
        $this->addColumn('texto', 'Texto', 'LONGVARCHAR', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Proposicao', '\\Model\\Proposicao', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_proposicao',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
            'aggregate_column_relation_aggregate_tempo_total' => array('foreign_table' => 'proposicao', 'update_method' => 'updateTempoTotal', 'aggregate_name' => 'TempoTotal', ),
        );
    } // getBehaviors()

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
        return $withPrefix ? PassoTableMap::CLASS_DEFAULT : PassoTableMap::OM_CLASS;
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
     * @return array           (Passo object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PassoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PassoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PassoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PassoTableMap::OM_CLASS;
            /** @var Passo $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PassoTableMap::addInstanceToPool($obj, $key);
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
            $key = PassoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PassoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Passo $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PassoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PassoTableMap::COL_ID);
            $criteria->addSelectColumn(PassoTableMap::COL_ID_PROPOSICAO);
            $criteria->addSelectColumn(PassoTableMap::COL_POSICAO);
            $criteria->addSelectColumn(PassoTableMap::COL_TITULO);
            $criteria->addSelectColumn(PassoTableMap::COL_LOCAL);
            $criteria->addSelectColumn(PassoTableMap::COL_DURACAO);
            $criteria->addSelectColumn(PassoTableMap::COL_MATERIAIS_NECESSARIOS);
            $criteria->addSelectColumn(PassoTableMap::COL_TEXTO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_proposicao');
            $criteria->addSelectColumn($alias . '.posicao');
            $criteria->addSelectColumn($alias . '.titulo');
            $criteria->addSelectColumn($alias . '.local');
            $criteria->addSelectColumn($alias . '.duracao');
            $criteria->addSelectColumn($alias . '.materiais_necessarios');
            $criteria->addSelectColumn($alias . '.texto');
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
        return Propel::getServiceContainer()->getDatabaseMap(PassoTableMap::DATABASE_NAME)->getTable(PassoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PassoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PassoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PassoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Passo or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Passo object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PassoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Passo) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PassoTableMap::DATABASE_NAME);
            $criteria->add(PassoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PassoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PassoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PassoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the passo table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PassoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Passo or Criteria object.
     *
     * @param mixed               $criteria Criteria or Passo object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PassoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Passo object
        }

        if ($criteria->containsKey(PassoTableMap::COL_ID) && $criteria->keyContainsValue(PassoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PassoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PassoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PassoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PassoTableMap::buildTableMap();
