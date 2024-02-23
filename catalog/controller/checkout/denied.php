<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Checkout;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';
use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;

class Denied extends \Opencart\System\Engine\Controller
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
    public function index()
    {
        $this->load->language('checkout/failure');
        $this->load->language($this->route);

        $this->document->setTitle($this->language->get('denied_heading_title'));

        $data['heading_title'] = $this->language->get('denied_heading_title');

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'language=' . $this->config->get('config_language')),
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_basket'),
            'href' => $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language')),
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_checkout'),
            'href' => $this->url->link('checkout/checkout', 'language=' . $this->config->get('config_language')),
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_denied'),
            'href' => $this->url->link('extension/paynl/checkout/failure', 'language=' . $this->config->get('config_language')),
        ];

        $data['text_message'] = $this->language->get('text_denied_message');

        $data['continue'] = $this->url->link('checkout/checkout', 'language=' . $this->config->get('config_language'));

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('common/success', $data));
    }

}
