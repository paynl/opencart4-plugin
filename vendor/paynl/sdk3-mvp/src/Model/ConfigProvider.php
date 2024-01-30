<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model;

use PayNL\Sdk\{
    Config\ProviderInterface as ConfigProviderInterface,
    Common\ManagerFactory
};

/**
 * Class ConfigProvider
 *
 * @package PayNL\Sdk\Model
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
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
                    'service_manager' => 'modelManager',
                    'config_key'      => 'models',
                    'class_method'    => 'getModelConfig'
                ],
            ],
            'hydrator_collection_map' => [
                // CollectionEntity(Alias) => EntryEntity(Alias)
                'contactMethods'        => 'contactMethod',
                'currencies'            => 'currency',
                'directdebits'          => 'directdebit',
                'errors'                => 'error',
                'issuers'               => 'issuer',
                'links'                 => 'link',
                'paymentMethods'        => 'paymentMethod',
                'paymentMethodGroups'   => 'paymentMethodGroup',
                'products'              => 'product',
                'productTypes'          => 'productType',
                'services'              => 'service',
                'merchants'             => 'merchant',
                'countries'             => 'country',
                'languages'             => 'language',
                'mccs'                  => 'mcc',
                'checkoutoptions'       => 'checkoutoption',
                'methods'               => 'method',
                'mccs'                  => 'mcc',
                'terminals'             => 'terminal',
                'trademarks'            => 'trademark',
                'refundedTransactions'  => 'refundTransaction'
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
                'modelManager' => Manager::class,
            ],
            'factories' => [
                Manager::class => ManagerFactory::class,
            ],
        ];
    }

    /**
     * @return array
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function getModelConfig(): array
    {
        return [
            'aliases' => [
                'address'               => 'Address',
                'amount'                => 'Amount',
                'bankAccount'           => 'BankAccount',
                'card'                  => 'Card',
                'company'               => 'Company',
                'companyCard'           => 'CompanyCard',
                'contactMethod'         => 'ContactMethod',
                'contactMethods'        => 'ContactMethods',
                'currencies'            => 'Currencies',
                'currency'              => 'Currency',
                'customer'              => 'Customer',
                'countries'             => 'Countries',
                'method'                => 'Method',
                'methods'               => 'Methods',
                'checkoutoption'        => 'CheckoutOption',
                'checkoutoptions'       => 'CheckoutOptions',
                'country'               => 'Country',
                'directdebit'           => 'Directdebit',
                'directdebits'          => 'Directdebits',
                'directdebitOverview'   => 'DirectdebitOverview',
                'error'                 => 'Error',
                'errors'                => 'Errors',
                'integration'           => 'Integration',
                'interval'              => 'Interval',
                'issuers'               => 'Issuers',
                'issuer'                => 'Issuer',
                'link'                  => 'Link',
                'links'                 => 'Links',
                'language'              => 'Language',
                'languages'             => 'Languages',
                'ipAddresses'           => 'IpAddresses',
                'mcc'                   => 'Mcc',
                'mccs'                  => 'Mccs',
                'productTypes'          => 'ProductTypes',
                'productType'           => 'ProductType',
                'mandate'               => 'Mandate',
                'merchant'              => 'Merchant',
                'merchants'             => 'Merchants',
                'notification'          => 'Notification',
                'order'                 => 'Order',
                'paymentMethod'         => 'PaymentMethod',
                'paymentMethods'        => 'PaymentMethods',
                'paymentMethodGroup'    => 'PaymentMethodGroup',
                'paymentMethodGroups'   => 'PaymentMethodGroups',
                'product'               => 'Product',
                'products'              => 'Products',
                'progress'              => 'Progress',
                'qr'                    => 'Qr',
                'receipt'               => 'Receipt',
                'recurringTransaction'  => 'RecurringTransaction',
                'refund'                => 'Refund',
                'refundOverview'        => 'RefundOverview',
                'refundTransaction'     => 'RefundTransaction',
                'refundedtransactions'  => 'RefundedTransactions',
                'refunded_transactions' => 'RefundedTransactions',
                'refundedTransactions'  => 'RefundedTransactions',
                'failedTransactions'    => 'RefundedTransactions',
                'failedtransactions'    => 'RefundedTransactions',
                'failed_transactions'   => 'RefundedTransactions',
                'service'               => 'Service',
                'services'              => 'Services',
                'servicePaymentLink'    => 'ServicePaymentLink',
                'statistics'            => 'Statistics',
                'status'                => 'Status',
                'terminal'              => 'Terminal',
                'terminals'             => 'Terminals',
                'terminalTransaction'   => 'TerminalTransaction',
                'terminalPaymentStatus' => 'TerminalPaymentStatus',
                'terminalCancelPayment' => 'TerminalCancelPayment',
                'trademark'             => 'Trademark',
                'trademarks'            => 'Trademarks',
                'transaction'           => 'Transaction',
                //'CreateTransactionResponse' => 'CreateTransactionResponse',
                //'TransactionRefundResponse' => 'TransactionRefundResponse',
                'transfer'                  => 'Transfer',
                'voucher'                   => 'Voucher',
            ],
            'invokables' => [
                'Address'               => Address::class,
                'Amount'                => Amount::class,
                'BankAccount'           => BankAccount::class,
                'Card'                  => Card::class,
                'Company'               => Company::class,
                'CompanyCard'           => CompanyCard::class,
                'ContactMethod'         => ContactMethod::class,
                'ContactMethods'        => ContactMethods::class,
                'Currencies'            => Currencies::class,
                'Currency'              => Currency::class,
                'Customer'              => Customer::class,
                'Countries'             => Countries::class,
                'Country'               => Country::class,
                'Directdebit'           => Directdebit::class,
                'Directdebits'          => Directdebits::class,
                'DirectdebitOverview'   => DirectdebitOverview::class,
                'Document'              => Document::class,
                'Error'                 => Error::class,
                'Errors'                => Errors::class,
                'Integration'           => Integration::class,
                'Interval'              => Interval::class,
                'Issuers'               => Issuers::class,
                'Issuer'                => Issuer::class,
                'Link'                  => Link::class,
                'Links'                 => Links::class,
                'Language'              => Language::class,
                'Languages'             => Languages::class,
                'Mcc'                   => Mcc::class,
                'Mccs'                  => Mccs::class,
                'IpAddresses'           => IpAddresses::class,
                'ProductType'           => ProductType::class,
                'ProductTypes'          => ProductTypes::class,
                'Mandate'               => Mandate::class,
                'Merchant'              => Merchant::class,
                'Merchants'             => Merchants::class,
                'Notification'          => Notification::class,
                'Order'                 => Order::class,
                'PaymentMethod'         => PaymentMethod::class,
                'PaymentMethods'        => PaymentMethods::class,
                'PaymentMethodGroup'    => PaymentMethodGroup::class,
                'PaymentMethodGroups'   => PaymentMethodGroups::class,
                'Product'               => Product::class,
                'Products'              => Products::class,
                'Progress'              => Progress::class,
                'Qr'                    => Qr::class,
                'Receipt'               => Receipt::class,
                'RecurringTransaction'  => RecurringTransaction::class,
                'Refund'                => Refund::class,
                'RefundOverview'        => RefundOverview::class,
                'RefundTransaction'     => RefundTransaction::class,
                'RefundedTransactions'  => RefundedTransactions::class,
                'Service'               => Service::class,
                'Config'                => Config::class,
                'Services'              => Services::class,
                'ServicePaymentLink'    => ServicePaymentLink::class,
                'Stats'                 => Stats::class,
                'Status'                => Status::class,
                'Terminal'              => Terminal::class,
                'Terminals'             => Terminals::class,
                'TerminalTransaction'   => TerminalTransaction::class,
                'TerminalPaymentStatus' => TerminalPaymentStatus::class,
                'TerminalCancelPayment' => TerminalPaymentStatus::class,
                'Trademark'             => Trademark::class,
                'Trademarks'            => Trademarks::class,
                'Transaction'           => Transaction::class,
                'CreateTransactionResponse'  => CreateTransactionResponse::class,
                'TransactionStatusResponse'  => TransactionStatusResponse::class,
                'TransactionRefundResponse'  => TransactionRefundResponse::class,
                'TransactionCaptureResponse' => TransactionCaptureResponse::class,
                'TransactionVoidResponse'    => TransactionVoidResponse::class,
                'ServicesGetAllResponse'     => ServicesGetAllResponse::class,
                'ServiceGetConfigResponse'   => ServiceGetConfigResponse::class,

                'Transfer'              => Transfer::class,
                'Voucher'               => Voucher::class,
                'CheckoutOptions'       => CheckoutOptions::class,
                'CheckoutOption'        => CheckoutOption::class,
                'Method'                => Method::class,
                'Methods'               => Methods::class,
            ],
        ];
    }
}
