<?php

namespace Model\Base;

use \Exception;
use \PDO;
use Model\Ingrediente as ChildIngrediente;
use Model\IngredienteQuery as ChildIngredienteQuery;
use Model\IngredienteReceitaQuery as ChildIngredienteReceitaQuery;
use Model\Receita as ChildReceita;
use Model\ReceitaQuery as ChildReceitaQuery;
use Model\Unidade as ChildUnidade;
use Model\UnidadeQuery as ChildUnidadeQuery;
use Model\Map\IngredienteReceitaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'ingrediente_receita' table.
 *
 * 
 *
* @package    propel.generator.Model.Base
*/
abstract class IngredienteReceita implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\IngredienteReceitaTableMap';


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
     * The value for the id_ingrediente field.
     * @var        int
     */
    protected $id_ingrediente;

    /**
     * The value for the id_receita field.
     * @var        int
     */
    protected $id_receita;

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
     * @var        ChildReceita
     */
    protected $aReceita;

    /**
     * @var        ChildUnidade
     */
    protected $aUnidade;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Model\Base\IngredienteReceita object.
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
     * Compares this with another <code>IngredienteReceita</code> instance.  If
     * <code>obj</code> is an instance of <code>IngredienteReceita</code>, delegates to
     * <code>equals(IngredienteReceita)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|IngredienteReceita The current object, for fluid interface
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
     * Get the [id_ingrediente] column value.
     * 
     * @return int
     */
    public function getIdIngrediente()
    {
        return $this->id_ingrediente;
    }

    /**
     * Get the [id_receita] column value.
     * 
     * @return int
     */
    public function getIdReceita()
    {
        return $this->id_receita;
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
     * Set the value of [id_ingrediente] column.
     * 
     * @param int $v new value
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
     */
    public function setIdIngrediente($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_ingrediente !== $v) {
            $this->id_ingrediente = $v;
            $this->modifiedColumns[IngredienteReceitaTableMap::COL_ID_INGREDIENTE] = true;
        }

        if ($this->aIngrediente !== null && $this->aIngrediente->getId() !== $v) {
            $this->aIngrediente = null;
        }

        return $this;
    } // setIdIngrediente()

    /**
     * Set the value of [id_receita] column.
     * 
     * @param int $v new value
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
     */
    public function setIdReceita($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_receita !== $v) {
            $this->id_receita = $v;
            $this->modifiedColumns[IngredienteReceitaTableMap::COL_ID_RECEITA] = true;
        }

        if ($this->aReceita !== null && $this->aReceita->getId() !== $v) {
            $this->aReceita = null;
        }

        return $this;
    } // setIdReceita()

    /**
     * Set the value of [quantidade] column.
     * 
     * @param string $v new value
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
     */
    public function setQuantidade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->quantidade !== $v) {
            $this->quantidade = $v;
            $this->modifiedColumns[IngredienteReceitaTableMap::COL_QUANTIDADE] = true;
        }

        return $this;
    } // setQuantidade()

    /**
     * Set the value of [id_unidade] column.
     * 
     * @param int $v new value
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
     */
    public function setIdUnidade($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_unidade !== $v) {
            $this->id_unidade = $v;
            $this->modifiedColumns[IngredienteReceitaTableMap::COL_ID_UNIDADE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : IngredienteReceitaTableMap::translateFieldName('IdIngrediente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_ingrediente = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : IngredienteReceitaTableMap::translateFieldName('IdReceita', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_receita = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : IngredienteReceitaTableMap::translateFieldName('Quantidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : IngredienteReceitaTableMap::translateFieldName('IdUnidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_unidade = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = IngredienteReceitaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\IngredienteReceita'), 0, $e);
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
        if ($this->aReceita !== null && $this->id_receita !== $this->aReceita->getId()) {
            $this->aReceita = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(IngredienteReceitaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildIngredienteReceitaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aIngrediente = null;
            $this->aReceita = null;
            $this->aUnidade = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see IngredienteReceita::setDeleted()
     * @see IngredienteReceita::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(IngredienteReceitaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildIngredienteReceitaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(IngredienteReceitaTableMap::DATABASE_NAME);
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
                IngredienteReceitaTableMap::addInstanceToPool($this);
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

            if ($this->aReceita !== null) {
                if ($this->aReceita->isModified() || $this->aReceita->isNew()) {
                    $affectedRows += $this->aReceita->save($con);
                }
                $this->setReceita($this->aReceita);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_ID_INGREDIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'id_ingrediente';
        }
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_ID_RECEITA)) {
            $modifiedColumns[':p' . $index++]  = 'id_receita';
        }
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_QUANTIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'quantidade';
        }
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_ID_UNIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'id_unidade';
        }

        $sql = sprintf(
            'INSERT INTO ingrediente_receita (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_ingrediente':                        
                        $stmt->bindValue($identifier, $this->id_ingrediente, PDO::PARAM_INT);
                        break;
                    case 'id_receita':                        
                        $stmt->bindValue($identifier, $this->id_receita, PDO::PARAM_INT);
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
        $pos = IngredienteReceitaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdIngrediente();
                break;
            case 1:
                return $this->getIdReceita();
                break;
            case 2:
                return $this->getQuantidade();
                break;
            case 3:
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

        if (isset($alreadyDumpedObjects['IngredienteReceita'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['IngredienteReceita'][$this->hashCode()] = true;
        $keys = IngredienteReceitaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdIngrediente(),
            $keys[1] => $this->getIdReceita(),
            $keys[2] => $this->getQuantidade(),
            $keys[3] => $this->getIdUnidade(),
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
            if (null !== $this->aReceita) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'receita';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'receita';
                        break;
                    default:
                        $key = 'Receita';
                }
        
                $result[$key] = $this->aReceita->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Model\IngredienteReceita
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = IngredienteReceitaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\IngredienteReceita
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdIngrediente($value);
                break;
            case 1:
                $this->setIdReceita($value);
                break;
            case 2:
                $this->setQuantidade($value);
                break;
            case 3:
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
        $keys = IngredienteReceitaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdIngrediente($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdReceita($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setQuantidade($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdUnidade($arr[$keys[3]]);
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
     * @return $this|\Model\IngredienteReceita The current object, for fluid interface
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
        $criteria = new Criteria(IngredienteReceitaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_ID_INGREDIENTE)) {
            $criteria->add(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $this->id_ingrediente);
        }
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_ID_RECEITA)) {
            $criteria->add(IngredienteReceitaTableMap::COL_ID_RECEITA, $this->id_receita);
        }
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_QUANTIDADE)) {
            $criteria->add(IngredienteReceitaTableMap::COL_QUANTIDADE, $this->quantidade);
        }
        if ($this->isColumnModified(IngredienteReceitaTableMap::COL_ID_UNIDADE)) {
            $criteria->add(IngredienteReceitaTableMap::COL_ID_UNIDADE, $this->id_unidade);
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
        $criteria = ChildIngredienteReceitaQuery::create();
        $criteria->add(IngredienteReceitaTableMap::COL_ID_INGREDIENTE, $this->id_ingrediente);
        $criteria->add(IngredienteReceitaTableMap::COL_ID_RECEITA, $this->id_receita);

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
        $validPk = null !== $this->getIdIngrediente() &&
            null !== $this->getIdReceita();

        $validPrimaryKeyFKs = 2;
        $primaryKeyFKs = [];

        //relation fk_ingrediente_has_receita_ingrediente1 to table ingrediente
        if ($this->aIngrediente && $hash = spl_object_hash($this->aIngrediente)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        //relation fk_ingrediente_has_receita_receita1 to table receita
        if ($this->aReceita && $hash = spl_object_hash($this->aReceita)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getIdIngrediente();
        $pks[1] = $this->getIdReceita();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setIdIngrediente($keys[0]);
        $this->setIdReceita($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getIdIngrediente()) && (null === $this->getIdReceita());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Model\IngredienteReceita (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdIngrediente($this->getIdIngrediente());
        $copyObj->setIdReceita($this->getIdReceita());
        $copyObj->setQuantidade($this->getQuantidade());
        $copyObj->setIdUnidade($this->getIdUnidade());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \Model\IngredienteReceita Clone of current object.
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
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
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
            $v->addIngredienteReceita($this);
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
                $this->aIngrediente->addIngredienteReceitas($this);
             */
        }

        return $this->aIngrediente;
    }

    /**
     * Declares an association between this object and a ChildReceita object.
     *
     * @param  ChildReceita $v
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
     * @throws PropelException
     */
    public function setReceita(ChildReceita $v = null)
    {
        if ($v === null) {
            $this->setIdReceita(NULL);
        } else {
            $this->setIdReceita($v->getId());
        }

        $this->aReceita = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildReceita object, it will not be re-added.
        if ($v !== null) {
            $v->addIngredienteReceita($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildReceita object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildReceita The associated ChildReceita object.
     * @throws PropelException
     */
    public function getReceita(ConnectionInterface $con = null)
    {
        if ($this->aReceita === null && ($this->id_receita !== null)) {
            $this->aReceita = ChildReceitaQuery::create()->findPk($this->id_receita, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aReceita->addIngredienteReceitas($this);
             */
        }

        return $this->aReceita;
    }

    /**
     * Declares an association between this object and a ChildUnidade object.
     *
     * @param  ChildUnidade $v
     * @return $this|\Model\IngredienteReceita The current object (for fluent API support)
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
            $v->addIngredienteReceita($this);
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
                $this->aUnidade->addIngredienteReceitas($this);
             */
        }

        return $this->aUnidade;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aIngrediente) {
            $this->aIngrediente->removeIngredienteReceita($this);
        }
        if (null !== $this->aReceita) {
            $this->aReceita->removeIngredienteReceita($this);
        }
        if (null !== $this->aUnidade) {
            $this->aUnidade->removeIngredienteReceita($this);
        }
        $this->id_ingrediente = null;
        $this->id_receita = null;
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
        } // if ($deep)

        $this->aIngrediente = null;
        $this->aReceita = null;
        $this->aUnidade = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(IngredienteReceitaTableMap::DEFAULT_STRING_FORMAT);
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
