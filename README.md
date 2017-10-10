[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg)](https://php.net/)

## Synopsis

Simple library for cummication with SuiteCRM via Soap or Restful API endpoints

## Code Example

Using Soap endopoint

```php
<?php

include('vendor/autoload.php');

use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\SoapClient;

$url = 'your sugar crm host';
$username = 'your username';
$password = 'your password';

$soap = new SoapClient("http://{$url}/service/v4_1/soap.php?wsdl");
$soap->Login(new LoginRequest($username, $password));

$request = new GetEntryListRequest();

$request->module_name   = 'Accounts';
$request->select_fields = array('id', 'name');
$request->max_results   = 100;
$request->favorites     = false;
$request->deleted       = 1;
 
$accounts = $soap->GetEntryList($request); 

print_r($accounts);

```

Using Rest endopoint

```php
<?php

include('vendor/autoload.php');

use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\RestClient;

$url = 'your sugar crm host';
$username = 'your username';
$password = 'your password';

$soap = new RestClient("http://{$url}/service/v4_1/rest.php");
$soap->Login(new LoginRequest($username, $password));

$request = new GetEntryListRequest();

$request->module_name   = 'Accounts';
$request->select_fields = array('id', 'name');
$request->max_results   = 100;
$request->favorites     = false;
$request->deleted       = 1;
 
$accounts = $soap->GetEntryList($request); 

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

