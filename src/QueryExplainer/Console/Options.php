<?php
require_once 'Console/Getopt.php';

class QueryExplainer_Console_Options implements ArrayAccess
{
    /**
     * オプション.
     *
     * @var array
     */
    protected $_options;

    protected static $_GETOPT_CONFIG = array(
        'h' => 'host',
        'u' => 'user',
        'd' => 'database',
        'f' => 'file',
    );

    /**
     * Constructor.
     *
     * @param  array $options
     */
    public function __construct(array $options = array())
    {
        $this->_options = $options;
    }

    /**
     * コマンドライン引数のパース.
     *
     * @param  array $argv
     * @return array
     */
    public static function parse(array $argv = array())
    {
        $g = new Console_Getopt;
        $getoptOptions = self::_createGetoptOptions();
        array_shift($argv);
        $options = self::_parse(
            $g->getopt2($argv, $getoptOptions['short'], $getoptOptions['long'])
        );
        return new self($options);
    }

    /**
     * オプションの取得.
     *
     * @param  string $key オプションの名前.
     * @return string      オプションの値.
     */
    public function offsetGet($key)
    {
        return $this->_options[$key];
    }

    /**
     * オプションの存在確認.
     *
     * @param  string $key オプションの名前.
     * @return bool
     */
    public function offsetExists($key)
    {
        return isset($this->_options[$key]);
    }

    public function offsetSet($key, $value)
    {
        $this->_options[$key] = $value;
    }

    public function offsetUnset($key)
    {
        unset($this->_options[$key]);
    }

    public function toArray()
    {
        return $this->_options;
    }

    /**
     * Console_Getopt から受け取った値を連想配列に変換.
     *
     * @param  array $options Console_Getopt->getopt2() の返り値.
     * @return array コマンドライン引数を解析した結果の連想配列.
     */
    public static function _parse($options)
    {
        $result = array();
        foreach ($options[0] as $optionPair) {
            if (strlen($optionPair[0]) === 1) {
                $result[self::$_GETOPT_CONFIG[$optionPair[0]]] = $optionPair[1];
            } else {
                $result[substr($optionPair[0], 2)] = $optionPair[1];
            }
        }
        return $result;
    }

    public static function _createGetoptOptions()
    {
        $result = array(
            'short' => '',
            'long'  => array(),
        );
        foreach (self::$_GETOPT_CONFIG as $short => $long) {
            $result['short'] .= "{$short}:";
            $result['long'][] = "{$long}=";
        }
        return $result;
    }
}
