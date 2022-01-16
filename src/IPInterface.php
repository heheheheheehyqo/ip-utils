<?php

namespace Hyqo\Utils;

interface IPInterface
{
    public static function isValid(string $ip): bool;

    public static function inSubnet(string $ip, string $subnet): bool;
}
