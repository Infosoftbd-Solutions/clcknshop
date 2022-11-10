<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductMediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductMediaTable Test Case
 */
class ProductMediaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductMediaTable
     */
    public $ProductMedia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProductMedia',
        'app.Products',
        'app.Variants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductMedia') ? [] : ['className' => ProductMediaTable::class];
        $this->ProductMedia = TableRegistry::getTableLocator()->get('ProductMedia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductMedia);

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
