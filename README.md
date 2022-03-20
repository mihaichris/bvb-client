# bvb-client

[![Build Status](https://img.shields.io/github/workflow/status/mihaichris/bvb-client/build)](https://github.com/mihaichris/bvb-client/actions/workflows/build.yml) [![Latest Stable Version](https://img.shields.io/github/v/release/mihaichris/bvb-client)](https://packagist.org/packages/mihaichris/bvb-client)
[![Latest Stable Version](https://img.shields.io/github/last-commit/mihaichris/bvb-client)](https://github.com/mihaichris/bvb-client) [![issues](https://img.shields.io/github/issues/mihaichris/bvb-client)](https://packagist.org/packages/mihaichris/bvb-client) [![License](https://img.shields.io/github/license/mihaichris/bvb-client)](https://github.com/mihaichris/bvb-client/actions/workflows/build.yml) [![PHP Version Require](https://img.shields.io/packagist/php-v/mihaichris/bvb-client)](https://packagist.org/packages/mihaichris/bvb-client)



## Description

This is BVBClient, a PHP library built for investment management and analysis of security returns targeted only for Bucharest Stock Exchange.

# Installation

It can be installed using composer:
```php
$ composer require mihaichris/bvb-client
```


## Basic Usage

```php
use BVB\Client;

// Creating the client
$client = new Client()

// Get ticker
$ticker = $client->getTicker('TRP');

// Get ticker current stock price
$price = $ticker->getPrice();

// Get ticker info
$info = $ticker->getInfo();

```

# Contributing
Pull requests are welcome. For any changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

# CHANGELOG
 Please refer to [CHANGELOG.md](https://github.com/mihaichris/bvb-client/blob/main/CHANGELOG.md)


# License
[MIT](https://opensource.org/licenses/MIT)
