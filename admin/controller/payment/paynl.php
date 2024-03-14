<?php

namespace Opencart\Admin\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayTransaction;
use Opencart\System\Library\PayPaymentMethods;

class Paynl extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $payConfig;
    private $helper;
    private $payTransaction;
    private $paymentMethods;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->payConfig = new PayConfig($this);
        $this->helper = new PayHelper($this);
        $this->payTransaction = new PayTransaction($this);
        $this->paymentMethods = new PayPaymentMethods($this);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
        parent::__construct($registry);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $this->load->language($this->route);

        $this->document->setTitle($this->language->get('heading_title_' . $this->code));
        $this->document->addStyle('../extension/paynl/admin/view/stylesheet/pay.css');
        $this->document->addScript('../extension/paynl/admin/view/javascript/jquery-ui/jquery-ui.js');
        $this->document->addScript('../extension/paynl/admin/view/javascript/pay.js');

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = ['text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])];
        $data['breadcrumbs'][] = ['text' => $this->language->get('text_extension'), 'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment')]; // phpcs:ignore
        $data['breadcrumbs'][] = ['text' => $this->language->get('heading_title'), 'href' => $this->url->link($this->route, 'user_token=' . $this->session->data['user_token'])];

        $data['save'] = $this->url->link('extension/paynl/payment/' . $this->code . '|save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment');

        // General
        $data['payment_' . $this->code . '_status'] = $this->config->get('payment_' . $this->code . '_status');
        $data['payment_' . $this->code . '_sort_order'] = $this->config->get('payment_' . $this->code . '_sort_order');

        $data['apitoken'] = $this->config->get('payment_' . $this->code . '_apitoken');
        $data['serviceid'] = $this->config->get('payment_' . $this->code . '_serviceid');
        $data['tokencode'] = $this->config->get('payment_' . $this->code . '_tokencode');
        $data['testmode'] = $this->config->get('payment_' . $this->code . '_testmode');

        $data['pay_tgu_list'] = (!empty($data['apitoken']) && !empty($data['serviceid']) && !empty($data['tokencode'])) ? $this->payConfig->getTguList() : [["domain" => "pay.nl", "status" => "ACTIVE"]];
        $data['pay_failover_gateway'] = $this->config->get('payment_' . $this->code . '_failover_gateway');
        $data['pay_custom_gateway'] = $this->config->get('payment_' . $this->code . '_custom_gateway');

        // Paymentmethods
        $gateways = [];
        try {
            $payPaymentMethods = $this->paymentMethods->getPaymentOptions();
            $sort_order = array();
            foreach ($payPaymentMethods as $key => $method) {
                $activeSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_active');
                $nameSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_name');
                $descriptionSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_description');
                $minAmountSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_minamount');
                $maxAmountSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_maxamount');
                $countriesSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_countries');
                $sortSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_sort');
                $image = 'https://static.pay.nl/' . $method->getImage();

                $gateways[$method->getId()] = [];

                $gateways[$method->getId()]['id'] = $method->getId();
                $gateways[$method->getId()]['active'] = (!empty($activeSetting)) ? $activeSetting : '0';
                $gateways[$method->getId()]['name'] = html_entity_decode((!empty($nameSetting)) ? $nameSetting : $method->getName());
                $gateways[$method->getId()]['description'] = html_entity_decode((!empty($descriptionSetting)) ? $descriptionSetting : $method->getDescription());
                $gateways[$method->getId()]['descriptionShort'] = mb_strimwidth($gateways[$method->getId()]['description'], 0, 120, '...');
                $gateways[$method->getId()]['minamount'] = (!empty($minAmountSetting)) ? $minAmountSetting : $method->getMinAmount();
                $gateways[$method->getId()]['maxamount'] = (!empty($maxAmountSetting)) ? $maxAmountSetting : $method->getMaxAmount();
                $gateways[$method->getId()]['countries'] = $countriesSetting;
                $gateways[$method->getId()]['sort'] = (!empty($sortSetting)) ? $sortSetting : $key;
                $gateways[$method->getId()]['image'] = $image;

                if ($this->paymentMethods->showIssuersField($method->getId())) {
                    $gateways[$method->getId()]['showIssuersField'] = true;
                    $gateways[$method->getId()]['showIssuers'] = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_issuers');
                }

                if ($this->paymentMethods->showBusinessFields($method->getId())) {
                    $gateways[$method->getId()]['showBusinessFields'] = true;
                    $gateways[$method->getId()]['showBOD'] = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_dob');
                    $gateways[$method->getId()]['showCOC'] = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_coc');
                    $gateways[$method->getId()]['showVAT'] = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_vat');
                }

                $sort_order[$method->getId()] = (!empty($sortSetting)) ? $sortSetting : $key;
            }

            uasort($gateways, function ($a, $b) {
                return (int) $a['sort'] - (int) $b['sort'];
            });
        } catch (\Exception $e) {
            $this->helper->log('Admin Paymentmethods: failed to load', ['error' => $e->getMessage()]);
        }

        $data['pay_paymentmethods'] = $gateways;

        $this->load->model('localisation/geo_zone');
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->load->model('localisation/country');
        $data['countries'] = $this->model_localisation_country->getCountries();

        // Settings
        $data['pay_screen_language'] = $this->config->get('payment_' . $this->code . '_screen_language');
        $data['pay_follow_payment'] = $this->config->get('payment_' . $this->code . '_follow_payment');
        $data['pay_logging'] = $this->config->get('payment_' . $this->code . '_logging');
        $data['pay_logging_download'] = $this->url->link('extension/paynl/payment/' . $this->code . '|downloadLogs', 'user_token=' . $this->session->data['user_token']);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/paynl/payment/' . $this->code, $data));
    }

    /**
     * @return void
     */
    public function save(): void
    {
        $this->load->language($this->route);

        if (((string) $this->request->server['REQUEST_METHOD'] === 'POST')) {
            $json = array();
            if (!$this->user->hasPermission('modify', $this->route)) {
                $json['error'] = $this->language->get('error_permission');
            }

            $tokencode = $this->request->post['payment_paynl_tokencode'];
            $apitoken = $this->request->post['payment_paynl_apitoken'];
            $serviceid = $this->request->post['payment_paynl_serviceid'];

            if (empty($tokencode)) {
                $json['error'] = $this->language->get('error_tokencode');
            }
            if (empty($apitoken)) {
                $json['error'] = $this->language->get('error_apitoken');
            }
            if (empty($serviceid)) {
                $json['error'] = $this->language->get('error_serviceid');
            }
            if (!$json) {
                if (!$this->helper->validateCredentials($tokencode, $apitoken, $serviceid)) {
                    $json['error'] = 'Failed to connect with Pay. - Please check your credentials.';
                }
            }

            if (!$json) {
                $this->load->model('setting/setting');
                $store_id = $this->request->get['store_id'] ?? 0;
                $this->model_setting_setting->editSetting('payment_' . $this->code, $this->request->post, (int) $store_id);
                $json['success'] = $this->language->get('text_success');
            }

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
    }

    /**
     * @return void
     */
    public function install(): void
    {
        if ($this->user->hasPermission('modify', 'extension/payment')) {
            $this->load->model($this->route);
            $this->load->model('setting/event');
            $this->model_extension_paynl_payment_paynl->install();
            $this->model_setting_event->addEvent(['code' => 'paynl_set_order_tab', 'description' => 'Set Pay. tab in admin order view page', 'trigger' => 'admin/view/sale/order_info/before', 'action' => 'extension/paynl/payment/paynl.order_info_before', 'status' => true, 'sort_order' => 1]);
            $this->model_setting_event->addEvent(['code' => 'paynl_set_order_tab_history', 'description' => 'Set Pay. tab in admin order view page', 'trigger' => 'admin/view/sale/order_info/before', 'action' => 'extension/paynl/payment/paynl.order_info_history_before', 'status' => true, 'sort_order' => 2]);
        }
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        if ($this->user->hasPermission('modify', 'extension/payment')) {
            $this->load->model($this->route);
            $this->load->model('setting/event');
            $this->model_extension_paynl_payment_paynl->uninstall();
            $this->model_setting_event->deleteEventByCode('paynl_set_order_tab');
            $this->model_setting_event->deleteEventByCode('paynl_set_order_tab_history');
        }
    }

    /**
     * @return void
     */
    public function downloadLogs()
    {
        if (file_exists(DIR_LOGS)) {
            if (class_exists('ZipArchive') && is_writable(DIR_LOGS)) {
                $file = DIR_LOGS . '/logs_opencart4.zip';
                $zipArchive = new \ZipArchive();
                $zipArchive->open($file, (\ZipArchive::CREATE | \ZipArchive::OVERWRITE));
                if (file_exists(DIR_LOGS . 'error.log')) {
                    $zipArchive->addFile(DIR_LOGS . 'error.log', 'error.log');
                }
                if (file_exists(DIR_LOGS . $this->code . '.log')) {
                    $zipArchive->addFile(DIR_LOGS . $this->code . '.log', $this->code . '.log');
                }
                $zipArchive->close();
            } else {
                $file = DIR_LOGS . $this->code . '.log';
            }
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                if (file_exists(DIR_LOGS . 'logs.zip')) {
                    unlink(DIR_LOGS . 'logs.zip');
                }
                exit;
            }
        }
    }

    public function order_info_history_before(&$route, &$data, &$template_code)
    {
        $payHistory = $this->payTransaction->getHistory($this->request->get['order_id']);
        if ($payHistory) {
            if ($data['tabs']) {
                foreach ($data['tabs'] as $tab_key => $tab) {
                    if ($tab['code'] == $this->code) {
                        unset($data['tabs'][$tab_key]);
                    }
                }
            }

            $data['pay_history'] = $payHistory;

            $this->load->language($this->route);
            $data['tabs'][] = [
                'code' => $this->code,
                'title' => $this->language->get('heading_title_history'),
                'content' => $this->load->view('extension/paynl/payment/history', $data),
            ];
        }
    }

    protected function getTemplate($route, $event_template)
    {

        if ($event_template) {
            return $event_template;
        }

        $template_file = DIR_TEMPLATE . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            return file_get_contents($template_file);
        }

        exit;
    }

    public function order_info_before(&$route, &$data, &$template_code)
    {

        $transaction = $this->payTransaction->getTransaction($this->request->get['order_id']);
        if ($transaction) {

            $dbTransaction = $transaction['db'];
            $payTransaction = $transaction['status'];
            $template = $this->getTemplate($route, $template_code);

            $payContent = '<link type="text/css" href="../extension/paynl/admin/view/stylesheet/order.css" rel="stylesheet" media="screen">';
            $payContent .= '<script type="text/javascript" src="../extension/paynl/admin/view/javascript/order.js"></script>';
            $payContent .= file_get_contents(DIR_EXTENSION . 'paynl/admin/view/template/payment/order.twig');
            $payContent .= '{{ footer }}';
            $template = str_replace('{{ footer }}', $payContent . json_encode($payTransaction), $template);

            $template_code = $template;

            $data['paynl_order_id'] = $this->request->get['order_id'];
            $data['paynl_transaction_id'] = $payTransaction->getOrderId();
            $data['paynl_status_code'] = $payTransaction->getStatusCode();
            $data['paynl_status_name'] = $payTransaction->getStatusName();
            $data['Paynl_payment_method'] = json_encode($payTransaction->getPaymentProfileId());
            $data['paynl_currency'] = $payTransaction->getAmountConvertedCurrency();
            $data['paynl_amount'] = number_format((float) $payTransaction->getAmountConverted(), 2, '.', '');
            $data['paynl_amount_captured'] = number_format((float) $payTransaction->getAmountPaid(), 2, '.', '');
            $data['paynl_amount_refunded'] = number_format((float) $payTransaction->getAmountRefunded(), 2, '.', '');
            $data['paynl_cart_amount'] = number_format((float) $dbTransaction['amount'], 2, '.', '');

            $data['show_refund'] = ($payTransaction->isPaid() || $payTransaction->isPartiallyRefunded());
            $data['show_capture'] = ($payTransaction->isAuthorized() || $payTransaction->getStatus()['code'] == 97);

            $this->load->language($this->route);

            if (($payTransaction->isPaid() || $payTransaction->isPartiallyRefunded())) {
                $data['ajax_url'] = $this->url->link('extension/paynl/payment/' . $this->code . '|refund', 'user_token=' . $this->session->data['user_token'] . '&transaction_id=' . $payTransaction->getOrderId());
                $data['paynl_amount_value'] = number_format((float) ($payTransaction->getAmountConverted() - $payTransaction->getAmountRefunded()), 2, '.', '');

                $data['text_button'] = $this->language->get('text_refund');
                $data['text_description'] = $this->language->get('text_refund_desc');
                $data['text_confirm'] = $this->language->get('text_refund_confirm');
            } else {
                $data['ajax_url'] = $this->url->link('extension/paynl/payment/' . $this->code . '|capture', 'user_token=' . $this->session->data['user_token'] . '&transaction_id=' . $payTransaction->getOrderId());
                $data['paynl_amount_value'] = number_format((float) ($payTransaction->getAmountConverted() - $payTransaction->getAmountPaid()), 2, '.', '');

                $data['text_button'] = $this->language->get('text_capture');
                $data['text_description'] = $this->language->get('text_capture_desc');
                $data['text_confirm'] = $this->language->get('text_capture_confirm');
            }

            $data['text_order_orderid'] = $this->language->get('text_order_orderid');
            $data['text_order_status'] = $this->language->get('text_order_status');
            $data['text_order_pm'] = $this->language->get('text_order_pm');
            $data['text_order_amount_cart'] = $this->language->get('text_order_amount_cart');
            $data['text_order_amount_pay'] = $this->language->get('text_order_amount_pay');
            $data['text_order_amount_refunded'] = $this->language->get('text_order_amount_refunded');
            $data['text_order_amount_captured'] = $this->language->get('text_order_amount_captured');

        }
        return null;

    }

    /**
     * @return void
     */
    public function refund()
    {
        $transactionId = $_REQUEST['transaction_id'] ?? null;
        $amount = $_REQUEST['amount'] ?? null;
        $currency = $_REQUEST['currency'] ?? null;
        try {
            $this->payTransaction->refund($transactionId, $amount, $currency);
            $json['success'] = 'Pay. refunded ' . $currency . ' ' . $amount . ' successfully!';
        } catch (\Exception $e) {
            $this->helper->log('Admin Refund: ' . $e->getMessage(), ['transactionId' => $transactionId, 'amount' => $amount, 'currency' => $currency]);
            $json['error'] = 'Pay. couldn\'t refund, please try again later.';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * @return void
     */
    public function capture()
    {
        $transactionId = $_REQUEST['transaction_id'] ?? null;
        $amount = $_REQUEST['amount'] ?? null;
        $currency = $_REQUEST['currency'] ?? null;
        try {
            $this->payTransaction->capture($transactionId, $amount);
            $json['success'] = 'Pay. captured ' . $currency . ' ' . $amount . ' successfully!';
        } catch (\Exception $e) {
            $this->helper->log('Admin Refund: ' . $e->getMessage(), ['transactionId' => $transactionId, 'amount' => $amount, 'currency' => $currency]);
            $json['error'] = 'Pay. couldn\'t capture, please try again later.';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
