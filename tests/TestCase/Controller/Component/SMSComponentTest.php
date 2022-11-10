<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SMSComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SMSComponent Test Case
 */
class SMSComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\SMSComponent
     */
    public $SMS;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->SMS = new SMSComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SMS);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
