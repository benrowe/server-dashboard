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
    }

    public function testGetValues()
    {
        $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        $this->assertTrue($cfg->add('require', 'money/money'));
        $this->assertTrue($cfg->add('require', 'money/money', 'dev-master'));
        $this->assertTrue($cfg->add('require', 'money/money', '155'));

        $this->assertTrue($cfg->exists('require', 'money/money'));
    }

    public function testPersistChanges()
    {
        $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        $cfg->add('require', 'money/money');
        $cfg->save();

        $content = file_get_contents($this->testFilePath);
        $this->assertTrue(strpos($content, '"money/money"') !== false, "could not detect presence of money/money");
    }
}
