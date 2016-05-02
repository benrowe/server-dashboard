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

    private $data;

    /**
     * Defaults for the requested key
     * @var array if the requested key is not defined in the configuration
     *      	  then this default is provided
     */
    private $keyDefaults = [
        'require' => []
    ];

    /**
     * Represents the configuration file
     *
     * @param SplFileInfo $file The file descriptor object
     */
    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
        if (!$this->file->isReadable()) {
            $this->file->openFile('w')->fwrite('{}');
        }
        $this->data = $this->load();
        // at this point we should be able to assume we have a config file that
        // has valid json
    }

    /**
     * Get the data for the provided key
     *
     * @param  string $key
     * @return mixded
     */
    public function get($key)
    {
        $data = $this->getConfig($key);
        if (!$data) {
            if (array_key_exists($key, $this->keyDefaults)) {
                return $this->keyDefaults[$key];
            } else {
                return null;
            }
        }
        return $data;
    }

    /**
     * add a new value to the provided key
     * @param string $key
     * @param string $value
     * @param [type] $other [description]
     */
    public function add($key, $value, $other = null)
    {
        if (!array_key_exists($key, $this->keyDefaults)) {
            throw new \Exception('Unkown key "'.$key.'"');
        }

        if (!array_key_exists($key, $this->data)) {
            $this->data[$key] = $this->keyDefaults[$key];
        }

        $this->data[$key][$value] = $other;
        return true;
    }

    /**
     * Check for the existance of a value in the config
     *
     * @param  string $key
     * @param  string $value
     * @return boolean true if exists
     */
    public function exists($key, $value = null)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get the configuration data
     * If a key is provided, just get that value
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function getConfig($key = null)
    {
        if (!$this->data) {
            $this->data = $this->load();
        }
        if ($key) {
            return array_key_exists($key, $this->data) ? $this->data[$key] : null;
        }
        return $this->data;
    }

    /**
     * Load the contents of the config file
     *
     * @return array
     */
    private function load()
    {
        $file = $this->file;
        if (!$file->isReadable()) {
            throw new \Exception('Unable to read the configuration file');
        }
        // parse the contents of the file into json
        $fileObj = $file->openFile('r');
            // create a blank config file
            // $file->openFile('w');
            // return [];
        // }
        return [];
    }

    /**
     * Persists the current state of the configuration to the file specified
     *
     * @return boolean
     */
    public function save()
    {
        $this->file->openFile('w')->fwrite(json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
