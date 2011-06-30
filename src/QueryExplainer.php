<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/../src');
require_once 'QueryExplainer/Console.php';
require_once 'QueryExplainer/Database.php';
require_once 'QueryExplainer/Query.php';
require_once 'QueryExplainer/Formatters/CsvFormatter.php';

class QueryExplainer
{
    const VERSION = '0.0.1';
}
