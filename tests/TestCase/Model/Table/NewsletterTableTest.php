<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewsletterTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewsletterTable Test Case
 */
class NewsletterTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NewsletterTable
     */
    public $Newsletter;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Newsletter',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Newsletter') ? [] : ['className' => NewsletterTable::class];
        $this->Newsletter = TableRegistry::getTableLocator()->get('Newsletter', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Newsletter);

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
