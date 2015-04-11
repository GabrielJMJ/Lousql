<?php
/**
 * @package Gabrieljmj\Lousql
 * @author  Gabriel Jacinto aka. GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
 */

namespace Gabrieljmj\Lousql\Statement;

use Gabrieljmj\Lousql\TerminableInterface;
use Gabrieljmj\Lousql\ReadableInterface;

interface StatementInterface extends TerminableInterface, ReadableInterface
{
}