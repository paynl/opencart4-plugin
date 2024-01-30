<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Model\Customer;
use PayNL\Sdk\Model\Order;
use PayNL\Sdk\Model\Stats;
use PayNL\Sdk\Model\CreateTransactionResponse;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Request\RequestInterface;
use PayNL\Sdk\Util\Text;

/**
 * Class TransactionCreateRequest
 *
 * @package PayNL\Sdk\Model\Request
 */
class TransactionCreateRequest extends RequestData
{
    private string $serviceId;
    private string $description = '';
    private string $reference = '';
    private string $expire = '';
    private string $returnUrl;
    private string $exchangeUrl = '';
    private int $amount;
    private string $currency = 'EUR';
    private int $paymentMethodId;
    private int $issuerId;
    private string $terminalCode;
    private ?bool $testmode = null;

    private ?Customer $customer = null;
    private ?Order $order = null;
    private ?Stats $stats = null;

    private string $notificationType = '';
    private string $notificationRecipient = '';
    private array $transferData = [];

    public function __construct()
    {
        parent::__construct('CreateTransaction', 'transactions', RequestInterface::METHOD_POST);
    }

    /**
     * @param string $returnUrl
     */
    public function setReturnurl(string $returnUrl): self
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * @return array
     */
    private function getProducts()
    {
        $products = [];

        foreach ($this->order->getProducts() as $objProduct) {
            $product = [];
            $product['id'] = $objProduct->getId();
            $product['description'] = $objProduct->getDescription();
            $product['type'] = $objProduct->getType();
            $product['price'] = [
              'value' => $objProduct->getPrice()->getValue(),
              'currency' => $objProduct->getPrice()->getCurrency(),
            ];
            $product['quantity'] = $objProduct->getQuantity();
            $product['vatCode'] = $objProduct->getVatCode();
            $products[] = $product;
        }

        return $products;
    }

    /**
     * @param $returnArr
     * @param $field
     * @param $value
     * @return void
     */
    private function _add(&$returnArr, $field, $value)
    {
        if (!empty($value)) {
            $returnArr = array_merge($returnArr, [$field => $value]);
        }
    }

    /**
     * @param float $amount Whole amount. Not in cents.
     * @return $this
     */
    public function setAmount(float $amount): self
    {
        $this->amount = (int)round($amount * 100);
        return $this;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @param Stats $stats
     */
    public function setStats(Stats $stats): self
    {
        $this->stats = $stats;
        return $this;
    }

    /**
     * @param string $serviceId
     */
    public function setServiceId(string $serviceId): self
    {
        $this->serviceId = $serviceId;
        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Field for ordernumber
     *
     * @param string $reference
     * @throws \Exception
     */
    public function setReference(string $reference): self
    {
        if (!ctype_alnum($reference)) {
            throw new \Exception('Reference should consist of all letters or digits');
        }
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param string $exchangeUrl
     */
    public function setExchangeUrl(string $exchangeUrl): self
    {
        $this->exchangeUrl = $exchangeUrl;
        return $this;
    }

    /**
     * @param int $paymentMethodId
     */
    public function setPaymentMethodId(int $paymentMethodId): self
    {
        $this->paymentMethodId = $paymentMethodId;
        return $this;
    }

    /**
     * @param int $issuerId Bank id
     */
    public function setIssuerId(int $issuerId): self
    {
        $this->issuerId = $issuerId;
        return $this;
    }

    /**
     * @param bool $testmode
     */
    public function setTestmode(bool $testmode): self
    {
        $this->testmode = $testmode;
        return $this;
    }

    /**
     * @param string $type options: push or email
     * @param string $recipient options: ad-code or emailaddress, depending on type
     * @return $this
     * @throws \Exception
     */
    public function setNotification(string $type, string $recipient): self
    {
        $type = strtolower($type);
        if ($type == 'email') {
            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Valid email format expected as notification recipient');
            }
        }
        if ($type == 'push') {
            if (!(substr(strtoupper($recipient),0,3) == 'AD-')) {
                throw new \Exception('Recepient expected to be AD-####-#### code');
            }
        }
        $this->notificationType = $type;
        $this->notificationRecipient = $recipient;
        return $this;
    }

    /**
     * @param array $transferData multidimensional array with one or more key and value
     */
    public function setTransferData(array $transferData): self
    {
        foreach ($transferData as $element) {
            foreach ($element as $key => $value) {
                $this->transferData[] = ['name' => $key, 'value' => $value];
            }
        }
        return $this;
    }

    /**
     * @return string[]
     */
    private function requiredArguments()
    {
        return ['amount', 'returnUrl', 'serviceId'];
    }

    /**
     * @return array
     */
    public function getPathParameters(): array
    {
        return [];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getBodyParameters(): array
    {
        foreach ($this->requiredArguments() as $field) {
            if (empty($this->$field)) {
                throw new \Exception('Required param `' . $field . '` is empty');
            }
        }

        # Required paramaters
        $parameters = [
          'serviceId' => $this->serviceId,
          'amount' => [
            'value' => $this->amount,
            'currency' => $this->currency,
          ],
          'returnUrl' => $this->returnUrl,
        ];

        # Optional parameters
        $this->_add($parameters, 'description', $this->description);
        $this->_add($parameters, 'reference', $this->reference);
        $this->_add($parameters, 'expire', $this->expire);
        $this->_add($parameters, 'exchangeUrl', $this->exchangeUrl);

        if (!empty($this->paymentMethodId)) {
            $parameters['paymentMethod'] = [
              'id' => $this->paymentMethodId,
            ];
            if (!empty($this->issuerId)) {
                $parameters['paymentMethod']['subId'] = $this->issuerId;
            } elseif (!empty($this->terminalCode)) {
                $parameters['paymentMethod']['subId'] = $this->terminalCode;
            }
        }

        $parameters['integration']['testMode'] = $this->testmode === true;

        if ($this->customer instanceof Customer) {
            $custParameters = [];
            $this->_add($custParameters, 'firstName', $this->customer->getFirstName());
            $this->_add($custParameters, 'lastName', $this->customer->getLastName());
            $this->_add($custParameters, 'ipAddress', $this->customer->getIpAddress());
            $this->_add($custParameters, 'birthDate', $this->customer->getBirthDate());
            $this->_add($custParameters, 'gender', $this->customer->getGender());
            $this->_add($custParameters, 'phone', $this->customer->getPhone());
            $this->_add($custParameters, 'email', $this->customer->getEmail());
            $this->_add($custParameters, 'language', $this->customer->getLanguage());
            $this->_add($custParameters, 'trust', $this->customer->getTrust());
            $this->_add($custParameters, 'reference', $this->customer->getReference());

            $compParameters = [];
            $this->_add($compParameters, 'name', $this->customer->getCompany()->getName());
            $this->_add($compParameters, 'coc', $this->customer->getCompany()->getCoc());
            $this->_add($compParameters, 'vat', $this->customer->getCompany()->getVat());
            $this->_add($compParameters, 'countryCode', $this->customer->getCompany()->getCountryCode());

            $this->_add($custParameters, 'company', $compParameters);
            $this->_add($parameters, 'customer', $custParameters);
        }

        if ($this->order instanceof Order) {
            $orderParameters = [];
            $this->_add($orderParameters, 'countryCode', $this->order->getCountryCode());
            $this->_add($orderParameters, 'deliveryDate', $this->order->getDeliveryDate());
            $this->_add($orderParameters, 'invoiceDate', $this->order->getInvoiceDate());

            $deliveryAddress = [];
            $this->_add($deliveryAddress, 'code', $this->order->getDeliveryAddress()->getCode());
            $this->_add($deliveryAddress, 'streetName', $this->order->getDeliveryAddress()->getStreetName());
            $this->_add($deliveryAddress, 'streetNumber', $this->order->getDeliveryAddress()->getStreetNumber());
            $this->_add($deliveryAddress, 'streetNumberExtension', $this->order->getDeliveryAddress()->getStreetNumberExtension());
            $this->_add($deliveryAddress, 'zipCode', $this->order->getDeliveryAddress()->getZipCode());
            $this->_add($deliveryAddress, 'city', $this->order->getDeliveryAddress()->getCity());
            $this->_add($deliveryAddress, 'regionCode', $this->order->getDeliveryAddress()->getRegionCode());
            $this->_add($deliveryAddress, 'countryCode', $this->order->getDeliveryAddress()->getCountryCode());
            $this->_add($orderParameters, 'deliveryAddress', $deliveryAddress);

            $invoiceAddress = [];
            $this->_add($invoiceAddress, 'code', $this->order->getInvoiceAddress()->getCode());
            $this->_add($invoiceAddress, 'streetName', $this->order->getInvoiceAddress()->getStreetName());
            $this->_add($invoiceAddress, 'streetNumber', $this->order->getInvoiceAddress()->getStreetNumber());
            $this->_add($invoiceAddress, 'streetNumberExtension', $this->order->getInvoiceAddress()->getStreetNumberExtension());
            $this->_add($invoiceAddress, 'zipCode', $this->order->getInvoiceAddress()->getZipCode());
            $this->_add($invoiceAddress, 'city', $this->order->getInvoiceAddress()->getCity());
            $this->_add($invoiceAddress, 'regionCode', $this->order->getInvoiceAddress()->getRegionCode());
            $this->_add($invoiceAddress, 'countryCode', $this->order->getInvoiceAddress()->getCountryCode());
            $this->_add($orderParameters, 'invoiceAddress', $invoiceAddress);
            $this->_add($orderParameters, 'products', $this->getProducts());
            $this->_add($parameters, 'order', $orderParameters);
        }

        if ($this->stats instanceof Stats) {
            $stats = [];
            $this->_add($stats, 'info', $this->stats->getInfo());
            $this->_add($stats, 'tool', $this->stats->getTool());
            $this->_add($stats, 'object', $this->stats->getObject());
            $this->_add($stats, 'extra1', $this->stats->getExtra1());
            $this->_add($stats, 'extra2', $this->stats->getExtra2());
            $this->_add($stats, 'extra3', $this->stats->getExtra3());
            $this->_add($stats, 'domainId', $this->stats->getDomainId());
            $this->_add($parameters, 'stats', $stats);
        }

        if (!empty($this->notificationType)) {
            $parameters['notification'] = [
              'type' => $this->notificationType,
              'recipient' => $this->notificationRecipient
            ];
        }

        $this->_add($parameters, 'transferData', $this->transferData);

        return $parameters;
    }

    /**
     * @param string $expire
     */
    public function setExpire(string $expire): void
    {
        $this->expire = $expire;
    }

    /**
     * @param string $terminalCode TH-code, use to set the terminal.
     */
    public function setTerminal(string $terminalCode): void
    {
        $this->terminalCode = $terminalCode;
    }

    /**
     * @return CreateTransactionResponse
     * @throws PayException
     */
    public function start(): CreateTransactionResponse
    {
        return parent::start();
    }
}