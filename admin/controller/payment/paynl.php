<?php

namespace Opencart\Admin\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Helper.php';

use Opencart\System\Library\PayHelper;

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
     * @return void
     */
    public function index(): void
    {       
        $this->load->language($this->route);

        $this->document->setTitle($this->language->get('heading_title_' . $this->code));

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = ['text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])];
        $data['breadcrumbs'][] = ['text' => $this->language->get('text_extension'), 'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment')];
        $data['breadcrumbs'][] = ['text' => $this->language->get('heading_title'), 'href' => $this->url->link($this->route, 'user_token=' . $this->session->data['user_token'])];

        $data['save'] = $this->url->link('extension/paynl/payment/' . $this->code . '|save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment');

        $data['payment_' . $this->code . '_status'] = $this->config->get('payment_' . $this->code . '_status');
        $data['payment_' . $this->code . '_sort_order'] = $this->config->get('payment_' . $this->code . '_sort_order');

        $data['apitoken'] = $this->config->get('payment_' . $this->code . '_apitoken');
        $data['serviceid'] = $this->config->get('payment_' . $this->code . '_serviceid');
        $data['tokencode'] = $this->config->get('payment_' . $this->code . '_tokencode');
        $data['testmode'] = $this->config->get('payment_' . $this->code . '_testmode');

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
            if (!$json) {
                $this->load->model('setting/setting');
                $store_id = $this->request->get['store_id'] ?? 0;
                $this->model_setting_setting->editSetting('payment_' . $this->code, $this->request->post, (int) $store_id);
                $json['success'] = $this->language->get('text_success');
            } else {
                $error_keys = $this->getErrorsKeysAndTypes();
                foreach ($error_keys as $key => $type) {
                    if (isset($this->error[$key])) {
                        $json['error'][$key] = $this->error[$key];
                    }
                    if (!isset($this->error[$key]) && ($type === 'string')) {
                        $json['error'][$key] = '';
                    }
                    if (!isset($this->error[$key]) && ($type === 'array')) {
                        $json['error'][$key] = array();
                    }
                }
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
            $this->load->model('extension/paynl/payment/' . $this->code);
            $mdl = 'model_extension_paynl_payment_' . $this->code;
            $this->$mdl->install();
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
}
