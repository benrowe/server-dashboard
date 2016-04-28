<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Tests the App\Services\Plugins\ConfigFile component
 */
class PluginConfigFileTest extends TestCase
{
    private $testFilePath = 'tests/test.json';

    public function setUp()
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }

    public function tearDown()
    {
        $this->setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNonExistFile()
    {
         $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
         $this->assertEmpty($cfg->get('require'));

        // $cfg->add('require', '')

    }
}
