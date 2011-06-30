<?php
class QueryExplainer_Database
{
    /**
     * 接続先のデータソース名.
     *
     * @var string
     */
    protected $_dsn;

    protected $_user;

    protected $_password;

    protected $_pdo;

    public function __construct($options)
    {
        $this->_dsn = "mysql:dbname={$options['database']};" .
                      "host={$options['host']}";
        $this->_user = $options['user'];
        $this->_password = $options['password'];
    }

    public function connect()
    {
        $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_password);
    }

    public function query($query)
    {
        $stmt = $this->_pdo->query($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
