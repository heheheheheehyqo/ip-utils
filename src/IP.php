<?php

namespace Hyqo\Utils;

class IP implements IPInterface
{
    public static function isValid(string $ip): bool
    {
        return self::version($ip) === 6 ? IP6::isValid($ip) : IP4::isValid($ip);
    }

    public static function inSubnet(string $ip, string $subnet): bool
    {
        return self::version($ip) === 6 ? IP6::inSubnet($ip, $subnet) : IP4::inSubnet($ip, $subnet);
    }

    public static function inAnySubnet(string $ip, array $subnets): bool
    {
        $ipVersion = self::version($ip);

        /** @var IPInterface $class */
        $class = $ipVersion === 6 ? IP6::class : IP4::class;

        foreach ($subnets as $subnet) {
            if ($ipVersion !== self::version($subnet)) {
                continue;
            }

            if ($class::inSubnet($ip, $subnet)) {
                return true;
            }
        }

        return false;
    }

    public static function version(string $ip): int
    {
        return substr_count($ip, ':') > 1 ? 6 : 4;
    }
}
