<?php

declare(strict_types=1);

namespace PayNL\Sdk\Mapper;

use PayNL\Sdk\Config\ProviderInterface;
use PayNL\Sdk\Common\ManagerFactory;

/**
 * Class ConfigProvider
 *
 * @package PayNL\Sdk\Mapper
 */
class ConfigProvider implements ProviderInterface
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
                    'service_manager' => 'mapperManager',
                    'config_key'      => 'mappers',
                    'class_method'    => 'getMapperConfig',
                ],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getDependencyConfig(): array
    {
        return [
            'aliases' => [
                'mapperManager' => Manager::class,
            ],
            'factories' => [
                Manager::class => ManagerFactory::class,
            ],
        ];
    }

    /**
     * Service manager definition for the models of this component
     *
     * @return array
     */
    public function getMapperConfig(): array
    {
        return [
            'aliases' => [
                'RequestModelMapper' => RequestModelMapper::class,
            ],
            'factories' => [
                RequestModelMapper::class => Factory::class,
            ],
            'mapping' => $this->getMap(),
        ];
    }

    /**
     * Mapping for setting the correct model for the corresponding request. If a
     * request is not in the list the text for the corresponding status code will
     * be shown.
     *
     * @return array
     */
    public function getMap(): array
    {
        return [
            'RequestModelMapper' => [
                'GetAllCurrencies'              => 'Currencies',
                'GetCurrency'                   => 'Currency',
                'GetAllCountries'               => 'Countries',
                'CreateDirectdebit'             => 'DirectdebitOverview',
                'CreateRecurringDirectdebit'    => 'DirectdebitOverview',
                'GetDirectdebit'                => 'DirectdebitOverview',
                'UpdateDirectdebit'             => 'DirectdebitOverview',
                'GetAllIssuers'                 => 'Issuers',
                'GetAllLanguages'               => 'Languages',
                'GetAllMccs'                    => 'Mccs',
                'AddTrademark'                  => 'Merchant',
                'DeleteTrademark'               => 'Merchant',
                'DocumentAdd'                   => 'Document',
                'GetMerchant'                   => 'Merchant',
                'MerchantsBrowse'               => 'Merchants',
                'MerchantsInfo'                 => 'Merchant',
                'MerchantCreate'                => 'Merchant',
                'ConfirmTerminalTransaction'    => 'TerminalTransaction',
                'GetReceipt'                    => 'Receipt',
                'GetTerminals'                  => 'Terminals',
                'GetTerminalTransactionStatus'  => 'TerminalTransaction',
                'PayTransaction'                => 'TerminalTransaction',
                'DecodeQr'                      => 'Qr',
                'EncodeQr'                      => 'Qr',
                'GetRefund'                     => 'Refund',
                'CreatePaymentLink'             => 'ServicePaymentLink',
                'GetService'                    => 'Service',
                'GetConfig'                     => 'ServiceGetConfigResponse',
                'GetIpAddresses'                => 'IpAddresses',

                'GetPaymentMethods'             => 'PaymentMethods',
                'GetAllPaymentMethods'          => 'PaymentMethods',
                'GetPaymentMethodGroups'        => 'PaymentMethodGroups',
                'TerminalPaymentStatus'         => 'TerminalPaymentStatus',
                'TerminalCancelPayment'         => 'TerminalPaymentStatus',
                'GetAllProductTypes'            => 'ProductTypes',
                'ApproveTransaction'            => 'Transaction',
                'CancelTransaction'             => 'Transaction',
                'CreateTransaction'             => 'CreateTransactionResponse',
                'DeclineTransaction'            => 'Transaction',
                'GetTransaction'                => 'Transaction',
                'GetTransactionStatus'          => 'TransactionStatusResponse',
                'CaptureTransactionByQr'        => 'Transaction',
                'RefundTransaction'             => 'RefundOverview',
                'TokenizeTransaction'           => 'Transaction',
                'TransactionRefund'             => 'TransactionRefundResponse',
                'TransactionCapture'            => 'TransactionCaptureResponse',
                'TransactionVoid'               => 'TransactionVoidResponse',
                'ServicesGetAll'                => 'ServicesGetAllResponse',
                'TerminalGet'                   => 'Terminal',
                'TerminalBrowse'                => 'Terminals'
            ],
        ];
    }
}
