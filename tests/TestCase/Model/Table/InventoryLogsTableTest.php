<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryLogsTable Test Case
 */
class InventoryLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryLogsTable
     */
    public $InventoryLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.InventoryLogs',
        'app.Products',
        'app.Variants',
        'app.Orders',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InventoryLogs') ? [] : ['className' => InventoryLogsTable::class];
        $this->InventoryLogs = TableRegistry::getTableLocator()->get('InventoryLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InventoryLogs);

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
