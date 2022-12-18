<?php
$inputFileType = 'Xls';
$inputFileName = './sampleData/example1.xls';
$sheetname = 'Data Sheet #3';

/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
class TestImport implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($columnAddress, $row, $worksheetName = '')
    {
        //  Read rows 1 to 7 and columns A to E only
        if ($row >= 1 && $row <= 7) {
            if (in_array($column, range('A', 'E'))) {
                return true;
            }
        }
        return false;
    }
}

/**  Create an Instance of our Read Filter  **/
$filterSubset = new MyReadFilter();

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Tell the Reader that we want to use the Read Filter  **/
$reader->setReadFilter($filterSubset);
/**  Load only the rows and columns that match our filter to Spreadsheet  **/
$spreadsheet = $reader->load($inputFileName);