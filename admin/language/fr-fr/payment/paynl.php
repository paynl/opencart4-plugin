<?php

// Heading
$_['heading_title'] = 'Pay. Payments pour Opencart 4';
$_['heading_title_history'] = ' Pay. Payments';
$_['heading_title_paynl'] = 'Pay. Payments pour Opencart 4';
// Text
$_['text_description'] = 'Pay. Payments pour Opencart 4';
$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Succès : Vous avez mis à jour le Pay. Modules!';
$_['text_edit'] = 'Edit Pay. Payments pour Opencart 4';
// Tabs
$_['tab_general'] = 'Général';
$_['tab_paymentmethods'] = 'Méthodes de payement';
$_['tab_settings'] = 'Paramètres';
// Tab General
$_['entry_status'] = 'statut';
$_['entry_sort_order'] = 'Ordre de tri';
$_['text_apitoken'] = 'API token';
$_['text_serviceid'] = 'Sales location';
$_['text_tokencode'] = 'Token code';
$_['text_testmode'] = 'Mode d\'essai';
$_['tooltip_tokencode'] = 'Token code doit se présenter sous la forme suivante: AT-xxxx-xxxx';
$_['tooltip_apitoken'] = 'Le jeton API utilisé pour communiquer avec l’API Pay';
$_['tooltip_serviceid'] = 'Sales location doit se présenter sous la forme suivante: SL-xxxx-xxxx';
$_['tooltip_testmode'] = 'Enable to start transactions in test mode';
// Tab Payment methods
$_['text_pm_name'] = 'Nom';
$_['text_pm_desc'] = 'Description';
$_['text_pm_min'] = 'Montant minimum';
$_['text_pm_max'] = 'Montant Maximum';
$_['text_pm_countries'] = 'Limiter les pays';
$_['text_pm_geozone'] = 'Géozone';
$_['text_pm_show_issuers'] = 'Afficher la sélection de banques';
$_['text_pm_show_dob'] = 'Demander la date de naissance';
$_['text_pm_show_coc'] = 'Afficher le numéro SIREN';
$_['text_pm_show_vat'] = 'Afficher le numéro de TVA';
$_['tooltip_pm_name'] = 'Le nom du mode de paiement tel qu\'indiqué lors du paiement.';
$_['tooltip_pm_min'] = 'Montant minimum de commande pour ce mode de paiement, laissez vide pour aucune limite.';
$_['tooltip_pm_max'] = 'Montant maximum de commande pour ce mode de paiement, laissez vide pour aucune limite.';
$_['tooltip_pm_countries'] = 'Sélectionnez dans quels pays cette méthode doit être disponible. Maintenez le bouton CTRL enfoncé pour sélectionner/désélectionner plusieurs';
$_['tooltip_pm_show_dob'] = 'Une date de naissance est obligatoire pour les méthodes de post-paiement. Demander la date de naissance, afin d’améliorer le flux de paiement de votre client.';
$_['tooltip_pm_show_coc'] = 'Activez cette option pour ajouter un champ supplémentaire dans le checkout afin que les clients puissent saisir leur numéro SIREN';
$_['tooltip_pm_show_vat'] = 'Activez cette option pour ajouter un champ supplémentaire dans le checkout pour que les clients puissent saisir leur numéro de TVA';
// Tab Settings
$_['text_screen_language'] = 'Écran de paiement en langue';
$_['tooltip_screen_language'] = 'Sélectionnez la langue dans laquelle Payer. L\'écran de paiement doit être affiché. Choisissez « automatique » pour correspondre à la langue du site Web.';
$_['text_nl'] = 'Néerlandais';
$_['text_en'] = 'Anglais';
$_['text_de'] = 'Allemand';
$_['text_fr'] = 'Français';
$_['text_follow_payment'] = '"Suivre le mode de paiement';
$_['tooltip_follow_payment'] = 'Cela garantira que la commande est mise à jour avec le mode de paiement réel utilisé pour terminer la commande. Celui-ci peut différer du mode de paiement initialement sélectionné';
$_['text_logging'] = 'Journalisation';
$_['text_logging_download'] = 'Télécharger les journaux';
$_['tooltip_logging'] = 'Enregistrer les informations de traitement des paiements';
$_['text_auto_capture'] = 'Capture automatique';
$_['text_auto_void'] = 'Annulation automatique';
$_['tooltip_auto_capture'] = 'Activez la capture automatique pour les transactions autorisées. Les captures seront lancées lorsqu’une commande est définie sur Expédiée ou Complétée.';
$_['tooltip_auto_void'] = 'Activez l’annulation automatique pour les transactions autorisées. Les annulations seront initiées lorsqu’une commande est définie sur Annulée.';
// Fields
$_['text_no'] = 'Non';
$_['text_yes'] = 'Oui';
$_['text_dropdown'] = 'Dérouler';
$_['text_optional'] = 'Optionnel';
$_['text_required'] = 'Requis';
// Error
$_['error_permission'] = 'Attention : Vous n\'êtes pas autorisé à modifier Pay. module de paiemente!';
$_['error_tokencode'] = 'Le jeton d’API est requis.';
$_['error_apitoken'] = 'API token est requis.';
$_['error_serviceid'] = 'Sales location est requis.';
$_['error_payment_methods'] = 'Impossible de charger les méthodes de paiement, veuillez vérifier vos informations d\'identification';

// Order page
$_['text_order_orderid'] = 'Pay. Numéro de commande';
$_['text_order_status'] = 'Pay. Statut';
$_['text_order_pm'] = 'Mode de paiement';
$_['text_order_amount_cart'] = 'Montant (Panier)';
$_['text_order_amount_pay'] = 'Montant (Pay.)';
$_['text_order_amount_refunded'] = 'Remboursé (Pay.)';
$_['text_order_amount_captured'] = 'capturé';

$_['text_refund'] = 'Remboursement';
$_['text_refund_desc'] = 'Montant à rembourser';
$_['text_refund_confirm'] = 'Êtes-vous sûr de vouloir rembourser ce montant: %amount% ?';
$_['text_refund_success'] = 'Pay. %amount% remboursé avec succès!';
$_['text_refund_error'] = 'Pay. Impossible de rembourser, veuillez réessayer plus tard.';

$_['text_capture'] = 'Capturer';
$_['text_capture_desc'] = 'Montant à capturer';
$_['text_capture_confirm'] = 'Êtes-vous sûr de vouloir capturer ce montant: %amount% ?';
$_['text_capture_success'] = 'Pay. capturé %amount% avec succès !';
$_['text_capture_error'] = 'Pay. Impossible de capturer, veuillez réessayer plus tard.';

