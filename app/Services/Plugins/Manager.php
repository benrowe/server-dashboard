<?php

namespace App\Services\Plugins;

use SplFileInfo;

/**
 * The plugin manager is a way to install, update & delete plugins,
 * as well as help registers the plugin with the service provider
 */
class Manager
{
    /**
     * @var SplFileInfo
     */
    private $configFile;

    protected $config;

    public function __construct(SplFileInfo $configFile)
    {
        $this->configFile = $configFile;
        // $this->loadConfig();
    }

    /**
     * Install the requested package
     *
     * @param  string $package the vendor/package name
     * @return [type]          [description]
     */
    public function install($package)
    {
        // check that the package doesn't already exist in the configuration
        //
    }

    public function update($package)
    {
        // 1. make sure that the package is already installed in the configuration
        // file
        // 2. run composer update, and force it
    }

    public function remove($package)
    {

    }

    public function hasPackage($package)
    {

    }

    public function registerPackageServiceProvider($package = null)
    {

    }

    /**
     * Checks if the package name is valid (includes a vendor prefix)
     *
     * @param  string  $package the package name to be validated
     * @param  boolean $checkPackagist check packagist that the package exists
     * @return boolean confirms if the package is valid or not
     */
    public function verifyPackageName($package, $checkPackagist = true)
    {
        $validName = preg_match("/^(\w+)\/(\w)$/", $package);

        $source = true;
        if ($checkPackagist) {
            $meta = $this->getPackageMeta($package);
            $source = (bool)$meta;
        }

        return $validName && $source;
    }

    /**
     * [getPackageMeta description]
     *
     * @param  [type] $packageName [description]
     * @return [type]              [description]
     */
    private function getPackageMeta($packageName)
    {
        try {
            $client = $this->getPackageApiClient();
            return $client->get($packageName);
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
            return false;
        }
    }

    /**
     * Gets a new instance of the package api lient
     *
     * @return \Packagist\Api\Client
     */
    private function getPackageApiClient()
    {
        return new \Packagist\Api\Client();
    }

    /**
     * Load the plugin configuration (based on the supplied file)
     *
     * @return boolean
     */
    private function loadConfig()
    {

    }

    /**
     * Save the current state of the configuration back to the config file
     *
     * @return boolean
     */
    private function saveConfig()
    {

    }
}
