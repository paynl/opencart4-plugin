<?php

// Heading
$_['heading_title'] = 'Pay. Payments for Opencart 4';
$_['heading_title_history'] = ' Pay. Payments';
$_['heading_title_paynl'] = 'Pay. Payments for Opencart 4';
// Text
$_['text_description'] = 'Pay. Payments for Opencart 4';
$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Success: You have updated the Pay. Module!';
$_['text_edit'] = 'Edit Pay. Payments for Opencart 4';
// Tabs
$_['tab_general'] = 'General';
$_['tab_paymentmethods'] = 'Payment methods';
$_['tab_settings'] = 'Settings';
// Tab General
$_['entry_status'] = 'Status';
$_['text_version'] = 'Version';
$_['text_register'] = 'Not registered with Pay. yet? Sign up ';
$_['text_here'] = 'here';
$_['entry_sort_order'] = 'Sort Order';
$_['text_apitoken'] = 'API token';
$_['text_serviceid'] = 'Sales location';
$_['text_tokencode'] = 'Token code';
$_['text_testmode'] = 'Testmodus';
$_['tooltip_tokencode'] = 'The AT-code belonging to your API token. The Token code should be in the following format: AT-xxxx-xxxx';
$_['tooltip_apitoken'] = 'The API token used to communicate with the Pay. API.';
$_['tooltip_serviceid'] = 'The SL-code of your Sales Location. The Sales Location should be in the following format: SL-xxxx-xxxx';
$_['tooltip_testmode'] = 'Enable to start transactions in test mode';
// Tab Payment methods
$_['text_pm_name'] = 'Name';
$_['text_pm_desc'] = 'Description';
$_['text_pm_min'] = 'Minimum amount';
$_['text_pm_max'] = 'Maximum amount';
$_['text_pm_countries'] = 'Limit countries';
$_['text_pm_geozone'] = 'Geozone';
$_['text_pm_show_issuers'] = 'Show bank selection';
$_['text_pm_show_dob'] = 'Show Date of Birth Field';
$_['text_pm_show_coc'] = 'Show COC Field';
$_['text_pm_show_vat'] = 'Show VAT Field';
$_['text_pm_translations'] = 'Translations';
$_['tooltip_pm_name'] = 'The name of the payment method as shown in the checkout.';
$_['tooltip_pm_min'] = 'Minimum order amount for this payment method, leave blank for no limit.';
$_['tooltip_pm_max'] = 'Maximum order amount for this payment method, leave blank for no limit.';
$_['tooltip_pm_countries'] = 'Select in which countries this method should be available. Hold CTRL button to select/deselect multiple';
$_['tooltip_pm_show_dob'] = 'A date of birth is mandatory for most Buy Now Pay Later payment methods. Show this field in the checkout, to improve your customer\'s payment flow.';
$_['tooltip_pm_show_coc'] = 'Enable to add an extra field to the checkout for customers to enter their COC number';
$_['tooltip_pm_show_vat'] = 'Enable to add an extra field to the checkout for customers to enter their VAT number';
// Tab Settings
$_['text_orderdesc'] = 'Order description prefix';
$_['text_testip'] = 'Test IP Address';
$_['text_testip_desc'] = 'Current IP Address: ';
$_['text_screen_language'] = 'Language payment screen';
$_['tooltip_screen_language'] = 'Select which language the Pay. payment screen should be in. Choose "automatic" to match the language of the website.';
$_['text_nl'] = 'Dutch';
$_['text_en'] = 'English';
$_['text_de'] = 'German';
$_['text_fr'] = 'French';
$_['text_follow_payment'] = 'Follow payment method';
$_['tooltip_orderdesc'] = 'Prefix the order description with a custom word';
$_['tooltip_testip'] = 'Forces testmode on these IP addresses, separate IP\'s by comma\'s for multiple IP\'s';
$_['tooltip_follow_payment'] = 'This will ensure the order is updated with the actual payment method used to complete the order. This can differ from the payment method initially selected.';
$_['text_logging'] = 'Logging';
$_['text_logging_all'] = 'Everything is logged, including Critical, Notice, Info and Debug';
$_['text_critical_notice'] = 'Only Critical errors and Notices are logged';
$_['text_critical_only'] = 'Only Critical errors are logged';
$_['text_no_logging'] = 'No logging';
$_['text_logging_download'] = 'Download logs';
$_['tooltip_logging'] = 'Log payment processing information';
$_['text_custom_exchange_url'] = 'Custom exchange URL';
$_['tooltip_custom_exchange_url'] = 'Use your own exchange-handler. Example: https://www.yourdomain.nl/exchange_handler?action=#action#&order_id=#order_id#';
$_['text_auto_capture'] = 'Auto Capture';
$_['text_auto_void'] = 'Auto Void';
$_['tooltip_auto_capture'] = 'Enable auto capture for authorized transactions. Captures will be initiated when an order is set to Shipped or Complete.';
$_['tooltip_auto_void'] = 'Enable auto void for authorized transactions. Voids will be initiated when an order is set to Cancelled';
// Tab Suggestions
$_['tab_suggestions'] = 'Suggestions?';
$_['text_suggestions'] = 'If you have a feature request or other ideas, let us know!<br/>Your submission will be reviewed by our development team.<br/><br/>If needed, we will contact you for further information via the e-mail address provided.<br/>Please note: this form is not for Support requests, please contact <a href="mailto:support@pay.nl" target="_blank">support@pay.nl</a> for this.'; // phpcs:ignore
$_['text_email_label'] = 'E-mail (optional)';
$_['text_email_error'] = 'Please fill in a valid e-mail.';
$_['text_message_label'] = 'Message';
$_['text_message_error'] = 'Please fill in your message.';
$_['text_message_placeholder'] = 'Leave your suggestions here…';
$_['text_suggestions_submit'] = 'Submit';
$_['text_suggestions_success_modal'] = 'Sent! Thank you for your contribution.';
$_['text_suggestions_fail_modal'] = 'E-mail could not be sent, please try again later.';
// Fields
$_['text_no'] = 'No';
$_['text_yes'] = 'Yes';
$_['text_dropdown'] = 'Dropdown';
$_['text_optional'] = 'Optional';
$_['text_required'] = 'Required';
// Error
$_['error_permission'] = 'Warning: You do not have permission to modify Pay. payment module!';
$_['error_tokencode'] = 'Token code is required';
$_['error_apitoken'] = 'API token is required.';
$_['error_serviceid'] = 'Sales location is required';
$_['error_payment_methods'] = 'Cannot load payment methods, please check your credentials';

// Order page
$_['text_order_orderid'] = 'Pay. Order id';
$_['text_order_status'] = 'Pay. Status';
$_['text_order_pm'] = 'Payment Method';
$_['text_order_amount_cart'] = 'Amount (Cart)';
$_['text_order_amount_pay'] = 'Amount (Pay.)';
$_['text_order_amount_refunded'] = 'Refunded (Pay.)';
$_['text_order_amount_captured'] = 'captured';

$_['text_refund'] = 'Refund';
$_['text_refund_desc'] = 'Amount to refund';
$_['text_refund_confirm'] = 'Are you sure want to refund this amount: %amount% ?';
$_['text_refund_success'] = 'Pay. refunded %amount% successfully!';
$_['text_refund_error'] = 'Pay. couldn\'t refund, please try again later.';

$_['text_capture'] = 'Capture';
$_['text_capture_desc'] = 'Amount to capture';
$_['text_capture_confirm'] = 'Are you sure want to capture this amount: %amount% ?';
$_['text_capture_success'] = 'Pay. captured %amount% successfully!';
$_['text_capture_error'] = 'Pay. couldn\'t capture, please try again later.';

$_['text_error_nan'] = 'Amount must be a number higher than zero.';
