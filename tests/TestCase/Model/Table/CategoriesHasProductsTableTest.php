<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriesHasProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriesHasProductsTable Test Case
 */
class CategoriesHasProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriesHasProductsTable
     */
    public $CategoriesHasProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CategoriesHasProducts',
        'app.Categories',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CategoriesHasProducts') ? [] : ['className' => CategoriesHasProductsTable::class];
        $this->CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriesHasProducts);

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
