<?php

namespace Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Model\Comentario as ChildComentario;
use Model\ComentarioQuery as ChildComentarioQuery;
use Model\Curtir as ChildCurtir;
use Model\CurtirQuery as ChildCurtirQuery;
use Model\Proposicao as ChildProposicao;
use Model\ProposicaoQuery as ChildProposicaoQuery;
use Model\ResetSenha as ChildResetSenha;
use Model\ResetSenhaQuery as ChildResetSenhaQuery;
use Model\Usuario as ChildUsuario;
use Model\UsuarioQuery as ChildUsuarioQuery;
use Model\Map\ComentarioTableMap;
use Model\Map\CurtirTableMap;
use Model\Map\ProposicaoTableMap;
use Model\Map\ResetSenhaTableMap;
use Model\Map\UsuarioTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'usuario' table.
 *
 *
 *
 * @package    propel.generator.Model.Base
 */
abstract class Usuario implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\UsuarioTableMap';


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
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the atuacao field.
     *
     * @var        string
     */
    protected $atuacao;

    /**
     * The value for the genero field.
     *
     * @var        string
     */
    protected $genero;

    /**
     * The value for the senha field.
     *
     * @var        string
     */
    protected $senha;

    /**
     * The value for the descricao_contexto field.
     *
     * @var        string
     */
    protected $descricao_contexto;

    /**
     * The value for the data_cadastro field.
     *
     * @var        DateTime
     */
    protected $data_cadastro;

    /**
     * The value for the is_admin field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_admin;

    /**
     * The value for the imagem_profile field.
     *
     * @var        string
     */
    protected $imagem_profile;

    /**
     * @var        ObjectCollection|ChildComentario[] Collection to store aggregation of ChildComentario objects.
     */
    protected $collComentarios;
    protected $collComentariosPartial;

    /**
     * @var        ObjectCollection|ChildCurtir[] Collection to store aggregation of ChildCurtir objects.
     */
    protected $collCurtirs;
    protected $collCurtirsPartial;

    /**
     * @var        ObjectCollection|ChildProposicao[] Collection to store aggregation of ChildProposicao objects.
     */
    protected $collProposicaos;
    protected $collProposicaosPartial;

    /**
     * @var        ObjectCollection|ChildResetSenha[] Collection to store aggregation of ChildResetSenha objects.
     */
    protected $collResetSenhas;
    protected $collResetSenhasPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildComentario[]
     */
    protected $comentariosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCurtir[]
     */
    protected $curtirsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProposicao[]
     */
    protected $proposicaosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildResetSenha[]
     */
    protected $resetSenhasScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->is_admin = false;
    }

    /**
     * Initializes internal state of Model\Base\Usuario object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>Usuario</code> instance.  If
     * <code>obj</code> is an instance of <code>Usuario</code>, delegates to
     * <code>equals(Usuario)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Usuario The current object, for fluid interface
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

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
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
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [atuacao] column value.
     *
     * @return string
     */
    public function getAtuacao()
    {
        return $this->atuacao;
    }

    /**
     * Get the [genero] column value.
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Get the [senha] column value.
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Get the [descricao_contexto] column value.
     *
     * @return string
     */
    public function getDescricaoContexto()
    {
        return $this->descricao_contexto;
    }

    /**
     * Get the [optionally formatted] temporal [data_cadastro] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDataCadastro($format = NULL)
    {
        if ($format === null) {
            return $this->data_cadastro;
        } else {
            return $this->data_cadastro instanceof \DateTimeInterface ? $this->data_cadastro->format($format) : null;
        }
    }

    /**
     * Get the [is_admin] column value.
     *
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Get the [is_admin] column value.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->getIsAdmin();
    }

    /**
     * Get the [imagem_profile] column value.
     *
     * @return string
     */
    public function getImagemProfile()
    {
        return $this->imagem_profile;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [nome] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [atuacao] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setAtuacao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->atuacao !== $v) {
            $this->atuacao = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_ATUACAO] = true;
        }

        return $this;
    } // setAtuacao()

    /**
     * Set the value of [genero] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setGenero($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->genero !== $v) {
            $this->genero = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_GENERO] = true;
        }

        return $this;
    } // setGenero()

    /**
     * Set the value of [senha] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setSenha($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->senha !== $v) {
            $this->senha = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_SENHA] = true;
        }

        return $this;
    } // setSenha()

    /**
     * Set the value of [descricao_contexto] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setDescricaoContexto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descricao_contexto !== $v) {
            $this->descricao_contexto = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_DESCRICAO_CONTEXTO] = true;
        }

        return $this;
    } // setDescricaoContexto()

    /**
     * Sets the value of [data_cadastro] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setDataCadastro($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data_cadastro !== null || $dt !== null) {
            if ($this->data_cadastro === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->data_cadastro->format("Y-m-d H:i:s.u")) {
                $this->data_cadastro = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsuarioTableMap::COL_DATA_CADASTRO] = true;
            }
        } // if either are not null

        return $this;
    } // setDataCadastro()

    /**
     * Sets the value of the [is_admin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setIsAdmin($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_admin !== $v) {
            $this->is_admin = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_IS_ADMIN] = true;
        }

        return $this;
    } // setIsAdmin()

    /**
     * Set the value of [imagem_profile] column.
     *
     * @param string $v new value
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function setImagemProfile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->imagem_profile !== $v) {
            $this->imagem_profile = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_IMAGEM_PROFILE] = true;
        }

        return $this;
    } // setImagemProfile()

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
            if ($this->is_admin !== false) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsuarioTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsuarioTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsuarioTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsuarioTableMap::translateFieldName('Atuacao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->atuacao = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsuarioTableMap::translateFieldName('Genero', TableMap::TYPE_PHPNAME, $indexType)];
            $this->genero = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsuarioTableMap::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)];
            $this->senha = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsuarioTableMap::translateFieldName('DescricaoContexto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descricao_contexto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsuarioTableMap::translateFieldName('DataCadastro', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->data_cadastro = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsuarioTableMap::translateFieldName('IsAdmin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_admin = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsuarioTableMap::translateFieldName('ImagemProfile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->imagem_profile = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = UsuarioTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Usuario'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsuarioQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collComentarios = null;

            $this->collCurtirs = null;

            $this->collProposicaos = null;

            $this->collResetSenhas = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Usuario::setDeleted()
     * @see Usuario::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsuarioQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                UsuarioTableMap::addInstanceToPool($this);
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

            if ($this->comentariosScheduledForDeletion !== null) {
                if (!$this->comentariosScheduledForDeletion->isEmpty()) {
                    \Model\ComentarioQuery::create()
                        ->filterByPrimaryKeys($this->comentariosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->comentariosScheduledForDeletion = null;
                }
            }

            if ($this->collComentarios !== null) {
                foreach ($this->collComentarios as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->curtirsScheduledForDeletion !== null) {
                if (!$this->curtirsScheduledForDeletion->isEmpty()) {
                    \Model\CurtirQuery::create()
                        ->filterByPrimaryKeys($this->curtirsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->curtirsScheduledForDeletion = null;
                }
            }

            if ($this->collCurtirs !== null) {
                foreach ($this->collCurtirs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->proposicaosScheduledForDeletion !== null) {
                if (!$this->proposicaosScheduledForDeletion->isEmpty()) {
                    \Model\ProposicaoQuery::create()
                        ->filterByPrimaryKeys($this->proposicaosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->proposicaosScheduledForDeletion = null;
                }
            }

            if ($this->collProposicaos !== null) {
                foreach ($this->collProposicaos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->resetSenhasScheduledForDeletion !== null) {
                if (!$this->resetSenhasScheduledForDeletion->isEmpty()) {
                    \Model\ResetSenhaQuery::create()
                        ->filterByPrimaryKeys($this->resetSenhasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->resetSenhasScheduledForDeletion = null;
                }
            }

            if ($this->collResetSenhas !== null) {
                foreach ($this->collResetSenhas as $referrerFK) {
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

        $this->modifiedColumns[UsuarioTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuarioTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ATUACAO)) {
            $modifiedColumns[':p' . $index++]  = 'atuacao';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_GENERO)) {
            $modifiedColumns[':p' . $index++]  = 'genero';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_SENHA)) {
            $modifiedColumns[':p' . $index++]  = 'senha';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DESCRICAO_CONTEXTO)) {
            $modifiedColumns[':p' . $index++]  = 'descricao_contexto';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DATA_CADASTRO)) {
            $modifiedColumns[':p' . $index++]  = 'data_cadastro';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_IS_ADMIN)) {
            $modifiedColumns[':p' . $index++]  = 'is_admin';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_IMAGEM_PROFILE)) {
            $modifiedColumns[':p' . $index++]  = 'imagem_profile';
        }

        $sql = sprintf(
            'INSERT INTO usuario (%s) VALUES (%s)',
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
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'atuacao':
                        $stmt->bindValue($identifier, $this->atuacao, PDO::PARAM_STR);
                        break;
                    case 'genero':
                        $stmt->bindValue($identifier, $this->genero, PDO::PARAM_STR);
                        break;
                    case 'senha':
                        $stmt->bindValue($identifier, $this->senha, PDO::PARAM_STR);
                        break;
                    case 'descricao_contexto':
                        $stmt->bindValue($identifier, $this->descricao_contexto, PDO::PARAM_STR);
                        break;
                    case 'data_cadastro':
                        $stmt->bindValue($identifier, $this->data_cadastro ? $this->data_cadastro->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'is_admin':
                        $stmt->bindValue($identifier, (int) $this->is_admin, PDO::PARAM_INT);
                        break;
                    case 'imagem_profile':
                        $stmt->bindValue($identifier, $this->imagem_profile, PDO::PARAM_STR);
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
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNome();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getAtuacao();
                break;
            case 4:
                return $this->getGenero();
                break;
            case 5:
                return $this->getSenha();
                break;
            case 6:
                return $this->getDescricaoContexto();
                break;
            case 7:
                return $this->getDataCadastro();
                break;
            case 8:
                return $this->getIsAdmin();
                break;
            case 9:
                return $this->getImagemProfile();
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

        if (isset($alreadyDumpedObjects['Usuario'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuario'][$this->hashCode()] = true;
        $keys = UsuarioTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getAtuacao(),
            $keys[4] => $this->getGenero(),
            $keys[5] => $this->getSenha(),
            $keys[6] => $this->getDescricaoContexto(),
            $keys[7] => $this->getDataCadastro(),
            $keys[8] => $this->getIsAdmin(),
            $keys[9] => $this->getImagemProfile(),
        );
        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collComentarios) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'comentarios';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'comentarios';
                        break;
                    default:
                        $key = 'Comentarios';
                }

                $result[$key] = $this->collComentarios->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCurtirs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'curtirs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'curtirs';
                        break;
                    default:
                        $key = 'Curtirs';
                }

                $result[$key] = $this->collCurtirs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProposicaos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'proposicaos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'proposicaos';
                        break;
                    default:
                        $key = 'Proposicaos';
                }

                $result[$key] = $this->collProposicaos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collResetSenhas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resetSenhas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reset_senhas';
                        break;
                    default:
                        $key = 'ResetSenhas';
                }

                $result[$key] = $this->collResetSenhas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Model\Usuario
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Usuario
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNome($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setAtuacao($value);
                break;
            case 4:
                $this->setGenero($value);
                break;
            case 5:
                $this->setSenha($value);
                break;
            case 6:
                $this->setDescricaoContexto($value);
                break;
            case 7:
                $this->setDataCadastro($value);
                break;
            case 8:
                $this->setIsAdmin($value);
                break;
            case 9:
                $this->setImagemProfile($value);
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
        $keys = UsuarioTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNome($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAtuacao($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setGenero($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSenha($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescricaoContexto($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDataCadastro($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsAdmin($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setImagemProfile($arr[$keys[9]]);
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
     * @return $this|\Model\Usuario The current object, for fluid interface
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
        $criteria = new Criteria(UsuarioTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioTableMap::COL_ID)) {
            $criteria->add(UsuarioTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOME)) {
            $criteria->add(UsuarioTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_EMAIL)) {
            $criteria->add(UsuarioTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ATUACAO)) {
            $criteria->add(UsuarioTableMap::COL_ATUACAO, $this->atuacao);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_GENERO)) {
            $criteria->add(UsuarioTableMap::COL_GENERO, $this->genero);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_SENHA)) {
            $criteria->add(UsuarioTableMap::COL_SENHA, $this->senha);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DESCRICAO_CONTEXTO)) {
            $criteria->add(UsuarioTableMap::COL_DESCRICAO_CONTEXTO, $this->descricao_contexto);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DATA_CADASTRO)) {
            $criteria->add(UsuarioTableMap::COL_DATA_CADASTRO, $this->data_cadastro);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_IS_ADMIN)) {
            $criteria->add(UsuarioTableMap::COL_IS_ADMIN, $this->is_admin);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_IMAGEM_PROFILE)) {
            $criteria->add(UsuarioTableMap::COL_IMAGEM_PROFILE, $this->imagem_profile);
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
        $criteria = ChildUsuarioQuery::create();
        $criteria->add(UsuarioTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Model\Usuario (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAtuacao($this->getAtuacao());
        $copyObj->setGenero($this->getGenero());
        $copyObj->setSenha($this->getSenha());
        $copyObj->setDescricaoContexto($this->getDescricaoContexto());
        $copyObj->setDataCadastro($this->getDataCadastro());
        $copyObj->setIsAdmin($this->getIsAdmin());
        $copyObj->setImagemProfile($this->getImagemProfile());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getComentarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComentario($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCurtirs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCurtir($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProposicaos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProposicao($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getResetSenhas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addResetSenha($relObj->copy($deepCopy));
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
     * @return \Model\Usuario Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Comentario' == $relationName) {
            return $this->initComentarios();
        }
        if ('Curtir' == $relationName) {
            return $this->initCurtirs();
        }
        if ('Proposicao' == $relationName) {
            return $this->initProposicaos();
        }
        if ('ResetSenha' == $relationName) {
            return $this->initResetSenhas();
        }
    }

    /**
     * Clears out the collComentarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addComentarios()
     */
    public function clearComentarios()
    {
        $this->collComentarios = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collComentarios collection loaded partially.
     */
    public function resetPartialComentarios($v = true)
    {
        $this->collComentariosPartial = $v;
    }

    /**
     * Initializes the collComentarios collection.
     *
     * By default this just sets the collComentarios collection to an empty array (like clearcollComentarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initComentarios($overrideExisting = true)
    {
        if (null !== $this->collComentarios && !$overrideExisting) {
            return;
        }

        $collectionClassName = ComentarioTableMap::getTableMap()->getCollectionClassName();

        $this->collComentarios = new $collectionClassName;
        $this->collComentarios->setModel('\Model\Comentario');
    }

    /**
     * Gets an array of ChildComentario objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildComentario[] List of ChildComentario objects
     * @throws PropelException
     */
    public function getComentarios(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collComentariosPartial && !$this->isNew();
        if (null === $this->collComentarios || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collComentarios) {
                // return empty collection
                $this->initComentarios();
            } else {
                $collComentarios = ChildComentarioQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collComentariosPartial && count($collComentarios)) {
                        $this->initComentarios(false);

                        foreach ($collComentarios as $obj) {
                            if (false == $this->collComentarios->contains($obj)) {
                                $this->collComentarios->append($obj);
                            }
                        }

                        $this->collComentariosPartial = true;
                    }

                    return $collComentarios;
                }

                if ($partial && $this->collComentarios) {
                    foreach ($this->collComentarios as $obj) {
                        if ($obj->isNew()) {
                            $collComentarios[] = $obj;
                        }
                    }
                }

                $this->collComentarios = $collComentarios;
                $this->collComentariosPartial = false;
            }
        }

        return $this->collComentarios;
    }

    /**
     * Sets a collection of ChildComentario objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $comentarios A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setComentarios(Collection $comentarios, ConnectionInterface $con = null)
    {
        /** @var ChildComentario[] $comentariosToDelete */
        $comentariosToDelete = $this->getComentarios(new Criteria(), $con)->diff($comentarios);


        $this->comentariosScheduledForDeletion = $comentariosToDelete;

        foreach ($comentariosToDelete as $comentarioRemoved) {
            $comentarioRemoved->setUsuario(null);
        }

        $this->collComentarios = null;
        foreach ($comentarios as $comentario) {
            $this->addComentario($comentario);
        }

        $this->collComentarios = $comentarios;
        $this->collComentariosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Comentario objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Comentario objects.
     * @throws PropelException
     */
    public function countComentarios(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collComentariosPartial && !$this->isNew();
        if (null === $this->collComentarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collComentarios) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getComentarios());
            }

            $query = ChildComentarioQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collComentarios);
    }

    /**
     * Method called to associate a ChildComentario object to this object
     * through the ChildComentario foreign key attribute.
     *
     * @param  ChildComentario $l ChildComentario
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function addComentario(ChildComentario $l)
    {
        if ($this->collComentarios === null) {
            $this->initComentarios();
            $this->collComentariosPartial = true;
        }

        if (!$this->collComentarios->contains($l)) {
            $this->doAddComentario($l);

            if ($this->comentariosScheduledForDeletion and $this->comentariosScheduledForDeletion->contains($l)) {
                $this->comentariosScheduledForDeletion->remove($this->comentariosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildComentario $comentario The ChildComentario object to add.
     */
    protected function doAddComentario(ChildComentario $comentario)
    {
        $this->collComentarios[]= $comentario;
        $comentario->setUsuario($this);
    }

    /**
     * @param  ChildComentario $comentario The ChildComentario object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeComentario(ChildComentario $comentario)
    {
        if ($this->getComentarios()->contains($comentario)) {
            $pos = $this->collComentarios->search($comentario);
            $this->collComentarios->remove($pos);
            if (null === $this->comentariosScheduledForDeletion) {
                $this->comentariosScheduledForDeletion = clone $this->collComentarios;
                $this->comentariosScheduledForDeletion->clear();
            }
            $this->comentariosScheduledForDeletion[]= clone $comentario;
            $comentario->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Comentarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildComentario[] List of ChildComentario objects
     */
    public function getComentariosJoinProposicao(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildComentarioQuery::create(null, $criteria);
        $query->joinWith('Proposicao', $joinBehavior);

        return $this->getComentarios($query, $con);
    }

    /**
     * Clears out the collCurtirs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCurtirs()
     */
    public function clearCurtirs()
    {
        $this->collCurtirs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCurtirs collection loaded partially.
     */
    public function resetPartialCurtirs($v = true)
    {
        $this->collCurtirsPartial = $v;
    }

    /**
     * Initializes the collCurtirs collection.
     *
     * By default this just sets the collCurtirs collection to an empty array (like clearcollCurtirs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCurtirs($overrideExisting = true)
    {
        if (null !== $this->collCurtirs && !$overrideExisting) {
            return;
        }

        $collectionClassName = CurtirTableMap::getTableMap()->getCollectionClassName();

        $this->collCurtirs = new $collectionClassName;
        $this->collCurtirs->setModel('\Model\Curtir');
    }

    /**
     * Gets an array of ChildCurtir objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCurtir[] List of ChildCurtir objects
     * @throws PropelException
     */
    public function getCurtirs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCurtirsPartial && !$this->isNew();
        if (null === $this->collCurtirs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCurtirs) {
                // return empty collection
                $this->initCurtirs();
            } else {
                $collCurtirs = ChildCurtirQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCurtirsPartial && count($collCurtirs)) {
                        $this->initCurtirs(false);

                        foreach ($collCurtirs as $obj) {
                            if (false == $this->collCurtirs->contains($obj)) {
                                $this->collCurtirs->append($obj);
                            }
                        }

                        $this->collCurtirsPartial = true;
                    }

                    return $collCurtirs;
                }

                if ($partial && $this->collCurtirs) {
                    foreach ($this->collCurtirs as $obj) {
                        if ($obj->isNew()) {
                            $collCurtirs[] = $obj;
                        }
                    }
                }

                $this->collCurtirs = $collCurtirs;
                $this->collCurtirsPartial = false;
            }
        }

        return $this->collCurtirs;
    }

    /**
     * Sets a collection of ChildCurtir objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $curtirs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setCurtirs(Collection $curtirs, ConnectionInterface $con = null)
    {
        /** @var ChildCurtir[] $curtirsToDelete */
        $curtirsToDelete = $this->getCurtirs(new Criteria(), $con)->diff($curtirs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->curtirsScheduledForDeletion = clone $curtirsToDelete;

        foreach ($curtirsToDelete as $curtirRemoved) {
            $curtirRemoved->setUsuario(null);
        }

        $this->collCurtirs = null;
        foreach ($curtirs as $curtir) {
            $this->addCurtir($curtir);
        }

        $this->collCurtirs = $curtirs;
        $this->collCurtirsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Curtir objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Curtir objects.
     * @throws PropelException
     */
    public function countCurtirs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCurtirsPartial && !$this->isNew();
        if (null === $this->collCurtirs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCurtirs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCurtirs());
            }

            $query = ChildCurtirQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collCurtirs);
    }

    /**
     * Method called to associate a ChildCurtir object to this object
     * through the ChildCurtir foreign key attribute.
     *
     * @param  ChildCurtir $l ChildCurtir
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function addCurtir(ChildCurtir $l)
    {
        if ($this->collCurtirs === null) {
            $this->initCurtirs();
            $this->collCurtirsPartial = true;
        }

        if (!$this->collCurtirs->contains($l)) {
            $this->doAddCurtir($l);

            if ($this->curtirsScheduledForDeletion and $this->curtirsScheduledForDeletion->contains($l)) {
                $this->curtirsScheduledForDeletion->remove($this->curtirsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCurtir $curtir The ChildCurtir object to add.
     */
    protected function doAddCurtir(ChildCurtir $curtir)
    {
        $this->collCurtirs[]= $curtir;
        $curtir->setUsuario($this);
    }

    /**
     * @param  ChildCurtir $curtir The ChildCurtir object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeCurtir(ChildCurtir $curtir)
    {
        if ($this->getCurtirs()->contains($curtir)) {
            $pos = $this->collCurtirs->search($curtir);
            $this->collCurtirs->remove($pos);
            if (null === $this->curtirsScheduledForDeletion) {
                $this->curtirsScheduledForDeletion = clone $this->collCurtirs;
                $this->curtirsScheduledForDeletion->clear();
            }
            $this->curtirsScheduledForDeletion[]= clone $curtir;
            $curtir->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Curtirs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCurtir[] List of ChildCurtir objects
     */
    public function getCurtirsJoinProposicao(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCurtirQuery::create(null, $criteria);
        $query->joinWith('Proposicao', $joinBehavior);

        return $this->getCurtirs($query, $con);
    }

    /**
     * Clears out the collProposicaos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProposicaos()
     */
    public function clearProposicaos()
    {
        $this->collProposicaos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProposicaos collection loaded partially.
     */
    public function resetPartialProposicaos($v = true)
    {
        $this->collProposicaosPartial = $v;
    }

    /**
     * Initializes the collProposicaos collection.
     *
     * By default this just sets the collProposicaos collection to an empty array (like clearcollProposicaos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProposicaos($overrideExisting = true)
    {
        if (null !== $this->collProposicaos && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProposicaoTableMap::getTableMap()->getCollectionClassName();

        $this->collProposicaos = new $collectionClassName;
        $this->collProposicaos->setModel('\Model\Proposicao');
    }

    /**
     * Gets an array of ChildProposicao objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProposicao[] List of ChildProposicao objects
     * @throws PropelException
     */
    public function getProposicaos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProposicaosPartial && !$this->isNew();
        if (null === $this->collProposicaos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProposicaos) {
                // return empty collection
                $this->initProposicaos();
            } else {
                $collProposicaos = ChildProposicaoQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProposicaosPartial && count($collProposicaos)) {
                        $this->initProposicaos(false);

                        foreach ($collProposicaos as $obj) {
                            if (false == $this->collProposicaos->contains($obj)) {
                                $this->collProposicaos->append($obj);
                            }
                        }

                        $this->collProposicaosPartial = true;
                    }

                    return $collProposicaos;
                }

                if ($partial && $this->collProposicaos) {
                    foreach ($this->collProposicaos as $obj) {
                        if ($obj->isNew()) {
                            $collProposicaos[] = $obj;
                        }
                    }
                }

                $this->collProposicaos = $collProposicaos;
                $this->collProposicaosPartial = false;
            }
        }

        return $this->collProposicaos;
    }

    /**
     * Sets a collection of ChildProposicao objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $proposicaos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setProposicaos(Collection $proposicaos, ConnectionInterface $con = null)
    {
        /** @var ChildProposicao[] $proposicaosToDelete */
        $proposicaosToDelete = $this->getProposicaos(new Criteria(), $con)->diff($proposicaos);


        $this->proposicaosScheduledForDeletion = $proposicaosToDelete;

        foreach ($proposicaosToDelete as $proposicaoRemoved) {
            $proposicaoRemoved->setUsuario(null);
        }

        $this->collProposicaos = null;
        foreach ($proposicaos as $proposicao) {
            $this->addProposicao($proposicao);
        }

        $this->collProposicaos = $proposicaos;
        $this->collProposicaosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Proposicao objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Proposicao objects.
     * @throws PropelException
     */
    public function countProposicaos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProposicaosPartial && !$this->isNew();
        if (null === $this->collProposicaos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProposicaos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProposicaos());
            }

            $query = ChildProposicaoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collProposicaos);
    }

    /**
     * Method called to associate a ChildProposicao object to this object
     * through the ChildProposicao foreign key attribute.
     *
     * @param  ChildProposicao $l ChildProposicao
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function addProposicao(ChildProposicao $l)
    {
        if ($this->collProposicaos === null) {
            $this->initProposicaos();
            $this->collProposicaosPartial = true;
        }

        if (!$this->collProposicaos->contains($l)) {
            $this->doAddProposicao($l);

            if ($this->proposicaosScheduledForDeletion and $this->proposicaosScheduledForDeletion->contains($l)) {
                $this->proposicaosScheduledForDeletion->remove($this->proposicaosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProposicao $proposicao The ChildProposicao object to add.
     */
    protected function doAddProposicao(ChildProposicao $proposicao)
    {
        $this->collProposicaos[]= $proposicao;
        $proposicao->setUsuario($this);
    }

    /**
     * @param  ChildProposicao $proposicao The ChildProposicao object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeProposicao(ChildProposicao $proposicao)
    {
        if ($this->getProposicaos()->contains($proposicao)) {
            $pos = $this->collProposicaos->search($proposicao);
            $this->collProposicaos->remove($pos);
            if (null === $this->proposicaosScheduledForDeletion) {
                $this->proposicaosScheduledForDeletion = clone $this->collProposicaos;
                $this->proposicaosScheduledForDeletion->clear();
            }
            $this->proposicaosScheduledForDeletion[]= clone $proposicao;
            $proposicao->setUsuario(null);
        }

        return $this;
    }

    /**
     * Clears out the collResetSenhas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addResetSenhas()
     */
    public function clearResetSenhas()
    {
        $this->collResetSenhas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collResetSenhas collection loaded partially.
     */
    public function resetPartialResetSenhas($v = true)
    {
        $this->collResetSenhasPartial = $v;
    }

    /**
     * Initializes the collResetSenhas collection.
     *
     * By default this just sets the collResetSenhas collection to an empty array (like clearcollResetSenhas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initResetSenhas($overrideExisting = true)
    {
        if (null !== $this->collResetSenhas && !$overrideExisting) {
            return;
        }

        $collectionClassName = ResetSenhaTableMap::getTableMap()->getCollectionClassName();

        $this->collResetSenhas = new $collectionClassName;
        $this->collResetSenhas->setModel('\Model\ResetSenha');
    }

    /**
     * Gets an array of ChildResetSenha objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildResetSenha[] List of ChildResetSenha objects
     * @throws PropelException
     */
    public function getResetSenhas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collResetSenhasPartial && !$this->isNew();
        if (null === $this->collResetSenhas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collResetSenhas) {
                // return empty collection
                $this->initResetSenhas();
            } else {
                $collResetSenhas = ChildResetSenhaQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collResetSenhasPartial && count($collResetSenhas)) {
                        $this->initResetSenhas(false);

                        foreach ($collResetSenhas as $obj) {
                            if (false == $this->collResetSenhas->contains($obj)) {
                                $this->collResetSenhas->append($obj);
                            }
                        }

                        $this->collResetSenhasPartial = true;
                    }

                    return $collResetSenhas;
                }

                if ($partial && $this->collResetSenhas) {
                    foreach ($this->collResetSenhas as $obj) {
                        if ($obj->isNew()) {
                            $collResetSenhas[] = $obj;
                        }
                    }
                }

                $this->collResetSenhas = $collResetSenhas;
                $this->collResetSenhasPartial = false;
            }
        }

        return $this->collResetSenhas;
    }

    /**
     * Sets a collection of ChildResetSenha objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $resetSenhas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setResetSenhas(Collection $resetSenhas, ConnectionInterface $con = null)
    {
        /** @var ChildResetSenha[] $resetSenhasToDelete */
        $resetSenhasToDelete = $this->getResetSenhas(new Criteria(), $con)->diff($resetSenhas);


        $this->resetSenhasScheduledForDeletion = $resetSenhasToDelete;

        foreach ($resetSenhasToDelete as $resetSenhaRemoved) {
            $resetSenhaRemoved->setUsuario(null);
        }

        $this->collResetSenhas = null;
        foreach ($resetSenhas as $resetSenha) {
            $this->addResetSenha($resetSenha);
        }

        $this->collResetSenhas = $resetSenhas;
        $this->collResetSenhasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ResetSenha objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ResetSenha objects.
     * @throws PropelException
     */
    public function countResetSenhas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collResetSenhasPartial && !$this->isNew();
        if (null === $this->collResetSenhas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collResetSenhas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getResetSenhas());
            }

            $query = ChildResetSenhaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collResetSenhas);
    }

    /**
     * Method called to associate a ChildResetSenha object to this object
     * through the ChildResetSenha foreign key attribute.
     *
     * @param  ChildResetSenha $l ChildResetSenha
     * @return $this|\Model\Usuario The current object (for fluent API support)
     */
    public function addResetSenha(ChildResetSenha $l)
    {
        if ($this->collResetSenhas === null) {
            $this->initResetSenhas();
            $this->collResetSenhasPartial = true;
        }

        if (!$this->collResetSenhas->contains($l)) {
            $this->doAddResetSenha($l);

            if ($this->resetSenhasScheduledForDeletion and $this->resetSenhasScheduledForDeletion->contains($l)) {
                $this->resetSenhasScheduledForDeletion->remove($this->resetSenhasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildResetSenha $resetSenha The ChildResetSenha object to add.
     */
    protected function doAddResetSenha(ChildResetSenha $resetSenha)
    {
        $this->collResetSenhas[]= $resetSenha;
        $resetSenha->setUsuario($this);
    }

    /**
     * @param  ChildResetSenha $resetSenha The ChildResetSenha object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeResetSenha(ChildResetSenha $resetSenha)
    {
        if ($this->getResetSenhas()->contains($resetSenha)) {
            $pos = $this->collResetSenhas->search($resetSenha);
            $this->collResetSenhas->remove($pos);
            if (null === $this->resetSenhasScheduledForDeletion) {
                $this->resetSenhasScheduledForDeletion = clone $this->collResetSenhas;
                $this->resetSenhasScheduledForDeletion->clear();
            }
            $this->resetSenhasScheduledForDeletion[]= clone $resetSenha;
            $resetSenha->setUsuario(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->nome = null;
        $this->email = null;
        $this->atuacao = null;
        $this->genero = null;
        $this->senha = null;
        $this->descricao_contexto = null;
        $this->data_cadastro = null;
        $this->is_admin = null;
        $this->imagem_profile = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collComentarios) {
                foreach ($this->collComentarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCurtirs) {
                foreach ($this->collCurtirs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProposicaos) {
                foreach ($this->collProposicaos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collResetSenhas) {
                foreach ($this->collResetSenhas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collComentarios = null;
        $this->collCurtirs = null;
        $this->collProposicaos = null;
        $this->collResetSenhas = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
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
