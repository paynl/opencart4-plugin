<?php

declare(strict_types=1);

/* You might need to adjust this mapping */
require '../vendor/autoload.php';

use PayNL\Sdk\Model\Product;
use PayNL\Sdk\Model\Request\TransactionCreateRequest;
use PayNL\Sdk\Exception\PayException;

$request = new TransactionCreateRequest();
$request->setServiceId( $_REQUEST['slcode'] ?? 'SL-4241-3001');
$request->setDescription('Order ABC0123456789');
$request->setReference('ABC0123456789');
$request->setReturnurl('https://yourdomain/finish.php');
$request->setExchangeUrl('https://yourdomain/exchange.php');
$request->setAmount(0.01);
$request->setCurrency('EUR');
$request->setPaymentMethodId(1927); # iDEAL
$request->setTerminal($_REQUEST['terminalcode'] ?? '');
$request->setTestmode(($_REQUEST['testmode'] ?? 1) == 1);

$customer = new \PayNL\Sdk\Model\Customer();
$customer->setFirstName('John');
$customer->setLastName('Doe');
$customer->setIpAddress('92.68.12.18');
$customer->setBirthDate('1999-02-15');
$customer->setGender('M');
$customer->setPhone('0612345678');
$customer->setEmail('testbetaling@pay.nl');
$customer->setLanguage('NL');
$customer->setTrust('1');
$customer->setReference('MyRef');

$company = new \PayNL\Sdk\Model\Company();
$company->setName('CompanyName');
$company->setCoc('12345678');
$company->setVat('NL807960147B01');
$company->setCountryCode('NL');

$customer->setCompany($company);

$request->setCustomer($customer);

$order = new \PayNL\Sdk\Model\Order();
$order->setCountryCode('NL');
$order->setDeliveryDate('2023-12-28 14:11:01');
$order->setInvoiceDate('2023-12-29 14:05:00');

$devAddress = new \PayNL\Sdk\Model\Address();
$devAddress->setCode('dev');
$devAddress->setStreetName('Istreet');
$devAddress->setStreetNumber('70');
$devAddress->setStreetNumberExtension('A');
$devAddress->setZipCode('5678CD');
$devAddress->setCity('ITest');
//$devAddress->setRegionCode('ZH');
$devAddress->setCountryCode('NL');
$order->setDeliveryAddress($devAddress);

$invAddress = new \PayNL\Sdk\Model\Address();
$invAddress->setCode('inv');
$invAddress->setStreetName('Lane');
$invAddress->setStreetNumber('4');
$invAddress->setStreetNumberExtension('B1');
$invAddress->setZipCode('1234AB');
$invAddress->setCity('Test');
//$devAddress->setRegionCode('ZH');
$invAddress->setCountryCode('BE');
$order->setInvoiceAddress($invAddress);

$products = new \PayNL\Sdk\Model\Products();

$product = new Product();
$product->setId('p1');
$product->setDescription('product1Desc');
$product->setType(Product::TYPE_ARTICLE);
$product->setAmount(1);
$product->setCurrency('EUR');
$product->setQuantity(1);
$product->setVatCode(Product::VAT_LOW);
$products->addProduct($product);

$products->addProduct(new Product('p2', 'product2Desc', 2,  'EUR', Product::TYPE_DISCOUNT, 2, 'H'));
$products->addProduct(new Product(null, 'Shipping', 0.3,  'EUR', Product::TYPE_SHIPPING, 1, 'H'));
$order->setProducts($products);

$request->setOrder($order);

$request->setStats((new \PayNL\Sdk\Model\Stats())
  ->setInfo('info')
  ->setTool('tool')
  ->setObject('object')
  ->setExtra1('ex1')
  ->setExtra2('ex2')
  ->setExtra3('ex3')
  //->setDomainId('WU-1234-1234')
);

$request->setNotification('EMAIL', 'youremail@yourdomain.ext');
$request->setTransferData([['yourField' => 'yourData'], ['tracker' => 'trackerinfo']]);

try {
    $transaction = $request->start();
} catch (PayException $e) {
    echo '<pre>';
    echo 'Technical message: ' . $e->getMessage() . PHP_EOL;
    echo 'Pay-code: ' . $e->getPayCode() . PHP_EOL;
    echo 'Customer message: ' . $e->getFriendlyMessage() . PHP_EOL;
    echo 'HTTP-code: ' . $e->getCode() . PHP_EOL;
    exit();
}

echo '<pre>';
echo 'Success, values:' . PHP_EOL;
echo 'getId: ' . $transaction->getId() . PHP_EOL;
echo 'getHash: ' . $transaction->getHash() . PHP_EOL;
echo 'getOrderStatusUrl:  <a href="' . $transaction->getOrderStatusUrl() . '">' . $transaction->getOrderStatusUrl() . '</a> ' . PHP_EOL;