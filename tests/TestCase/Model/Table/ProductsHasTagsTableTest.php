<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsHasTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsHasTagsTable Test Case
 */
class ProductsHasTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsHasTagsTable
     */
    public $ProductsHasTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProductsHasTags',
        'app.Products',
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductsHasTags') ? [] : ['className' => ProductsHasTagsTable::class];
        $this->ProductsHasTags = TableRegistry::getTableLocator()->get('ProductsHasTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductsHasTags);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
