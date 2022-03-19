# bvb-client

[![Build Status](https://travis-ci.com/phplicengine/bitly.svg?branch=master)](https://travis-ci.com/phplicengine/bitly)
[![Latest Stable Version](http://poser.pugx.org/mihaichris/bvb-client/v)](https://packagist.org/packages/phpunit/phpunit) [![Total Downloads](http://poser.pugx.org/mihaichris/bvb-client/downloads)](https://packagist.org/packages/phpunit/phpunit) [![License](http://poser.pugx.org/mihaichris/bvb-client/license)](https://packagist.org/packages/phpunit/phpunit) [![PHP Version Require](http://poser.pugx.org/mihaichris/bvb-client/require/php)](https://packagist.org/packages/phpunit/phpunit)

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