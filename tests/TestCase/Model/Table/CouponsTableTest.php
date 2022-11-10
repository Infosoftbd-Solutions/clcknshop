<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CouponsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CouponsTable Test Case
 */
class CouponsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CouponsTable
     */
    public $Coupons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Coupons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Coupons') ? [] : ['className' => CouponsTable::class];
        $this->Coupons = TableRegistry::getTableLocator()->get('Coupons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Coupons);

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
