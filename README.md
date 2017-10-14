[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg)](https://php.net/)
[![Build Status](https://travis-ci.org/ste80pa/suitecrm-client.svg?branch=master)](https://travis-ci.org/ste80pa/suitecrm-client)

## Synopsis

Simple library to communicate with SuiteCRM via Soap or Restful endpoints

## Code Example

Using Soap endopoint

```php
<?php

include('vendor/autoload.php');

use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\SoapClient;
use ste80pa\SuiteCRMClient\Session;

$url = 'your sugar crm host';
$username = 'your username';
$password = 'your password';

$session = new Session($url, $username, $password);

$client = new SoapClient($session);

$client->login();

$request = new GetEntryListRequest();

$request->module_name   = 'Accounts';
$request->select_fields = array('id', 'name');
$request->max_results   = 100;
$request->favorites     = false;
$request->deleted       = 1;
 
$accounts = $client->getEntryList($request); 

print_r($accounts);

```

Using Rest endopoint

```php
<?php

include('vendor/autoload.php');

use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\RestClient;
use ste80pa\SuiteCRMClient\Session;

$url = 'your sugar crm host';
$username = 'your username';
$password = 'your password';

$session = new Session($url, $username, $password);

$client = new RestClient($session);

$client->login();

$request = new GetEntryListRequest();

$request->module_name   = 'Accounts';
$request->select_fields = array('id', 'name');
$request->max_results   = 100;
$request->favorites     = false;
$request->deleted       = 1;
 
$accounts = $client->getEntryList($request); 

print_r($accounts);

```
## Motivation


## Installation

```
composer require ste80pa/suitecrm-client:dev-master
```
## API Reference


## Tests
To run all tests

```
phpunit
```

## Contributors


## License

