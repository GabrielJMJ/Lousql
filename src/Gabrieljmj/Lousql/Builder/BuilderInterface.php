<?php
/**
 * @package Gabrieljmj\Lousql
 * @author  Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
 */

namespace Gabrieljmj\Lousql\Builder;

/**
 * Interface for SQL builders
 */
interface BuilderInterface
{
    /**
     * Creates an SQL table
     *
     * @param string $table
     */
    public function createTable($table);

    /**
     * Alters an SQL table
     *
     * @param string $table
     */
    public function alterTable($table);
}