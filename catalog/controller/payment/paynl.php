<?php
namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;

class Paynl extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $helper;
    private $payTransaction;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->helper = new PayHelper($this);
        $this->payTransaction = new PayTransaction($this);
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
            $json['error']['warning'] = $this->language->get('session_error_order');
        }
        if (!isset($this->session->data['payment_method'])) {
            $json['error']['warning'] = $this->language->get('session_error_payment_method');
        }
        $this->load->model('checkout/order');
        $order = $this->model_checkout_order->getOrder($this->request->post['order_id']);
        if (!$json) {
            try {
                $this->helper->log('Transaction: starting transaction', ['orderId' => $this->request->post['order_id']]);
                $json['redirect'] = $this->payTransaction->startTransaction($order);
            } catch (\Exception $e) {
                $this->helper->log('Transaction: start failed', ['orderId' => $this->request->post['order_id'], ' Error' => $e->getMessage()]);
                $json['error']['warning'] = $this->language->get('error_start_transaction');
            }
        } else {
            $this->helper->log('Transaction: cannot start transaction', ['orderId' => $this->request->post['order_id'], ' Json' => json_encode($json)]);
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
