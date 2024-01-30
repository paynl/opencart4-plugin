<?php

namespace Opencart\Admin\Model\Extension\paynl\Payment;

class Paynl extends \Opencart\System\Engine\Model
{
    /**
     * @return void
     */
    public function install(): void
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "paynl_report` (
		`paynl_report_id` int(11) NOT NULL AUTO_INCREMENT,
		`order_id` int(11) NOT NULL,
		`card` varchar(64) NOT NULL,
		`amount` decimal(15,4) NOT NULL,
		`response` text NOT NULL,
		`order_status_id` int(11) NOT NULL,
		`date_added` datetime NOT NULL,
		PRIMARY KEY (`paynl_report_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
    }

    /**
     * @return void
     */
    public function uninstall(): void
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "paynl_report`");
    }
}
