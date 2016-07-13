<?php

namespace Model\Map;

use Model\Pedido;
use Model\PedidoQuery;
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
 * This class defines the structure of the 'pedido' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PedidoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Model.Map.PedidoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'pedido';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Model\\Pedido';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Model.Pedido';

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
    const COL_ID = 'pedido.id';

    /**
     * the column name for the codigo field
     */
    const COL_CODIGO = 'pedido.codigo';

    /**
     * the column name for the id_cliente field
     */
    const COL_ID_CLIENTE = 'pedido.id_cliente';

    /**
     * the column name for the data_pedido field
     */
    const COL_DATA_PEDIDO = 'pedido.data_pedido';

    /**
     * the column name for the data_entrega field
     */
    const COL_DATA_ENTREGA = 'pedido.data_entrega';

    /**
     * the column name for the valor_cobrado field
     */
    const COL_VALOR_COBRADO = 'pedido.valor_cobrado';

    /**
     * the column name for the custo field
     */
    const COL_CUSTO = 'pedido.custo';

    /**
     * the column name for the lucro field
     */
    const COL_LUCRO = 'pedido.lucro';

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
        self::TYPE_PHPNAME       => array('Id', 'Codigo', 'IdCliente', 'DataPedido', 'DataEntrega', 'ValorCobrado', 'Custo', 'Lucro', ),
        self::TYPE_CAMELNAME     => array('id', 'codigo', 'idCliente', 'dataPedido', 'dataEntrega', 'valorCobrado', 'custo', 'lucro', ),
        self::TYPE_COLNAME       => array(PedidoTableMap::COL_ID, PedidoTableMap::COL_CODIGO, PedidoTableMap::COL_ID_CLIENTE, PedidoTableMap::COL_DATA_PEDIDO, PedidoTableMap::COL_DATA_ENTREGA, PedidoTableMap::COL_VALOR_COBRADO, PedidoTableMap::COL_CUSTO, PedidoTableMap::COL_LUCRO, ),
        self::TYPE_FIELDNAME     => array('id', 'codigo', 'id_cliente', 'data_pedido', 'data_entrega', 'valor_cobrado', 'custo', 'lucro', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Codigo' => 1, 'IdCliente' => 2, 'DataPedido' => 3, 'DataEntrega' => 4, 'ValorCobrado' => 5, 'Custo' => 6, 'Lucro' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'codigo' => 1, 'idCliente' => 2, 'dataPedido' => 3, 'dataEntrega' => 4, 'valorCobrado' => 5, 'custo' => 6, 'lucro' => 7, ),
        self::TYPE_COLNAME       => array(PedidoTableMap::COL_ID => 0, PedidoTableMap::COL_CODIGO => 1, PedidoTableMap::COL_ID_CLIENTE => 2, PedidoTableMap::COL_DATA_PEDIDO => 3, PedidoTableMap::COL_DATA_ENTREGA => 4, PedidoTableMap::COL_VALOR_COBRADO => 5, PedidoTableMap::COL_CUSTO => 6, PedidoTableMap::COL_LUCRO => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'codigo' => 1, 'id_cliente' => 2, 'data_pedido' => 3, 'data_entrega' => 4, 'valor_cobrado' => 5, 'custo' => 6, 'lucro' => 7, ),
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
        $this->setName('pedido');
        $this->setPhpName('Pedido');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Model\\Pedido');
        $this->setPackage('Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('codigo', 'Codigo', 'VARCHAR', true, 45, null);
        $this->addForeignKey('id_cliente', 'IdCliente', 'INTEGER', 'cliente', 'id', true, 10, null);
        $this->addColumn('data_pedido', 'DataPedido', 'TIMESTAMP', true, null, null);
        $this->addColumn('data_entrega', 'DataEntrega', 'TIMESTAMP', false, null, null);
        $this->addColumn('valor_cobrado', 'ValorCobrado', 'DECIMAL', true, null, null);
        $this->addColumn('custo', 'Custo', 'DECIMAL', false, null, null);
        $this->addColumn('lucro', 'Lucro', 'DECIMAL', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Cliente', '\\Model\\Cliente', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_cliente',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Producao', '\\Model\\Producao', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_pedido',
    1 => ':id',
  ),
), null, null, 'Producaos', false);
    } // buildRelations()

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

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return $withPrefix ? PedidoTableMap::CLASS_DEFAULT : PedidoTableMap::OM_CLASS;
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
     * @return array           (Pedido object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PedidoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PedidoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PedidoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PedidoTableMap::OM_CLASS;
            /** @var Pedido $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PedidoTableMap::addInstanceToPool($obj, $key);
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
            $key = PedidoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PedidoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pedido $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PedidoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PedidoTableMap::COL_ID);
            $criteria->addSelectColumn(PedidoTableMap::COL_CODIGO);
            $criteria->addSelectColumn(PedidoTableMap::COL_ID_CLIENTE);
            $criteria->addSelectColumn(PedidoTableMap::COL_DATA_PEDIDO);
            $criteria->addSelectColumn(PedidoTableMap::COL_DATA_ENTREGA);
            $criteria->addSelectColumn(PedidoTableMap::COL_VALOR_COBRADO);
            $criteria->addSelectColumn(PedidoTableMap::COL_CUSTO);
            $criteria->addSelectColumn(PedidoTableMap::COL_LUCRO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.codigo');
            $criteria->addSelectColumn($alias . '.id_cliente');
            $criteria->addSelectColumn($alias . '.data_pedido');
            $criteria->addSelectColumn($alias . '.data_entrega');
            $criteria->addSelectColumn($alias . '.valor_cobrado');
            $criteria->addSelectColumn($alias . '.custo');
            $criteria->addSelectColumn($alias . '.lucro');
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
        return Propel::getServiceContainer()->getDatabaseMap(PedidoTableMap::DATABASE_NAME)->getTable(PedidoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PedidoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PedidoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PedidoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Pedido or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Pedido object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Model\Pedido) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PedidoTableMap::DATABASE_NAME);
            $criteria->add(PedidoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PedidoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PedidoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PedidoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pedido table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PedidoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pedido or Criteria object.
     *
     * @param mixed               $criteria Criteria or Pedido object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pedido object
        }

        if ($criteria->containsKey(PedidoTableMap::COL_ID) && $criteria->keyContainsValue(PedidoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PedidoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PedidoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PedidoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PedidoTableMap::buildTableMap();
