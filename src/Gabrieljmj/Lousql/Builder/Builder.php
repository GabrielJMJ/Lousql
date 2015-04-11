<?php
/**
 * @package Gabrieljmj\Lousql
 * @author  Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
 */

namespace Gabrieljmj\Lousql\Builder;

use Gabrieljmj\Lousql\Statement\CreateTable;
use Gabrieljmj\Lousql\Builder\BuilderInterface;
use Gabrieljmj\Lousql\Statement\DropTable;

/**
 * Build SQL queries
 */
class Builder implements BuilderInterface
{
    /**
     * All queires created
     *
     * @var array
     */
    private $queries = [];

    /**
     * Used for create an SQL table
     *
     * @param string $table
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\CreateTable
     */
    public function createTable($table)
    {
        return $this->addQuery(new CreateTable($table, $this));
    }

    /**
     * Used for alter an SQL table
     *
     * @param string $table
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\AlterTable
     */
    public function alterTable($table)
    {
        return $this->addQuery(new AlterTable($table, $this));
    }

    /**
     * Used for delete some table
     *
     * @param string $table
     *
     * @return \Gabrieljmj\Lousql\Builder\Statement\DropTable
     */
    public function dropTable($table)
    {
        return $this->addQuery(new DropTable($table, $this));
    }

    private function addQuery($query)
    {
        $this->queries[] = $query;
        return $this->queries[count($this->queries) - 1];
    }

    /**
     * Returns all created queries
     *
     * @return array
     */
    public function getQueries()
    {
        return $this->queries;
    }
}