<?php

/**
 *
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Tests the App\Services\Plugins\ConfigFile component
 */
class PluginConfigFileTest extends TestCase
{
    private $testFilePath = 'tests/test.json';

    /**
     * [setUp description]
     */
    public function setUp()
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }

    /**
     * [tearDown description]
     * @return [type] [description]
     */
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

    /**
     * [testGetValues description]
     *
     * @return [type] [description]
     */
    public function testAddGetValues()
    {
        $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        $this->assertTrue($cfg->add('require', 'money/money'));
        $this->assertTrue($cfg->add('require', 'money/money', 'dev-master'));
        $this->assertTrue($cfg->add('require', 'money/money', '155'));

        $this->assertTrue($cfg->exists('require', 'money/money'));
    }

    /**
     * [testRemove description]
     * @return [type] [description]
     */
    public function testRemove()
    {
        $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        $this->assertTrue($cfg->add('require', 'money/money'));

        $this->assertTrue($cfg->exists('require', 'money/money'));

        $this->assertTrue($cfg->remove('require', 'money/money'));
        $this->assertFalse($cfg->exists('require', 'money/money'));
        $this->assertFalse($cfg->remove('require', 'money/dontexist'));
        // $this->assert
    }

    /**
     * [testSetGetValues description]
     * @return [type] [description]
     */
    public function testSetGetValues()
    {
        $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        $cfg->add('require', 'test/test');
        $cfg->add('require', 'test/test2');
        $cfg->add('require', 'test/test3');
        $cfg->set('require', ['money/money' => '1.0.0']);
        $this->assertSame($cfg->get('require'), ['money/money' => '1.0.0']);

    }



    /**
     * [testPersistChanges description]
     *
     * @return [type] [description]
     */
    public function testPersistChanges()
    {
        $cfg = new App\Services\Plugins\ConfigFile(new \SplFileInfo($this->testFilePath));
        $cfg->add('require', 'money/money');
        $cfg->save();

        $content = file_get_contents($this->testFilePath);
        $this->assertTrue(strpos($content, '"money/money"') !== false, "could not detect presence of money/money");
    }
}
