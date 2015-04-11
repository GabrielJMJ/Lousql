<?php
namespace Test\Gabrieljmj\Lousql\Builder;

use Gabrieljmj\Lousql\Builder\Builder;

/**
 * @coversDefaultClass \Gabrieljmj\Lousql\Builder\Builder
 */
class BuiderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::createTable
     * @covers ::getQueries
     */
    public function testCreatingTableWillBeReturnedOnGetterForQueries()
    {
        $builder = new Builder();
        $sql = $builder
            ->createTable('users')
                ->ifNotExists()
                ->id
                    ->integer(11)
                ->done()
                ->name
                    ->varchar(50)
                ->done();

        $queries = array_map(function ($query) {
            return (string) $query;
        }, $builder->getQueries());

        $this->assertContains((string) $sql, $queries);
    }

    /**
     * @covers ::dropTable
     * @covers ::getQueries
     */
    public function testDroppingTableWillBeReturnedOnGetterForQueries()
    {
        $builder = new Builder();
        $sql = $builder->dropTable('users');

        $queries = array_map(function ($query) {
            return (string) $query;
        }, $builder->getQueries());

        $this->assertContains((string) $sql, $queries);
    }
}