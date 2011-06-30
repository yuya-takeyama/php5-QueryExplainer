<?php
require_once dirname(__FILE__) . '/../../test_helper.php';

/**
 * Test class for QueryExplainer_Console_Options.
 */
class QueryExplainer_Console_OptionsTest extends PHPUnit_Framework_TestCase
{
    protected $expected;

    public function setUp()
    {
        $this->expected = array(
            'host'     => 'somehost',
            'user'     => 'someuser',
            'database' => 'somedatabase',
            'file'     => 'somefile',
        );
    }

    /**
     * @test
     */
    public function 短い引数から適切にオプションを生成する()
    {
        $this->assertSameOption(
            $this->expected,
            QueryExplainer_Console_Options::parse(array(
                'query_explainer.php',
                '-h',
                'somehost',
                '-u',
                'someuser',
                '-d',
                'somedatabase',
                '-f',
                'somefile',
            ))
        );
    }

    /**
     * @test
     */
    public function 長い引数から適切にオプションを生成する()
    {
        $this->assertSameOption(
            $this->expected,
            QueryExplainer_Console_Options::parse(array(
                'query_explainer.php',
                '--host',
                'somehost',
                '--user',
                'someuser',
                '--database',
                'somedatabase',
                '--file',
                'somefile',
            ))
        );
    }

    /**
     * @test
     */
    public function 等号で分割された長い引数から適切にオプションを生成する()
    {
        $this->assertSameOption(
            $this->expected,
            QueryExplainer_Console_Options::parse(array(
                'query_explainer.php',
                '--host',
                'somehost',
                '--user',
                'someuser',
                '--database',
                'somedatabase',
                '--file',
                'somefile',
            ))
        );
    }

    public function assertSameOption($expected, $actual, $message = NULL)
    {
        $this->assertSame($expected, $actual->toArray(), $message);
    }
}
