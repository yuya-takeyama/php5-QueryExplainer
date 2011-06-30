<?php
require_once 'QueryExplainer/Result.php';

class QueryExplainer_Query
{
    protected $_sql;

    protected $_database;

    public function __construct($options = array())
    {
        $this->_database = $options['database'];
        $this->_sql      = $options['sql'];
    }

    public function getResult()
    {
        $result = array();
        $result['explain'] = $this->getExplain();
        $result['time']    = $this->getExecutionTime();
        return new QueryExplainer_Result($result);
    }

    public function getExecutionTime()
    {
        $begin = microtime(true);
        $this->_database->query($this->_sql);
        $end = microtime(true);
        return $end - $begin;
    }

    public function getExplain()
    {
        $sql = 'EXPLAIN ' . $this->_sql;
        return $this->_database->query($sql);
    }

    public static function load($options)
    {
        $lines = file($options['file']);
        $queries = array();
        $sql = '';
        foreach ($lines as $line) {
            if (preg_match('/^\-{5,}/', $line)) {
                $queries[] = new self(array(
                    'sql'      => $sql,
                    'database' => $options['database'],
                ));
                $sql = '';
            } else {
                $sql .= $line;
            }
        }
        if (strlen($sql) > 0) {
            $queries[] = new self(array(
               'sql'      => $sql,
               'database' => $options['database'],
           ));
        }
        return $queries;
    }
}
