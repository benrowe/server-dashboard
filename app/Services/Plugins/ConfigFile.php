<?php

namespace App\Services\Plugins;

use SplFileInfo;

class ConfigFile
{
    private $file;

    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
    }
}
