<?php

namespace App\Games\Lotto;

class TableResult
{
    protected $originResults;
    protected $resultArray;
    protected $threeNumResultArray;
    protected $twoNumResultArray;
    protected $fourNumResultArray;
    public function __construct($originResults)
    {
        $this->originResults = $originResults;
    }
    public function getResultArray()
    {
        if (!$this->resultArray) {
            $fullResults = [];
            foreach ($this->originResults as $key => $items) {
                $fullResults[$key]  = [];
                foreach ($items as $item) {
                    $fullResults[$key][] = $item['value'];
                }
            }
            $this->resultArray = $fullResults;
        }
        return $this->resultArray;
    }
    public function getThreeNumResultArray()
    {
        if (!$this->threeNumResultArray) {
            $tableResults = $this->getResultArray();
            $results = [];
            foreach ($tableResults as $items) {
                foreach ($items as $item) {
                    if (strlen($item) > 2) {
                        $results[] = substr($item, -3);
                    }
                }
            }
            $this->threeNumResultArray = $results;
        }

        return $this->threeNumResultArray;
    }
    public function getFourNumResultArray()
    {
        if (!$this->fourNumResultArray) {
            $tableResults = $this->getResultArray();
            $results = [];
            foreach ($tableResults as $items) {
                foreach ($items as $item) {
                    if (strlen($item) > 2) {
                        $results[] = substr($item, -4);
                    }
                }
            }
            $this->fourNumResultArray = $results;
        }

        return $this->fourNumResultArray;
    }
    public function getTwoNumResultArray()
    {
        if (!$this->twoNumResultArray) {
            $tableResults = $this->getResultArray();
            $results = [];
            foreach ($tableResults as $items) {
                foreach ($items as $item) {
                    if (strlen($item) > 1) {
                        $results[] = substr($item, -2);
                    }
                }
            }
            $this->twoNumResultArray = $results;
        }

        return $this->twoNumResultArray;
    }
    public function getByGiai($giai)
    {
        $resultArray = $this->getResultArray();
        return array_key_exists($giai, $resultArray) ? $resultArray[$giai] : [];
    }
}
