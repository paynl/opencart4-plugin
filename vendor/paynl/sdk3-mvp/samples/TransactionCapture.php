<?php

declare(strict_types=1);

/* You might need to adjust this mapping */
require '../vendor/autoload.php';

use PayNL\Sdk\Model\Request\TransactionCaptureRequest;
use PayNL\Sdk\Exception\PayException;

$transactionId = $_REQUEST['pay_order_id'] ?? exit('Pass transactionId');

$transactionCaptureRequest = new TransactionCaptureRequest($transactionId);
//$productId = 'p2';
//$productQuantity = 2;
//$transactionCaptureRequest->setProduct($productId, $productQuantity);
//$transactionCaptureRequest->setAmount(5.3);

try {
    $capture = $transactionCaptureRequest->start();
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
echo 'getOrderId: ' . $capture->getId() . PHP_EOL;
echo 'getTransactionId: ' . $capture->getOrderId() . PHP_EOL;
echo 'getServiceCode: ' . $capture->getServiceCode() . PHP_EOL;
echo 'getDescription: ' . $capture->getDescription() . PHP_EOL;
echo 'getReference: ' . $capture->getReference() . PHP_EOL;
echo 'getIpAddress: ' . $capture->getIpAddress() . PHP_EOL;
echo 'getAmount getValue: ' . $capture->getAmount()->getValue() . PHP_EOL;
echo 'getAmount getCurrency: ' . $capture->getAmount()->getCurrency() . PHP_EOL;
echo 'getAmountConverted getCurrency: ' . $capture->getAmountConverted()->getCurrency() . PHP_EOL;
echo 'getAmountConverted getValue: ' . $capture->getAmountConverted()->getValue() . PHP_EOL;
echo 'getAmountPaid getCurrency: ' . $capture->getAmountPaid()->getCurrency() . PHP_EOL;
echo 'getAmountPaid getValue: ' . $capture->getAmountPaid()->getValue() . PHP_EOL;
echo 'getAmountRefunded getCurrency: ' . $capture->getAmountRefunded()->getCurrency() . PHP_EOL;
echo 'getAmountRefunded getValue: ' . $capture->getAmountRefunded()->getValue() . PHP_EOL;
echo 'getStatus:' . print_r($capture->getStatus(), true) . PHP_EOL;
echo 'getPaymentData:' . print_r($capture->getPaymentData(), true) . PHP_EOL;
echo 'getIntegration:' . print_r($capture->getIntegration(), true) . PHP_EOL;
echo 'getExpiresAt: ' . $capture->getExpiresAt() . PHP_EOL;
echo 'getCreatedAt: ' . $capture->getCreatedAt() . PHP_EOL;
echo 'getCreatedBy: ' . $capture->getCreatedBy() . PHP_EOL;
echo 'getModifiedAt: ' . $capture->getModifiedAt() . PHP_EOL;
echo 'getModifiedBy: ' . $capture->getModifiedBy() . PHP_EOL;
echo 'getDeletedAt: ' . $capture->getDeletedAt() . PHP_EOL;
echo 'getDeletedBy: ' . $capture->getDeletedBy() . PHP_EOL;