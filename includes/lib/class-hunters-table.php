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

namespace atcDrawing\includes\lib;

use atcDrawing as NS;
use atcDrawing\admin as Admin;
use atcDrawing\frontend as Frontend;

class Hunters_Table
{
    public static function get_table()
    {
        global $table_prefix;
        return $table_prefix . "hunter";
    }

    public static function create_table()
    {
        global $wpdb;

        $wp_track_table = self::get_table();

        #Check to see if the table exists already, if not, then create it

        if ($wpdb->get_var("show tables like '$wp_track_table'") != $wp_track_table) {
            $sql = "CREATE TABLE `". $wp_track_table . "` ( ";
            $sql .= "  `id`  bigint(20) unsigned  NOT NULL auto_increment, ";
            $sql .= "  `numero`  int(128) unsigned  , ";
            $sql .= "  `datareg` datetime DEFAULT '0000-00-00 00:00:00', ";
            $sql .= "  `anno` int(4) unsigned  , ";
            $sql .= "  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `datanas` datetime DEFAULT '0000-00-00 00:00:00', ";
            $sql .= "  `comunenas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `indirizzo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `cap` int(6) unsigned  , ";
            $sql .= "  `localita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `cellulare` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `cf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `note` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `panumero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `paquestura` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `padata` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `painvio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `paallegatonome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `paallegatotipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `paallegato` BLOB, ";
            $sql .= "  `tipocaccia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `regione` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  `priorita` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '', ";
            $sql .= "  PRIMARY KEY `ana_id` (`id`) ";
            $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ; ";
            require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public static function get_columns()
    {
        global $wpdb;

        $wp_track_table = self::get_table();
        
        return $wpdb->get_col("DESC {$wp_track_table}", 0);
    }

    public static function filter_keys($arr)
    {
        $allowed_keys = self::get_columns();
        return array_intersect_key($arr, array_flip($allowed_keys));
    }

    public static function save($data)
    {
        global $wpdb;

        $wp_track_table = self::get_table();

        $wpdb->insert($wp_track_table, self::filter_keys($data));
    }
}
