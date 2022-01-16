<?php

namespace Hyqo\Utils;

class IP4 implements IPInterface
{
    public static function isValid(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    public static function inSubnet(string $ip, string $subnet): bool
    {
        if (strpos($subnet, '/') === false) {
            $address = $subnet;
            $netmask = -1;
        } else {
            [$address, $bits] = explode('/', $subnet, 2);
            $netmask = ~((1 << (32 - (int)$bits)) - 1);
        }

        $intIP = ip2long($ip);
        $intAddress = ip2long($address);

        if (!$intIP || !$intAddress) {
            return false;
        }

        return ($intIP & $netmask) === ($intAddress & $netmask);
    }

    public static function inAnySubnet(string $ip, array $subnets): bool
    {
        foreach ($subnets as $subnet) {
            if (self::inSubnet($ip, $subnet)) {
                return true;
            }
        }

        return false;
    }
}
