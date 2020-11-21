<?php

namespace App\Services\performanceMedia;

use mysql_xdevapi\Exception;
use Symfony\Component\Filesystem\Filesystem;

class PerformanceMediaHelper
{
    private $fileNameToRead = "data1.json";

    private $projectDir;

    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }



    public function readDocument()
    {
        $filesystem = new Filesystem();

        $filePath = $this->getDir() . "/var/local-data/{$this->fileNameToRead}";

        if(!$filesystem->exists($filePath) )
        {
            throw new Exception('The file does not exist in the given directory');
        }

        $dataJson = file_get_contents($filePath);
        $dataArray = json_decode($dataJson, true);
        return $dataArray;
    }



    public function getDir(){
        return $this->projectDir;
    }

}