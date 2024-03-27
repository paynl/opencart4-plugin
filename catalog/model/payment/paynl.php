<?php

namespace Opencart\Catalog\Model\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayPaymentMethods;

class Paynl extends \Opencart\System\Engine\Model
{
    private $code;
    private $route;
    private $payConfig;
    private $helper;
    private $paymentMethods;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->payConfig = new PayConfig($this);
        $this->helper = new PayHelper($this);
        $this->paymentMethods = new PayPaymentMethods($this);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
        parent::__construct($registry);
    }

    /**
     * @param array $address
     * @return array
     */
    public function getMethod(array $address): array
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
     * @return array
     */
    public function getMethods(array $address, $ignoreChecks = false): array
    {
        $option_data = [];
        try {
            $payPaymentMethods = $this->paymentMethods->getPaymentOptions();
            foreach ($payPaymentMethods as $key => $method) {
                if ($this->checkPaymentMethod($method) || $ignoreChecks) {
                    $nameSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_name');
                    $nameTranslatedSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_name_' . $this->config->get('config_language'));
                    $descriptionSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_description');
                    $descriptionTranslatedSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_description_' . $this->config->get('config_language'));
                    $sortSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_sort');
                    $sort = (!empty($sortSetting)) ? $sortSetting : $key;

                    $name = (!empty($nameSetting)) ? $nameSetting : $method->getName();
                    $description = (!empty($descriptionSetting)) ? $descriptionSetting : $method->getDescription();

                    $option_data[$sort] = [
                        'code' => $this->code . '.' . $sort,
                        'paymentOptionId' => $method->getId(),
                        'name' => (!empty($nameTranslatedSetting)) ? $nameTranslatedSetting : $name,
                        'description' => (!empty($descriptionTranslatedSetting)) ? $descriptionTranslatedSetting : $description,
                        'sort' => (!empty($sortSetting)) ? $sortSetting : $key,
                        'issuers' => $method->getOptions() ?? null,
                        'showIssuers' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_issuers'),
                        'showDOB' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_dob'),
                        'showCOC' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_coc'),
                        'showVAT' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_show_vat'),
                    ];
                }
            }
            uasort($option_data, function ($a, $b) {
                return (int) $a['sort'] - (int) $b['sort'];
            });
        } catch (\Exception $e) {
            $this->helper->logCritical('Paymentmethods: failed to load', ['error' => $e->getMessage()]);
        }

        if (!empty($option_data)) {
            $methods_data = array(
                'code' => $this->code,
                'name' => 'Pay. Payments',
                'title' => "Pay. Payments",
                'option' => $option_data,
                'sort_order' => $this->config->get('payment_' . $this->code . '_sort_order'),
            );
            return $methods_data;
        }
        return [];
    }

    /**
     * @param string $method
     * @return boolean
     */
    public function checkPaymentMethod($method)
    {

        $active = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_active');
        if ($active !== '1') {
            return false;
        }

        $total = $this->cart->getSubTotal();
        $minAmountSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_minamount');
        $maxAmountSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_maxamount');
        if ($total < $minAmountSetting || $total > $maxAmountSetting) {
            return false;
        }

        $countryId = $this->getCountryId();
        $countriesSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_countries');
        if (!empty($countriesSetting)) {
            if (!in_array($countryId, $countriesSetting)) {
                return false;
            }
        }

        $geozoneId = $this->getGeoZoneId();
        $geozoneSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->getId() . '_geozone');
        if (!empty($geozoneSetting) && $geozoneSetting != $geozoneId) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getGeoZoneId()
    {
        $geozone = '';
        if (!empty($this->session->data['payment_address'])) {
            $geozone = $this->session->data['payment_address']['zone_id'] ?? '';
        } elseif (!empty($this->session->data['shipping_address'])) {
            $geozone = $this->session->data['shipping_address']['zone_id'] ?? '';
        }
        return $geozone;
    }

    /**
     * @return string
     */
    public function getCountryId()
    {
        $country = '';
        if (!empty($this->session->data['payment_address'])) {
            $country = $this->session->data['payment_address']['country_id'] ?? '';
        } elseif (!empty($this->session->data['shipping_address'])) {
            $country = $this->session->data['shipping_address']['country_id'] ?? '';
        }
        return $country;
    }
}
