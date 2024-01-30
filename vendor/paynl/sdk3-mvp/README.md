
# Pay. PHP SDK
Pay.'s PHP software development kit.

---

## Requirements
The PAY. PHP SDK works with PHP version 7.4 and up and uses the JSON-extension.

## Installation
### Composer
Require it from composer. Just run `composer require paynl/sdk:^2.0` in order to get the latest stable.

### Without composer
Installing without composer is possible, just download the zip on the projects [releases](https://github.com/paynl/sdk/releases) page.
Download the package zip (SDKvx.x.x.zip), then unzip the contents of the zip, and upload the vendor directory to your server.
In your project, require the file vendor/autoload.php.

## Configuration
First of all, configure the global configuration in /config/config.global.php.
Enter the username and password. Username is AT-Code and password your API-Token, although it is also possible to authenticate with SL-code as username and secret as password.
 
## Quickstart
In this example we retrieve all services linked to the provided username and password, using **ServicesGetAllRequest**:
```php
declare(strict_types=1);

require '<path-to-your-vendor-autoload>';

use PayNL\Sdk\Model\Request\ServicesGetAllRequest;
use PayNL\Sdk\Config\Config;

$altConfig = new Config();
$altConfig->setCore('achterelkebetaling.nl');

try {
    $allServicesRequest = new ServicesGetAllRequest();
    $allServicesRequest->setConfig($altConfig);
    $allServicesResponse = $allServicesRequest->start();
} catch (\Exception $e) {
    exit($e->getMessage());
}

foreach ($allServicesResponse->getServices() as $service) {
    echo $service->getId();
}
```
Check the samples folder for more. 

## Functions
Besides classes the SDK also provide some functions which can be used for implementation easiness:
- paynl_split_address;
- paynl_calc_vat_percentage;
- paynl_determine_vat_class
- paynl_determine_vat_class_by_percentage