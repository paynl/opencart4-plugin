<?php

// Heading
$_['heading_title'] = 'Pay. Payments für Opencart 4';
$_['heading_title_history'] = ' Pay. Payments';
$_['heading_title_paynl'] = 'Pay. Payments für Opencart 4';
// Text
$_['text_description'] = 'Pay. Payments für Opencart 4';
$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Erfolg: Sie haben das Pay. Modul aktualisiert!';
$_['text_edit'] = 'Bearbeit Pay. Payments für Opencart 4';
// Tabs
$_['tab_general'] = 'Allgemein';
$_['tab_paymentmethods'] = 'Zahlungsmöglichkeiten';
$_['tab_settings'] = 'Einstellungen';
// Tab General
$_['entry_status'] = 'Status';
$_['entry_sort_order'] = 'Sortierreihenfolge';
$_['text_apitoken'] = 'API token';
$_['text_serviceid'] = 'Sales Location';
$_['text_tokencode'] = 'Token code';
$_['text_testmode'] = 'Testmodus';
$_['tooltip_tokencode'] = 'Der zu Ihrem API Token gehörende AT-Code. Der Token code sollte das folgende Format haben: AT-xxxx-xxxx';
$_['tooltip_apitoken'] = 'Das API-Token, das für die Kommunikation mit der Pay. API.';
$_['tooltip_serviceid'] = 'Der Sales location hast das folgende Format: SL-xxxx-xxxx';
$_['tooltip_testmode'] = 'Aktivieren, um Transaktionen im Testmodus zu starten';
// Tab Payment methods
$_['text_pm_name'] = 'Name';
$_['text_pm_desc'] = 'Beschreibung';
$_['text_pm_min'] = 'Mindestbetrag';
$_['text_pm_max'] = 'Höchstbetrag';
$_['text_pm_countries'] = 'Länder begrenzen';
$_['text_pm_allowed_shipping'] = 'Versandarten begrenzen';
$_['text_pm_customer_type'] = 'Kundentyp';
$_['text_pm_customer_type_both'] = 'Beides (B2C und B2B)';
$_['text_pm_customer_type_private'] = 'Privat (B2C)';
$_['text_pm_customer_type_business'] = 'Unternehmen (B2B)';
$_['text_pm_geozone'] = 'Geozone';
$_['text_pm_show_issuers'] = 'Bankauswahl anzeigen';
$_['text_pm_show_dob'] = 'Feld Geburtsdatum anzeigen';
$_['text_pm_show_coc'] = 'HRB-Feld anzeigen';
$_['text_pm_show_vat'] = 'MwSt-Feld anzeigen';
$_['tooltip_pm_name'] = 'Der Name der Zahlungsmethode, wie er an der Kasse angezeigt wird.';
$_['tooltip_pm_min'] = 'Mindestbestellwert für diese Zahlungsmethode, leer lassen, wenn es kein Limit gibt.';
$_['tooltip_pm_max'] = 'Maximaler Bestellbetrag für diese Zahlungsmethode, leer lassen, wenn es kein Limit gibt.';
$_['tooltip_pm_countries'] = 'Wählen Sie aus, in welchen Ländern diese Methode verfügbar sein soll. Halten Sie die STRG-Taste gedrückt, um mehrere auszuwählen bzw. die Auswahl aufzuheben';
$_['tooltip_pm_allowed_shipping'] = 'Wählen Sie aus, für welche Versandarten diese Methode verfügbar sein soll. Halten Sie die STRG-Taste gedrückt, um mehrere auszuwählen bzw. die Auswahl aufzuheben';
$_['tooltip_pm_show_dob'] = 'Bei den meisten Zahlungsmethoden „Jetzt kaufen, später zahlen“ ist die Angabe eines Geburtsdatums obligatorisch. Zeigen Sie dieses Feld im Checkout an, um den Zahlungsfluss Ihres Kunden zu verbessern.';
$_['tooltip_pm_show_coc'] = 'Aktivieren Sie diese Option, um dem Checkout ein zusätzliches Feld hinzuzufügen, in dem Kunden ihre HRB-Nummer eingeben können';
$_['tooltip_pm_show_vat'] = 'Aktivieren Sie diese Option, um dem Checkout ein zusätzliches Feld hinzuzufügen, in dem Kunden ihre MwSt—Nummer eingeben können';
// Tab Settings
$_['text_screen_language'] = 'Sprachzahlungsbildschirm';
$_['tooltip_screen_language'] = 'Wählen Sie aus, in welcher Sprache die Bezahlung erfolgen soll. Der Zahlungsbildschirm sollte angezeigt werden. Wählen Sie „Automatisch“, um der Sprache der Website zu entsprechen.';
$_['text_nl'] = 'Niederländisch';
$_['text_en'] = 'Englisch';
$_['text_de'] = 'Deutsch';
$_['text_fr'] = 'Französisch';
$_['text_follow_payment'] = 'Befolgen Sie die Zahlungsmethode';
$_['tooltip_follow_payment'] = 'Dadurch wird sichergestellt, dass die Bestellung mit der tatsächlichen Zahlungsmethode aktualisiert wird, die zum Abschluss der Bestellung verwendet wurde. Diese kann von der ursprünglich gewählten Zahlungsart abweichen.';
$_['text_logging'] = 'Protokollierung';
$_['text_logging_download'] = 'Protokolle herunterladen';
$_['tooltip_logging'] = 'Informationen zur Zahlungsabwicklung protokollieren';
$_['text_auto_capture'] = 'Automatische capture';
$_['text_auto_void'] = 'Automatisches stornieren';
$_['tooltip_auto_capture'] = 'Aktivieren Sie die automatische capture für autorisierte Transaktionen. Captures werden initiiert, wenn eine Bestellung auf “Versendet” oder  “Komplett” gesetzt wird.';
$_['tooltip_auto_void'] = 'Aktivieren Sie die automatische Stornierung für autorisierte Transaktionen. Stornierungen werden ausgelöst, wenn eine Bestellung auf Storniert gesetzt wird.';
// Fields
$_['text_no'] = 'Nein';
$_['text_yes'] = 'Ja';
$_['text_dropdown'] = 'Auswahlliste';
$_['text_optional'] = 'Optional';
$_['text_required'] = 'Erforderlich';
// Error
$_['error_permission'] = 'Warnung! Sie haben nicht die Berechtigung, das Zahlungsmodul Pay. zu ändern!';
$_['error_tokencode'] = 'Token code ist erforderlich';
$_['error_apitoken'] = 'API token ist erforderlich';
$_['error_serviceid'] = 'Sales location ist erforderlich';
$_['error_payment_methods'] = 'Zahlungsarten können nicht geladen werden, bitte überprüfen Sie Ihre Anmeldedaten';

// Order page
$_['text_order_orderid'] = 'Pay. Bestellnummer';
$_['text_order_status'] = 'Pay. Status';
$_['text_order_pm'] = 'Zahlungsmethode';
$_['text_order_amount_cart'] = 'Betrag (Cart)';
$_['text_order_amount_pay'] = 'Betrag (Pay.)';
$_['text_order_amount_refunded'] = 'Erstattet (Pay.)';
$_['text_order_amount_captured'] = 'erfasst';

$_['text_refund'] = 'Erstattung';
$_['text_refund_desc'] = 'Zu erstattender Betrag';
$_['text_refund_confirm'] = 'Möchten Sie diesen Betrag wirklich zurückerstatten: %amount% ?';
$_['text_refund_success'] = 'Pay. %amount% erfolgreich zurückerstattet!';
$_['text_refund_error'] = 'Pay. Die Rückerstattung konnte nicht erfolgen. Bitte versuchen Sie es später noch einmal.';

$_['text_capture'] = 'Erfassung';
$_['text_capture_desc'] = 'Betrag zur Erfassung';
$_['text_capture_confirm'] = 'Möchten Sie diesen Betrag wirklich erfassen: %amount% ?';
$_['text_capture_success'] = 'Pay. %amount% erfolgreich erfassen!';
$_['text_capture_error'] = 'Pay. konnte nicht erfasst werden, bitte versuchen Sie es später noch einmal';
