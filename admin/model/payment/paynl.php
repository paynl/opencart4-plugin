<?php

namespace Opencart\Admin\Model\Extension\paynl\Payment;

class Paynl extends \Opencart\System\Engine\Model
{
    /**
     * @return void
     */
    public function install(): void
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pay_transactions` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `order_id` varchar(64) DEFAULT NULL,
            `transaction_id` varchar(255) DEFAULT NULL,
            `amount` decimal(15,4) DEFAULT NULL,
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`),
            UNIQUE (`order_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pay_history` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `order_id` varchar(64) DEFAULT NULL,
            `transaction_id` varchar(255) DEFAULT NULL,
            `message` varchar(255) DEFAULT NULL,
            `oc_status` varchar(255) DEFAULT NULL,
            `pay_status` varchar(255) DEFAULT NULL,
            `pay_action` varchar(255) DEFAULT NULL,
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        $this->db->query("DROP TABLE `" . DB_PREFIX . "pay_transactions`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "pay_history`");
    }
}
