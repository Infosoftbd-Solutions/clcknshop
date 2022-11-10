<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentProcessorTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentProcessorTable Test Case
 */
class PaymentProcessorTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentProcessorTable
     */
    public $PaymentProcessor;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PaymentProcessor',
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
        $config = TableRegistry::getTableLocator()->exists('PaymentProcessor') ? [] : ['className' => PaymentProcessorTable::class];
        $this->PaymentProcessor = TableRegistry::getTableLocator()->get('PaymentProcessor', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentProcessor);

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
