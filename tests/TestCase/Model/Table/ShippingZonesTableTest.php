<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ShippingZonesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ShippingZonesTable Test Case
 */
class ShippingZonesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ShippingZonesTable
     */
    public $ShippingZones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ShippingZones',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ShippingZones') ? [] : ['className' => ShippingZonesTable::class];
        $this->ShippingZones = TableRegistry::getTableLocator()->get('ShippingZones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ShippingZones);

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
