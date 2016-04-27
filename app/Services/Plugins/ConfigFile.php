<?php

/**
 *
 */

namespace App\Services\Plugins;

use SplFileInfo;

/**
 * ConfigFile class
 * This class manages the plugin.json file which is used to include Plugins
 * and their dependancies via the composer dependancy management system
 */
class ConfigFile
{
    private $file;

    /**
     * [__construct description]
     * @param SplFileInfo $file [description]
     */
    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
    }

    public function getConfig($key = null)
    {

    }

    /**
     * Load the contents of the config file
     *
     * @return array
     */
    private function load()
    {
        $file = $this->file;
        if (!$file->isFile() || !$file->isReadable()) {
            // create a blank config file
            // $file->openFile('w');
            return [];
        }
    }

    /**
     * Persists the current state of the configuration to the file specified
     *
     * @return boolean
     */
    private function save()
    {
        // @todo implement logic
    }
}
