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
	 * @param bool $ignoreChecks
	 * @return array
	 */
	public function getMethods(array $address, bool $ignoreChecks = false): array
	{
		$option_data = [];
		try {
			$payPaymentMethods = json_decode($this->config->get('payment_' . $this->code . '_gateways'));

			if (!empty($payPaymentMethods) && is_object($payPaymentMethods)) {

				foreach ($payPaymentMethods as $key => $method) {

					if ($this->checkPaymentMethod($method) || $ignoreChecks) {

						$nameSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_name');
						$nameTranslatedSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_name_' . $this->config->get('config_language'));
						$descriptionSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_description');
						$descriptionTranslatedSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_description_' . $this->config->get('config_language'));
						$sortSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_sort');
						$sort = (!empty($sortSetting)) ? $sortSetting : $key;

						$name = (!empty($nameSetting)) ? $nameSetting : $method->name;
						$description = (!empty($descriptionSetting)) ? $descriptionSetting : $method->description;

						$option_data[$sort] = [
							'code' => $this->code . '.' . $sort,
							'paymentOptionId' => $method->id,
							'name' => (!empty($nameTranslatedSetting)) ? $nameTranslatedSetting : $name,
							'description' => (!empty($descriptionTranslatedSetting)) ? $descriptionTranslatedSetting : $description,
							'sort' => (!empty($sortSetting)) ? $sortSetting : $key,
							'issuers' => $method->options ?? null,
							'showIssuers' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_show_issuers'),
							'showDOB' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_show_dob'),
							'showCOC' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_show_coc'),
							'showVAT' => $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_show_vat'),
						];
					}
				}
			}
			uasort($option_data, function ($a, $b) {
				return (int)$a['sort'] - (int)$b['sort'];
			});
		} catch (\Exception $e) {
			$this->helper->logCritical('Paymentmethods: failed to load', ['error' => $e->getMessage()]);
		}

		if (!empty($option_data)) {
			return array(
				'code' => $this->code,
				'name' => 'Pay. Payments',
				'title' => "Pay. Payments",
				'option' => $option_data,
				'sort_order' => $this->config->get('payment_' . $this->code . '_sort_order'),
			);
		}
		return [];
	}

    /**
     * @param string $method
     * @return boolean
     */
    public function checkPaymentMethod($method)
    {
        $active = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_active');

        if ($active !== '1') {
            return false;
        }      

        $countryId = $this->getCountryId();
        $countriesSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_countries');
        if (!empty($countriesSetting)) {
            if (!in_array($countryId, $countriesSetting)) {
                return false;
            }
        }

        $shippingMethod = $this->session->data['shipping_method'] ?? null;
        $allowedShippingSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_allowed_shipping');
        if (!empty($allowedShippingSetting) && !empty($shippingMethod)) {
            $allowedShippingCodes = [];
            foreach ($allowedShippingSetting as $shippingSetting) {
                $allowedShippingCodes[] = $this->getShippingCodeByCode($shippingSetting);
            }
            if (!in_array($shippingMethod['code'], $allowedShippingCodes)) {
                return false;
            }
        }

        $total = $this->cart->getTotal();
        if (!empty($shippingMethod)) {
            $total += (float) $shippingMethod['cost'];
            $taxes = $this->tax->getRates($shippingMethod['cost'], $shippingMethod['tax_class_id']);
            foreach ($taxes as $taxInfo) {
                $total += $taxInfo['amount'];
            }
        }        
        $total = $this->currency->convert($total, $this->config->get('config_currency'), $this->session->data['currency']); 
        $minAmountSetting = (float) $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_minamount');
        $maxAmountSetting = (float) $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_maxamount');
        if ($total < $minAmountSetting || $total > $maxAmountSetting) {
            return false;
        }      

        $company = $this->getCompany();
        $customerTypeSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_customer_type');
        if (!empty($customerTypeSetting)) {
            if ($customerTypeSetting == 1 && !empty($company)) {
                return false;
            } elseif ($customerTypeSetting == 2 && empty($company)) {
                return false;
            }
        }

        $geozoneId = $this->getGeoZoneId();
        $geozoneSetting = $this->config->get('payment_' . $this->code . '_paymentmethod_' . $method->id . '_geozone');
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

    /**
     * @return string
     */
    public function getCompany()
    {
        $country = '';
        if (!empty($this->session->data['payment_address'])) {
            $country = $this->session->data['payment_address']['company'] ?? '';
        } elseif (!empty($this->session->data['shipping_address'])) {
            $country = $this->session->data['shipping_address']['company'] ?? '';
        }
        return $country;
    }

    /**
     * @param string $shippingCode
     * @return string
     */
    public function getShippingCodeByCode($shippingCode)
    {
        $this->load->model('setting/extension');
        $results = $this->model_setting_extension->getExtensionsByType('shipping');
        $code = $shippingCode;
        foreach ($results as $result) {
            if ($result['code'] == $shippingCode) {
                if ($this->config->get('shipping_' . $result['code'] . '_status')) {
                    $this->load->model('extension/' . $result['extension'] . '/shipping/' . $result['code']);
                    if (is_callable([$this->{'model_extension_' . $result['extension'] . '_shipping_' . $result['code']}, 'getQuote'])) {
                        $quote = $this->{'model_extension_' . $result['extension'] . '_shipping_' . $result['code']}->getQuote($this->session->data['payment_address'] ?? $this->session->data['shipping_address']);
                        if ($quote) {
                            $code = $quote['quote'][$shippingCode]['code'];
                        }
                    }
                }
            }
        }
        return $code;
    }
}
