<?php

namespace App\Http;

use PhpOffice\PhpSpreadsheet\IOFactory;

class MyExcel
{
    protected $objPHPExcel;

    /**
     * MyExcel constructor.
     *
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function __construct($file)
    {
        if ($file instanceof \SplFileInfo) {
            $filename = $file->getRealPath();
        } else {
            $filename = $file;
        }
        $this->objPHPExcel = IOFactory::load($filename);
        $this->objPHPExcel->setActiveSheetIndex(0);
    }

    /**
     * @throws \PHPExcel_Exception
     */
    public function setActiveSheetIndex($index)
    {
        $this->objPHPExcel->setActiveSheetIndex($index);
    }

    /**
     * @param  null  $nullValue
     *
     * @throws \PHPExcel_Exception
     */
    public function toArray($nullValue = null, bool $calculateFormulas = true, bool $formatData = false): array
    {

        $rows = $this->objPHPExcel->getActiveSheet()->toArray($nullValue, $calculateFormulas, $formatData, false);
        $headers = array_shift($rows);

        array_walk($rows, function (&$values) use ($headers) {
            $values = array_combine($headers, $values);
        });

        return $rows;
    }

    /**
     * @param  null  $nullValue
     *
     * @throws \PHPExcel_Exception
     */
    public function toJson(int $options = 0, $nullValue = null, bool $calculateFormulas = true, bool $formatData = false): string
    {
        return json_encode($this->toArray($nullValue, $calculateFormulas, $formatData), $options);
    }
}
