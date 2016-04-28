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
     * Holds the configuration object, related to the specified config file
     *
     * @var ConfigFile
     */
    protected $config;

    /**
     * the package that must be defined as a dependancy in the plugin root in
     * order for it to be considered as a 'Plugin'
     *
     *  'benrowe/serverdash-plugin'
     *
     * @var string
     */
    protected $corePackage;

    /**
     * Constructor
     *
     * @param SplFileInfo $configFile a file pointer to the config file that
     *                                will contain the list of
     *                                installed/required plugins
     * @param string $corePackage the dependancy in the plugins that
     *                            must be included if it's a valid 'Plugin'
     */
    public function __construct(SplFileInfo $configFile, $corePackage)
    {
        $this->config = new ConfigFile($configFile);
        $this->corePackage = $corePackage;
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

    /**
     * [update description]
     * @param  [type] $package [description]
     * @return [type]          [description]
     */
    public function update($package)
    {
        // 1. make sure that the package is already installed in the configuration
        // file
        // 2. run composer update, and force it
    }

    /**
     * [remove description]
     * @param  [type] $package [description]
     * @return [type]          [description]
     */
    public function remove($package)
    {

    }

    /**
     * [hasPackage description]
     * @param  [type]  $package [description]
     * @return boolean          [description]
     */
    public function hasPackage($package)
    {

    }

    /**
     * List the currently installed plugins
     *
     * @return array it should contain a list of packages
     */
    public function installed()
    {
        return array_keys($this->config->get('require'));
    }

    /**
     * Search the
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function search($query)
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
}
