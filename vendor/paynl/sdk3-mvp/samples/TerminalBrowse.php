<?php

declare(strict_types=1);

/* You might need to adjust this mapping */
require '../vendor/autoload.php';

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Model\Request\TerminalBrowseRequest;

try {
    $request = new TerminalBrowseRequest();

    $terminalResp = $request->start();
} catch (PayException $e) {
    echo '<pre>';
    echo 'Technical message: ' . $e->getMessage() . PHP_EOL;
    echo 'Pay-code: ' . $e->getPayCode() . PHP_EOL;
    echo 'Customer message: ' . $e->getFriendlyMessage() . PHP_EOL;
    echo 'HTTP code: ' . $e->getcode();
    exit();
}

echo '<pre>';
echo 'Success, values:' . PHP_EOL . PHP_EOL;

$allTerminals = $terminalResp->getTerminals();

foreach ($allTerminals as $terminal) {
    echo str_pad($terminal->getCode(), 15, ' ');
    echo str_pad(substr($terminal->getName(), 0, 40), 40, ' ');
    echo str_pad($terminal->getAttribution(), 15, ' ');
    echo PHP_EOL;
}