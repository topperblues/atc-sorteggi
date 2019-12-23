<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    atc-drawing
 * @subpackage atc-drawing/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    atc-drawing
 * @subpackage atc-drawing/includes
 * @author     Nicola Bonavita <n.bonavita@ereg.it>
 */
class Atc_Drawing_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        //$this->create_anagrafica_table();
    }
    
    private function create_anagrafica_table()
    {
        global $table_prefix, $wpdb;

        $tblname = 'anagrafica';
        $wp_track_table = $table_prefix . "$tblname ";

        #Check to see if the table exists already, if not, then create it

        if ($wpdb->get_var("show tables like '$wp_track_table'") != $wp_track_table) {
            $sql = "CREATE TABLE `". $wp_track_table . "` ( ";
            $sql .= "  `id`  bigint(20) unsigned  NOT NULL auto_increment, ";
            $sql .= "  `numero`  int(128) unsigned   NOT NULL, ";
            $sql .= "  `datareg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', ";
            $sql .= "  `anno` int(4) unsigned   NOT NULL, ";
            $sql .= "  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', ";
            $sql .= "  `datanas` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', ";
            $sql .= "  `comunenas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', ";
            $sql .= "  `indirizzo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', ";
            $sql .= "  PRIMARY KEY `ana_id` (`id`) ";
            $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ; ";
            require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
}
