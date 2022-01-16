<?php

namespace Hyqo\Utils\Test;

use Hyqo\Utils\IP;
use PHPUnit\Framework\TestCase;

class IPTest extends TestCase
{
    public function test_is_valid()
    {
        $this->assertTrue(IP::isValid('192.168.1.0'));
        $this->assertTrue(IP::isValid('0:0:0:0:0:0:0:1'));
    }

    public function test_version()
    {
        $this->assertEquals(4, IP::version('192.168.1.0/31'));
        $this->assertEquals(6, IP::version('0:0:0:0:0:0:0:1'));
    }

    public function test_is_match()
    {
        $this->assertTrue(IP::isMatch('192.168.1.0', '192.168.1.0/31'));
        $this->assertFalse(IP::isMatch('192.168.1.0', '::1'));

        $this->assertTrue(IP::isMatch('0:0:0:0:0:0:0:1', '::1/64'));
        $this->assertFalse(IP::isMatch('0:0:0:0:0:0:0:1', '192.168.1.0/31'));

        $this->assertTrue(IP::isMatch('131.0.72.199', ['131.0.72.0/22', '192.168.1.0/31']));
        $this->assertFalse(IP::isMatch('132.0.72.199', ['131.0.72.0/22', '192.168.1.0/31']));

        $this->assertTrue(IP::isMatch('2a01:198:603:0:396e:4789:8e99:890f', ['2a01:198:603:0::/0', '192.168.1.0/31']));
        $this->assertFalse(IP::isMatch('2a01:198:603:0:396e:4789:8e99:890f', ['1a01:198:603:0::/65', '::1']));
    }
}
