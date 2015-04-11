<?php
namespace Test\Gabrieljmj\Lousql\Statement;

use Gabrieljmj\Lousql\Statement\DropTable;
use Test\Gabrieljmj\Lousql\Statement\AbstractStatementTest;

/**
 * @coversDefaultClass \Gabrieljmj\Lousql\Statement\DropTable
 */
class DropTableTest extends AbstractStatementTest
{
    /**
     * @covers ::__contruct
     * @covers ::__toString
     */
    public function testCreatingQueryWithoutOptions()
    {
        $query = new DropTable('users', $this->getBuilderMock());

        $this->assertEquals('DROP TABLE `users`;', (string) $query);
    }

    /**
     * @covers ::__contruct
     * @covers ::__toString
     * @covers ::ifExists
     */
    public function testCreatingQueryWithIfExistsOption()
    {
        $query = new DropTable('users', $this->getBuilderMock());
        $query->ifExists();

        $this->assertEquals('DROP TABLE IF EXISTS `users`;', (string) $query);
    }
}