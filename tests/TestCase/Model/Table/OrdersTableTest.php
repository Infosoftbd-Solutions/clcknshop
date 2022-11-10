<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdersTable Test Case
 */
class OrdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdersTable
     */
    public $Orders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Orders',
        'app.ShippingMethods',
        'app.PaymentMethods',
        'app.Customers',
        'app.OrderProducts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Orders') ? [] : ['className' => OrdersTable::class];
        $this->Orders = TableRegistry::getTableLocator()->get('Orders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Orders);

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
