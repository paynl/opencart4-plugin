<?php

namespace Opencart\Admin\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Config;
use Document;
use Language;
use Loader;
use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayTransaction;
use Opencart\System\Library\PayPaymentMethods;
use Registry;
use Response;
use Session;
use Request;
use Url;

/**
 * @property Document $document
 * @property Language $language
 * @property Loader $load
 * @property Url $url
 * @property Session $session
 * @property Response $response
 * @property Request $request
 * @property Config $config
 * @property Registry $registry
 *
 * @property \Opencart\Admin\Model\Localisation\Language $model_localisation_language
 * @property \Opencart\Admin\Model\Localisation\GeoZone $model_localisation_geo_zone
 * @property \Opencart\Admin\Model\Localisation\Country $model_localisation_country
 *
 */
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

		$data['payment_' . $this->code . '_status'] = $this->config->get('payment_' . $this->code . '_status');
		$data['payment_' . $this->code . '_sort_order'] = $this->config->get('payment_' . $this->code . '_sort_order');

		$data['apitoken'] = $this->config->get('payment_' . $this->code . '_apitoken');
		$data['serviceid'] = $this->config->get('payment_' . $this->code . '_serviceid');
		$data['tokencode'] = $this->config->get('payment_' . $this->code . '_tokencode');
		$data['testmode'] = $this->config->get('payment_' . $this->code . '_testmode');
		$data['pay_checkversion_url'] = $this->url->link('extension/paynl/payment/' . $this->code . '|version_check', 'user_token=' . $this->session->data['user_token']);
		$data['pay_current_version'] = $this->payConfig->getVersion();

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['pay_tgu_list'] = (!empty($data['apitoken']) && !empty($data['serviceid']) && !empty($data['tokencode'])) ? $this->payConfig->getTguList() : [["domain" => "pay.nl", "status" => "ACTIVE"]];
		$data['pay_failover_gateway'] = $this->config->get('payment_' . $this->code . '_failover_gateway');
		$data['pay_custom_gateway'] = $this->config->get('payment_' . $this->code . '_custom_gateway');

		$gateways = $this->getGateways($data['apitoken'], $data['serviceid'], $data['tokencode']);

		$data['pay_paymentmethods'] = $gateways;

		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();

		$data['shipping_methods'] = $this->getShippingMethods();

		# Settings
		$data['pay_order_description'] = $this->config->get('payment_' . $this->code . '_order_description');
		$data['pay_test_ip_address'] = $this->config->get('payment_' . $this->code . '_test_ip_address');
		$data['current_ip'] = $_SERVER["REMOTE_ADDR"];
		$data['pay_screen_language'] = $this->config->get('payment_' . $this->code . '_screen_language');
		$data['pay_follow_payment'] = $this->config->get('payment_' . $this->code . '_follow_payment');
		$data['pay_logging'] = $this->config->get('payment_' . $this->code . '_logging');
		$data['pay_logging_download'] = $this->url->link('extension/paynl/payment/' . $this->code . '|downloadLogs', 'user_token=' . $this->session->data['user_token']);
		$data['pay_logging_options'] = [
			$this->helper::LOG_ALL => $this->language->get('text_logging_all'),
			$this->helper::LOG_CRITICAL_NOTICE => $this->language->get('text_critical_notice'),
			$this->helper::LOG_ONLY_CRITICAL => $this->language->get('text_critical_only'),
			$this->helper::LOG_NONE => $this->language->get('text_no_logging')
		];
		$data['pay_custom_exchange_url'] = $this->config->get('payment_' . $this->code . '_custom_exchange_url');
		$data['pay_auto_capture'] = $this->config->get('payment_' . $this->code . '_auto_capture');
		$data['pay_auto_void'] = $this->config->get('payment_' . $this->code . '_auto_void');

		# Suggestions
		$data['pay_suggestions_url'] = $this->url->link('extension/paynl/payment/' . $this->code . '|suggestions', 'user_token=' . $this->session->data['user_token']);
		$data['pay_plugin_version'] = $this->payConfig->getObject();

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

		if (((string)$this->request->server['REQUEST_METHOD'] === 'POST')) {
			$json = array();
			if (!$this->user->hasPermission('modify', $this->route)) {
				$json['error'] = $this->language->get('error_permission');
			}

			$tokencode = $this->request->post['payment_paynl_tokencode'];
			$apitoken = $this->request->post['payment_paynl_apitoken'];
			$serviceId = $this->request->post['payment_paynl_serviceid'];

			if (empty($tokencode)) {
				$json['error'] = $this->language->get('error_tokencode');
			}
			if (empty($apitoken)) {
				$json['error'] = $this->language->get('error_apitoken');
			}
			if (empty($serviceId)) {
				$json['error'] = $this->language->get('error_serviceid');
			}
			if (!$json) {
				if (!$this->helper->validateCredentials($tokencode, $apitoken, $serviceId)) {
					$json['error'] = 'Failed to connect with Pay. - Please check your credentials.';
				}
			}

			if (!$json) {
				$this->load->model('setting/setting');
				$store_id = $this->request->get['store_id'] ?? 0;
				$data = $this->request->post;
				$data['payment_paynl_gateways'] = json_encode($this->getGateways($apitoken, $serviceId, $tokencode));
				$this->model_setting_setting->editSetting('payment_' . $this->code, $data, (int)$store_id);
				$json['success'] = $this->language->get('text_success');
			}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}

    /**
     * @param $apitoken
     * @param $serviceId
     * @param $tokencode
     * @return array|void
     */
    public function getGateways($apitoken, $serviceId, $tokencode)
    {
		$gateways = [];

		if (!empty($apitoken) && !empty($serviceId) && !empty($tokencode)) {

			try {
				$payPaymentMethods = $this->paymentMethods->getPaymentOptions();
				foreach ($payPaymentMethods as $key => $method) {
					$activeSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_active');
					$nameSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_name');
					$descriptionSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_description');
					$minAmountSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_minamount');
					$maxAmountSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_maxamount');
					$countriesSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_countries');
					$sortSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_sort');
                    
                    $this->saveLogo($method->getImage());
					$image = $this->getLogo($method->getImage());

                    $gateways[$method->getId()] = [];

					$gateways[$method->getId()]['id'] = $method->getId();
					$gateways[$method->getId()]['active'] = (!empty($activeSetting)) ? $activeSetting : '0';
					$gateways[$method->getId()]['name'] = html_entity_decode((!empty($nameSetting)) ? $nameSetting : $method->getName());
					$gateways[$method->getId()]['description'] = html_entity_decode((!empty($descriptionSetting)) ? $descriptionSetting : $method->getDescription());
					$gateways[$method->getId()]['descriptionShort'] = mb_strimwidth($gateways[$method->getId()]['description'], 0, 120, '...');
					$gateways[$method->getId()]['minamount'] = (!empty($minAmountSetting)) ? $minAmountSetting : (float) $method->getMinAmount() / 100;
					$gateways[$method->getId()]['maxamount'] = (!empty($maxAmountSetting)) ? $maxAmountSetting : (float) $method->getMaxAmount() / 100;
					$gateways[$method->getId()]['countries'] = $countriesSetting;
					$shippingSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_allowed_shipping');
					$customerTypeSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_customer_type');
					$gateways[$method->getId()]['allowed_shipping'] = $shippingSetting;
					$gateways[$method->getId()]['customer_type'] = $customerTypeSetting;
					$gateways[$method->getId()]['sort'] = (!empty($sortSetting)) ? $sortSetting : $key;
					$gateways[$method->getId()]['image'] = $image;

					try {
						$gateways[$method->getId()]['options'] = $method->getOptions();
					} catch (\Throwable $th) {
						$gateways[$method->getId()]['options'] = null;
					}

					$gateways[$method->getId()]['name_translations'] = [];
					$gateways[$method->getId()]['description_translations'] = [];

					foreach ($this->model_localisation_language->getLanguages() as $language) {
						$gateways[$method->getId()]['name_translations'][$language['code']] = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_name_' . $language['code']);
						$gateways[$method->getId()]['description_translations'][$language['code']] = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_description_' . $language['code']);
					}

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
				}

				uasort($gateways, function ($a, $b) {
					return (int)$a['sort'] - (int)$b['sort'];
				});
			} catch (\Exception $e) {
				$this->helper->logCritical('Admin Payment methods: failed to load', ['error' => $e->getMessage()]);
			}

			return $gateways;
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
            $this->model_setting_event->addEvent(['code' => 'paynl_auto_functions', 'description' => 'Pay. Automated functionalities', 'trigger' => 'catalog/model/checkout/order.addHistory/after', 'action' => 'extension/paynl/payment/webhooks.onOrderStatusChange', 'status' => true, 'sort_order' => 3]);
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
            $this->model_setting_event->deleteEventByCode('paynl_auto_functions');
        }
    }

    /**
     * @return void
     */
    public function downloadLogs(): void
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

    /**
     * @param string $route
     * @param array $data
     * @param string $template_code
     * @return void
     */
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

    /**
     * @param string $route
     * @param string $event_template
     * @return mixed
     */
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

    /**
     * @param $route
     * @param $data
     * @param $template_code
     * @return null
     * @throws \Exception
     */
    public function order_info_before(&$route, &$data, &$template_code)
    {

        $transaction = $this->payTransaction->getTransaction($this->request->get['order_id']);
        if ($transaction) {

            $dbTransaction = $transaction['db'];
            $payOrder = $transaction['orderStatus'];

            if (empty($payOrder) || ($payOrder instanceof \PayNL\Sdk\Model\Pay\PayOrder && ($payOrder->isPaid() || $payOrder->isAuthorized()))) {
                $payGmsOrder = $this->payTransaction->getTransactionStatus($dbTransaction['transaction_id']);
                if ($payGmsOrder->isRefunded() || empty($payOrder)) {
                    $payOrder = $payGmsOrder;
                }
                try {
                    $alreadyRefunded = $payGmsOrder->getAmountRefunded();
                } catch (\Throwable $th) {
                    $alreadyRefunded = 0;
                }
            }

            $payOrderId = $dbTransaction['transaction_id'];
            $payTransactionId = $payOrder->getOrderId();
            $status = $payOrder->getStatusName();

            $template = $this->getTemplate($route, $template_code);

            $payContent = '<link type="text/css" href="../extension/paynl/admin/view/stylesheet/order.css" rel="stylesheet" media="screen">';
            $payContent .= '<script type="text/javascript" src="../extension/paynl/admin/view/javascript/order.js"></script>';
            $payContent .= file_get_contents(DIR_EXTENSION . 'paynl/admin/view/template/payment/order.twig');
            $payContent .= '{{ footer }}';
            $template = str_replace('{{ footer }}', $payContent, $template);

            $template_code = $template;

            if (!empty($this->config->get('payment_' . $this->code . '_paymentmethod_' . $payOrder->getPaymentMethod() . '_name'))) {
                $paymentMethodName = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $payOrder->getPaymentMethod() . '_name');
            } elseif ($payOrder->getPaymentMethod() == 613) {
                $paymentMethodName = 'Sandbox';
            }

            $data['paynl_order_id'] = $payOrderId;
            $data['paynl_transaction_id'] = $payTransactionId;
            $data['paynl_status_name'] = $status;
            $data['Paynl_payment_method_name'] = $paymentMethodName ?? '';
            $data['paynl_currency'] = $payOrder->getCurrency();
            $data['paynl_amount'] = number_format((float) $payOrder->getAmount(), 2, '.', '');
            $data['paynl_cart_amount'] = number_format((float) $dbTransaction['amount'], 2, '.', '');

            $data['show_refund'] = ($payOrder->isPaid() || $payOrder->isRefundedPartial());
            $data['show_capture'] = ($payOrder->isAuthorized() || $payOrder->getStatus()['code'] == 97);

            $this->load->language($this->route);

            if ($payOrder->isPaid() || $payOrder->isRefundedPartial() || $payOrder->isRefunded()) {

                $data['ajax_url'] = $this->url->link('extension/paynl/payment/' . $this->code . '|refund', 'user_token=' . $this->session->data['user_token'] . '&transaction_id=' . $payTransactionId);
                $data['paynl_amount_value'] = number_format((float) ($payOrder->getAmount()), 2, '.', '');
                if ($payOrder->getCurrency() == 'EUR') {
                    $data['paynl_amount_refunded'] = $alreadyRefunded;
                    $data['paynl_amount'] = number_format((float) $payOrder->getAmount() - $alreadyRefunded, 2, '.', '');
                    $data['paynl_amount_value'] = number_format((float) ($payOrder->getAmount() - $alreadyRefunded), 2, '.', '');
                }
                $data['text_button'] = $this->language->get('text_refund');
                $data['text_description'] = $this->language->get('text_refund_desc');
                $data['text_confirm'] = $this->language->get('text_refund_confirm');
            } else {
                $data['paynl_amount_captured'] = number_format((float) ($payOrder->getCapturedAmount()->getValue() / 100), 2, '.', '');

                $data['ajax_url'] = $this->url->link('extension/paynl/payment/' . $this->code . '|capture', 'user_token=' . $this->session->data['user_token'] . '&transaction_id=' . $payTransactionId);
                $data['ajax_url_void'] = $this->url->link('extension/paynl/payment/' . $this->code . '|void', 'user_token=' . $this->session->data['user_token'] . '&transaction_id=' . $payTransactionId);

                $data['paynl_amount_value'] = number_format((float) ($data['paynl_amount'] - $data['paynl_amount_captured']), 2, '.', '');

                $data['text_button'] = $this->language->get('text_capture');
                $data['text_description'] = $this->language->get('text_capture_desc');
                $data['text_confirm'] = $this->language->get('text_capture_confirm');

                $data['show_void'] = (($payOrder->isAuthorized() || $payOrder->getStatus()['code'] == 97) && $data['paynl_amount_captured'] == 0);

                $data['text_button_void'] = $this->language->get('text_void');
                $data['text_confirm_void'] = $this->language->get('text_void_confirm');
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
        $transactionId = $this->request->get['transaction_id'] ?? null;
        $amount = $this->request->get['amount'] ?? null;
        $currency = $this->request->get['currency'] ?? null;
        try {
            $this->payTransaction->refund($transactionId, $amount, $currency);
            $json['success'] = 'Pay. refunded ' . $currency . ' ' . $amount . ' successfully!';
        } catch (\Exception $e) {
            $this->helper->logCritical('Admin Refund: ' . $e->getMessage(), ['transactionId' => $transactionId, 'amount' => $amount, 'currency' => $currency]);
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
        $transactionId = $this->request->get['transaction_id'] ?? null;
        $amount = $this->request->get['amount'] ?? null;
        $currency = $this->request->get['currency'] ?? null;
        try {
            $this->payTransaction->capture($transactionId, $amount);
            $json['success'] = 'Pay. captured ' . $currency . ' ' . $amount . ' successfully!';
        } catch (\Exception $e) {
            $this->helper->logCritical('Admin Capture: ' . $e->getMessage(), ['transactionId' => $transactionId, 'amount' => $amount, 'currency' => $currency]);
            $json['error'] = 'Pay. couldn\'t capture, please try again later.';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * @return void
     */
    public function void()
    {
        $transactionId = $this->request->get['transaction_id'] ?? null;
        $amount = $this->request->get['amount'] ?? null;
        $currency = $this->request->get['currency'] ?? null;
        try {
            $this->payTransaction->void($transactionId, $amount);
            $json['success'] = 'Pay. voided ' . $currency . ' ' . $amount . ' successfully!';
        } catch (\Exception $e) {
            $this->helper->logCritical('Admin Void: ' . $e->getMessage(), ['transactionId' => $transactionId, 'amount' => $amount, 'currency' => $currency]);
            $json['error'] = 'Pay. couldn\'t void, please try again later.';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * @return void
     */
    public function version_check()
    {
        $result = false;
        $url = 'https://api.github.com/repos/paynl/opencart3-plugin/releases';
        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'User-Agent:' . $_SERVER['HTTP_USER_AGENT']
            )
        );

        $context = stream_context_create($options);

        try {
            $output = file_get_contents($url, false, $context);
            $json = json_decode($output);

            $response = '';
            if (isset($json[0])) {
                $response = $json[0]->tag_name;
                $result = true;
            }
        } catch (\Exception $e) {
            $response = '';
        }
        header('Content-Type: application/json;charset=UTF-8');
        die(json_encode(['success' => $result, 'version' => $response]));
    }

    /**
     * @return void
     */
    public function suggestions()
    {
        try {
            $suggestions_form_message = $this->request->post['message'];
            $suggestions_form_email = $this->request->post['email'];
            $suggestions_form_plugin_version = $this->request->post['pluginverison'];

            $pluginVersion = strtolower($suggestions_form_plugin_version);
            $phpVersion = phpversion();
            $message = isset($suggestions_form_message) ? nl2br($suggestions_form_message) : null;

            $email = null;
            if (!empty($suggestions_form_email)) {
                $email = '<b>Client Email:</b><span style="width: 100%;box-sizing: border-box; display:inline-block; padding: 10px; border:1px solid #cccccc;">' . strtolower($suggestions_form_email) . '</span><br/><br/>'; // phpcs:ignore
            }

            if (empty($message)) {
                throw new Exception('Empty message');
            }

            $to = 'webshop@pay.nl';
            $subject = 'Feature Request Opencart4';
            $body = '
            <table role="presentation" style="margin-top:50px; margin-bottom:50px; width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                <tr>
                    <td align="center" style="padding:0;">
                        <table role="presentation" style="width:600px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                            <tr>
                                <td style="padding:25px;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Pay. Suggestion</h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        Pay. object: ' . $pluginVersion . ' | ' . $phpVersion . '.<br/><br/>
                                        ' . $email . '
                                        <b>Message:</b>
                                        <span style="width: 100%;box-sizing: border-box; display:inline-block; padding: 10px; border:1px solid #cccccc;">' . $message . '</span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            ';
            $headers = "Content-Type: text/html; charset=UTF-8";
            mail($to, $subject, $body, $headers);
            $result = true;
        } catch (Exception $e) {
            $result = false;
        }
        header('Content-Type: application/json;charset=UTF-8');
        die(json_encode(['success' => $result]));
    }

    /**
     * @return array
     */
    public function getShippingMethods()
    {
        $method_data = [];
        $this->load->model('setting/extension');
        $results = $this->model_setting_extension->getExtensionsByType('shipping');
        foreach ($results as $result) {
            $this->load->language('extension/' . $result['extension'] . '/shipping/' . $result['code'], $result['code']);
            $result['name'] = ($this->language->get($result['code'] . '_heading_title')) ?? $result['code'];
            $method_data[$result['code']] = $result;
        }
        return $method_data;
    }

    /**
     * Get logo
     *
     * @param $imagePath   
     */
    public function getLogo($imagePath)
    {
        $path = '/extension/paynl/admin/view/image/cache' . $imagePath;
        if (file_exists(DIR_OPENCART . $path)) {
            return $path;
        } else {
            return 'https://static.pay.nl' . $imagePath;
        }
    }

    /**
     * Save logo
     *  
     * @param $imagePath   
     */
    public function saveLogo($imagePath)
    {
        $path = DIR_OPENCART . 'extension/paynl/admin/view/image/cache';
        if (file_exists($path . $imagePath) && (time() - filemtime($path . $imagePath) < 86400)) {
            return;
        }
        $imageUrl = 'https://static.pay.nl/' . $imagePath;
        $this->downloadImage($imageUrl, $path, $imagePath);
    }

    /**
     * Download image from url
     *
     * @param string $url
     * @param string $path
     * @param string $imagePath
     * @return bool
     */
    public function downloadImage($url, $path, $image)
    {
        try {
            $data = @file_get_contents($url);
            if ($data === false) {
                return false;
            }
            $imagePath = explode('/', $image)[1];
            if (!is_dir($path . '/' . $imagePath . '/')) {
                mkdir($path . '/' . $imagePath . '/', 0755, true);
            }
            $result = file_put_contents($path . $image, $data);
        } catch (\Throwable $th) {
            return false;
        }
        return $result;
    }
}
