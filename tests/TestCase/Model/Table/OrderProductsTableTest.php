<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderProductsTable Test Case
 */
class OrderProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderProductsTable
     */
    public $OrderProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrderProducts',
        'app.ProductVariants',
        'app.Products',
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
        $config = TableRegistry::getTableLocator()->exists('OrderProducts') ? [] : ['className' => OrderProductsTable::class];
        $this->OrderProducts = TableRegistry::getTableLocator()->get('OrderProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderProducts);

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
