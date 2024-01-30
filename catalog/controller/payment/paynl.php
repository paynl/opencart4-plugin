<?php
namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/system/library/Helper.php';
require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';

use Opencart\System\Library\PayHelper;
use PayNL\Sdk\Model\Product;
use PayNL\Sdk\Model\Request\TransactionCreateRequest;

class Paynl extends \Opencart\System\Engine\Controller
{
    private string $code;
    private string $route;
    private PayHelper $helper;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->helper = new PayHelper($this);
        $this->code = $this->helper->code;
        $this->route = $this->helper->route;
        parent::__construct($registry);
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $this->load->language($this->route);
        $data['logged'] = $this->customer->isLogged();
        $data['language'] = $this->config->get('config_language');
        $data['order_id'] = (int) $this->session->data['order_id'];
        $data['description'] = $this->session->data['payment_method']['description'];
        return $this->load->view($this->route, $data);
    }

    /**
     * @return void
     */
    public function confirm(): void
    {
        $this->load->language($this->route);
        $json = [];
        if (!isset($this->session->data['order_id'])) {
            $json['error']['warning'] = $this->language->get('error_order');
        }
        if (!isset($this->session->data['payment_method'])) {
            $json['error']['warning'] = $this->language->get('error_payment_method');
        }
        $this->load->model('checkout/order');
        $order = $this->model_checkout_order->getOrder($this->request->post['order_id']);
        if (!$json) {
            $json['redirect'] = $this->startTransaction($order);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * @param array $order_info
     * @return void
     */
    public function startTransaction($order_info)
    {
        $request = new TransactionCreateRequest();
        $request->setConfig($this->helper->getConfig());
        $request->setServiceId($this->config->get('payment_' . $this->code . '_serviceid'));
        $request->setDescription('Order ' . $order_info['order_id']);

        $request->setReturnurl($this->url->link('extension/paynl/payment/finish.finish'));
        $request->setExchangeUrl($this->url->link('extension/paynl/payment/exchange.exchange'));

        $request->setAmount($order_info['total']);
        $request->setCurrency($order_info['currency_code']);
        $request->setPaymentMethodId($this->session->data['payment_method']['paymentOptionId']);
        $request->setTestmode(($this->config->get('payment_' . $this->code . '_testmode') == 1));

        $customer = new \PayNL\Sdk\Model\Customer();
        $customer->setFirstName($order_info['firstname'] ?? '');
        $customer->setLastName($order_info['lastname'] ?? '');
        $customer->setIpAddress($_SERVER["REMOTE_ADDR"]);
        $customer->setPhone($order_info['telephone'] ?? '');
        $customer->setEmail($order_info['email'] ?? '');
        $customer->setLanguage($this->language->get('code'));

        $address = array();
        if (!empty($this->session->data['payment_address'])) {
            $address = $this->session->data['payment_address'];
        } else if (!empty($this->session->data['shipping_address'])) {
            $address = $this->session->data['shipping_address'];
        }
        if (empty($toggle_address)) {
            $this->load->model('account/address');
            if ($this->customer->getAddressId()) {
                $address = $this->model_account_address->getAddress($this->customer->getId(), $this->customer->getAddressId()) ?: array();
            }
        }

        $order = new \PayNL\Sdk\Model\Order();

        if (!empty($address)) {
            $company = new \PayNL\Sdk\Model\Company();
            $company->setName($address['company']);
            $company->setCoc('');
            $company->setVat('');
            $company->setCountryCode($address['iso_code_2'] ?? '');

            $customer->setCompany($company);
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
        $products = $this->cart->getProducts();

        foreach ($products as $key => $product) {
            $tax = $this->tax->getTax($product['price'], $product['tax_class_id']);
            $payProducts->addProduct(new Product($product['product_id'], $product['name'], $product['total'], $order_info['currency_code'], Product::TYPE_ARTICLE, $product['quantity'], paynl_determine_vat_class_by_percentage($tax)));
        }

        if (!empty($order_info['shipping_method'])) {
            $shipping = $order_info['shipping_method'];
            $tax = $this->tax->getTax($shipping['cost'], $shipping['tax_class_id']);
            $payProducts->addProduct(new Product(null, $shipping['name'], $shipping['cost'], $order_info['currency_code'], Product::TYPE_SHIPPING, 1, paynl_determine_vat_class_by_percentage($tax)));
        }

        $order->setProducts($payProducts);

        $request->setStats((new \PayNL\Sdk\Model\Stats())
                ->setObject($this->helper->getObject())
                ->setExtra1($order_info['order_id'])
        );

        $request->setOrder($order);

        $transaction = $request->start();

        return $transaction->getPaymentUrl();
    }
}
