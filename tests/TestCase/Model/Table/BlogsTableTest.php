<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BlogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BlogsTable Test Case
 */
class BlogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BlogsTable
     */
    public $Blogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Blogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Blogs') ? [] : ['className' => BlogsTable::class];
        $this->Blogs = TableRegistry::getTableLocator()->get('Blogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Blogs);

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
