<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PluginManagerTest extends TestCase
{
    private $testFilePath = 'test.json';

    public function testInstalled()
    {
        // $manager = new \App\Services\Plugins\Manager(new SplFileInfo($this->testFilePath));
        // Get the list of installed plugins
        // $this->assertEmpty($manager->installed());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSearch()
    {
        // $manager = new \App\Services\Plugins\Manager(new SplFileInfo($this->testFilePath));
        // $this->assertEmpty($manager->search('this should not exist'));
    }

    public function testInstall()
    {

    }



    public function testRemove()
    {

    }

    public function testUpdate()
    {

    }

}
