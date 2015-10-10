<?php

use GroupMePHP\AbstractClient;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /* @var AbstractClient */
    private $c;

    public function setUp () {
        $this->c = new AbstractClient('token');
    }

    public function testSimpleQueryString()
    {
        $args = array();
        $queryString = $this->c->buildQueryString($args);
        $this->assertEquals("?token=token", $queryString);
    }

    public function testComplexQueryString() {
        $args = array('a' => 1, 'b' => 2);
        $queryString = $this->c->buildQueryString($args);
        $this->assertEquals("?a=1&b=2&token=token", $queryString);
    }
}
