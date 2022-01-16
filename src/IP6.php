<?php

namespace Hyqo\Utils;

class IP6 implements IPInterface
{
    public static function isValid(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
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
            $netmask = 128;
        } else {
            [$address, $netmask] = explode('/', $subnet, 2);

            if (!$netmask) {
                return (bool)unpack('n*', @inet_pton($address));
            }

            if ($netmask < 1 || $netmask > 128) {
                return false;
            }
        }

        $bytesAddr = unpack('n*', @inet_pton($address));
        $bytesTest = unpack('n*', @inet_pton($ip));

        if (!$bytesAddr || !$bytesTest) {
            return false;
        }

        for ($i = 1, $ceil = ceil($netmask / 16); $i <= $ceil; ++$i) {
            $left = $netmask - 16 * ($i - 1);
            $left = ($left <= 16) ? $left : 16;
            $mask = ~(0xFFFF >> $left) & 0xFFFF;

            if (($bytesAddr[$i] & $mask) !== ($bytesTest[$i] & $mask)) {
                return false;
            }
        }

        return true;
    }
}
