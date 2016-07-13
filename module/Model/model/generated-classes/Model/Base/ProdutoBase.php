<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Ingrediente as ChildIngrediente;
use Model\IngredienteQuery as ChildIngredienteQuery;
use Model\Marca as ChildMarca;
use Model\MarcaQuery as ChildMarcaQuery;
use Model\Produto as ChildProduto;
use Model\ProdutoBase as ChildProdutoBase;
use Model\ProdutoBaseQuery as ChildProdutoBaseQuery;
use Model\ProdutoQuery as ChildProdutoQuery;
use Model\Unidade as ChildUnidade;
use Model\UnidadeQuery as ChildUnidadeQuery;
use Model\Map\ProdutoBaseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'produto_base' table.
 *
 * 
 *
* @package    propel.generator.Model.Base
*/
abstract class ProdutoBase implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\ProdutoBaseTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the id_ingrediente field.
     * @var        int
     */
    protected $id_ingrediente;

    /**
     * The value for the id_marca field.
     * @var        int
     */
    protected $id_marca;

    /**
     * The value for the nome field.
     * @var        string
     */
    protected $nome;

    /**
     * The value for the quantidade field.
     * @var        string
     */
    protected $quantidade;

    /**
     * The value for the id_unidade field.
     * @var        int
     */
    protected $id_unidade;

    /**
     * @var        ChildIngrediente
     */
    protected $aIngrediente;

    /**
     * @var        ChildMarca
     */
    protected $aMarca;

    /**
     * @var        ChildUnidade
     */
    protected $aUnidade;

    /**
     * @var        ObjectCollection|ChildProduto[] Collection to store aggregation of ChildProduto objects.
     */
    protected $collProdutos;
    protected $collProdutosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProduto[]
     */
    protected $produtosScheduledForDeletion = null;

    /**
     * Initializes internal state of Model\Base\ProdutoBase object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>ProdutoBase</code> instance.  If
     * <code>obj</code> is an instance of <code>ProdutoBase</code>, delegates to
     * <code>equals(ProdutoBase)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|ProdutoBase The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [id_ingrediente] column value.
     * 
     * @return int
     */
    public function getIdIngrediente()
    {
        return $this->id_ingrediente;
    }

    /**
     * Get the [id_marca] column value.
     * 
     * @return int
     */
    public function getIdMarca()
    {
        return $this->id_marca;
    }

    /**
     * Get the [nome] column value.
     * 
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [quantidade] column value.
     * 
     * @return string
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Get the [id_unidade] column value.
     * 
     * @return int
     */
    public function getIdUnidade()
    {
        return $this->id_unidade;
    }

    /**
     * Set the value of [id] column.
     * 
     * @param int $v new value
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProdutoBaseTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_ingrediente] column.
     * 
     * @param int $v new value
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function setIdIngrediente($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_ingrediente !== $v) {
            $this->id_ingrediente = $v;
            $this->modifiedColumns[ProdutoBaseTableMap::COL_ID_INGREDIENTE] = true;
        }

        if ($this->aIngrediente !== null && $this->aIngrediente->getId() !== $v) {
            $this->aIngrediente = null;
        }

        return $this;
    } // setIdIngrediente()

    /**
     * Set the value of [id_marca] column.
     * 
     * @param int $v new value
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function setIdMarca($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_marca !== $v) {
            $this->id_marca = $v;
            $this->modifiedColumns[ProdutoBaseTableMap::COL_ID_MARCA] = true;
        }

        if ($this->aMarca !== null && $this->aMarca->getId() !== $v) {
            $this->aMarca = null;
        }

        return $this;
    } // setIdMarca()

    /**
     * Set the value of [nome] column.
     * 
     * @param string $v new value
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[ProdutoBaseTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [quantidade] column.
     * 
     * @param string $v new value
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function setQuantidade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->quantidade !== $v) {
            $this->quantidade = $v;
            $this->modifiedColumns[ProdutoBaseTableMap::COL_QUANTIDADE] = true;
        }

        return $this;
    } // setQuantidade()

    /**
     * Set the value of [id_unidade] column.
     * 
     * @param int $v new value
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function setIdUnidade($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_unidade !== $v) {
            $this->id_unidade = $v;
            $this->modifiedColumns[ProdutoBaseTableMap::COL_ID_UNIDADE] = true;
        }

        if ($this->aUnidade !== null && $this->aUnidade->getId() !== $v) {
            $this->aUnidade = null;
        }

        return $this;
    } // setIdUnidade()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProdutoBaseTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProdutoBaseTableMap::translateFieldName('IdIngrediente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_ingrediente = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProdutoBaseTableMap::translateFieldName('IdMarca', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_marca = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProdutoBaseTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProdutoBaseTableMap::translateFieldName('Quantidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProdutoBaseTableMap::translateFieldName('IdUnidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_unidade = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = ProdutoBaseTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\ProdutoBase'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aIngrediente !== null && $this->id_ingrediente !== $this->aIngrediente->getId()) {
            $this->aIngrediente = null;
        }
        if ($this->aMarca !== null && $this->id_marca !== $this->aMarca->getId()) {
            $this->aMarca = null;
        }
        if ($this->aUnidade !== null && $this->id_unidade !== $this->aUnidade->getId()) {
            $this->aUnidade = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProdutoBaseTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProdutoBaseQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aIngrediente = null;
            $this->aMarca = null;
            $this->aUnidade = null;
            $this->collProdutos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ProdutoBase::setDeleted()
     * @see ProdutoBase::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoBaseTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProdutoBaseQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoBaseTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProdutoBaseTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aIngrediente !== null) {
                if ($this->aIngrediente->isModified() || $this->aIngrediente->isNew()) {
                    $affectedRows += $this->aIngrediente->save($con);
                }
                $this->setIngrediente($this->aIngrediente);
            }

            if ($this->aMarca !== null) {
                if ($this->aMarca->isModified() || $this->aMarca->isNew()) {
                    $affectedRows += $this->aMarca->save($con);
                }
                $this->setMarca($this->aMarca);
            }

            if ($this->aUnidade !== null) {
                if ($this->aUnidade->isModified() || $this->aUnidade->isNew()) {
                    $affectedRows += $this->aUnidade->save($con);
                }
                $this->setUnidade($this->aUnidade);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->produtosScheduledForDeletion !== null) {
                if (!$this->produtosScheduledForDeletion->isEmpty()) {
                    \Model\ProdutoQuery::create()
                        ->filterByPrimaryKeys($this->produtosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->produtosScheduledForDeletion = null;
                }
            }

            if ($this->collProdutos !== null) {
                foreach ($this->collProdutos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ProdutoBaseTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProdutoBaseTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID_INGREDIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'id_ingrediente';
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID_MARCA)) {
            $modifiedColumns[':p' . $index++]  = 'id_marca';
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_QUANTIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'quantidade';
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID_UNIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'id_unidade';
        }

        $sql = sprintf(
            'INSERT INTO produto_base (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':                        
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'id_ingrediente':                        
                        $stmt->bindValue($identifier, $this->id_ingrediente, PDO::PARAM_INT);
                        break;
                    case 'id_marca':                        
                        $stmt->bindValue($identifier, $this->id_marca, PDO::PARAM_INT);
                        break;
                    case 'nome':                        
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'quantidade':                        
                        $stmt->bindValue($identifier, $this->quantidade, PDO::PARAM_STR);
                        break;
                    case 'id_unidade':                        
                        $stmt->bindValue($identifier, $this->id_unidade, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProdutoBaseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getIdIngrediente();
                break;
            case 2:
                return $this->getIdMarca();
                break;
            case 3:
                return $this->getNome();
                break;
            case 4:
                return $this->getQuantidade();
                break;
            case 5:
                return $this->getIdUnidade();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['ProdutoBase'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ProdutoBase'][$this->hashCode()] = true;
        $keys = ProdutoBaseTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdIngrediente(),
            $keys[2] => $this->getIdMarca(),
            $keys[3] => $this->getNome(),
            $keys[4] => $this->getQuantidade(),
            $keys[5] => $this->getIdUnidade(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aIngrediente) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ingrediente';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ingrediente';
                        break;
                    default:
                        $key = 'Ingrediente';
                }
        
                $result[$key] = $this->aIngrediente->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMarca) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'marca';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'marca';
                        break;
                    default:
                        $key = 'Marca';
                }
        
                $result[$key] = $this->aMarca->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUnidade) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'unidade';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'unidade';
                        break;
                    default:
                        $key = 'Unidade';
                }
        
                $result[$key] = $this->aUnidade->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProdutos) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'produtos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'produtos';
                        break;
                    default:
                        $key = 'Produtos';
                }
        
                $result[$key] = $this->collProdutos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Model\ProdutoBase
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProdutoBaseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\ProdutoBase
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdIngrediente($value);
                break;
            case 2:
                $this->setIdMarca($value);
                break;
            case 3:
                $this->setNome($value);
                break;
            case 4:
                $this->setQuantidade($value);
                break;
            case 5:
                $this->setIdUnidade($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProdutoBaseTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdIngrediente($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdMarca($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNome($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setQuantidade($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIdUnidade($arr[$keys[5]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Model\ProdutoBase The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProdutoBaseTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID)) {
            $criteria->add(ProdutoBaseTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID_INGREDIENTE)) {
            $criteria->add(ProdutoBaseTableMap::COL_ID_INGREDIENTE, $this->id_ingrediente);
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID_MARCA)) {
            $criteria->add(ProdutoBaseTableMap::COL_ID_MARCA, $this->id_marca);
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_NOME)) {
            $criteria->add(ProdutoBaseTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_QUANTIDADE)) {
            $criteria->add(ProdutoBaseTableMap::COL_QUANTIDADE, $this->quantidade);
        }
        if ($this->isColumnModified(ProdutoBaseTableMap::COL_ID_UNIDADE)) {
            $criteria->add(ProdutoBaseTableMap::COL_ID_UNIDADE, $this->id_unidade);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildProdutoBaseQuery::create();
        $criteria->add(ProdutoBaseTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\ProdutoBase (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdIngrediente($this->getIdIngrediente());
        $copyObj->setIdMarca($this->getIdMarca());
        $copyObj->setNome($this->getNome());
        $copyObj->setQuantidade($this->getQuantidade());
        $copyObj->setIdUnidade($this->getIdUnidade());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProdutos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProduto($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Model\ProdutoBase Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildIngrediente object.
     *
     * @param  ChildIngrediente $v
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setIngrediente(ChildIngrediente $v = null)
    {
        if ($v === null) {
            $this->setIdIngrediente(NULL);
        } else {
            $this->setIdIngrediente($v->getId());
        }

        $this->aIngrediente = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildIngrediente object, it will not be re-added.
        if ($v !== null) {
            $v->addProdutoBase($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildIngrediente object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildIngrediente The associated ChildIngrediente object.
     * @throws PropelException
     */
    public function getIngrediente(ConnectionInterface $con = null)
    {
        if ($this->aIngrediente === null && ($this->id_ingrediente !== null)) {
            $this->aIngrediente = ChildIngredienteQuery::create()->findPk($this->id_ingrediente, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aIngrediente->addProdutoBases($this);
             */
        }

        return $this->aIngrediente;
    }

    /**
     * Declares an association between this object and a ChildMarca object.
     *
     * @param  ChildMarca $v
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMarca(ChildMarca $v = null)
    {
        if ($v === null) {
            $this->setIdMarca(NULL);
        } else {
            $this->setIdMarca($v->getId());
        }

        $this->aMarca = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMarca object, it will not be re-added.
        if ($v !== null) {
            $v->addProdutoBase($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMarca object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildMarca The associated ChildMarca object.
     * @throws PropelException
     */
    public function getMarca(ConnectionInterface $con = null)
    {
        if ($this->aMarca === null && ($this->id_marca !== null)) {
            $this->aMarca = ChildMarcaQuery::create()->findPk($this->id_marca, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMarca->addProdutoBases($this);
             */
        }

        return $this->aMarca;
    }

    /**
     * Declares an association between this object and a ChildUnidade object.
     *
     * @param  ChildUnidade $v
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUnidade(ChildUnidade $v = null)
    {
        if ($v === null) {
            $this->setIdUnidade(NULL);
        } else {
            $this->setIdUnidade($v->getId());
        }

        $this->aUnidade = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUnidade object, it will not be re-added.
        if ($v !== null) {
            $v->addProdutoBase($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUnidade object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUnidade The associated ChildUnidade object.
     * @throws PropelException
     */
    public function getUnidade(ConnectionInterface $con = null)
    {
        if ($this->aUnidade === null && ($this->id_unidade !== null)) {
            $this->aUnidade = ChildUnidadeQuery::create()->findPk($this->id_unidade, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUnidade->addProdutoBases($this);
             */
        }

        return $this->aUnidade;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Produto' == $relationName) {
            return $this->initProdutos();
        }
    }

    /**
     * Clears out the collProdutos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProdutos()
     */
    public function clearProdutos()
    {
        $this->collProdutos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProdutos collection loaded partially.
     */
    public function resetPartialProdutos($v = true)
    {
        $this->collProdutosPartial = $v;
    }

    /**
     * Initializes the collProdutos collection.
     *
     * By default this just sets the collProdutos collection to an empty array (like clearcollProdutos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProdutos($overrideExisting = true)
    {
        if (null !== $this->collProdutos && !$overrideExisting) {
            return;
        }
        $this->collProdutos = new ObjectCollection();
        $this->collProdutos->setModel('\Model\Produto');
    }

    /**
     * Gets an array of ChildProduto objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProdutoBase is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProduto[] List of ChildProduto objects
     * @throws PropelException
     */
    public function getProdutos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProdutosPartial && !$this->isNew();
        if (null === $this->collProdutos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProdutos) {
                // return empty collection
                $this->initProdutos();
            } else {
                $collProdutos = ChildProdutoQuery::create(null, $criteria)
                    ->filterByProdutoBase($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProdutosPartial && count($collProdutos)) {
                        $this->initProdutos(false);

                        foreach ($collProdutos as $obj) {
                            if (false == $this->collProdutos->contains($obj)) {
                                $this->collProdutos->append($obj);
                            }
                        }

                        $this->collProdutosPartial = true;
                    }

                    return $collProdutos;
                }

                if ($partial && $this->collProdutos) {
                    foreach ($this->collProdutos as $obj) {
                        if ($obj->isNew()) {
                            $collProdutos[] = $obj;
                        }
                    }
                }

                $this->collProdutos = $collProdutos;
                $this->collProdutosPartial = false;
            }
        }

        return $this->collProdutos;
    }

    /**
     * Sets a collection of ChildProduto objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $produtos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProdutoBase The current object (for fluent API support)
     */
    public function setProdutos(Collection $produtos, ConnectionInterface $con = null)
    {
        /** @var ChildProduto[] $produtosToDelete */
        $produtosToDelete = $this->getProdutos(new Criteria(), $con)->diff($produtos);

        
        $this->produtosScheduledForDeletion = $produtosToDelete;

        foreach ($produtosToDelete as $produtoRemoved) {
            $produtoRemoved->setProdutoBase(null);
        }

        $this->collProdutos = null;
        foreach ($produtos as $produto) {
            $this->addProduto($produto);
        }

        $this->collProdutos = $produtos;
        $this->collProdutosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Produto objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Produto objects.
     * @throws PropelException
     */
    public function countProdutos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProdutosPartial && !$this->isNew();
        if (null === $this->collProdutos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProdutos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProdutos());
            }

            $query = ChildProdutoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProdutoBase($this)
                ->count($con);
        }

        return count($this->collProdutos);
    }

    /**
     * Method called to associate a ChildProduto object to this object
     * through the ChildProduto foreign key attribute.
     *
     * @param  ChildProduto $l ChildProduto
     * @return $this|\Model\ProdutoBase The current object (for fluent API support)
     */
    public function addProduto(ChildProduto $l)
    {
        if ($this->collProdutos === null) {
            $this->initProdutos();
            $this->collProdutosPartial = true;
        }

        if (!$this->collProdutos->contains($l)) {
            $this->doAddProduto($l);
        }

        return $this;
    }

    /**
     * @param ChildProduto $produto The ChildProduto object to add.
     */
    protected function doAddProduto(ChildProduto $produto)
    {
        $this->collProdutos[]= $produto;
        $produto->setProdutoBase($this);
    }

    /**
     * @param  ChildProduto $produto The ChildProduto object to remove.
     * @return $this|ChildProdutoBase The current object (for fluent API support)
     */
    public function removeProduto(ChildProduto $produto)
    {
        if ($this->getProdutos()->contains($produto)) {
            $pos = $this->collProdutos->search($produto);
            $this->collProdutos->remove($pos);
            if (null === $this->produtosScheduledForDeletion) {
                $this->produtosScheduledForDeletion = clone $this->collProdutos;
                $this->produtosScheduledForDeletion->clear();
            }
            $this->produtosScheduledForDeletion[]= clone $produto;
            $produto->setProdutoBase(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProdutoBase is new, it will return
     * an empty collection; or if this ProdutoBase has previously
     * been saved, it will retrieve related Produtos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProdutoBase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProduto[] List of ChildProduto objects
     */
    public function getProdutosJoinLocal(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProdutoQuery::create(null, $criteria);
        $query->joinWith('Local', $joinBehavior);

        return $this->getProdutos($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aIngrediente) {
            $this->aIngrediente->removeProdutoBase($this);
        }
        if (null !== $this->aMarca) {
            $this->aMarca->removeProdutoBase($this);
        }
        if (null !== $this->aUnidade) {
            $this->aUnidade->removeProdutoBase($this);
        }
        $this->id = null;
        $this->id_ingrediente = null;
        $this->id_marca = null;
        $this->nome = null;
        $this->quantidade = null;
        $this->id_unidade = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collProdutos) {
                foreach ($this->collProdutos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProdutos = null;
        $this->aIngrediente = null;
        $this->aMarca = null;
        $this->aUnidade = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProdutoBaseTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
