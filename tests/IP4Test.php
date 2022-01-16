<?php

namespace Hyqo\Utils\Test;

use Hyqo\Utils\IP4;
use PHPUnit\Framework\TestCase;

class IP4Test extends TestCase
{

    public function test_is_valid()
    {
        $this->assertTrue(IP4::isValid('127.0.0.1'));
        $this->assertFalse(IP4::isValid('127.0.0'));
        $this->assertFalse(IP4::isValid('fake'));
    }

    public function test_is_match()
    {
        $this->assertTrue(IP4::isMatch('192.168.1.1', '192.168.1.0/31'));
        $this->assertFalse(IP4::isMatch('192.168.1.2', '192.168.1.0/31'));

        $this->assertTrue(IP4::isMatch('192.168.1.3', '192.168.1.0/30'));
        $this->assertFalse(IP4::isMatch('192.168.1.4', '192.168.1.0/30'));

        $this->assertTrue(IP4::isMatch('192.168.1.100', '192.168.0.0/23'));
        $this->assertFalse(IP4::isMatch('192.168.2.100', '192.168.0.0/23'));

        $this->assertTrue(IP4::isMatch('131.0.72.199', '131.0.72.0/22'));
        $this->assertTrue(IP4::isMatch('131.0.73.199', '131.0.72.0/22'));
        $this->assertFalse(IP4::isMatch('131.0.76.199', '131.0.72.0/22'));

        $this->assertFalse(IP4::isMatch('131.0.76.199', 'fake'));
        $this->assertFalse(IP4::isMatch('}{}', 'fake'));

        $this->assertTrue(IP4::isMatch('131.0.72.199', ['131.0.72.0/22', '192.168.1.0/31']));
        $this->assertFalse(IP4::isMatch('132.0.72.199', ['131.0.72.0/22', '192.168.1.0/31']));
    }
}
