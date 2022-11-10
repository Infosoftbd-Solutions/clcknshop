<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SmsHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SmsHistoriesTable Test Case
 */
class SmsHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SmsHistoriesTable
     */
    public $SmsHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SmsHistories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SmsHistories') ? [] : ['className' => SmsHistoriesTable::class];
        $this->SmsHistories = TableRegistry::getTableLocator()->get('SmsHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SmsHistories);

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
