<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\TablerFormHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\TablerFormHelper Test Case
 */
class TablerFormHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\TablerFormHelper
     */
    public $TablerForm;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->TablerForm = new TablerFormHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TablerForm);

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
