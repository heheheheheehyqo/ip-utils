<?php

namespace Hyqo\Utils;

class IP implements IPInterface
{
    public static function version(string $ip): int
    {
        return substr_count($ip, ':') > 1 ? 6 : 4;
    }

    public static function isValid(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    /** @param string|array $subnets */
    public static function isMatch(string $ip, $subnets): bool
    {
        $version = self::version($ip);
        $subnets = array_filter((array)$subnets, static function (string $subnet) use ($version) {
            return $version === self::version($subnet);
        });

        /** @var IPInterface $class */
        $class = $version === 6 ? IP6::class : IP4::class;

        return $class::isMatch($ip, $subnets);
    }

    public static function normalize(string $ip): string
    {
        $version = self::version($ip);

        /** @var IPInterface $class */
        $class = $version === 6 ? IP6::class : IP4::class;

        return $class::normalize($ip);
    }
}
