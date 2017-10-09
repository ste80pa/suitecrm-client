## Synopsis

Simple library for cummication with SuiteCRM via Soap or  Restful API endpoints

## Code Example

```php
<?php

include('vendor/autoload.php');

use ste80pa\SuiteCRMClient\Types\Requests\GetEntryListRequest;
use ste80pa\SuiteCRMClient\Types\Requests\LoginRequest;
use ste80pa\SuiteCRMClient\SoapClient;

$url = 'your sugar crm host';
$username = 'your username';
$password = 'your passowrd';

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
## Motivation


## Installation

```
composer require ste80pa/suitecrm-client:dev-master
```
## API Reference


## Tests


## Contributors


## License

