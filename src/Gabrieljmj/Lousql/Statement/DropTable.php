<?php
/**
 * @package Gabrieljmj\Lousql
 * @author  Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
 */

namespace Gabrieljmj\Lousql\Statement;

use Gabrieljmj\Lousql\Builder\BuilderInterface;
use Gabrieljmj\Lousql\Statement\AbstractStatement;

/**
 * The statement DROP TABLE is used to delete tables
 */
class DropTable extends AbstractStatement
{
    /**
     * The command will be executed only if the table exists
     *
     * @var boolean
     */
    private $ifExists = false;

    /**
     * Says that the command will be executed 
     *  only if the table exists
     *
     * @return \Gabrieljmj\Lousql\Statement\DropTable
     */
    public function ifExists()
    {
        $this->ifExists = true;
        return $this;
    }

    /**
     * Rreturns the query as string
     *
     * @return string
     */
    public function __toString()
    {
        $ifExists = $this->ifExists ? ' IF EXISTS' : null;
        return "DROP TABLE{$ifExists} `{$this->table}`;";
    }
}