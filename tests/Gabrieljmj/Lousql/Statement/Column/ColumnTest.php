<?php
namespace Test\Gabrieljmj\Lousql\Statement\Column;

use Gabrieljmj\Lousql\Statement\Column\Column;

/**
 * @coversDefaultClass \Gabrieljmj\Lousql\Statement\Column\Column
 */
class ColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \Gabrieljmj\Lousql\Statement\StatementInterface
     */
    private function getStatementMock()
    {
        return $this->getMockBuilder(
            '\Gabrieljmj\Lousql\Statement\StatementInterface'
        )->getMock();
    }

    /**
     * @covers ::integer
     */
    public function testDefiningTypeAsInteger()
    {
        $column = new Column('id', $this->getStatementMock());
        $column->integer(11);

        $this->assertEquals('`id` INT(11)', (string) $column);
    }

    /**
     * @covers ::varchar
     */
    public function testDefiningTypeAsVarchar()
    {
        $column = new Column('name', $this->getStatementMock());
        $column->varchar(255);

        $this->assertEquals('`name` VARCHAR(255)', (string) $column);
    }

    /**
     * @covers ::timestamp
     */
    public function testDefiningTypeAsTimestamp()
    {
        $column = new Column('created_at', $this->getStatementMock());
        $column->timestamp();

        $this->assertEquals('`created_at` TIMESTAMP', (string) $column);
    }

    /**
     * @covers ::date
     */
    public function testDefiningTypeAsDate()
    {
        $column = new Column('time', $this->getStatementMock());
        $column->date();

        $this->assertEquals('`time` DATE', (string) $column);
    }

    /**
     * @depends testDefiningTypeAsVarchar
     * @covers  ::notNull
     */
    public function testDefiningColumnAsNotNull()
    {
        $column = new Column('name', $this->getStatementMock());
        $column
            ->varchar(255)
            ->notNull();

        $this->assertEquals('`name` VARCHAR(255) NOT NULL', (string) $column);
    }

    /**
     * @depends testDefiningTypeAsInteger
     * @covers  ::asDefault
     */
    public function testDefiningADefaultValue()
    {
        $column = new Column('avarage', $this->getStatementMock());
        $column
            ->integer(1)
            ->asDefault(5);

        $this->assertEquals('`avarage` INT(1) DEFAULT 5', (string) $column);
    }

    /**
     * @depends testDefiningTypeAsInteger
     * @covers  ::autoIncrement
     */
    public function testDefiningColumnAsAutoIncrement()
    {
        $column = new Column('id', $this->getStatementMock());
        $column
            ->integer(11)
            ->autoIncrement();

        $this->assertEquals('`id` INT(11) AUTO_INCREMENT', (string) $column);
    }
}