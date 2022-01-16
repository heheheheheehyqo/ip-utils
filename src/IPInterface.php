<?php

namespace Hyqo\Utils;

interface IPInterface
{
    public static function isValid(string $ip): bool;

    /** @param string|array $subnets */
    public static function isMatch(string $ip, $subnets): bool;

    public static function normalize(string $ip): string;
}
