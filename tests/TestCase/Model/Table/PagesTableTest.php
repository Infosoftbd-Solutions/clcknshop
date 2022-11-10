<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PagesTable Test Case
 */
class PagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PagesTable
     */
    public $Pages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Pages',
        'app.Facebook',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pages') ? [] : ['className' => PagesTable::class];
        $this->Pages = TableRegistry::getTableLocator()->get('Pages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pages);

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
