<?php

namespace Hyqo\Utils\Test;

use Hyqo\Utils\IP4;
use Hyqo\Utils\IP6;
use PHPUnit\Framework\TestCase;

class IP6Test extends TestCase
{

    public function test_is_valid()
    {
        $this->assertTrue(IP6::isValid('::1'));
        $this->assertFalse(IP6::isValid(':1'));
        $this->assertFalse(IP6::isValid('fake'));
    }

    public function test_is_match()
    {
        $this->assertTrue(IP6::isMatch('2a01:198:603:0:396e:4789:8e99:890f', '::0/0'));

        $this->assertFalse(IP6::isMatch('0:0:0:0:0:0:0:1', '192.168.1.0/31'));

        $this->assertTrue(IP6::isMatch('0:0:0:0:0:0:0:1', '::1'));
        $this->assertFalse(IP6::isMatch('0:0:603:0:396e:4789:8e99:0001', '::1'));

        $this->assertTrue(IP6::isMatch('2a01:198:603:0:396e:4789:8e99:890f', '2a01:198:603:0::/0'));
        $this->assertTrue(IP6::isMatch('0:0:603:0:396e:4789:8e99:0001', '::1/0'));
        $this->assertFalse(IP6::isMatch('0:0:603:0:396e:4789:8e99:0001', '::1'));

        $this->assertFalse(IP6::isMatch('0:0:603:0:396e:4789:8e99:0001', 'fake'));
        $this->assertFalse(IP6::isMatch('}{}', '::1'));
        $this->assertFalse(IP6::isMatch('', '::1'));

        $this->assertTrue(IP6::isMatch('2a01:198:603:0:396e:4789:8e99:890f', ['2a01:198:603:0::/0', '192.168.1.0/31']));
        $this->assertFalse(IP6::isMatch('2a01:198:603:0:396e:4789:8e99:890f', ['1a01:198:603:0::/65', '::1']));
    }

    public function test_normalize()
    {
        $this->assertEquals('::1', IP6::normalize('[::1]:80'));
        $this->assertEquals('::1', IP6::normalize('::1'));
        $this->assertEquals('fake', IP6::normalize('fake'));
    }
}
