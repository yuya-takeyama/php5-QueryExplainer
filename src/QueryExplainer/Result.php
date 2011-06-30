<?php
class QueryExplainer_Result
{
    protected $_explain;

    protected $_time;

    public function __construct($params = array())
    {
        $this->_explain = $params['explain'];
        $this->_time    = $params['time'];
    }

    public function getExplain()
    {
        return $this->_explain;
    }

    public function getTime()
    {
        return $this->_time;
    }

    public function getColumnNames()
    {
        $result = array();
        foreach ($this->_explain[0] as $key => $value) {
            $result[] = $key;
        }
        return $result;
    }
}
