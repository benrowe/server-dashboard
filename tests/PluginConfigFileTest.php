<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PluginConfigFileTest extends TestCase
{
    private $testFilePath = 'test.json';

    public function setUp()
    {
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        // $this->assertSomething(cfg->get('require'));

        // $cfg->add('require', '')

    }
}
