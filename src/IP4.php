<?php

namespace Hyqo\Utils;

class IP4 implements IPInterface
{
    public static function isValid(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /** @inheritDoc */
    public static function isMatch(string $ip, $subnets): bool
    {
        foreach ((array)$subnets as $subnet) {
            if (self::doMatch($ip, $subnet)) {
                return true;
            }
        }

        return false;
    }

    protected static function doMatch(string $ip, string $subnet): bool
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

    public static function normalize(string $ip): string
    {
        if ($i = strpos($ip, ':')) {
            return substr($ip, 0, $i);
        }

        return $ip;
    }
}
