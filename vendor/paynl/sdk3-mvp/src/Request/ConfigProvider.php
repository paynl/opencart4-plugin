<?php

declare(strict_types=1);

namespace PayNL\Sdk\Request;

use PayNL\Sdk\{Config\ProviderInterface as ConfigProviderInterface,
    Common\ManagerFactory,
    Common\DebugAwareInitializer,
    Validator\Qr\Decode,
    Validator\Qr\Encode
};

/**
 * Class Manager
 *
 * @package PayNL\Sdk\Request
 */
class ConfigProvider implements ConfigProviderInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(): array
    {
        return [
            'service_manager' => $this->getDependencyConfig(),
            'service_loader_options' => [
                Manager::class => [
                    'service_manager' => 'requestManager',
                    'config_key'      => 'requests',
                    'class_method'    => 'getRequestConfig'
                ],
            ],
            'request' => [
                'format' => RequestInterface::FORMAT_OBJECTS,
            ],
          'domainMapping' => $this->getDomainMapping()
        ];
    }

    /**
     * @inheritDoc
     */
    public function getDependencyConfig(): array
    {
        return [
            'aliases' => [
                'requestManager' => Manager::class,
            ],
            'factories' => [
                Manager::class => ManagerFactory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getRequestConfig(): array
    {
        return [
            'aliases' => [
                'Request' => Request::class,
            ],
            'initializers' => [
                DebugAwareInitializer::class,
            ],
            'services' => array_merge(
                $this->getCurrencyServicesConfig(),
                $this->getDirectdebitServicesConfig(),
                $this->getIsPayServicesConfig(),
                $this->getMerchantServicesConfig(),
                $this->getPinServicesConfig(),
                $this->getQrServicesConfig(),
                $this->getRefundServicesConfig(),
                $this->getServiceServicesConfig(),
                $this->getTransactionServicesConfig(),
                $this->getVouchersServicesConfig()
            ),
            'factories' => [
                Request::class => Factory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getCurrencyServicesConfig(): array
    {
        return [
            'GetAllCurrencies' => [
                'uri' => '/currencies',
                'method' => RequestInterface::METHOD_GET,
            ],
            'GetCurrency' => [
                'uri' => '/currencies/%currencyId%',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                    'currencyId' => '[a-zA-Z]{3}',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getDirectdebitServicesConfig(): array
    {
        return [
            'CreateDirectdebit' => [
                'uri' => '/directdebits',
                'method' => RequestInterface::METHOD_POST,
            ],
            'CreateRecurringDirectdebit' => [
                'uri' => '/directdebits/%incassoOrderId%/debits',
                'method' => RequestInterface::METHOD_POST,
                'requiredParams' => [
                    'incassoOrderId' => 'IO(-\d{4}){3,}'
                ],
            ],
            'DeleteDirectdebit' => [
                'uri' => '/directdebits/%incassoOrderId%',
                'method' => RequestInterface::METHOD_DELETE,
                'requiredParams' => [
                    'incassoOrderId' => 'IO(-\d{4}){3,}'
                ],
            ],
            'GetDirectdebit' => [
                'uri' => '/directdebits/%incassoOrderId%',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                    'incassoOrderId' => 'IO(-\d{4}){3,}'
                ],
            ],
            'UpdateDirectdebit' => [
                'uri' => '/directdebits/%incassoOrderId%',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'incassoOrderId' => 'IO(-\d{4}){3,}'
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getIsPayServicesConfig(): array
    {
        return [
          'IsPay' => [
            'uri' => '/ispay/ip?value=%value%',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [
              'value' => '[0-9\.]+',
            ],
          ],
          'GetIpAddresses' => [
            'uri' => '/ipaddresses',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
        ];
    }

    /**
     * @return array
     */
    protected function getMerchantServicesConfig(): array
    {
        return [
          'AddTrademark' => [
            'uri' => '/merchants/%merchantId%/trademarks',
            'method' => RequestInterface::METHOD_POST,
            'requiredParams' => ['merchantId' => 'M(-\d{4}){2,}'],
          ],
          'DeleteTrademark' => [
            'uri' => '/merchants/%merchantId%/trademarks/%trademarkId%',
            'method' => RequestInterface::METHOD_DELETE,
            'requiredParams' => [
              'merchantId' => 'M(-\d{4}){2,}',
              'trademarkId' => 'TM(-\d{4}){2,}'
            ],
          ],
          'GetMerchant' => [
            'uri' => '/merchants/%merchantId%',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [
              'merchantId' => 'M(-\d{4}){2,}',
            ],
          ],
          'DocumentAdd' => [
            'uri' => '/documents',
            'method' => RequestInterface::METHOD_POST,
            'requiredParams' => [],
          ],
          'MerchantsBrowse' => [
            'uri' => '/merchants',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
          'MerchantCreate' => [
            'uri' => '/merchants',
            'method' => RequestInterface::METHOD_POST,
          ],
          'MerchantsInfo' => [
            'uri' => '/merchants/%merchantCode%/info',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => ['merchantCode' => 'M(-\d{4}){2,}'],
          ],
          'GetAllCountries' => [
            'uri' => '/countries',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
          'GetAllIssuers' => [
            'uri' => '/issuers',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
          'GetAllLanguages' => [
            'uri' => '/languages',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
          'GetAllMccs' => [
            'uri' => '/mcc',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
          'GetAllProductTypes' => [
            'uri' => '/producttypes',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
        ];
    }

    /**
     * @return array
     */
    protected function getPinServicesConfig(): array
    {
        return [
            'TerminalGet' => [
                'uri' => '/terminals/%terminalCode%',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => ['terminalCode' => ''],
            ],
            'TerminalBrowse' => [
                'uri' => '/terminals',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [],
            ],
            'ConfirmTerminalTransaction' => [
                'uri' => '/pin/%terminalTransactionId%/confirm',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => ['terminalTransactionId' => 'TT(-\d{4}){3,}'],
            ],
            'GetReceipt' => [
                'uri' => '/pin/%terminalTransactionId%/receipt',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                    'terminalTransactionId' => 'TT(-\d{4}){3,}',
                ],
            ],
            'GetTerminals' => [
                'uri' => '/pin/terminals',
                'method' => RequestInterface::METHOD_GET,
            ],
            'GetTerminalTransactionStatus' => [
                'uri' => '/pin/%terminalTransactionId%/status',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                    'terminalTransactionId' => 'TT(-\d{4}){3,}',
                ],
            ],
            'PayTransaction' => [
                'uri' => '/pin/%terminalTransactionId%/payment',
                'method' => RequestInterface::METHOD_POST,
                'requiredParams' => [
                    'terminalTransactionId' => 'TT(-\d{4}){3,}',
                ],
            ],
          'TerminalPaymentStatus' => [
            'uri' => '/api/status?hash=%hash%&timeout=%timeout%',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [
              'hash' => '',
              'timeout' => ''
            ],
          ],
          'TerminalCancelPayment' => [
            'uri' => '/api/cancel?hash=%hash%',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [
              'hash' => '',
            ],
          ],
        ];
    }

    /**
     * @return array[]
     */
    protected function getDomainMapping(): array
    {
        return ['https://pin.pay.nl' => ['GetPinPaymentStatus', 'TerminalCancelPayment']];
    }

    /**
     * @return array
     */
    protected function getQrServicesConfig(): array
    {
        return [
            'DecodeQr' => [
                'uri' => '/qr/decode',
                'method' => RequestInterface::METHOD_POST,
                'validator' => Decode::class,
            ],
            'EncodeQr' => [
                'uri' => '/qr/encode',
                'method' => RequestInterface::METHOD_POST,
                'validator' => Encode::class,
            ],
            'ValidateQr' => [
                'uri' => '/qr/validate',
                'method' => RequestInterface::METHOD_POST,
                'validator' => Decode::class,
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getRefundServicesConfig(): array
    {
        return [
            'GetRefund' => [
                'uri' => '/refund/%refundId%',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                    'refundId' => 'RF(-\d{4}){2,}',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getServiceServicesConfig(): array
    {
        return [
          'CreatePaymentLink' => [
            'uri' => '/services/%serviceId%/paymentlink',
            'method' => RequestInterface::METHOD_POST,
            'requiredParams' => [
              'serviceId' => 'SL(-\d{4}){2,}',
            ],
          ],
          'GetService' => [
            'uri' => '/services/%serviceId%',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [
              'serviceId' => 'SL(-\d{4}){2,}',
            ],
          ],
          'GetConfig' => [
            'uri' =>  '/services/config',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
            'optionalParams' => [
                'serviceId' => 'SL(-\d{4}){2,}',
            ],
          ],
          'ServicesGetAll' => [
            'uri' => '',
          ],
          'GetPaymentMethods' => [
            'uri' => '/services/%serviceId%/paymentmethods',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [
              'serviceId' => 'SL(-\d{4}){2,}',
            ],
          ],
          'GetPaymentMethodGroups' => [
            'uri' => '/paymentmethodgroups',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],
          'GetAllPaymentMethods' => [
            'uri' => '/paymentmethods',
            'method' => RequestInterface::METHOD_GET,
            'requiredParams' => [],
          ],

        ];
    }

    /**
     * @return array
     */
    protected function getTransactionServicesConfig(): array
    {
        return [
            'ApproveTransaction' => [
                'uri' => '/transactions/%transactionId%/approve',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => 'EX(-\d{4}){3,}',
                ],
            ],
            'VoidTransaction' => [
                'uri' => '/transactions/%transactionId%/void',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => 'EX(-\d{4}){3,}',
                ],
            ],
            'TransactionCapture' => [
                'uri' => '',
                'requiredParams' => [
                    'transactionId' => '',
                ],
            ],
            'TransactionVoid' => [
                'uri' => '',
                'requiredParams' => [
                    'transactionId' => '',
                ],
            ],
            'CreateTransaction' => [
                'uri' => '/transactions',
                'method' => RequestInterface::METHOD_POST,
            ],
            'DeclineTransaction' => [
                'uri' => '/transactions/%transactionId%/decline',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => 'EX(-\d{4}){3,}',
                ],
            ],
            'GetTransaction' => [
                'uri' => '/transactions/%transactionId%',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                    'transactionId' => '',
                ],
            ],
              'GetTransactionStatus' => [
                'uri' => '/transactions/%transactionId%/status',
                'method' => RequestInterface::METHOD_GET,
                'requiredParams' => [
                  'transactionId' => '',
                ],
              ],
            'CaptureTransactionByQr' => [
                'uri' => '/transactions/%transactionId%/qr',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => 'EX(-\d{4}){3,}',
                ],
            ],
            'MakeTransactionRecurring' => [
                'uri' => '/transactions/%transactionId%/recurring',
                'method' => RequestInterface::METHOD_POST,
                'requiredParams' => [
                    'transactionId' => 'EX(-\d{4}){3,}',
                ],
            ],
          'TransactionRefund' => [
            'uri' => '/transactions/%transactionId%/refund',
            'method' => RequestInterface::METHOD_PATCH,
            'requiredParams' => [
              'transactionId' => '',
            ],
          ],
            'RefundTransaction' => [
                'uri' => '/transactions/%transactionId%/refund',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => '',
                ],
            ],
            'TokenizeTransaction' => [
                'uri' => '/transactions/%transactionId%/tokenize',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => 'EX(-\d{4}){3,}',
                ],
            ],
            'CancelTransaction' => [
                'uri' => '/transactions/%transactionId%/cancel',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'transactionId' => '',
                ],
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getVouchersServicesConfig(): array
    {
        return [
            'ActivateVoucher' => [
                'uri' => '/vouchers/%cardNumber%/activate',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'cardNumber' => '\d+',
                ],
            ],
            'CheckVoucherBalance' => [
                'uri' => '/vouchers/%cardNumber%/balance',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'cardNumber' => '\d+',
                ],
            ],
            'ChargeVoucher' => [
                'uri' => '/vouchers/%cardNumber%/charge',
                'method' => RequestInterface::METHOD_PATCH,
                'requiredParams' => [
                    'cardNumber' => '\d+',
                ],
            ],
        ];
    }
}
