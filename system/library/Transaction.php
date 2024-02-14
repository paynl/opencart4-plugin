<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayHelper;
use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Model\Product;
use PayNL\Sdk\Model\Request\TransactionCreateRequest;
use PayNL\Sdk\Model\Request\TransactionStatusRequest;

class PayTransaction
{
    public $openCart;
    public $helper;
    public $code;
    public $route;

    public $STATUS_PENDING = 1;
    public $STATUS_PROCESSING = 2;
    public $STATUS_COMPLETE = 5;
    public $STATUS_CANCELED = 7;
    public $STATUS_DENIED = 8;
    public $STATUS_REFUNDED = 11;
    public $STATUS_VOIDED = 16;

    /**
     * @param object $openCart
     */
    public function __construct($openCart)
    {
        $this->openCart = $openCart;
        $this->helper = new PayHelper($openCart);
        $this->code = $this->helper->code;
        $this->route = $this->helper->route;
    }

    /**
     * @param string $transactionId
     * @return \PayNL\Sdk\Model\TransactionStatusResponse
     * @throws Exception
     */
    public function getTransactionStatus($transactionId)
    {
        $transactionStatusRequest = new TransactionStatusRequest($transactionId);
        $transactionStatusRequest->setConfig($this->helper->getConfig());
        $transaction = $transactionStatusRequest->start();
        return $transaction;
    }

    /**
     * @param string $transactionId
     * @param string $orderId
     * @return string
     * @throws Exception
     * @throws PayException
     */
    public function processTransaction($transactionId, $orderId)
    {
        $this->openCart->load->model('checkout/order');
        $this->openCart->load->model('extension/paynl/payment/paynl');

        $transaction = $this->getTransactionStatus($transactionId);

        $iOrderState = null;
        if ($transaction->isPaid() || $transaction->isAuthorized()) {
            $iOrderState = $this->STATUS_PROCESSING;
            $status = 'Processing';
        }
        if ($transaction->isCancelled()) {
            $iOrderState = $this->STATUS_CANCELED;
            $status = 'Cancelled';
        }
        if ($transaction->isRefunded(false)) {
            $iOrderState = $this->STATUS_REFUNDED;
            $status = 'Refunded';
        }

        $order_info = $this->openCart->model_checkout_order->getOrder($orderId);
        $current_order_status = $order_info['order_status_id'];

        if ($current_order_status == $iOrderState || !$iOrderState || ($current_order_status == $this->STATUS_PROCESSING && $iOrderState == $this->STATUS_CANCELED)) {
            return 'Ignoring';
        }

        $message = "Status updated to $status";
        $this->openCart->model_checkout_order->addHistory($orderId, (int) $iOrderState, $message . ', Pay. orderId: (' . $transactionId . '), Pay. status: ('.$transaction->getStatus()['action'].')', true);

        return $message;
    }

    /**
     * @param array $order_info
     * @return string
     * @throws Exception
     */
    public function startTransaction($order_info, $options)
    {
        $request = new TransactionCreateRequest();
        $request->setConfig($this->helper->getConfig());
        $request->setServiceId($this->openCart->config->get('payment_' . $this->code . '_serviceid'));
        $request->setDescription('Order ' . $order_info['order_id']);
        $request->setReference($order_info['order_id']);        

        $request->setReturnurl($this->openCart->url->link('extension/paynl/payment/finish.finish'));
        $request->setExchangeUrl($this->openCart->url->link('extension/paynl/payment/exchange.exchange'));

        $request->setAmount($order_info['total']);
        $request->setCurrency($order_info['currency_code']);
        $request->setPaymentMethodId($this->openCart->session->data['payment_method']['paymentOptionId']);
        $request->setIssuerId($options['issuer']);
        $request->setTestmode(($this->openCart->config->get('payment_' . $this->code . '_testmode') == 1));

        $customer = new \PayNL\Sdk\Model\Customer();
        $customer->setFirstName($order_info['firstname'] ?? '');
        $customer->setLastName($order_info['lastname'] ?? '');
        $customer->setIpAddress($_SERVER["REMOTE_ADDR"]);
        $customer->setPhone($order_info['telephone'] ?? '');
        $customer->setEmail($order_info['email'] ?? '');
        $customer->setLanguage($this->openCart->language->get('code'));

        $address = array();
        if (!empty($this->openCart->session->data['payment_address'])) {
            $address = $this->openCart->session->data['payment_address'];
        } else if (!empty($this->openCart->session->data['shipping_address'])) {
            $address = $this->openCart->session->data['shipping_address'];
        }
        if (empty($toggle_address)) {
            $this->openCart->load->model('account/address');
            if ($this->openCart->customer->getAddressId()) {
                $address = $this->openCart->model_account_address->getAddress($this->openCart->customer->getId(), $this->openCart->customer->getAddressId()) ?: array();
            }
        }

        $order = new \PayNL\Sdk\Model\Order();

        if (!empty($address)) {
            $company = new \PayNL\Sdk\Model\Company();
            $company->setName($address['company']);
            $company->setCoc($options['coc']);
            $company->setVat($options['vat']);
            $company->setCountryCode($address['iso_code_2'] ?? '');

            $customer->setCompany($company);
            $customer->setBirthDate($options['dob']);

            $request->setCustomer($customer);

            $arrStreet = paynl_split_address(trim(($address['address_1'] ?? '') . ' ' . ($address['address_2'] ?? '')));

            $devAddress = new \PayNL\Sdk\Model\Address();
            $devAddress->setCode('dev');
            $devAddress->setStreetName($arrStreet['street']);
            $devAddress->setStreetNumber($arrStreet['number']);
            $devAddress->setZipCode($address['postcode'] ?? '');
            $devAddress->setCity($address['city'] ?? '');
            $devAddress->setCountryCode($address['country'] ?? '');
            $order->setDeliveryAddress($devAddress);

            $invAddress = new \PayNL\Sdk\Model\Address();
            $invAddress->setCode('inv');
            $invAddress->setStreetName($arrStreet['street']);
            $invAddress->setStreetNumber($arrStreet['number']);
            $invAddress->setZipCode($address['postcode'] ?? '');
            $invAddress->setCity($address['city'] ?? '');
            $invAddress->setCountryCode($address['country'] ?? '');
            $order->setInvoiceAddress($invAddress);
        }

        $payProducts = new \PayNL\Sdk\Model\Products();
        $products = $this->openCart->cart->getProducts();
        $totalPrice = 0;

        foreach ($products as $key => $product) {
            $tax = $this->openCart->tax->getTax($product['price'], $product['tax_class_id']);
            $totalPrice += $product['total'];
            $payProducts->addProduct(new Product($product['product_id'], $product['name'], $product['total'], $order_info['currency_code'], Product::TYPE_ARTICLE, $product['quantity'], paynl_determine_vat_class_by_percentage($tax)));
        }

        if (!empty($order_info['shipping_method'])) {
            $shipping = $order_info['shipping_method'];
            $tax = $this->openCart->tax->getTax($shipping['cost'], $shipping['tax_class_id']);
            $payProducts->addProduct(new Product('Shipping', $shipping['name'], $shipping['cost'], $order_info['currency_code'], Product::TYPE_SHIPPING, 1, paynl_determine_vat_class_by_percentage($tax)));
        }

        if ($options['coupon']) {
            $discount = 0;
			$this->openCart->load->model('marketing/coupon');
			$coupon_info = $this->openCart->model_marketing_coupon->getCoupon($options['coupon']);
            if($coupon_info['type'] == 'P'){
                $discount += ($totalPrice / 100) * $coupon_info['discount'];
            } else if($coupon_info['type'] == 'F'){
                $discount += $coupon_info['discount'];
            }
            if (!empty($order_info['shipping_method']) && $coupon_info['shipping'] == 1) {
                $discount += $order_info['shipping_method']['cost'];
            }
            $payProducts->addProduct(new Product($options['coupon'], $coupon_info['name'], -$discount, $order_info['currency_code'], Product::TYPE_DISCOUNT, 1, 'N'));
		}

        if ($options['voucher']) {
            $this->openCart->load->model('checkout/voucher');
            $voucher_info = $this->openCart->model_checkout_voucher->getVoucher($options['voucher']);
            $payProducts->addProduct(new Product('voucher', $voucher_info['code'], -$voucher_info['amount'], $order_info['currency_code'], Product::TYPE_DISCOUNT, 1, 'N'));           
        }       

        $order->setProducts($payProducts);

        $request->setStats((new \PayNL\Sdk\Model\Stats())
                ->setObject($this->helper->getObject())
                ->setExtra1($order_info['order_id'])
        );

        $request->setOrder($order);

        try {
            $transaction = $request->start();
        } catch (PayException $e) {
            throw new \Exception($e->getFriendlyMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

        return $transaction->getPaymentUrl();
    }
}
