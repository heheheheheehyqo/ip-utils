<?php

namespace Hyqo\Utils\Test;

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

    public function test_in_subnet()
    {
        $this->assertFalse(IP6::inSubnet('0:0:0:0:0:0:0:1', '192.168.1.0/31'));

        $this->assertTrue(IP6::inSubnet('0:0:0:0:0:0:0:1', '::1'));
        $this->assertFalse(IP6::inSubnet('0:0:603:0:396e:4789:8e99:0001', '::1'));

        $this->assertTrue(IP6::inSubnet('2a01:198:603:0:396e:4789:8e99:890f', '2a01:198:603:0::/0'));
        $this->assertTrue(IP6::inSubnet('0:0:603:0:396e:4789:8e99:0001', '::1/0'));
        $this->assertFalse(IP6::inSubnet('0:0:603:0:396e:4789:8e99:0001', '::1'));

        $this->assertFalse(IP6::inSubnet('0:0:603:0:396e:4789:8e99:0001', 'fake'));
        $this->assertFalse(IP6::inSubnet('}{}', '::1'));
        $this->assertFalse(IP6::inSubnet('', '::1'));
    }

    public function test_in_any_subnet()
    {
        $this->assertTrue(IP6::inAnySubnet('2a01:198:603:0:396e:4789:8e99:890f', ['2a01:198:603:0::/0', '192.168.1.0/31']));
        $this->assertFalse(IP6::inAnySubnet('2a01:198:603:0:396e:4789:8e99:890f', ['1a01:198:603:0::/65', '::1']));
    }
}
