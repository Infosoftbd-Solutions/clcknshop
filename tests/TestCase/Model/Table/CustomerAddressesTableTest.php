<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerAddressesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerAddressesTable Test Case
 */
class CustomerAddressesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerAddressesTable
     */
    public $CustomerAddresses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CustomerAddresses',
        'app.Customers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CustomerAddresses') ? [] : ['className' => CustomerAddressesTable::class];
        $this->CustomerAddresses = TableRegistry::getTableLocator()->get('CustomerAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerAddresses);

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
