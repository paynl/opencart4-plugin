<?php

declare(strict_types=1);

/* You might need to adjust this mapping */
require '../vendor/autoload.php';

use PayNL\Sdk\Model\Request\ServicesGetAllRequest;
use PayNL\Sdk\Exception\PayException;

try {
    $request = new ServicesGetAllRequest();

    $services = $request->start();
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
foreach ($services->getServices() as $service) {
    /**
     * @var Service $service
     */
    echo $service->getId() . ' - ';
    echo htmlentities($service->getName()). ' - ';
    echo htmlentities($service->getDescription()) . ' - ';
    echo $service->isTestMode() ? 'yes' : 'no' . ' - ';
    echo htmlentities($service->getSecret()). ' - ';
    echo $service->getCreatedAt() . '<br>';
}



