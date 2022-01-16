# ip-utils 
![Packagist Version](https://img.shields.io/packagist/v/hyqo/ip-utils?style=flat-square)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/hyqo/ip-utils?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/hyqo/ip-utils/run-tests?style=flat-square)

## Install

```sh
composer require hyqo/ip-utils
```

## Usage

```php
use Hyqo\Utils\IP;

IP::isValid('192.168.1.0'); //true
IP::isValid('0:0:0:0:0:0:0:1'); //true

IP::inSubnet('131.0.72.199', '131.0.72.0/22'); //true
IP::inSubnet('131.0.76.199', '131.0.72.0/22'); //false

IP::inAnySubnet('132.0.72.199', ['131.0.72.0/22', '192.168.1.0/31']); //true
```

The `IP` class automatically detects IP version, but you can use `IP4` and `IP6` classes with the same methods as well.
