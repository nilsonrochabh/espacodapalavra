<?php

namespace Model\Map;

use Model\IngredienteReceita;
use Model\IngredienteReceitaQuery;
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
 * This class defines the structure of the 'ingrediente_receita' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class IngredienteReceitaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.IngredienteReceitaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ingrediente_receita';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\IngredienteReceita';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.IngredienteReceita';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_ingrediente field
     */
    const COL_ID_INGREDIENTE = 'ingrediente_receita.id_ingrediente';

    /**
     * the column name for the id_receita field
     */
    const COL_ID_RECEITA = 'ingrediente_receita.id_receita';

    /**
     * the column name for the quantidade field
     */
    const COL_QUANTIDADE = 'ingrediente_receita.quantidade';

    /**
     * the column name for the id_unidade field
     */
    const COL_ID_UNIDADE = 'ingrediente_receita.id_unidade';

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
        self::TYPE_PHPNAME       => array('IdIngrediente', 'IdReceita', 'Quantidade', 'IdUnidade', ),
        self::TYPE_CAMELNAME     => array('idIngrediente', 'idReceita', 'quantidade', 'idUnidade', ),
        self::TYPE_COLNAME       => array(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, IngredienteReceitaTableMap::COL_ID_RECEITA, IngredienteReceitaTableMap::COL_QUANTIDADE, IngredienteReceitaTableMap::COL_ID_UNIDADE, ),
        self::TYPE_FIELDNAME     => array('id_ingrediente', 'id_receita', 'quantidade', 'id_unidade', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdIngrediente' => 0, 'IdReceita' => 1, 'Quantidade' => 2, 'IdUnidade' => 3, ),
        self::TYPE_CAMELNAME     => array('idIngrediente' => 0, 'idReceita' => 1, 'quantidade' => 2, 'idUnidade' => 3, ),
        self::TYPE_COLNAME       => array(IngredienteReceitaTableMap::COL_ID_INGREDIENTE => 0, IngredienteReceitaTableMap::COL_ID_RECEITA => 1, IngredienteReceitaTableMap::COL_QUANTIDADE => 2, IngredienteReceitaTableMap::COL_ID_UNIDADE => 3, ),
        self::TYPE_FIELDNAME     => array('id_ingrediente' => 0, 'id_receita' => 1, 'quantidade' => 2, 'id_unidade' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('ingrediente_receita');
        $this->setPhpName('IngredienteReceita');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\IngredienteReceita');
        $this->setPackage('Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id_ingrediente', 'IdIngrediente', 'INTEGER' , 'ingrediente', 'id', true, 10, null);
        $this->addForeignPrimaryKey('id_receita', 'IdReceita', 'INTEGER' , 'receita', 'id', true, 10, null);
        $this->addColumn('quantidade', 'Quantidade', 'DECIMAL', true, null, null);
        $this->addForeignKey('id_unidade', 'IdUnidade', 'INTEGER', 'unidade', 'id', true, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ingrediente', '\\Model\\Ingrediente', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_ingrediente',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Receita', '\\Model\\Receita', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_receita',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Unidade', '\\Model\\Unidade', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_unidade',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Model\IngredienteReceita $obj A \Model\IngredienteReceita object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getIdIngrediente(), (string) $obj->getIdReceita()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Model\IngredienteReceita object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Model\IngredienteReceita) {
                $key = serialize(array((string) $value->getIdIngrediente(), (string) $value->getIdReceita()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Model\IngredienteReceita object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdIngrediente', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdReceita', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdIngrediente', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('IdReceita', TableMap::TYPE_PHPNAME, $indexType)]));
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
            $pks = [];
            
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdIngrediente', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('IdReceita', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? IngredienteReceitaTableMap::CLASS_DEFAULT : IngredienteReceitaTableMap::OM_CLASS;
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
     * @return array           (IngredienteReceita object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = IngredienteReceitaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = IngredienteReceitaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + IngredienteReceitaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = IngredienteReceitaTableMap::OM_CLASS;
            /** @var IngredienteReceita $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            IngredienteReceitaTableMap::addInstanceToPool($obj, $key);
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
            $key = IngredienteReceitaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = IngredienteReceitaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var IngredienteReceita $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                IngredienteReceitaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(IngredienteReceitaTableMap::COL_ID_INGREDIENTE);
            $criteria->addSelectColumn(IngredienteReceitaTableMap::COL_ID_RECEITA);
            $criteria->addSelectColumn(IngredienteReceitaTableMap::COL_QUANTIDADE);
            $criteria->addSelectColumn(IngredienteReceitaTableMap::COL_ID_UNIDADE);
        } else {
            $criteria->addSelectColumn($alias . '.id_ingrediente');
            $criteria->addSelectColumn($alias . '.id_receita');
            $criteria->addSelectColumn($alias . '.quantidade');
            $criteria->addSelectColumn($alias . '.id_unidade');
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
        return Propel::getServiceContainer()->getDatabaseMap(IngredienteReceitaTableMap::DATABASE_NAME)->getTable(IngredienteReceitaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(IngredienteReceitaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(IngredienteReceitaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new IngredienteReceitaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a IngredienteReceita or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or IngredienteReceita object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(IngredienteReceitaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\IngredienteReceita) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(IngredienteReceitaTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(IngredienteReceitaTableMap::COL_ID_RECEITA, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = IngredienteReceitaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            IngredienteReceitaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                IngredienteReceitaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ingrediente_receita table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return IngredienteReceitaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a IngredienteReceita or Criteria object.
     *
     * @param mixed               $criteria Criteria or IngredienteReceita object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredienteReceitaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from IngredienteReceita object
        }


        // Set the correct dbName
        $query = IngredienteReceitaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // IngredienteReceitaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
IngredienteReceitaTableMap::buildTableMap();
