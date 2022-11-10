<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentMethodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentMethodsTable Test Case
 */
class PaymentMethodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentMethodsTable
     */
    public $PaymentMethods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PaymentMethods',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PaymentMethods') ? [] : ['className' => PaymentMethodsTable::class];
        $this->PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentMethods);

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
}
