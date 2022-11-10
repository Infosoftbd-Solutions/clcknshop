<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderStatusTable Test Case
 */
class OrderStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderStatusTable
     */
    public $OrderStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrderStatus',
        'app.Orders',
        'app.Statuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderStatus') ? [] : ['className' => OrderStatusTable::class];
        $this->OrderStatus = TableRegistry::getTableLocator()->get('OrderStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderStatus);

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
