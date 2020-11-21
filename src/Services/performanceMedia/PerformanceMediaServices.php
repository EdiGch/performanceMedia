<?php

namespace App\Services\performanceMedia;

use App\Services\performanceMedia\PerformanceMediaHelper;
Use App\Services\performanceMedia\SaveHistory;

class PerformanceMediaServices
{


    private $performanceMediaHelper;
    private $saveHistory;


    public function __construct(PerformanceMediaHelper $performanceMediaHelper, SaveHistory $saveHistory )
    {
        $this->performanceMediaHelper = $performanceMediaHelper;
        $this->saveHistory = $saveHistory;
    }

    public function savingDataFromFileToDatabase()
    {
        try {
            $dataArray = $this->performanceMediaHelper->readDocument();
            $message = $this->savingDataToDatabase($dataArray);
        } catch (\Exception $e) {
            $message = sprintf('Exception [%i]: %s', $e->getCode(), $e->getMessage());
        }
        return $message;
    }


    private function readDocument()
    {
       return $this->performanceMediaHelper->readDocument();
    }

    private function savingDataToDatabase(array $dataArray)
    {
        return  $this->saveHistory->setHistoryList($dataArray);
    }



}