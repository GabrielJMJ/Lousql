<?php
/**
 * @package Gabrieljmj\Lousql
 * @author  Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
 */

namespace Gabrieljmj\Lousql\Statement\Column;

use Gabrieljmj\Lousql\TerminableInterface;
use Gabrieljmj\Lousql\ReadableInterface;
use Gabrieljmj\Lousql\Statement\StatementInterface;
use Gabrieljmj\Lousql\Statement\Column\ColumnTypes;

/**
 * Represents a table column
 */
class Column implements TerminableInterface, ReadableInterface
{
    /**
     * Column name
     * 
     * @var string
     */
    private $name;

    /**
     * Column options
     *
     * @var array
     */
    private $options = ['other' => []];

    /**
     * @param string                                           $name
     * @param \Gabrieljmj\Lousql\Builder\Statement\StatementInterface $statement
     */
    public function __construct($name, StatementInterface $statement)
    {
        $this->name = $name;
        $this->statement = $statement;
    }

    /**
     * Defines the column as integer type
     *
     * @param integer $size
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function integer($size)
    {
        $this->setType(ColumnTypes::INTEGER, [$size]);
        return $this;
    }

    /**
     * Defines the column as varchar type
     *
     * @param integer $size
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function varchar($size)
    {
        $this->setType(ColumnTypes::VARCHAR, [$size]);
        return $this;
    }

    /**
     * Defines the column as timestamp type
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function timestamp()
    {
        $this->setType(ColumnTypes::TIMESTAMP);
        return $this;
    }

    /**
     * Defines the column as sate type
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function date()
    {
        $this->setType(ColumnTypes::DATE);
        return $this;
    }

    /**
     * The column cannot be null
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function notNull()
    {
        $this->options['other'][] = 'NOT NULL';
        return $this;
    }

    /**
     * Defines the column as auto incrementable
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function autoIncrement()
    {
        $this->options['other'][] = 'AUTO_INCREMENT';
        return $this;
    }

    /**
     * Defines the column as the primary key of the table
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function primaryKey()
    {
        $this->options['other'][] = 'PRIMARY KEY';
        return $this;
    }

    /**
     * Sets the default value of a column
     *
     * @param string|integer $value
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\Column
     */
    public function asDefault($value)
    {
        $value = is_string($value) ? "'{$value}'" : (int) $value;
        $this->options['other'][] = 'DEFAULT ' . $value;
        return $this;
    }

    /**
     * Returns the column options as string
     *
     * @return string
     */
    private function getOptions()
    {
        $o  = $this->options['type'];
        $o .= empty($this->options['params']) ? null : '(' . implode(', ', $this->options['params']) . ')';
        $o .= ' ' . implode(' ', $this->options['other']);

        return $o;
    }

    /**
     * Returns the column field
     */
    public function __toString()
    {
        return rtrim('`' . $this->name . '` ' . $this->getOptions());
    }

    /**
     * Finish the column creation
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\StatementInterface
     */
    public function done()
    {
        return $this->statement;
    }

    /**
     * Sets the column type
     *
     * @param stirng $type
     * @param array  $params
     */
    private function setType($type, array $params = [])
    {
        $this->options['type'] = $type;
        $this->options['params'] = count($params) ? array_map(function ($param) {
            return is_string($param) ? "'{$param}'" :
                   is_int($param)    ? $param
                   : (int) $param;
        }, $params) : null;
    }
}