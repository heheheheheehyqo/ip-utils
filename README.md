# ip-utils

![Packagist Version](https://img.shields.io/packagist/v/hyqo/ip-utils?style=flat-square)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/hyqo/ip-utils?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/hyqo/ip-utils/tests.yml?branch=main&label=tests&style=flat-square)

## Install

```sh
composer require hyqo/ip-utils
```
## Methods
```php
IPInterface::isValid(string $ip): bool;
IPInterface::isMatch(string $ip, string|array $subnets): bool;
IPInterface::normalize(string $ip): string;
IPInterface::port(string $ip): ?int;
```

## Usage

```php
use Hyqo\Utils\IP;

IP::isValid('192.168.1.0'); //true
IP::isValid('0:0:0:0:0:0:0:1'); //true

IP::isMatch('131.0.72.199', '131.0.72.0/22'); //true
IP::isMatch('131.0.76.199', '131.0.72.0/22'); //false

IP::isMatch('132.0.72.199', ['131.0.72.0/22', '192.168.1.0/31']); //true

IP::normalize('127.0.0.1:80'); //127.0.0.1
IP::normalize('[::1]:80'); //::1

IP::port('127.0.0.1:80'); //80
IP::port('[::1]:80'); //80
```

The `IP` class automatically detects IP version, but you can use `IP4` and `IP6` classes with the same methods as well.
