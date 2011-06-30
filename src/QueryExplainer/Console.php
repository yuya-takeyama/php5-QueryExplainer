<?php
require_once 'QueryExplainer/Console/Options.php';

class QueryExplainer_Console
{
    /**
     * 起動オプション.
     *
     * @var QueryExplainer_Console_Options
     */
    protected $_options;

    /**
     * 起動.
     *
     * 起動オプションを受け取り, 処理を開始する.
     *
     * @param  QueryExplainer_Console_Options $options
     * @return void
     */
    public function run(QueryExplainer_Console_Options $options)
    {
        echo "QueryExplainer ver. " . QueryExplainer::VERSION, PHP_EOL;
        $this->_options = $options;
        echo "Input Password: ";
        $options['password'] = $this->getPassword();

        $db = new QueryExplainer_Database($options);
        try {
            $db->connect();
            echo "Connected successfully.", PHP_EOL;
            $queries = QueryExplainer_Query::load(array(
                'database' => $db,
                'file'     => $options['file'],
            ));

            $results = array();
            foreach ($queries as $query) {
                $results[] = $query->getResult();
            }

            foreach ($results as $result) {
                $formatter = new QueryExplainer_Formatters_CsvFormatter($result);
                echo $formatter->toString();
            }
        }
        catch (Exception $e) {
            fputs(STDERR, $e->getMessage() . PHP_EOL);
        }
    }

    /**
     * パスワードの取得.
     *
     * 標準入力から受け取った文字列を返す.
     *
     * @return string
     */
    public static function getPassword()
    {
        return chop(fgets(STDIN));
    }
}
