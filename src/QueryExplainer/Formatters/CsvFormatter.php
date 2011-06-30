<?php
class QueryExplainer_Formatters_CsvFormatter
{
    protected $_result;

    public function __construct($result)
    {
        $this->_result = $result;
    }

    public function toString()
    {
        $str = '';
        $result = $this->_result;

        $str .= join(',', $result->getColumnNames()) . ',Time' . PHP_EOL;
        foreach ($result->getExplain() as $explain) {
            $str .= join(',', $explain) . ',' . $result->getTime() . PHP_EOL;
        }

        return $str;
    }
}
