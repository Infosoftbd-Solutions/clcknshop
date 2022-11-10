<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderLogsTable Test Case
 */
class OrderLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderLogsTable
     */
    public $OrderLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrderLogs',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderLogs') ? [] : ['className' => OrderLogsTable::class];
        $this->OrderLogs = TableRegistry::getTableLocator()->get('OrderLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderLogs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
