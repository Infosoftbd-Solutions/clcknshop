<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\FbComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\FbComponent Test Case
 */
class FacebookComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\FbComponent
     */
    public $Facebook;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Facebook = new FbComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Facebook);

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
