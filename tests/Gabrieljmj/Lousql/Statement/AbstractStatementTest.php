<?php
namespace Test\Gabrieljmj\Lousql\Statement;

abstract class AbstractStatementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \Gabrieljmj\Lousql\Builder\BuilderInterface
     */
    protected function getBuilderMock()
    {
        return $this->getMockBuilder(
            '\Gabrieljmj\Lousql\Builder\BuilderInterface'
        )->getMock();
    }
}