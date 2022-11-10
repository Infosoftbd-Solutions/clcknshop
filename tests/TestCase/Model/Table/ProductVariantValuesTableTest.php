<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductVariantValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductVariantValuesTable Test Case
 */
class ProductVariantValuesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductVariantValuesTable
     */
    public $ProductVariantValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProductVariantValues',
        'app.ProductOptions',
        'app.ProductVariants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductVariantValues') ? [] : ['className' => ProductVariantValuesTable::class];
        $this->ProductVariantValues = TableRegistry::getTableLocator()->get('ProductVariantValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductVariantValues);

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
