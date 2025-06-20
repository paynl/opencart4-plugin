<?php

// Heading
$_['heading_title'] = 'Pay. Payments voor Opencart 4';
$_['heading_title_history'] = ' Pay. Payments';
$_['heading_title_paynl'] = 'Pay. Payments voor Opencart 4';
// Text
$_['text_description'] = 'Pay. Payments voor Opencart 4';
$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Succes: U hebt de Pay. Module bijgewerkt!';
$_['text_edit'] = 'Bewerk Pay. Payments voor Opencart 4';
// Tabs
$_['tab_general'] = 'Algemeen';
$_['tab_paymentmethods'] = 'Betaalmethoden';
$_['tab_settings'] = 'Instellingen';
// Tab General
$_['entry_status'] = 'Status';
$_['entry_sort_order'] = 'Sort Order';
$_['text_apitoken'] = 'API token';
$_['text_serviceid'] = 'Verkooplocatie';
$_['text_tokencode'] = 'Token code';
$_['text_testmode'] = 'Testmodus';
$_['tooltip_tokencode'] = 'De AT-code die bij je API token hoort. De Token code moet in het volgende formaat zijn: AT-xxxx-xxxx';
$_['tooltip_apitoken'] = 'Het API token dat wordt gebruikt om te communiceren met de Pay. API.';
$_['tooltip_serviceid'] = 'De SL-code van je verkooplocatie. De verkooplocatie moet het volgende formaat hebben: SL-xxxx-xxxx';
$_['tooltip_testmode'] = 'Schakel dit in om transacties in testmodus te starten';
// Tab Payment methods
$_['text_pm_name'] = 'Naam';
$_['text_pm_desc'] = 'Beschrijving';
$_['text_pm_min'] = 'Minimum bedrag';
$_['text_pm_max'] = 'Maximaal bedrag';
$_['text_pm_countries'] = 'Landen beperken';
$_['text_pm_allowed_shipping'] = 'Verzendmethoden beperken';
$_['text_pm_customer_type'] = 'Klanttype';
$_['text_pm_customer_type_both'] = 'Beide (B2C & B2B)';
$_['text_pm_customer_type_private'] = 'Privé (B2C)';
$_['text_pm_customer_type_business'] = 'Zakelijk (B2B)';
$_['text_pm_geozone'] = 'Geozone';
$_['text_pm_show_issuers'] = 'Toon bankselectie';
$_['text_pm_show_dob'] = 'Toon geboortedatum veld';
$_['text_pm_show_coc'] = 'KVK-veld tonen';
$_['text_pm_show_vat'] = 'BTW-veld tonen';
$_['tooltip_pm_name'] = 'De naam van de betaalmethode zoals weergegeven in de checkout.';
$_['tooltip_pm_min'] = 'Minimum bestelbedrag voor deze betaalmethode, leeg laten voor geen limiet.';
$_['tooltip_pm_max'] = 'Maximum bestelbedrag voor deze betaalmethode, leeg laten voor geen limiet.';
$_['tooltip_pm_countries'] = 'Selecteer in welke landen deze methode beschikbaar moet zijn. Houd de CTRL-toets ingedrukt om meerdere te selecteren/deselecteren';
$_['tooltip_pm_allowed_shipping'] = 'Selecteer voor welke verzendmethoden deze methode beschikbaar moet zijn. Houd de CTRL-toets ingedrukt om meerdere te selecteren/deselecteren';
$_['tooltip_pm_show_dob'] = 'Een geboortedatum is verplicht voor de meeste betaalmethoden Buy Now Pay Later. Toon dit veld in de checkout om de betalingsstroom van je klant te verbeteren.';
$_['tooltip_pm_show_coc'] = 'Een extra veld aan de checkout toevoegen waarin klanten hun KVK-nummer kunnen invoeren';
$_['tooltip_pm_show_vat'] = 'Een extra veld aan de checkout toevoegen waarin klanten hun BTW-nummer kunnen invoeren';
// Tab Settings
$_['text_screen_language'] = 'Scherm voor taalbetaling';
$_['tooltip_screen_language'] = 'Selecteer in welke taal het Pay. betaalscherm moet zijn. Kies "automatisch" om overeen te komen met de taal van de website.';
$_['text_nl'] = 'Nederlands';
$_['text_en'] = 'Engels';
$_['text_de'] = 'Duits';
$_['text_fr'] = 'Frans';
$_['text_follow_payment'] = 'Betaalmethode volgen';
$_['tooltip_follow_payment'] = 'Hierdoor wordt de bestelling bijgewerkt met de werkelijke betalingsmethode die is gebruikt om de bestelling af te ronden. Dit kan afwijken van de betaalmethode die in eerste instantie is geselecteerd.';
$_['text_logging'] = 'Loggen';
$_['text_logging_download'] = 'Logs downloaden';
$_['tooltip_logging'] = 'Log informatie over betalingsverwerking';
$_['text_auto_capture'] = 'Auto Capture';
$_['text_auto_void'] = 'Auto Void';
$_['tooltip_auto_capture'] = 'Schakel auto capture in voor gereserveerde transacties met status AUTHORIZE. De capture wordt uitgevoerd wanneer een bestelstatus wijzigt naar Shipped of Complete';
$_['tooltip_auto_void'] = 'Schakel auto void in voor gereserveerde transacties met status AUTHORIZE. De void wordt uitgevoerd wanneer een bestelstatus wijzigt naar Cancelled';
// Fields
$_['text_no'] = 'Nee';
$_['text_yes'] = 'Ja';
$_['text_dropdown'] = 'Dropdown';
$_['text_optional'] = 'Optioneel';
$_['text_required'] = 'Vereist';
// Error
$_['error_permission'] = 'Waarschuwing: Je hebt geen toestemming om Pay. betalingsmodule te wijzigen!';
$_['error_tokencode'] = 'Token code is vereist';
$_['error_apitoken'] = 'API token is vereist';
$_['error_serviceid'] = 'Verkooplocatie is vereist';
$_['error_payment_methods'] = 'Kan betaalmethoden niet laden, controleer uw gegevens';

// Order page
$_['text_order_orderid'] = 'Pay. Order id';
$_['text_order_status'] = 'Pay. Status';
$_['text_order_pm'] = 'Betaalmethode';
$_['text_order_amount_cart'] = 'Bedrag (Winkelwagen)';
$_['text_order_amount_pay'] = 'Bedrag (Pay.)';
$_['text_order_amount_refunded'] = 'Terugbetaald (Pay.)';
$_['text_order_amount_captured'] = 'gecaptured';

$_['text_refund'] = 'Terugbetaalen';
$_['text_refund_desc'] = 'Terug te betalen bedrag';
$_['text_refund_confirm'] = 'Weet je zeker dat je dit bedrag wilt terugbetalen: %amount% ?';
$_['text_refund_success'] = 'Pay. %bedrag% succesvol terugbetaald!';
$_['text_refund_error'] = 'Pay. kon het bedrag niet terugbetalen, probeer het later nog eens.';

$_['text_capture'] = 'Capture';
$_['text_capture_desc'] = 'Bedrag om te capturen';
$_['text_capture_confirm'] = 'Weet je zeker dat je dit bedrag wilt capturen: %amount% ?';
$_['text_capture_success'] = 'Pay. heeft %amount% succesvol gecaptured!';
$_['text_capture_error'] = 'Pay. kon het bedrag niet capturen, probeer het later nog eens.';

$_['text_void'] = 'Void';
$_['text_void_confirm'] = 'Weet je zeker dat je dit bedrag wilt voiden: %amount% ?';
$_['text_void_success'] = 'Pay. heeft %amount% succesvol gevoid!';
$_['text_void_error'] = 'Pay. kon het bedrag niet voiden, probeer het later nog eens.';