<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServersTable Test Case
 */
class ServersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ServersTable
     */
    public $Servers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Servers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Servers') ? [] : ['className' => ServersTable::class];
        $this->Servers = TableRegistry::getTableLocator()->get('Servers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Servers);

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
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
