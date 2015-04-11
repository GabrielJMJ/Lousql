<?php
namespace Gabrieljmj\Lousql\Statement;

use Gabrieljmj\Lousql\Builder\BuilderInterface;

abstract class AbstractStatement implements StatementInterface
{
    /**
     * Statement table
     *
     * @var string
     */
    protected $table;

    /**
     * SQL builder instance
     *
     * @var \Gabrieljmj\Lousql\Builder\BuilderInterface
     */
    private $builder;

    /**
     * @param string                                      $table
     * @param \Gabrieljmj\Lousql\Builder\BuilderInterface $bulder
     */
    public function __construct($table, BuilderInterface $builder)
    {
        $this->table = $table;
        $this->builder = $builder;
    }

    /**
     * Finish the table creation
     *
     * @return \Gabrieljmj\Lousql\Builder\BuilderInterface
     */
    final public function done()
    {
        return $this->builder;
    }
}