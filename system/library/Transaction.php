<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Model\Product;
use PayNL\Sdk\Model\Request\OrderCaptureRequest;
use PayNL\Sdk\Model\Request\OrderVoidRequest;
use PayNL\Sdk\Model\Request\OrderCreateRequest;
use PayNL\Sdk\Model\Request\TransactionRefundRequest;
use PayNL\Sdk\Model\Request\OrderStatusRequest;
use PayNL\Sdk\Model\Request\TransactionStatusRequest;


class PayTransaction
{
    public $openCart;
    public $payConfig;
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
    public function __construct($openCart) // phpcs:ignore
    {
        $this->openCart = $openCart;
        $this->payConfig = new PayConfig($openCart);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
    }

    /**
     * @param string $transactionId
     * @return \PayNL\Sdk\Model\TransactionStatusResponse
     * @throws Exception
     */
    public function getTransactionStatus($transactionId)
    {
        $transactionStatusRequest = new TransactionStatusRequest($transactionId);
        $transactionStatusRequest->setConfig($this->payConfig->getConfig(true));
        $transactionStatus = $transactionStatusRequest->start();  
        return $transactionStatus;
    }

    /**
     * @param string $transactionId
     * @return \PayNL\Sdk\Model\OrderStatusResponse
     * @throws Exception
     */
    public function getOrderStatus($transactionId)
    {
        $orderStatusRequest = new OrderStatusRequest($transactionId);
        $orderStatusRequest->setConfig($this->payConfig->getConfig(true));
        $orderStatus = $orderStatusRequest->start();
        return $orderStatus;
    }

    /**
     * @param string $transactionId
     * @param string $orderId
     * @param string $action
     * @return string
     * @throws Exception
     * @throws PayException
     */
    public function processTransaction($transactionId, $payOrder, $action)
    {
        $this->openCart->load->model('checkout/order');
        $this->openCart->load->model('extension/paynl/payment/paynl');

        $orderId = $payOrder->getReference();

        $iOrderState = null;
        if ($payOrder->isPaid() || $payOrder->isAuthorized() || $payOrder->getStatus()['code'] == 97) {
            $iOrderState = $this->STATUS_PROCESSING;
            $status = 'Processing';
        }
        if ($payOrder->isCancelled() || $payOrder->isVoided()) {
            $iOrderState = $this->STATUS_CANCELED;
            $status = 'Cancelled';
        }
        if ($payOrder->isRefunded()) {
            $iOrderState = $this->STATUS_REFUNDED;
            $status = 'Refunded';
        } 

        $order_info = $this->openCart->model_checkout_order->getOrder($orderId);
        $current_order_status = $order_info['order_status_id'];   
        
        if (!$iOrderState || ($current_order_status == $this->STATUS_PROCESSING && $iOrderState == $this->STATUS_CANCELED && $payOrder->isPaid() && !$payOrder->isAuthorized())) {
            return 'Ignoring';
        }

        if ($current_order_status == $iOrderState) {
            $message = 'Status unchanged';
        } else {
            $this->openCart->model_checkout_order->addHistory($orderId, (int) $iOrderState);
            $message = "Status updated to $status";
        }

        $this->addHistory($orderId, $transactionId, $message, $status, $payOrder->getStatusName(), $action);

        if ($this->payConfig->shouldFollowPayment() && $payOrder->isPaid() && $payOrder->isPaid()) {
            $this->getRealPaymentMethod($orderId);
        }

        return $message;
    }

    /**
     * @param string $orderId
     * @return void
     */
    public function getRealPaymentMethod($orderId)
    {
        $payment_profile_id = $this->openCart->request->get['payment_profile_id'] ?? null;

        $this->openCart->load->model('checkout/order');
        $order = $this->openCart->model_checkout_order->getOrder($orderId);

        if ($order['payment_method']['paymentOptionId'] == $payment_profile_id) {
            return;
        }

        $this->openCart->load->model('extension/paynl/payment/paynl');
        $payment_methods = $this->openCart->{'model_extension_paynl_payment_paynl'}->getMethods([], true);
        if (!empty($payment_methods['option'])) {
            foreach ($payment_methods['option'] as $payment_method) {
                if ($payment_method['paymentOptionId'] == $payment_profile_id) {
                    $method = json_encode($payment_method);
                    if (!empty($method)) {
                        $this->openCart->db->query("UPDATE `" . DB_PREFIX . "order` SET `payment_method` = '" . $this->openCart->db->escape($method) . "' WHERE `order_id` = '" . (int) $orderId . "'");
                    }
                    break;
                }
            }
        }
    }

    /**
     * @param string $orderId
     * @return void
     */
    public function getPaymentMethod($payment_profile_id)
    {              
        $this->openCart->load->model('extension/paynl/payment/paynl');
        $payment_methods = $this->openCart->{'model_extension_paynl_payment_paynl'}->getMethods([], true);
        if (!empty($payment_methods['option'])) {
            foreach ($payment_methods['option'] as $payment_method) {
                if ($payment_method['paymentOptionId'] == $payment_profile_id) {
                    $method = json_encode($payment_method);                  
                    return $method;
                }
            }
        }
    }

    /**
     * @param array $order_info
     * @param array $options
     * @return string
     * @throws Exception
     */
    public function startTransaction(array $order_info, array $options)
    {
        $request = new OrderCreateRequest();
        $request->setConfig($this->payConfig->getConfig(true));
        $request->setServiceId($this->payConfig->getServiceId());
        $request->setDescription('Order ' . $order_info['order_id']);
        $request->setReference($order_info['order_id']);

        $request->setReturnurl($this->openCart->url->link('extension/paynl/payment/finish.finish') . '&session_id=' . $this->openCart->session->getId());
        $request->setExchangeUrl($this->openCart->url->link('extension/paynl/payment/exchange.exchange'));

        $request->setAmount($order_info['total']);
        $request->setCurrency($order_info['currency_code']);
        $request->setPaymentMethodId($this->openCart->session->data['payment_method']['paymentOptionId']);
        $request->setIssuerId($options['issuer']);
        $request->setTestmode($this->payConfig->isTestMode());

        $customer = new \PayNL\Sdk\Model\Customer();
        $customer->setFirstName($order_info['firstname'] ?? '');
        $customer->setLastName($order_info['lastname'] ?? '');
        $customer->setIpAddress($_SERVER["REMOTE_ADDR"]);
        $customer->setPhone($order_info['telephone'] ?? '');
        $customer->setEmail($order_info['email'] ?? '');

        $language = $this->payConfig->getScreenLanguage();
        if ($language == 'auto' || $language == null) {
            $language = $this->openCart->language->get('code');
        }
        $customer->setLanguage($language);

        $address = array();
        if (!empty($this->openCart->session->data['payment_address'])) {
            $address = $this->openCart->session->data['payment_address'];
        } elseif (!empty($this->openCart->session->data['shipping_address'])) {
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
            $devAddress->setCountryCode($address['iso_code_2'] ?? '');
            $order->setDeliveryAddress($devAddress);

            $invAddress = new \PayNL\Sdk\Model\Address();
            $invAddress->setCode('inv');
            $invAddress->setStreetName($arrStreet['street']);
            $invAddress->setStreetNumber($arrStreet['number']);
            $invAddress->setZipCode($address['postcode'] ?? '');
            $invAddress->setCity($address['city'] ?? '');
            $invAddress->setCountryCode($address['iso_code_2'] ?? '');
            $order->setInvoiceAddress($invAddress);
        }

        $payProducts = new \PayNL\Sdk\Model\Products();
        $products = $this->openCart->cart->getProducts();
        $totalPrice = 0;

        foreach ($products as $key => $product) {
            $tax = $this->openCart->tax->getTax($product['price'], $product['tax_class_id']);
            $totalPrice += $product['total'];
            $payProducts->addProduct(new Product($product['product_id'], $product['name'], $product['total'], $order_info['currency_code'], Product::TYPE_ARTICLE, $product['quantity'], paynl_determine_vat_class_by_percentage($tax))); // phpcs:ignore
        }

        if (!empty($order_info['shipping_method'])) {
            $shipping = $order_info['shipping_method'];
            $tax = $this->openCart->tax->getTax($shipping['cost'], $shipping['tax_class_id']);
            $payProducts->addProduct(new Product('Shipping', $shipping['name'], $shipping['cost'], $order_info['currency_code'], Product::TYPE_SHIPPING, 1, paynl_determine_vat_class_by_percentage($tax))); // phpcs:ignore
        }

        if ($options['coupon']) {
            $discount = 0;
            $this->openCart->load->model('marketing/coupon');
            $coupon_info = $this->openCart->model_marketing_coupon->getCoupon($options['coupon']);
            if ($coupon_info['type'] == 'P') {
                $discount += ($totalPrice / 100) * $coupon_info['discount'];
            } elseif ($coupon_info['type'] == 'F') {
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
            ->setObject($this->payConfig->getObject())
            ->setExtra1($order_info['order_id']));

        $request->setOrder($order);

        

        try {
            $transaction = $request->start();
        } catch (PayException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
        
        $this->addTransaction($order_info['order_id'], $transaction->getOrderId(), $order_info['total']);
        return $transaction->getPaymentUrl();
    }

    /**
     * @param string $order_id
     * @param string $transaction_id
     * @param float $amount
     *
     */
    public function addTransaction($order_id, $transaction_id, $amount)
    {
        $query = "INSERT INTO `" . DB_PREFIX . "pay_transactions`(`order_id`, `transaction_id`, `amount`) VALUES ('" . $order_id . "','" . $transaction_id . "'," . $amount . ")  ON DUPLICATE KEY UPDATE transaction_id='" . $transaction_id . "', amount=" . $amount . ";";
        $this->openCart->db->query($query);
    }

    /**
     * @param string $order_id
     * @return array|null
     */
    public function getTransaction($order_id)
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "pay_transactions` WHERE `order_id` = '" . $order_id . "';";
        $dbTransaction = $this->openCart->db->query($query);

        if ($dbTransaction->num_rows) {
            return [
                'db' => $dbTransaction->row,
                'orderStatus' => $this->getOrderStatus($dbTransaction->row['transaction_id'])
            ];
        } else {
            return null;
        }
    }

    /**
     * @param string $order_id
     * @param string $transaction_id
     * @param float $amount
     *
     */
    public function addHistory($order_id, $transaction_id, $message, $ocStatus, $payStatus, $action)
    {
        $query = "INSERT INTO `" . DB_PREFIX . "pay_history`(`order_id`, `transaction_id`, `message`, `oc_status`, `pay_status`, `pay_action`) VALUES ('" . $order_id . "','" . $transaction_id . "','" . $message . "','" . $ocStatus . "','" . $payStatus . "','" . $action . "');";
        $this->openCart->db->query($query);
    }

    /**
     * @param string $order_id
     */
    public function getHistory($order_id)
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "pay_history` WHERE `order_id` = '" . $order_id . "'  ORDER BY created_at DESC;";
        $dbTransaction = $this->openCart->db->query($query);
        if ($dbTransaction->num_rows) {
            return $dbTransaction->rows ?? $dbTransaction->row;
        } else {
            return null;
        }
    }

    /**
     * @param string $order_id
     * @param string $amount
     * @param string $currency
     * @throws Exception
     */
    public function refund($transactionId, $amount, $currency)
    {
        $request = new TransactionRefundRequest($transactionId);
        $request->setConfig($this->payConfig->getConfig());
        $request->setAmount($amount);
        $request->setCurrency($currency);
        $request->start();
    }

    /**
     * @param string $order_id
     * @param string $amount
     * @throws Exception
     */
    public function capture($transactionId, $amount)
    {
        $transaction = $this->getOrderStatus($transactionId);
        $maxAmount = number_format((float) $transaction->getAmount(), 2, '.', '');
        $request = new OrderCaptureRequest($transactionId);
        $request->setConfig($this->payConfig->getConfig());
        if($maxAmount != $amount) {
            $request->setAmount($amount);
        }        
        $request->start();
    }

    /**
     * @param string $order_id
     * @param string $amount
     * @throws Exception
     */
    public function void($transactionId, $amount)
    {
        $request = new OrderVoidRequest($transactionId);
        $request->setConfig($this->payConfig->getConfig());
        $request->start();
    }

    /**
     * @param $payOrderId
     * @return array
     */
    public function checkProcessing($payOrderId)
    {
        $result = null;
        try {
            $query = "SELECT * FROM `" . DB_PREFIX . "pay_processing` WHERE `payOrderId` = '" . $payOrderId . "' AND created_at > date_sub('" . date('Y-m-d H:i:s') . "', interval 1 minute) ORDER BY created_at DESC;";
            $dbTransaction = $this->openCart->db->query($query);
            if ($dbTransaction && !empty($dbTransaction->num_rows) && $dbTransaction->num_rows) {
                $result = $dbTransaction->rows ?? $dbTransaction->row;
            }        
            if (empty($result)) {
                $query = "INSERT INTO `" . DB_PREFIX . "pay_processing`(`payOrderId`) VALUES ('" . $payOrderId . "') ON DUPLICATE KEY UPDATE created_at='" . date('Y-m-d H:i:s') . "';";
                $this->openCart->db->query($query);
            }
        } catch (\Exception $e) {
            $result = null;
        }
        return is_array($result) ? $result : array();
    }

    /**
     * @param $payOrderId
     * @return void
     */
    public function removeProcessing($payOrderId)
    {     
        $query = "DELETE FROM `" . DB_PREFIX . "pay_processing` WHERE `payOrderId` = '" . $payOrderId . "';";
        $this->openCart->db->query($query);
    }
}
