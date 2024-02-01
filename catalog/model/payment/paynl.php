<?php

namespace Opencart\Catalog\Model\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Engine\Model;
use Opencart\System\Library\Helper;
use Opencart\System\Library\PayHelper;

class Paynl extends \Opencart\System\Engine\Model
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
     * @param array $address
     * @param float $total
     * @return array $method_data
     */
    public function getMethod(array $address = array(), float $total = 0.0): array
    {
        $method_data = [
            'code' => $this->code,
            'name' => 'Pay.',
            'title' => "Pay.",
            'sort_order' => $this->config->get('payment_' . $this->code . '_sort_order'),
        ];
        return $method_data;
    }

    /**
     * @param array $address
     * @param float $total
     * @return array $method_data
     */
    public function getMethods(array $address = array(), float $total = 0.0): array
    {
        $option_data = [];
        try {
            $payPaymentMethods = $this->helper->getPaymentOptions();
            foreach ($payPaymentMethods as $key => $method) {
                $option_data[$method->getId()] = [
                    'code' => $this->code . '.' . $method->getId(),
                    'paymentOptionId' => $method->getId(),
                    'name' => $method->getName(),
                    'description' => $method->getDescription(),
                ];
            }
        } catch (\Exception $e) {
            $option_data['generic'] = [
                'code' => $this->code . '.generic',
                'paymentOptionId' => 0,
                'name' => 'Pay.',
                'description' => 'Pay.',
            ];
        }

        $methods_data = array(
            'code' => $this->code,
            'name' => 'Pay.',
            'title' => "Pay.",
            'option' => $option_data,
            'sort_order' => $this->config->get('payment_' . $this->code . '_sort_order'),
        );
        return $methods_data;
    }
}
