#!/usr/bin/env php
<?php
require_once dirname(__FILE__) . '/../src/QueryExplainer.php';

$console = new QueryExplainer_Console;
$console->run(QueryExplainer_Console_Options::parse($argv));
