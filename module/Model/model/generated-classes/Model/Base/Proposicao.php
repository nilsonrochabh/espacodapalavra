<?php

namespace Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Model\AmbienteProposicao as ChildAmbienteProposicao;
use Model\AmbienteProposicaoQuery as ChildAmbienteProposicaoQuery;
use Model\Comentario as ChildComentario;
use Model\ComentarioQuery as ChildComentarioQuery;
use Model\Concluir as ChildConcluir;
use Model\ConcluirQuery as ChildConcluirQuery;
use Model\Curtir as ChildCurtir;
use Model\CurtirQuery as ChildCurtirQuery;
use Model\HabilidadeProposicao as ChildHabilidadeProposicao;
use Model\HabilidadeProposicaoQuery as ChildHabilidadeProposicaoQuery;
use Model\Passo as ChildPasso;
use Model\PassoQuery as ChildPassoQuery;
use Model\Proposicao as ChildProposicao;
use Model\ProposicaoQuery as ChildProposicaoQuery;
use Model\RecursoProposicao as ChildRecursoProposicao;
use Model\RecursoProposicaoQuery as ChildRecursoProposicaoQuery;
use Model\Seguir as ChildSeguir;
use Model\SeguirQuery as ChildSeguirQuery;
use Model\TamanhoTurmaProposicao as ChildTamanhoTurmaProposicao;
use Model\TamanhoTurmaProposicaoQuery as ChildTamanhoTurmaProposicaoQuery;
use Model\Usuario as ChildUsuario;
use Model\UsuarioQuery as ChildUsuarioQuery;
use Model\Map\AmbienteProposicaoTableMap;
use Model\Map\ComentarioTableMap;
use Model\Map\ConcluirTableMap;
use Model\Map\CurtirTableMap;
use Model\Map\HabilidadeProposicaoTableMap;
use Model\Map\PassoTableMap;
use Model\Map\ProposicaoTableMap;
use Model\Map\RecursoProposicaoTableMap;
use Model\Map\SeguirTableMap;
use Model\Map\TamanhoTurmaProposicaoTableMap;
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
 * Base class that represents a row from the 'proposicao' table.
 *
 *
 *
 * @package    propel.generator.Model.Base
 */
abstract class Proposicao implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Model\\Map\\ProposicaoTableMap';


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
     * The value for the id_usuario field.
     *
     * @var        int
     */
    protected $id_usuario;

    /**
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the objetivo field.
     *
     * @var        string
     */
    protected $objetivo;

    /**
     * The value for the start field.
     *
     * @var        string
     */
    protected $start;

    /**
     * The value for the imagem field.
     *
     * @var        string
     */
    protected $imagem;

    /**
     * The value for the tempo_total field.
     *
     * @var        string
     */
    protected $tempo_total;

    /**
     * The value for the data_cadastro field.
     *
     * @var        DateTime
     */
    protected $data_cadastro;

    /**
     * The value for the is_rascunho field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_rascunho;

    /**
     * The value for the categoria field.
     *
     * @var        string
     */
    protected $categoria;

    /**
     * The value for the qte_comentarios field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $qte_comentarios;

    /**
     * The value for the qte_curtidas field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $qte_curtidas;

    /**
     * The value for the qte_seguidores field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $qte_seguidores;

    /**
     * The value for the qte_concluidos field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $qte_concluidos;

    /**
     * @var        ChildUsuario
     */
    protected $aUsuario;

    /**
     * @var        ObjectCollection|ChildAmbienteProposicao[] Collection to store aggregation of ChildAmbienteProposicao objects.
     */
    protected $collAmbienteProposicaos;
    protected $collAmbienteProposicaosPartial;

    /**
     * @var        ObjectCollection|ChildComentario[] Collection to store aggregation of ChildComentario objects.
     */
    protected $collComentarios;
    protected $collComentariosPartial;

    /**
     * @var        ObjectCollection|ChildConcluir[] Collection to store aggregation of ChildConcluir objects.
     */
    protected $collConcluirs;
    protected $collConcluirsPartial;

    /**
     * @var        ObjectCollection|ChildCurtir[] Collection to store aggregation of ChildCurtir objects.
     */
    protected $collCurtirs;
    protected $collCurtirsPartial;

    /**
     * @var        ObjectCollection|ChildHabilidadeProposicao[] Collection to store aggregation of ChildHabilidadeProposicao objects.
     */
    protected $collHabilidadeProposicaos;
    protected $collHabilidadeProposicaosPartial;

    /**
     * @var        ObjectCollection|ChildPasso[] Collection to store aggregation of ChildPasso objects.
     */
    protected $collPassos;
    protected $collPassosPartial;

    /**
     * @var        ObjectCollection|ChildRecursoProposicao[] Collection to store aggregation of ChildRecursoProposicao objects.
     */
    protected $collRecursoProposicaos;
    protected $collRecursoProposicaosPartial;

    /**
     * @var        ObjectCollection|ChildSeguir[] Collection to store aggregation of ChildSeguir objects.
     */
    protected $collSeguirs;
    protected $collSeguirsPartial;

    /**
     * @var        ObjectCollection|ChildTamanhoTurmaProposicao[] Collection to store aggregation of ChildTamanhoTurmaProposicao objects.
     */
    protected $collTamanhoTurmaProposicaos;
    protected $collTamanhoTurmaProposicaosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAmbienteProposicao[]
     */
    protected $ambienteProposicaosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildComentario[]
     */
    protected $comentariosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildConcluir[]
     */
    protected $concluirsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCurtir[]
     */
    protected $curtirsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHabilidadeProposicao[]
     */
    protected $habilidadeProposicaosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPasso[]
     */
    protected $passosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRecursoProposicao[]
     */
    protected $recursoProposicaosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSeguir[]
     */
    protected $seguirsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTamanhoTurmaProposicao[]
     */
    protected $tamanhoTurmaProposicaosScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->is_rascunho = true;
        $this->qte_comentarios = 0;
        $this->qte_curtidas = 0;
        $this->qte_seguidores = 0;
        $this->qte_concluidos = 0;
    }

    /**
     * Initializes internal state of Model\Base\Proposicao object.
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
     * Compares this with another <code>Proposicao</code> instance.  If
     * <code>obj</code> is an instance of <code>Proposicao</code>, delegates to
     * <code>equals(Proposicao)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Proposicao The current object, for fluid interface
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
     * Get the [id_usuario] column value.
     *
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
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
     * Get the [objetivo] column value.
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Get the [start] column value.
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the [imagem] column value.
     *
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Get the [tempo_total] column value.
     *
     * @return string
     */
    public function getTempoTotal()
    {
        return $this->tempo_total;
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
     * Get the [is_rascunho] column value.
     *
     * @return boolean
     */
    public function getIsRascunho()
    {
        return $this->is_rascunho;
    }

    /**
     * Get the [is_rascunho] column value.
     *
     * @return boolean
     */
    public function isRascunho()
    {
        return $this->getIsRascunho();
    }

    /**
     * Get the [categoria] column value.
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Get the [qte_comentarios] column value.
     *
     * @return int
     */
    public function getQteComentarios()
    {
        return $this->qte_comentarios;
    }

    /**
     * Get the [qte_curtidas] column value.
     *
     * @return int
     */
    public function getQteCurtidas()
    {
        return $this->qte_curtidas;
    }

    /**
     * Get the [qte_seguidores] column value.
     *
     * @return int
     */
    public function getQteSeguidores()
    {
        return $this->qte_seguidores;
    }

    /**
     * Get the [qte_concluidos] column value.
     *
     * @return int
     */
    public function getQteConcluidos()
    {
        return $this->qte_concluidos;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_usuario] column.
     *
     * @param int $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setIdUsuario($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_usuario !== $v) {
            $this->id_usuario = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_ID_USUARIO] = true;
        }

        if ($this->aUsuario !== null && $this->aUsuario->getId() !== $v) {
            $this->aUsuario = null;
        }

        return $this;
    } // setIdUsuario()

    /**
     * Set the value of [nome] column.
     *
     * @param string $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [objetivo] column.
     *
     * @param string $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setObjetivo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->objetivo !== $v) {
            $this->objetivo = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_OBJETIVO] = true;
        }

        return $this;
    } // setObjetivo()

    /**
     * Set the value of [start] column.
     *
     * @param string $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setStart($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start !== $v) {
            $this->start = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_START] = true;
        }

        return $this;
    } // setStart()

    /**
     * Set the value of [imagem] column.
     *
     * @param string $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setImagem($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->imagem !== $v) {
            $this->imagem = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_IMAGEM] = true;
        }

        return $this;
    } // setImagem()

    /**
     * Set the value of [tempo_total] column.
     *
     * @param string $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setTempoTotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tempo_total !== $v) {
            $this->tempo_total = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_TEMPO_TOTAL] = true;
        }

        return $this;
    } // setTempoTotal()

    /**
     * Sets the value of [data_cadastro] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setDataCadastro($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data_cadastro !== null || $dt !== null) {
            if ($this->data_cadastro === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->data_cadastro->format("Y-m-d H:i:s.u")) {
                $this->data_cadastro = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProposicaoTableMap::COL_DATA_CADASTRO] = true;
            }
        } // if either are not null

        return $this;
    } // setDataCadastro()

    /**
     * Sets the value of the [is_rascunho] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setIsRascunho($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_rascunho !== $v) {
            $this->is_rascunho = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_IS_RASCUNHO] = true;
        }

        return $this;
    } // setIsRascunho()

    /**
     * Set the value of [categoria] column.
     *
     * @param string $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setCategoria($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->categoria !== $v) {
            $this->categoria = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_CATEGORIA] = true;
        }

        return $this;
    } // setCategoria()

    /**
     * Set the value of [qte_comentarios] column.
     *
     * @param int $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setQteComentarios($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qte_comentarios !== $v) {
            $this->qte_comentarios = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_QTE_COMENTARIOS] = true;
        }

        return $this;
    } // setQteComentarios()

    /**
     * Set the value of [qte_curtidas] column.
     *
     * @param int $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setQteCurtidas($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qte_curtidas !== $v) {
            $this->qte_curtidas = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_QTE_CURTIDAS] = true;
        }

        return $this;
    } // setQteCurtidas()

    /**
     * Set the value of [qte_seguidores] column.
     *
     * @param int $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setQteSeguidores($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qte_seguidores !== $v) {
            $this->qte_seguidores = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_QTE_SEGUIDORES] = true;
        }

        return $this;
    } // setQteSeguidores()

    /**
     * Set the value of [qte_concluidos] column.
     *
     * @param int $v new value
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function setQteConcluidos($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qte_concluidos !== $v) {
            $this->qte_concluidos = $v;
            $this->modifiedColumns[ProposicaoTableMap::COL_QTE_CONCLUIDOS] = true;
        }

        return $this;
    } // setQteConcluidos()

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
            if ($this->is_rascunho !== true) {
                return false;
            }

            if ($this->qte_comentarios !== 0) {
                return false;
            }

            if ($this->qte_curtidas !== 0) {
                return false;
            }

            if ($this->qte_seguidores !== 0) {
                return false;
            }

            if ($this->qte_concluidos !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProposicaoTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProposicaoTableMap::translateFieldName('IdUsuario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_usuario = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProposicaoTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProposicaoTableMap::translateFieldName('Objetivo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->objetivo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProposicaoTableMap::translateFieldName('Start', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProposicaoTableMap::translateFieldName('Imagem', TableMap::TYPE_PHPNAME, $indexType)];
            $this->imagem = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProposicaoTableMap::translateFieldName('TempoTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tempo_total = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProposicaoTableMap::translateFieldName('DataCadastro', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->data_cadastro = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProposicaoTableMap::translateFieldName('IsRascunho', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_rascunho = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProposicaoTableMap::translateFieldName('Categoria', TableMap::TYPE_PHPNAME, $indexType)];
            $this->categoria = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProposicaoTableMap::translateFieldName('QteComentarios', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qte_comentarios = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ProposicaoTableMap::translateFieldName('QteCurtidas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qte_curtidas = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ProposicaoTableMap::translateFieldName('QteSeguidores', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qte_seguidores = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ProposicaoTableMap::translateFieldName('QteConcluidos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qte_concluidos = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = ProposicaoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Model\\Proposicao'), 0, $e);
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
        if ($this->aUsuario !== null && $this->id_usuario !== $this->aUsuario->getId()) {
            $this->aUsuario = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProposicaoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsuario = null;
            $this->collAmbienteProposicaos = null;

            $this->collComentarios = null;

            $this->collConcluirs = null;

            $this->collCurtirs = null;

            $this->collHabilidadeProposicaos = null;

            $this->collPassos = null;

            $this->collRecursoProposicaos = null;

            $this->collSeguirs = null;

            $this->collTamanhoTurmaProposicaos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Proposicao::setDeleted()
     * @see Proposicao::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProposicaoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProposicaoTableMap::DATABASE_NAME);
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
                ProposicaoTableMap::addInstanceToPool($this);
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

            if ($this->aUsuario !== null) {
                if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
                    $affectedRows += $this->aUsuario->save($con);
                }
                $this->setUsuario($this->aUsuario);
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

            if ($this->ambienteProposicaosScheduledForDeletion !== null) {
                if (!$this->ambienteProposicaosScheduledForDeletion->isEmpty()) {
                    \Model\AmbienteProposicaoQuery::create()
                        ->filterByPrimaryKeys($this->ambienteProposicaosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ambienteProposicaosScheduledForDeletion = null;
                }
            }

            if ($this->collAmbienteProposicaos !== null) {
                foreach ($this->collAmbienteProposicaos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->concluirsScheduledForDeletion !== null) {
                if (!$this->concluirsScheduledForDeletion->isEmpty()) {
                    \Model\ConcluirQuery::create()
                        ->filterByPrimaryKeys($this->concluirsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->concluirsScheduledForDeletion = null;
                }
            }

            if ($this->collConcluirs !== null) {
                foreach ($this->collConcluirs as $referrerFK) {
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

            if ($this->habilidadeProposicaosScheduledForDeletion !== null) {
                if (!$this->habilidadeProposicaosScheduledForDeletion->isEmpty()) {
                    \Model\HabilidadeProposicaoQuery::create()
                        ->filterByPrimaryKeys($this->habilidadeProposicaosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->habilidadeProposicaosScheduledForDeletion = null;
                }
            }

            if ($this->collHabilidadeProposicaos !== null) {
                foreach ($this->collHabilidadeProposicaos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->passosScheduledForDeletion !== null) {
                if (!$this->passosScheduledForDeletion->isEmpty()) {
                    \Model\PassoQuery::create()
                        ->filterByPrimaryKeys($this->passosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->passosScheduledForDeletion = null;
                }
            }

            if ($this->collPassos !== null) {
                foreach ($this->collPassos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->recursoProposicaosScheduledForDeletion !== null) {
                if (!$this->recursoProposicaosScheduledForDeletion->isEmpty()) {
                    \Model\RecursoProposicaoQuery::create()
                        ->filterByPrimaryKeys($this->recursoProposicaosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->recursoProposicaosScheduledForDeletion = null;
                }
            }

            if ($this->collRecursoProposicaos !== null) {
                foreach ($this->collRecursoProposicaos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->seguirsScheduledForDeletion !== null) {
                if (!$this->seguirsScheduledForDeletion->isEmpty()) {
                    \Model\SeguirQuery::create()
                        ->filterByPrimaryKeys($this->seguirsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->seguirsScheduledForDeletion = null;
                }
            }

            if ($this->collSeguirs !== null) {
                foreach ($this->collSeguirs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tamanhoTurmaProposicaosScheduledForDeletion !== null) {
                if (!$this->tamanhoTurmaProposicaosScheduledForDeletion->isEmpty()) {
                    \Model\TamanhoTurmaProposicaoQuery::create()
                        ->filterByPrimaryKeys($this->tamanhoTurmaProposicaosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tamanhoTurmaProposicaosScheduledForDeletion = null;
                }
            }

            if ($this->collTamanhoTurmaProposicaos !== null) {
                foreach ($this->collTamanhoTurmaProposicaos as $referrerFK) {
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

        $this->modifiedColumns[ProposicaoTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProposicaoTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProposicaoTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_ID_USUARIO)) {
            $modifiedColumns[':p' . $index++]  = 'id_usuario';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_OBJETIVO)) {
            $modifiedColumns[':p' . $index++]  = 'objetivo';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_START)) {
            $modifiedColumns[':p' . $index++]  = 'start';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_IMAGEM)) {
            $modifiedColumns[':p' . $index++]  = 'imagem';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_TEMPO_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'tempo_total';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_DATA_CADASTRO)) {
            $modifiedColumns[':p' . $index++]  = 'data_cadastro';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_IS_RASCUNHO)) {
            $modifiedColumns[':p' . $index++]  = 'is_rascunho';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_CATEGORIA)) {
            $modifiedColumns[':p' . $index++]  = 'categoria';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_COMENTARIOS)) {
            $modifiedColumns[':p' . $index++]  = 'qte_comentarios';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_CURTIDAS)) {
            $modifiedColumns[':p' . $index++]  = 'qte_curtidas';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_SEGUIDORES)) {
            $modifiedColumns[':p' . $index++]  = 'qte_seguidores';
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_CONCLUIDOS)) {
            $modifiedColumns[':p' . $index++]  = 'qte_concluidos';
        }

        $sql = sprintf(
            'INSERT INTO proposicao (%s) VALUES (%s)',
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
                    case 'id_usuario':
                        $stmt->bindValue($identifier, $this->id_usuario, PDO::PARAM_INT);
                        break;
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'objetivo':
                        $stmt->bindValue($identifier, $this->objetivo, PDO::PARAM_STR);
                        break;
                    case 'start':
                        $stmt->bindValue($identifier, $this->start, PDO::PARAM_STR);
                        break;
                    case 'imagem':
                        $stmt->bindValue($identifier, $this->imagem, PDO::PARAM_STR);
                        break;
                    case 'tempo_total':
                        $stmt->bindValue($identifier, $this->tempo_total, PDO::PARAM_STR);
                        break;
                    case 'data_cadastro':
                        $stmt->bindValue($identifier, $this->data_cadastro ? $this->data_cadastro->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'is_rascunho':
                        $stmt->bindValue($identifier, (int) $this->is_rascunho, PDO::PARAM_INT);
                        break;
                    case 'categoria':
                        $stmt->bindValue($identifier, $this->categoria, PDO::PARAM_STR);
                        break;
                    case 'qte_comentarios':
                        $stmt->bindValue($identifier, $this->qte_comentarios, PDO::PARAM_INT);
                        break;
                    case 'qte_curtidas':
                        $stmt->bindValue($identifier, $this->qte_curtidas, PDO::PARAM_INT);
                        break;
                    case 'qte_seguidores':
                        $stmt->bindValue($identifier, $this->qte_seguidores, PDO::PARAM_INT);
                        break;
                    case 'qte_concluidos':
                        $stmt->bindValue($identifier, $this->qte_concluidos, PDO::PARAM_INT);
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
        $pos = ProposicaoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdUsuario();
                break;
            case 2:
                return $this->getNome();
                break;
            case 3:
                return $this->getObjetivo();
                break;
            case 4:
                return $this->getStart();
                break;
            case 5:
                return $this->getImagem();
                break;
            case 6:
                return $this->getTempoTotal();
                break;
            case 7:
                return $this->getDataCadastro();
                break;
            case 8:
                return $this->getIsRascunho();
                break;
            case 9:
                return $this->getCategoria();
                break;
            case 10:
                return $this->getQteComentarios();
                break;
            case 11:
                return $this->getQteCurtidas();
                break;
            case 12:
                return $this->getQteSeguidores();
                break;
            case 13:
                return $this->getQteConcluidos();
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

        if (isset($alreadyDumpedObjects['Proposicao'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Proposicao'][$this->hashCode()] = true;
        $keys = ProposicaoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdUsuario(),
            $keys[2] => $this->getNome(),
            $keys[3] => $this->getObjetivo(),
            $keys[4] => $this->getStart(),
            $keys[5] => $this->getImagem(),
            $keys[6] => $this->getTempoTotal(),
            $keys[7] => $this->getDataCadastro(),
            $keys[8] => $this->getIsRascunho(),
            $keys[9] => $this->getCategoria(),
            $keys[10] => $this->getQteComentarios(),
            $keys[11] => $this->getQteCurtidas(),
            $keys[12] => $this->getQteSeguidores(),
            $keys[13] => $this->getQteConcluidos(),
        );
        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUsuario) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuario';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'usuario';
                        break;
                    default:
                        $key = 'Usuario';
                }

                $result[$key] = $this->aUsuario->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAmbienteProposicaos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ambienteProposicaos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ambiente_proposicaos';
                        break;
                    default:
                        $key = 'AmbienteProposicaos';
                }

                $result[$key] = $this->collAmbienteProposicaos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->collConcluirs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'concluirs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'concluirs';
                        break;
                    default:
                        $key = 'Concluirs';
                }

                $result[$key] = $this->collConcluirs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collHabilidadeProposicaos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'habilidadeProposicaos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'habilidade_proposicaos';
                        break;
                    default:
                        $key = 'HabilidadeProposicaos';
                }

                $result[$key] = $this->collHabilidadeProposicaos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPassos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'passos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'passos';
                        break;
                    default:
                        $key = 'Passos';
                }

                $result[$key] = $this->collPassos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRecursoProposicaos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'recursoProposicaos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'recurso_proposicaos';
                        break;
                    default:
                        $key = 'RecursoProposicaos';
                }

                $result[$key] = $this->collRecursoProposicaos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSeguirs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'seguirs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'seguirs';
                        break;
                    default:
                        $key = 'Seguirs';
                }

                $result[$key] = $this->collSeguirs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTamanhoTurmaProposicaos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tamanhoTurmaProposicaos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tamanho_turma_proposicaos';
                        break;
                    default:
                        $key = 'TamanhoTurmaProposicaos';
                }

                $result[$key] = $this->collTamanhoTurmaProposicaos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Model\Proposicao
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProposicaoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Model\Proposicao
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdUsuario($value);
                break;
            case 2:
                $this->setNome($value);
                break;
            case 3:
                $this->setObjetivo($value);
                break;
            case 4:
                $this->setStart($value);
                break;
            case 5:
                $this->setImagem($value);
                break;
            case 6:
                $this->setTempoTotal($value);
                break;
            case 7:
                $this->setDataCadastro($value);
                break;
            case 8:
                $this->setIsRascunho($value);
                break;
            case 9:
                $this->setCategoria($value);
                break;
            case 10:
                $this->setQteComentarios($value);
                break;
            case 11:
                $this->setQteCurtidas($value);
                break;
            case 12:
                $this->setQteSeguidores($value);
                break;
            case 13:
                $this->setQteConcluidos($value);
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
        $keys = ProposicaoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdUsuario($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNome($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setObjetivo($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStart($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setImagem($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTempoTotal($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDataCadastro($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsRascunho($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCategoria($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setQteComentarios($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setQteCurtidas($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setQteSeguidores($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setQteConcluidos($arr[$keys[13]]);
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
     * @return $this|\Model\Proposicao The current object, for fluid interface
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
        $criteria = new Criteria(ProposicaoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProposicaoTableMap::COL_ID)) {
            $criteria->add(ProposicaoTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_ID_USUARIO)) {
            $criteria->add(ProposicaoTableMap::COL_ID_USUARIO, $this->id_usuario);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_NOME)) {
            $criteria->add(ProposicaoTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_OBJETIVO)) {
            $criteria->add(ProposicaoTableMap::COL_OBJETIVO, $this->objetivo);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_START)) {
            $criteria->add(ProposicaoTableMap::COL_START, $this->start);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_IMAGEM)) {
            $criteria->add(ProposicaoTableMap::COL_IMAGEM, $this->imagem);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_TEMPO_TOTAL)) {
            $criteria->add(ProposicaoTableMap::COL_TEMPO_TOTAL, $this->tempo_total);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_DATA_CADASTRO)) {
            $criteria->add(ProposicaoTableMap::COL_DATA_CADASTRO, $this->data_cadastro);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_IS_RASCUNHO)) {
            $criteria->add(ProposicaoTableMap::COL_IS_RASCUNHO, $this->is_rascunho);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_CATEGORIA)) {
            $criteria->add(ProposicaoTableMap::COL_CATEGORIA, $this->categoria);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_COMENTARIOS)) {
            $criteria->add(ProposicaoTableMap::COL_QTE_COMENTARIOS, $this->qte_comentarios);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_CURTIDAS)) {
            $criteria->add(ProposicaoTableMap::COL_QTE_CURTIDAS, $this->qte_curtidas);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_SEGUIDORES)) {
            $criteria->add(ProposicaoTableMap::COL_QTE_SEGUIDORES, $this->qte_seguidores);
        }
        if ($this->isColumnModified(ProposicaoTableMap::COL_QTE_CONCLUIDOS)) {
            $criteria->add(ProposicaoTableMap::COL_QTE_CONCLUIDOS, $this->qte_concluidos);
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
        $criteria = ChildProposicaoQuery::create();
        $criteria->add(ProposicaoTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Model\Proposicao (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdUsuario($this->getIdUsuario());
        $copyObj->setNome($this->getNome());
        $copyObj->setObjetivo($this->getObjetivo());
        $copyObj->setStart($this->getStart());
        $copyObj->setImagem($this->getImagem());
        $copyObj->setTempoTotal($this->getTempoTotal());
        $copyObj->setDataCadastro($this->getDataCadastro());
        $copyObj->setIsRascunho($this->getIsRascunho());
        $copyObj->setCategoria($this->getCategoria());
        $copyObj->setQteComentarios($this->getQteComentarios());
        $copyObj->setQteCurtidas($this->getQteCurtidas());
        $copyObj->setQteSeguidores($this->getQteSeguidores());
        $copyObj->setQteConcluidos($this->getQteConcluidos());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAmbienteProposicaos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAmbienteProposicao($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getComentarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComentario($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getConcluirs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConcluir($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCurtirs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCurtir($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHabilidadeProposicaos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHabilidadeProposicao($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPassos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPasso($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRecursoProposicaos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecursoProposicao($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSeguirs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSeguir($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTamanhoTurmaProposicaos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTamanhoTurmaProposicao($relObj->copy($deepCopy));
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
     * @return \Model\Proposicao Clone of current object.
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
     * Declares an association between this object and a ChildUsuario object.
     *
     * @param  ChildUsuario $v
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsuario(ChildUsuario $v = null)
    {
        if ($v === null) {
            $this->setIdUsuario(NULL);
        } else {
            $this->setIdUsuario($v->getId());
        }

        $this->aUsuario = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsuario object, it will not be re-added.
        if ($v !== null) {
            $v->addProposicao($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsuario object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsuario The associated ChildUsuario object.
     * @throws PropelException
     */
    public function getUsuario(ConnectionInterface $con = null)
    {
        if ($this->aUsuario === null && ($this->id_usuario !== null)) {
            $this->aUsuario = ChildUsuarioQuery::create()->findPk($this->id_usuario, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsuario->addProposicaos($this);
             */
        }

        return $this->aUsuario;
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
        if ('AmbienteProposicao' == $relationName) {
            return $this->initAmbienteProposicaos();
        }
        if ('Comentario' == $relationName) {
            return $this->initComentarios();
        }
        if ('Concluir' == $relationName) {
            return $this->initConcluirs();
        }
        if ('Curtir' == $relationName) {
            return $this->initCurtirs();
        }
        if ('HabilidadeProposicao' == $relationName) {
            return $this->initHabilidadeProposicaos();
        }
        if ('Passo' == $relationName) {
            return $this->initPassos();
        }
        if ('RecursoProposicao' == $relationName) {
            return $this->initRecursoProposicaos();
        }
        if ('Seguir' == $relationName) {
            return $this->initSeguirs();
        }
        if ('TamanhoTurmaProposicao' == $relationName) {
            return $this->initTamanhoTurmaProposicaos();
        }
    }

    /**
     * Clears out the collAmbienteProposicaos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAmbienteProposicaos()
     */
    public function clearAmbienteProposicaos()
    {
        $this->collAmbienteProposicaos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAmbienteProposicaos collection loaded partially.
     */
    public function resetPartialAmbienteProposicaos($v = true)
    {
        $this->collAmbienteProposicaosPartial = $v;
    }

    /**
     * Initializes the collAmbienteProposicaos collection.
     *
     * By default this just sets the collAmbienteProposicaos collection to an empty array (like clearcollAmbienteProposicaos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAmbienteProposicaos($overrideExisting = true)
    {
        if (null !== $this->collAmbienteProposicaos && !$overrideExisting) {
            return;
        }

        $collectionClassName = AmbienteProposicaoTableMap::getTableMap()->getCollectionClassName();

        $this->collAmbienteProposicaos = new $collectionClassName;
        $this->collAmbienteProposicaos->setModel('\Model\AmbienteProposicao');
    }

    /**
     * Gets an array of ChildAmbienteProposicao objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAmbienteProposicao[] List of ChildAmbienteProposicao objects
     * @throws PropelException
     */
    public function getAmbienteProposicaos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAmbienteProposicaosPartial && !$this->isNew();
        if (null === $this->collAmbienteProposicaos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAmbienteProposicaos) {
                // return empty collection
                $this->initAmbienteProposicaos();
            } else {
                $collAmbienteProposicaos = ChildAmbienteProposicaoQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAmbienteProposicaosPartial && count($collAmbienteProposicaos)) {
                        $this->initAmbienteProposicaos(false);

                        foreach ($collAmbienteProposicaos as $obj) {
                            if (false == $this->collAmbienteProposicaos->contains($obj)) {
                                $this->collAmbienteProposicaos->append($obj);
                            }
                        }

                        $this->collAmbienteProposicaosPartial = true;
                    }

                    return $collAmbienteProposicaos;
                }

                if ($partial && $this->collAmbienteProposicaos) {
                    foreach ($this->collAmbienteProposicaos as $obj) {
                        if ($obj->isNew()) {
                            $collAmbienteProposicaos[] = $obj;
                        }
                    }
                }

                $this->collAmbienteProposicaos = $collAmbienteProposicaos;
                $this->collAmbienteProposicaosPartial = false;
            }
        }

        return $this->collAmbienteProposicaos;
    }

    /**
     * Sets a collection of ChildAmbienteProposicao objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ambienteProposicaos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setAmbienteProposicaos(Collection $ambienteProposicaos, ConnectionInterface $con = null)
    {
        /** @var ChildAmbienteProposicao[] $ambienteProposicaosToDelete */
        $ambienteProposicaosToDelete = $this->getAmbienteProposicaos(new Criteria(), $con)->diff($ambienteProposicaos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ambienteProposicaosScheduledForDeletion = clone $ambienteProposicaosToDelete;

        foreach ($ambienteProposicaosToDelete as $ambienteProposicaoRemoved) {
            $ambienteProposicaoRemoved->setProposicao(null);
        }

        $this->collAmbienteProposicaos = null;
        foreach ($ambienteProposicaos as $ambienteProposicao) {
            $this->addAmbienteProposicao($ambienteProposicao);
        }

        $this->collAmbienteProposicaos = $ambienteProposicaos;
        $this->collAmbienteProposicaosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AmbienteProposicao objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related AmbienteProposicao objects.
     * @throws PropelException
     */
    public function countAmbienteProposicaos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAmbienteProposicaosPartial && !$this->isNew();
        if (null === $this->collAmbienteProposicaos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAmbienteProposicaos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAmbienteProposicaos());
            }

            $query = ChildAmbienteProposicaoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collAmbienteProposicaos);
    }

    /**
     * Method called to associate a ChildAmbienteProposicao object to this object
     * through the ChildAmbienteProposicao foreign key attribute.
     *
     * @param  ChildAmbienteProposicao $l ChildAmbienteProposicao
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addAmbienteProposicao(ChildAmbienteProposicao $l)
    {
        if ($this->collAmbienteProposicaos === null) {
            $this->initAmbienteProposicaos();
            $this->collAmbienteProposicaosPartial = true;
        }

        if (!$this->collAmbienteProposicaos->contains($l)) {
            $this->doAddAmbienteProposicao($l);

            if ($this->ambienteProposicaosScheduledForDeletion and $this->ambienteProposicaosScheduledForDeletion->contains($l)) {
                $this->ambienteProposicaosScheduledForDeletion->remove($this->ambienteProposicaosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAmbienteProposicao $ambienteProposicao The ChildAmbienteProposicao object to add.
     */
    protected function doAddAmbienteProposicao(ChildAmbienteProposicao $ambienteProposicao)
    {
        $this->collAmbienteProposicaos[]= $ambienteProposicao;
        $ambienteProposicao->setProposicao($this);
    }

    /**
     * @param  ChildAmbienteProposicao $ambienteProposicao The ChildAmbienteProposicao object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removeAmbienteProposicao(ChildAmbienteProposicao $ambienteProposicao)
    {
        if ($this->getAmbienteProposicaos()->contains($ambienteProposicao)) {
            $pos = $this->collAmbienteProposicaos->search($ambienteProposicao);
            $this->collAmbienteProposicaos->remove($pos);
            if (null === $this->ambienteProposicaosScheduledForDeletion) {
                $this->ambienteProposicaosScheduledForDeletion = clone $this->collAmbienteProposicaos;
                $this->ambienteProposicaosScheduledForDeletion->clear();
            }
            $this->ambienteProposicaosScheduledForDeletion[]= clone $ambienteProposicao;
            $ambienteProposicao->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related AmbienteProposicaos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAmbienteProposicao[] List of ChildAmbienteProposicao objects
     */
    public function getAmbienteProposicaosJoinAmbiente(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAmbienteProposicaoQuery::create(null, $criteria);
        $query->joinWith('Ambiente', $joinBehavior);

        return $this->getAmbienteProposicaos($query, $con);
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
     * If this ChildProposicao is new, it will return
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
                    ->filterByProposicao($this)
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
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setComentarios(Collection $comentarios, ConnectionInterface $con = null)
    {
        /** @var ChildComentario[] $comentariosToDelete */
        $comentariosToDelete = $this->getComentarios(new Criteria(), $con)->diff($comentarios);


        $this->comentariosScheduledForDeletion = $comentariosToDelete;

        foreach ($comentariosToDelete as $comentarioRemoved) {
            $comentarioRemoved->setProposicao(null);
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
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collComentarios);
    }

    /**
     * Method called to associate a ChildComentario object to this object
     * through the ChildComentario foreign key attribute.
     *
     * @param  ChildComentario $l ChildComentario
     * @return $this|\Model\Proposicao The current object (for fluent API support)
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
        $comentario->setProposicao($this);
    }

    /**
     * @param  ChildComentario $comentario The ChildComentario object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
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
            $comentario->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related Comentarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildComentario[] List of ChildComentario objects
     */
    public function getComentariosJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildComentarioQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getComentarios($query, $con);
    }

    /**
     * Clears out the collConcluirs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addConcluirs()
     */
    public function clearConcluirs()
    {
        $this->collConcluirs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collConcluirs collection loaded partially.
     */
    public function resetPartialConcluirs($v = true)
    {
        $this->collConcluirsPartial = $v;
    }

    /**
     * Initializes the collConcluirs collection.
     *
     * By default this just sets the collConcluirs collection to an empty array (like clearcollConcluirs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConcluirs($overrideExisting = true)
    {
        if (null !== $this->collConcluirs && !$overrideExisting) {
            return;
        }

        $collectionClassName = ConcluirTableMap::getTableMap()->getCollectionClassName();

        $this->collConcluirs = new $collectionClassName;
        $this->collConcluirs->setModel('\Model\Concluir');
    }

    /**
     * Gets an array of ChildConcluir objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildConcluir[] List of ChildConcluir objects
     * @throws PropelException
     */
    public function getConcluirs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collConcluirsPartial && !$this->isNew();
        if (null === $this->collConcluirs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConcluirs) {
                // return empty collection
                $this->initConcluirs();
            } else {
                $collConcluirs = ChildConcluirQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collConcluirsPartial && count($collConcluirs)) {
                        $this->initConcluirs(false);

                        foreach ($collConcluirs as $obj) {
                            if (false == $this->collConcluirs->contains($obj)) {
                                $this->collConcluirs->append($obj);
                            }
                        }

                        $this->collConcluirsPartial = true;
                    }

                    return $collConcluirs;
                }

                if ($partial && $this->collConcluirs) {
                    foreach ($this->collConcluirs as $obj) {
                        if ($obj->isNew()) {
                            $collConcluirs[] = $obj;
                        }
                    }
                }

                $this->collConcluirs = $collConcluirs;
                $this->collConcluirsPartial = false;
            }
        }

        return $this->collConcluirs;
    }

    /**
     * Sets a collection of ChildConcluir objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $concluirs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setConcluirs(Collection $concluirs, ConnectionInterface $con = null)
    {
        /** @var ChildConcluir[] $concluirsToDelete */
        $concluirsToDelete = $this->getConcluirs(new Criteria(), $con)->diff($concluirs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->concluirsScheduledForDeletion = clone $concluirsToDelete;

        foreach ($concluirsToDelete as $concluirRemoved) {
            $concluirRemoved->setProposicao(null);
        }

        $this->collConcluirs = null;
        foreach ($concluirs as $concluir) {
            $this->addConcluir($concluir);
        }

        $this->collConcluirs = $concluirs;
        $this->collConcluirsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Concluir objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Concluir objects.
     * @throws PropelException
     */
    public function countConcluirs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collConcluirsPartial && !$this->isNew();
        if (null === $this->collConcluirs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConcluirs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConcluirs());
            }

            $query = ChildConcluirQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collConcluirs);
    }

    /**
     * Method called to associate a ChildConcluir object to this object
     * through the ChildConcluir foreign key attribute.
     *
     * @param  ChildConcluir $l ChildConcluir
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addConcluir(ChildConcluir $l)
    {
        if ($this->collConcluirs === null) {
            $this->initConcluirs();
            $this->collConcluirsPartial = true;
        }

        if (!$this->collConcluirs->contains($l)) {
            $this->doAddConcluir($l);

            if ($this->concluirsScheduledForDeletion and $this->concluirsScheduledForDeletion->contains($l)) {
                $this->concluirsScheduledForDeletion->remove($this->concluirsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildConcluir $concluir The ChildConcluir object to add.
     */
    protected function doAddConcluir(ChildConcluir $concluir)
    {
        $this->collConcluirs[]= $concluir;
        $concluir->setProposicao($this);
    }

    /**
     * @param  ChildConcluir $concluir The ChildConcluir object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removeConcluir(ChildConcluir $concluir)
    {
        if ($this->getConcluirs()->contains($concluir)) {
            $pos = $this->collConcluirs->search($concluir);
            $this->collConcluirs->remove($pos);
            if (null === $this->concluirsScheduledForDeletion) {
                $this->concluirsScheduledForDeletion = clone $this->collConcluirs;
                $this->concluirsScheduledForDeletion->clear();
            }
            $this->concluirsScheduledForDeletion[]= clone $concluir;
            $concluir->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related Concluirs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildConcluir[] List of ChildConcluir objects
     */
    public function getConcluirsJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildConcluirQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getConcluirs($query, $con);
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
     * If this ChildProposicao is new, it will return
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
                    ->filterByProposicao($this)
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
     * @return $this|ChildProposicao The current object (for fluent API support)
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
            $curtirRemoved->setProposicao(null);
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
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collCurtirs);
    }

    /**
     * Method called to associate a ChildCurtir object to this object
     * through the ChildCurtir foreign key attribute.
     *
     * @param  ChildCurtir $l ChildCurtir
     * @return $this|\Model\Proposicao The current object (for fluent API support)
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
        $curtir->setProposicao($this);
    }

    /**
     * @param  ChildCurtir $curtir The ChildCurtir object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
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
            $curtir->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related Curtirs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCurtir[] List of ChildCurtir objects
     */
    public function getCurtirsJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCurtirQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getCurtirs($query, $con);
    }

    /**
     * Clears out the collHabilidadeProposicaos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addHabilidadeProposicaos()
     */
    public function clearHabilidadeProposicaos()
    {
        $this->collHabilidadeProposicaos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collHabilidadeProposicaos collection loaded partially.
     */
    public function resetPartialHabilidadeProposicaos($v = true)
    {
        $this->collHabilidadeProposicaosPartial = $v;
    }

    /**
     * Initializes the collHabilidadeProposicaos collection.
     *
     * By default this just sets the collHabilidadeProposicaos collection to an empty array (like clearcollHabilidadeProposicaos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHabilidadeProposicaos($overrideExisting = true)
    {
        if (null !== $this->collHabilidadeProposicaos && !$overrideExisting) {
            return;
        }

        $collectionClassName = HabilidadeProposicaoTableMap::getTableMap()->getCollectionClassName();

        $this->collHabilidadeProposicaos = new $collectionClassName;
        $this->collHabilidadeProposicaos->setModel('\Model\HabilidadeProposicao');
    }

    /**
     * Gets an array of ChildHabilidadeProposicao objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHabilidadeProposicao[] List of ChildHabilidadeProposicao objects
     * @throws PropelException
     */
    public function getHabilidadeProposicaos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collHabilidadeProposicaosPartial && !$this->isNew();
        if (null === $this->collHabilidadeProposicaos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collHabilidadeProposicaos) {
                // return empty collection
                $this->initHabilidadeProposicaos();
            } else {
                $collHabilidadeProposicaos = ChildHabilidadeProposicaoQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHabilidadeProposicaosPartial && count($collHabilidadeProposicaos)) {
                        $this->initHabilidadeProposicaos(false);

                        foreach ($collHabilidadeProposicaos as $obj) {
                            if (false == $this->collHabilidadeProposicaos->contains($obj)) {
                                $this->collHabilidadeProposicaos->append($obj);
                            }
                        }

                        $this->collHabilidadeProposicaosPartial = true;
                    }

                    return $collHabilidadeProposicaos;
                }

                if ($partial && $this->collHabilidadeProposicaos) {
                    foreach ($this->collHabilidadeProposicaos as $obj) {
                        if ($obj->isNew()) {
                            $collHabilidadeProposicaos[] = $obj;
                        }
                    }
                }

                $this->collHabilidadeProposicaos = $collHabilidadeProposicaos;
                $this->collHabilidadeProposicaosPartial = false;
            }
        }

        return $this->collHabilidadeProposicaos;
    }

    /**
     * Sets a collection of ChildHabilidadeProposicao objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $habilidadeProposicaos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setHabilidadeProposicaos(Collection $habilidadeProposicaos, ConnectionInterface $con = null)
    {
        /** @var ChildHabilidadeProposicao[] $habilidadeProposicaosToDelete */
        $habilidadeProposicaosToDelete = $this->getHabilidadeProposicaos(new Criteria(), $con)->diff($habilidadeProposicaos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->habilidadeProposicaosScheduledForDeletion = clone $habilidadeProposicaosToDelete;

        foreach ($habilidadeProposicaosToDelete as $habilidadeProposicaoRemoved) {
            $habilidadeProposicaoRemoved->setProposicao(null);
        }

        $this->collHabilidadeProposicaos = null;
        foreach ($habilidadeProposicaos as $habilidadeProposicao) {
            $this->addHabilidadeProposicao($habilidadeProposicao);
        }

        $this->collHabilidadeProposicaos = $habilidadeProposicaos;
        $this->collHabilidadeProposicaosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HabilidadeProposicao objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related HabilidadeProposicao objects.
     * @throws PropelException
     */
    public function countHabilidadeProposicaos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collHabilidadeProposicaosPartial && !$this->isNew();
        if (null === $this->collHabilidadeProposicaos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHabilidadeProposicaos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHabilidadeProposicaos());
            }

            $query = ChildHabilidadeProposicaoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collHabilidadeProposicaos);
    }

    /**
     * Method called to associate a ChildHabilidadeProposicao object to this object
     * through the ChildHabilidadeProposicao foreign key attribute.
     *
     * @param  ChildHabilidadeProposicao $l ChildHabilidadeProposicao
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addHabilidadeProposicao(ChildHabilidadeProposicao $l)
    {
        if ($this->collHabilidadeProposicaos === null) {
            $this->initHabilidadeProposicaos();
            $this->collHabilidadeProposicaosPartial = true;
        }

        if (!$this->collHabilidadeProposicaos->contains($l)) {
            $this->doAddHabilidadeProposicao($l);

            if ($this->habilidadeProposicaosScheduledForDeletion and $this->habilidadeProposicaosScheduledForDeletion->contains($l)) {
                $this->habilidadeProposicaosScheduledForDeletion->remove($this->habilidadeProposicaosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHabilidadeProposicao $habilidadeProposicao The ChildHabilidadeProposicao object to add.
     */
    protected function doAddHabilidadeProposicao(ChildHabilidadeProposicao $habilidadeProposicao)
    {
        $this->collHabilidadeProposicaos[]= $habilidadeProposicao;
        $habilidadeProposicao->setProposicao($this);
    }

    /**
     * @param  ChildHabilidadeProposicao $habilidadeProposicao The ChildHabilidadeProposicao object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removeHabilidadeProposicao(ChildHabilidadeProposicao $habilidadeProposicao)
    {
        if ($this->getHabilidadeProposicaos()->contains($habilidadeProposicao)) {
            $pos = $this->collHabilidadeProposicaos->search($habilidadeProposicao);
            $this->collHabilidadeProposicaos->remove($pos);
            if (null === $this->habilidadeProposicaosScheduledForDeletion) {
                $this->habilidadeProposicaosScheduledForDeletion = clone $this->collHabilidadeProposicaos;
                $this->habilidadeProposicaosScheduledForDeletion->clear();
            }
            $this->habilidadeProposicaosScheduledForDeletion[]= clone $habilidadeProposicao;
            $habilidadeProposicao->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related HabilidadeProposicaos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildHabilidadeProposicao[] List of ChildHabilidadeProposicao objects
     */
    public function getHabilidadeProposicaosJoinHabilidade(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildHabilidadeProposicaoQuery::create(null, $criteria);
        $query->joinWith('Habilidade', $joinBehavior);

        return $this->getHabilidadeProposicaos($query, $con);
    }

    /**
     * Clears out the collPassos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPassos()
     */
    public function clearPassos()
    {
        $this->collPassos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPassos collection loaded partially.
     */
    public function resetPartialPassos($v = true)
    {
        $this->collPassosPartial = $v;
    }

    /**
     * Initializes the collPassos collection.
     *
     * By default this just sets the collPassos collection to an empty array (like clearcollPassos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPassos($overrideExisting = true)
    {
        if (null !== $this->collPassos && !$overrideExisting) {
            return;
        }

        $collectionClassName = PassoTableMap::getTableMap()->getCollectionClassName();

        $this->collPassos = new $collectionClassName;
        $this->collPassos->setModel('\Model\Passo');
    }

    /**
     * Gets an array of ChildPasso objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPasso[] List of ChildPasso objects
     * @throws PropelException
     */
    public function getPassos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPassosPartial && !$this->isNew();
        if (null === $this->collPassos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPassos) {
                // return empty collection
                $this->initPassos();
            } else {
                $collPassos = ChildPassoQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPassosPartial && count($collPassos)) {
                        $this->initPassos(false);

                        foreach ($collPassos as $obj) {
                            if (false == $this->collPassos->contains($obj)) {
                                $this->collPassos->append($obj);
                            }
                        }

                        $this->collPassosPartial = true;
                    }

                    return $collPassos;
                }

                if ($partial && $this->collPassos) {
                    foreach ($this->collPassos as $obj) {
                        if ($obj->isNew()) {
                            $collPassos[] = $obj;
                        }
                    }
                }

                $this->collPassos = $collPassos;
                $this->collPassosPartial = false;
            }
        }

        return $this->collPassos;
    }

    /**
     * Sets a collection of ChildPasso objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $passos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setPassos(Collection $passos, ConnectionInterface $con = null)
    {
        /** @var ChildPasso[] $passosToDelete */
        $passosToDelete = $this->getPassos(new Criteria(), $con)->diff($passos);


        $this->passosScheduledForDeletion = $passosToDelete;

        foreach ($passosToDelete as $passoRemoved) {
            $passoRemoved->setProposicao(null);
        }

        $this->collPassos = null;
        foreach ($passos as $passo) {
            $this->addPasso($passo);
        }

        $this->collPassos = $passos;
        $this->collPassosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Passo objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Passo objects.
     * @throws PropelException
     */
    public function countPassos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPassosPartial && !$this->isNew();
        if (null === $this->collPassos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPassos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPassos());
            }

            $query = ChildPassoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collPassos);
    }

    /**
     * Method called to associate a ChildPasso object to this object
     * through the ChildPasso foreign key attribute.
     *
     * @param  ChildPasso $l ChildPasso
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addPasso(ChildPasso $l)
    {
        if ($this->collPassos === null) {
            $this->initPassos();
            $this->collPassosPartial = true;
        }

        if (!$this->collPassos->contains($l)) {
            $this->doAddPasso($l);

            if ($this->passosScheduledForDeletion and $this->passosScheduledForDeletion->contains($l)) {
                $this->passosScheduledForDeletion->remove($this->passosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPasso $passo The ChildPasso object to add.
     */
    protected function doAddPasso(ChildPasso $passo)
    {
        $this->collPassos[]= $passo;
        $passo->setProposicao($this);
    }

    /**
     * @param  ChildPasso $passo The ChildPasso object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removePasso(ChildPasso $passo)
    {
        if ($this->getPassos()->contains($passo)) {
            $pos = $this->collPassos->search($passo);
            $this->collPassos->remove($pos);
            if (null === $this->passosScheduledForDeletion) {
                $this->passosScheduledForDeletion = clone $this->collPassos;
                $this->passosScheduledForDeletion->clear();
            }
            $this->passosScheduledForDeletion[]= clone $passo;
            $passo->setProposicao(null);
        }

        return $this;
    }

    /**
     * Clears out the collRecursoProposicaos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRecursoProposicaos()
     */
    public function clearRecursoProposicaos()
    {
        $this->collRecursoProposicaos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRecursoProposicaos collection loaded partially.
     */
    public function resetPartialRecursoProposicaos($v = true)
    {
        $this->collRecursoProposicaosPartial = $v;
    }

    /**
     * Initializes the collRecursoProposicaos collection.
     *
     * By default this just sets the collRecursoProposicaos collection to an empty array (like clearcollRecursoProposicaos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRecursoProposicaos($overrideExisting = true)
    {
        if (null !== $this->collRecursoProposicaos && !$overrideExisting) {
            return;
        }

        $collectionClassName = RecursoProposicaoTableMap::getTableMap()->getCollectionClassName();

        $this->collRecursoProposicaos = new $collectionClassName;
        $this->collRecursoProposicaos->setModel('\Model\RecursoProposicao');
    }

    /**
     * Gets an array of ChildRecursoProposicao objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRecursoProposicao[] List of ChildRecursoProposicao objects
     * @throws PropelException
     */
    public function getRecursoProposicaos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRecursoProposicaosPartial && !$this->isNew();
        if (null === $this->collRecursoProposicaos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRecursoProposicaos) {
                // return empty collection
                $this->initRecursoProposicaos();
            } else {
                $collRecursoProposicaos = ChildRecursoProposicaoQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRecursoProposicaosPartial && count($collRecursoProposicaos)) {
                        $this->initRecursoProposicaos(false);

                        foreach ($collRecursoProposicaos as $obj) {
                            if (false == $this->collRecursoProposicaos->contains($obj)) {
                                $this->collRecursoProposicaos->append($obj);
                            }
                        }

                        $this->collRecursoProposicaosPartial = true;
                    }

                    return $collRecursoProposicaos;
                }

                if ($partial && $this->collRecursoProposicaos) {
                    foreach ($this->collRecursoProposicaos as $obj) {
                        if ($obj->isNew()) {
                            $collRecursoProposicaos[] = $obj;
                        }
                    }
                }

                $this->collRecursoProposicaos = $collRecursoProposicaos;
                $this->collRecursoProposicaosPartial = false;
            }
        }

        return $this->collRecursoProposicaos;
    }

    /**
     * Sets a collection of ChildRecursoProposicao objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $recursoProposicaos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setRecursoProposicaos(Collection $recursoProposicaos, ConnectionInterface $con = null)
    {
        /** @var ChildRecursoProposicao[] $recursoProposicaosToDelete */
        $recursoProposicaosToDelete = $this->getRecursoProposicaos(new Criteria(), $con)->diff($recursoProposicaos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->recursoProposicaosScheduledForDeletion = clone $recursoProposicaosToDelete;

        foreach ($recursoProposicaosToDelete as $recursoProposicaoRemoved) {
            $recursoProposicaoRemoved->setProposicao(null);
        }

        $this->collRecursoProposicaos = null;
        foreach ($recursoProposicaos as $recursoProposicao) {
            $this->addRecursoProposicao($recursoProposicao);
        }

        $this->collRecursoProposicaos = $recursoProposicaos;
        $this->collRecursoProposicaosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RecursoProposicao objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related RecursoProposicao objects.
     * @throws PropelException
     */
    public function countRecursoProposicaos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRecursoProposicaosPartial && !$this->isNew();
        if (null === $this->collRecursoProposicaos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRecursoProposicaos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRecursoProposicaos());
            }

            $query = ChildRecursoProposicaoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collRecursoProposicaos);
    }

    /**
     * Method called to associate a ChildRecursoProposicao object to this object
     * through the ChildRecursoProposicao foreign key attribute.
     *
     * @param  ChildRecursoProposicao $l ChildRecursoProposicao
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addRecursoProposicao(ChildRecursoProposicao $l)
    {
        if ($this->collRecursoProposicaos === null) {
            $this->initRecursoProposicaos();
            $this->collRecursoProposicaosPartial = true;
        }

        if (!$this->collRecursoProposicaos->contains($l)) {
            $this->doAddRecursoProposicao($l);

            if ($this->recursoProposicaosScheduledForDeletion and $this->recursoProposicaosScheduledForDeletion->contains($l)) {
                $this->recursoProposicaosScheduledForDeletion->remove($this->recursoProposicaosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildRecursoProposicao $recursoProposicao The ChildRecursoProposicao object to add.
     */
    protected function doAddRecursoProposicao(ChildRecursoProposicao $recursoProposicao)
    {
        $this->collRecursoProposicaos[]= $recursoProposicao;
        $recursoProposicao->setProposicao($this);
    }

    /**
     * @param  ChildRecursoProposicao $recursoProposicao The ChildRecursoProposicao object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removeRecursoProposicao(ChildRecursoProposicao $recursoProposicao)
    {
        if ($this->getRecursoProposicaos()->contains($recursoProposicao)) {
            $pos = $this->collRecursoProposicaos->search($recursoProposicao);
            $this->collRecursoProposicaos->remove($pos);
            if (null === $this->recursoProposicaosScheduledForDeletion) {
                $this->recursoProposicaosScheduledForDeletion = clone $this->collRecursoProposicaos;
                $this->recursoProposicaosScheduledForDeletion->clear();
            }
            $this->recursoProposicaosScheduledForDeletion[]= clone $recursoProposicao;
            $recursoProposicao->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related RecursoProposicaos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRecursoProposicao[] List of ChildRecursoProposicao objects
     */
    public function getRecursoProposicaosJoinRecurso(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRecursoProposicaoQuery::create(null, $criteria);
        $query->joinWith('Recurso', $joinBehavior);

        return $this->getRecursoProposicaos($query, $con);
    }

    /**
     * Clears out the collSeguirs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSeguirs()
     */
    public function clearSeguirs()
    {
        $this->collSeguirs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSeguirs collection loaded partially.
     */
    public function resetPartialSeguirs($v = true)
    {
        $this->collSeguirsPartial = $v;
    }

    /**
     * Initializes the collSeguirs collection.
     *
     * By default this just sets the collSeguirs collection to an empty array (like clearcollSeguirs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSeguirs($overrideExisting = true)
    {
        if (null !== $this->collSeguirs && !$overrideExisting) {
            return;
        }

        $collectionClassName = SeguirTableMap::getTableMap()->getCollectionClassName();

        $this->collSeguirs = new $collectionClassName;
        $this->collSeguirs->setModel('\Model\Seguir');
    }

    /**
     * Gets an array of ChildSeguir objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSeguir[] List of ChildSeguir objects
     * @throws PropelException
     */
    public function getSeguirs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSeguirsPartial && !$this->isNew();
        if (null === $this->collSeguirs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSeguirs) {
                // return empty collection
                $this->initSeguirs();
            } else {
                $collSeguirs = ChildSeguirQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSeguirsPartial && count($collSeguirs)) {
                        $this->initSeguirs(false);

                        foreach ($collSeguirs as $obj) {
                            if (false == $this->collSeguirs->contains($obj)) {
                                $this->collSeguirs->append($obj);
                            }
                        }

                        $this->collSeguirsPartial = true;
                    }

                    return $collSeguirs;
                }

                if ($partial && $this->collSeguirs) {
                    foreach ($this->collSeguirs as $obj) {
                        if ($obj->isNew()) {
                            $collSeguirs[] = $obj;
                        }
                    }
                }

                $this->collSeguirs = $collSeguirs;
                $this->collSeguirsPartial = false;
            }
        }

        return $this->collSeguirs;
    }

    /**
     * Sets a collection of ChildSeguir objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $seguirs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setSeguirs(Collection $seguirs, ConnectionInterface $con = null)
    {
        /** @var ChildSeguir[] $seguirsToDelete */
        $seguirsToDelete = $this->getSeguirs(new Criteria(), $con)->diff($seguirs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->seguirsScheduledForDeletion = clone $seguirsToDelete;

        foreach ($seguirsToDelete as $seguirRemoved) {
            $seguirRemoved->setProposicao(null);
        }

        $this->collSeguirs = null;
        foreach ($seguirs as $seguir) {
            $this->addSeguir($seguir);
        }

        $this->collSeguirs = $seguirs;
        $this->collSeguirsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Seguir objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Seguir objects.
     * @throws PropelException
     */
    public function countSeguirs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSeguirsPartial && !$this->isNew();
        if (null === $this->collSeguirs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSeguirs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSeguirs());
            }

            $query = ChildSeguirQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collSeguirs);
    }

    /**
     * Method called to associate a ChildSeguir object to this object
     * through the ChildSeguir foreign key attribute.
     *
     * @param  ChildSeguir $l ChildSeguir
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addSeguir(ChildSeguir $l)
    {
        if ($this->collSeguirs === null) {
            $this->initSeguirs();
            $this->collSeguirsPartial = true;
        }

        if (!$this->collSeguirs->contains($l)) {
            $this->doAddSeguir($l);

            if ($this->seguirsScheduledForDeletion and $this->seguirsScheduledForDeletion->contains($l)) {
                $this->seguirsScheduledForDeletion->remove($this->seguirsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSeguir $seguir The ChildSeguir object to add.
     */
    protected function doAddSeguir(ChildSeguir $seguir)
    {
        $this->collSeguirs[]= $seguir;
        $seguir->setProposicao($this);
    }

    /**
     * @param  ChildSeguir $seguir The ChildSeguir object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removeSeguir(ChildSeguir $seguir)
    {
        if ($this->getSeguirs()->contains($seguir)) {
            $pos = $this->collSeguirs->search($seguir);
            $this->collSeguirs->remove($pos);
            if (null === $this->seguirsScheduledForDeletion) {
                $this->seguirsScheduledForDeletion = clone $this->collSeguirs;
                $this->seguirsScheduledForDeletion->clear();
            }
            $this->seguirsScheduledForDeletion[]= clone $seguir;
            $seguir->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related Seguirs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSeguir[] List of ChildSeguir objects
     */
    public function getSeguirsJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSeguirQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getSeguirs($query, $con);
    }

    /**
     * Clears out the collTamanhoTurmaProposicaos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTamanhoTurmaProposicaos()
     */
    public function clearTamanhoTurmaProposicaos()
    {
        $this->collTamanhoTurmaProposicaos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTamanhoTurmaProposicaos collection loaded partially.
     */
    public function resetPartialTamanhoTurmaProposicaos($v = true)
    {
        $this->collTamanhoTurmaProposicaosPartial = $v;
    }

    /**
     * Initializes the collTamanhoTurmaProposicaos collection.
     *
     * By default this just sets the collTamanhoTurmaProposicaos collection to an empty array (like clearcollTamanhoTurmaProposicaos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTamanhoTurmaProposicaos($overrideExisting = true)
    {
        if (null !== $this->collTamanhoTurmaProposicaos && !$overrideExisting) {
            return;
        }

        $collectionClassName = TamanhoTurmaProposicaoTableMap::getTableMap()->getCollectionClassName();

        $this->collTamanhoTurmaProposicaos = new $collectionClassName;
        $this->collTamanhoTurmaProposicaos->setModel('\Model\TamanhoTurmaProposicao');
    }

    /**
     * Gets an array of ChildTamanhoTurmaProposicao objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProposicao is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTamanhoTurmaProposicao[] List of ChildTamanhoTurmaProposicao objects
     * @throws PropelException
     */
    public function getTamanhoTurmaProposicaos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTamanhoTurmaProposicaosPartial && !$this->isNew();
        if (null === $this->collTamanhoTurmaProposicaos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTamanhoTurmaProposicaos) {
                // return empty collection
                $this->initTamanhoTurmaProposicaos();
            } else {
                $collTamanhoTurmaProposicaos = ChildTamanhoTurmaProposicaoQuery::create(null, $criteria)
                    ->filterByProposicao($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTamanhoTurmaProposicaosPartial && count($collTamanhoTurmaProposicaos)) {
                        $this->initTamanhoTurmaProposicaos(false);

                        foreach ($collTamanhoTurmaProposicaos as $obj) {
                            if (false == $this->collTamanhoTurmaProposicaos->contains($obj)) {
                                $this->collTamanhoTurmaProposicaos->append($obj);
                            }
                        }

                        $this->collTamanhoTurmaProposicaosPartial = true;
                    }

                    return $collTamanhoTurmaProposicaos;
                }

                if ($partial && $this->collTamanhoTurmaProposicaos) {
                    foreach ($this->collTamanhoTurmaProposicaos as $obj) {
                        if ($obj->isNew()) {
                            $collTamanhoTurmaProposicaos[] = $obj;
                        }
                    }
                }

                $this->collTamanhoTurmaProposicaos = $collTamanhoTurmaProposicaos;
                $this->collTamanhoTurmaProposicaosPartial = false;
            }
        }

        return $this->collTamanhoTurmaProposicaos;
    }

    /**
     * Sets a collection of ChildTamanhoTurmaProposicao objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $tamanhoTurmaProposicaos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function setTamanhoTurmaProposicaos(Collection $tamanhoTurmaProposicaos, ConnectionInterface $con = null)
    {
        /** @var ChildTamanhoTurmaProposicao[] $tamanhoTurmaProposicaosToDelete */
        $tamanhoTurmaProposicaosToDelete = $this->getTamanhoTurmaProposicaos(new Criteria(), $con)->diff($tamanhoTurmaProposicaos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->tamanhoTurmaProposicaosScheduledForDeletion = clone $tamanhoTurmaProposicaosToDelete;

        foreach ($tamanhoTurmaProposicaosToDelete as $tamanhoTurmaProposicaoRemoved) {
            $tamanhoTurmaProposicaoRemoved->setProposicao(null);
        }

        $this->collTamanhoTurmaProposicaos = null;
        foreach ($tamanhoTurmaProposicaos as $tamanhoTurmaProposicao) {
            $this->addTamanhoTurmaProposicao($tamanhoTurmaProposicao);
        }

        $this->collTamanhoTurmaProposicaos = $tamanhoTurmaProposicaos;
        $this->collTamanhoTurmaProposicaosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TamanhoTurmaProposicao objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related TamanhoTurmaProposicao objects.
     * @throws PropelException
     */
    public function countTamanhoTurmaProposicaos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTamanhoTurmaProposicaosPartial && !$this->isNew();
        if (null === $this->collTamanhoTurmaProposicaos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTamanhoTurmaProposicaos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTamanhoTurmaProposicaos());
            }

            $query = ChildTamanhoTurmaProposicaoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProposicao($this)
                ->count($con);
        }

        return count($this->collTamanhoTurmaProposicaos);
    }

    /**
     * Method called to associate a ChildTamanhoTurmaProposicao object to this object
     * through the ChildTamanhoTurmaProposicao foreign key attribute.
     *
     * @param  ChildTamanhoTurmaProposicao $l ChildTamanhoTurmaProposicao
     * @return $this|\Model\Proposicao The current object (for fluent API support)
     */
    public function addTamanhoTurmaProposicao(ChildTamanhoTurmaProposicao $l)
    {
        if ($this->collTamanhoTurmaProposicaos === null) {
            $this->initTamanhoTurmaProposicaos();
            $this->collTamanhoTurmaProposicaosPartial = true;
        }

        if (!$this->collTamanhoTurmaProposicaos->contains($l)) {
            $this->doAddTamanhoTurmaProposicao($l);

            if ($this->tamanhoTurmaProposicaosScheduledForDeletion and $this->tamanhoTurmaProposicaosScheduledForDeletion->contains($l)) {
                $this->tamanhoTurmaProposicaosScheduledForDeletion->remove($this->tamanhoTurmaProposicaosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTamanhoTurmaProposicao $tamanhoTurmaProposicao The ChildTamanhoTurmaProposicao object to add.
     */
    protected function doAddTamanhoTurmaProposicao(ChildTamanhoTurmaProposicao $tamanhoTurmaProposicao)
    {
        $this->collTamanhoTurmaProposicaos[]= $tamanhoTurmaProposicao;
        $tamanhoTurmaProposicao->setProposicao($this);
    }

    /**
     * @param  ChildTamanhoTurmaProposicao $tamanhoTurmaProposicao The ChildTamanhoTurmaProposicao object to remove.
     * @return $this|ChildProposicao The current object (for fluent API support)
     */
    public function removeTamanhoTurmaProposicao(ChildTamanhoTurmaProposicao $tamanhoTurmaProposicao)
    {
        if ($this->getTamanhoTurmaProposicaos()->contains($tamanhoTurmaProposicao)) {
            $pos = $this->collTamanhoTurmaProposicaos->search($tamanhoTurmaProposicao);
            $this->collTamanhoTurmaProposicaos->remove($pos);
            if (null === $this->tamanhoTurmaProposicaosScheduledForDeletion) {
                $this->tamanhoTurmaProposicaosScheduledForDeletion = clone $this->collTamanhoTurmaProposicaos;
                $this->tamanhoTurmaProposicaosScheduledForDeletion->clear();
            }
            $this->tamanhoTurmaProposicaosScheduledForDeletion[]= clone $tamanhoTurmaProposicao;
            $tamanhoTurmaProposicao->setProposicao(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Proposicao is new, it will return
     * an empty collection; or if this Proposicao has previously
     * been saved, it will retrieve related TamanhoTurmaProposicaos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Proposicao.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTamanhoTurmaProposicao[] List of ChildTamanhoTurmaProposicao objects
     */
    public function getTamanhoTurmaProposicaosJoinTamanhoTurma(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTamanhoTurmaProposicaoQuery::create(null, $criteria);
        $query->joinWith('TamanhoTurma', $joinBehavior);

        return $this->getTamanhoTurmaProposicaos($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUsuario) {
            $this->aUsuario->removeProposicao($this);
        }
        $this->id = null;
        $this->id_usuario = null;
        $this->nome = null;
        $this->objetivo = null;
        $this->start = null;
        $this->imagem = null;
        $this->tempo_total = null;
        $this->data_cadastro = null;
        $this->is_rascunho = null;
        $this->categoria = null;
        $this->qte_comentarios = null;
        $this->qte_curtidas = null;
        $this->qte_seguidores = null;
        $this->qte_concluidos = null;
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
            if ($this->collAmbienteProposicaos) {
                foreach ($this->collAmbienteProposicaos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collComentarios) {
                foreach ($this->collComentarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collConcluirs) {
                foreach ($this->collConcluirs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCurtirs) {
                foreach ($this->collCurtirs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHabilidadeProposicaos) {
                foreach ($this->collHabilidadeProposicaos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPassos) {
                foreach ($this->collPassos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRecursoProposicaos) {
                foreach ($this->collRecursoProposicaos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSeguirs) {
                foreach ($this->collSeguirs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTamanhoTurmaProposicaos) {
                foreach ($this->collTamanhoTurmaProposicaos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAmbienteProposicaos = null;
        $this->collComentarios = null;
        $this->collConcluirs = null;
        $this->collCurtirs = null;
        $this->collHabilidadeProposicaos = null;
        $this->collPassos = null;
        $this->collRecursoProposicaos = null;
        $this->collSeguirs = null;
        $this->collTamanhoTurmaProposicaos = null;
        $this->aUsuario = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProposicaoTableMap::DEFAULT_STRING_FORMAT);
    }

    // aggregate_tempo_total behavior

    /**
     * Computes the value of the aggregate column tempo_total *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeTempoTotal(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT SUM(duracao) FROM passo WHERE passo.ID_PROPOSICAO = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column tempo_total *
     * @param ConnectionInterface $con A connection object
     */
    public function updateTempoTotal(ConnectionInterface $con)
    {
        $this->setTempoTotal($this->computeTempoTotal($con));
        $this->save($con);
    }

    // aggregate_comentarios behavior

    /**
     * Computes the value of the aggregate column qte_comentarios *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeQteComentarios(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT COUNT(id) FROM comentario WHERE comentario.ID_PROPOSICAO = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column qte_comentarios *
     * @param ConnectionInterface $con A connection object
     */
    public function updateQteComentarios(ConnectionInterface $con)
    {
        $this->setQteComentarios($this->computeQteComentarios($con));
        $this->save($con);
    }

    // aggregate_curtir behavior

    /**
     * Computes the value of the aggregate column qte_curtidas *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeQteCurtidas(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT COUNT(*) FROM curtir WHERE curtir.ID_PROPOSICAO = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column qte_curtidas *
     * @param ConnectionInterface $con A connection object
     */
    public function updateQteCurtidas(ConnectionInterface $con)
    {
        $this->setQteCurtidas($this->computeQteCurtidas($con));
        $this->save($con);
    }

    // aggregate_seguir behavior

    /**
     * Computes the value of the aggregate column qte_seguidores *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeQteSeguidores(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT COUNT(*) FROM seguir WHERE seguir.ID_PROPOSICAO = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column qte_seguidores *
     * @param ConnectionInterface $con A connection object
     */
    public function updateQteSeguidores(ConnectionInterface $con)
    {
        $this->setQteSeguidores($this->computeQteSeguidores($con));
        $this->save($con);
    }

    // aggregate_concluir behavior

    /**
     * Computes the value of the aggregate column qte_concluidos *
     * @param ConnectionInterface $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeQteConcluidos(ConnectionInterface $con)
    {
        $stmt = $con->prepare('SELECT COUNT(*) FROM concluir WHERE concluir.ID_PROPOSICAO = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column qte_concluidos *
     * @param ConnectionInterface $con A connection object
     */
    public function updateQteConcluidos(ConnectionInterface $con)
    {
        $this->setQteConcluidos($this->computeQteConcluidos($con));
        $this->save($con);
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
