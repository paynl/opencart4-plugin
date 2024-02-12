<?php

namespace Opencart\Admin\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayHelper;

class Paynl extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $helper;

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
        $data['breadcrumbs'][] = ['text' => $this->language->get('text_extension'), 'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment')];
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

        // Paymentmethods
        $gateways = [];   
        try {           
            $payPaymentMethods = $this->helper->getPaymentOptions();
            $sort_order = array();
            foreach ($payPaymentMethods as $key => $method) {     
                $activeSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_active');      
                $nameSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_name');
                $descriptionSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_description');
                $minAmountSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_minamount');
                $maxAmountSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_maxamount');
                $countriesSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_countries');
                $sortSetting =  $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_sort');
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
                
                $sort_order[$method->getId()] = (!empty($sortSetting)) ? $sortSetting : $key;       
            }              
            
            uasort($gateways, function($a,$b){return (int)$a['sort']-(int)$b['sort'];});
         
        } catch (\Exception $e) {
            
        }     

        $data['pay_paymentmethods'] = $gateways;        

        $this->load->model('localisation/geo_zone');
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
     
        $this->load->model('localisation/country');
		$data['countries'] =  $this->model_localisation_country->getCountries();


        // Settings
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
            $this->model_extension_paynl_payment_paynl->install();
        }
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        if ($this->user->hasPermission('modify', 'extension/payment')) {
            $this->load->model($this->route);
            $this->model_extension_paynl_payment_paynl->uninstall();
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
}
