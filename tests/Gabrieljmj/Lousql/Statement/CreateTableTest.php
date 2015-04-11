<?php
namespace Test\Gabrieljmj\Lousql\Statement;

use Gabrieljmj\Lousql\Statement\CreateTable;
use Test\Gabrieljmj\Lousql\Statement\AbstractStatementTest;

/**
 * @coversDefaultClass \Gabrieljmj\Lousql\Statement\CreateTable
 */
class CreateTableTest extends AbstractStatementTest
{
    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testCreatingQueryWithoutOptions()
    {
        $query = new CreateTable('users', $this->getBuilderMock());

        $this->assertEquals("CREATE TABLE `users` (\n\n);", (string) $query);
    }

    /**
     * @covers ::__contruct
     * @covers ::__toString
     * @covers ::ifNotExists
     */
    public function testCreatingQueryWithIfNotExistsOption()
    {
        $query = new CreateTable('users', $this->getBuilderMock());
        $query->ifNotExists();

        $this->assertEquals("CREATE TABLE IF NOT EXISTS `users` (\n\n);", (string) $query);
    }

    /**
     * @covers ::__construct
     * @covers ::__toString
     * @covers ::engine
     */
    public function testCreatingQueryWithEngineSetted()
    {
        $engine = 'INNODB';
        $query = new CreateTable('users', $this->getBuilderMock());
        $query->engine($engine);

        $this->assertEquals("CREATE TABLE `users` (\n\n)ENGINE = {$engine};", (string) $query);
    }

    /**
     * @covers ::__contruct
     * @covers ::__toString
     * @covers ::__get
     */
    public function testCreatingQueryWithoutOptionsButWithColumns()
    {
        $query = new CreateTable('users', $this->getBuilderMock());
        $query
            ->id
                ->integer(11)
                ->notNull()
                ->autoIncrement()
            ->done()
            ->name
                ->varchar(255)
                ->notNull()
            ->done();

        $this->assertEquals("CREATE TABLE `users` (\n`id` INT(11) NOT NULL AUTO_INCREMENT,\n`name` VARCHAR(255) NOT NULL\n);", (string) $query);
    }

    /**
     * @covers ::__construct
     * @covers ::__toString
     * @covers ::__get
     * @covers ::ifNotExists
     * @covers ::engine
     */
    public function testCreatingQueryWithOptionsAndColumns()
    {
        $query = new CreateTable('users', $this->getBuilderMock());
        $query
            ->ifNotExists()
            ->engine('INNODB')
            ->id
                ->integer(11)
                ->notNull()
                ->autoIncrement()
            ->done()
            ->name
                ->varchar(255)
                ->notNull()
            ->done();

        $this->assertEquals("CREATE TABLE IF NOT EXISTS `users` (\n`id` INT(11) NOT NULL AUTO_INCREMENT,\n`name` VARCHAR(255) NOT NULL\n)ENGINE = INNODB;", (string) $query);
    }
}