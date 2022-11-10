<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacebookTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacebookTable Test Case
 */
class FacebookTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FacebookTable
     */
    public $Facebook;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Facebook',
        'app.Pages',
        'app.Businesses',
        'app.Catalogs',
        'app.Feeds',
        'app.Pixels',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Facebook') ? [] : ['className' => FacebookTable::class];
        $this->Facebook = TableRegistry::getTableLocator()->get('Facebook', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Facebook);

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
