<?php
/**
 * @package Gabrieljmj\Lousql
 * @author  Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
 */

namespace Gabrieljmj\Lousql\Statement;

use Gabrieljmj\Lousql\Builder\BuilderInterface;
use Gabrieljmj\Lousql\Statement\AbstractStatement;
use Gabrieljmj\Lousql\Statement\Column\Column;

/**
 * The statement CREATE TABLE is used to create tables (obviously)
 */
class CreateTable extends AbstractStatement
{
    /**
     * Columns of the table
     *
     * @var array
     */
    private $columns = [];

    /**
     * If the tables needs to not exists to create
     *
     * @var boolean
     */
    private $ifNotExists = false;

    /**
     * The table engine
     *
     * @var string
     */
    private $engine;

    /**
     * Used to create columns
     *
     * @param string $column
     */
    public function __get($column)
    {
        if (!isset($this->columns[$column])) {
            $this->columns[$column] = new Column($column, $this);
        }

        return $this->columns[$column];
    }

    /**
     * Defined that the table only will be created if it does not exists
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\CrateTable
     */
    public function ifNotExists()
    {
        $this->ifNotExists = true;
        return $this;
    }

    /**
     * Sets the table used engine
     *
     * @param string $engine
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\CrateTable
     */
    public function engine($engine)
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * Returns as string the created query
     *
     * @return string
     */
    public function __toString()
    {
        $engine = $this->engine !== null ? 'ENGINE = ' . $this->engine : null;
        $ifNotExists = $this->ifNotExists ? ' IF NOT EXISTS' : null;
        $str  = "CREATE TABLE$ifNotExists `{$this->table}` (\n";
        $str .= implode(",\n", $this->columns);
        $str .= "\n){$engine};";

        return $str;
    }
}