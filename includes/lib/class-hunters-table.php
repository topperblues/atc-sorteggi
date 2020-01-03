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
    private static function get_columns()
    {
        global $wpdb;

        $wp_track_table = self::get_table();
        
        return $wpdb->get_col("DESC {$wp_track_table}", 0);
    }

    private static function filter_keys($arr)
    {
        $allowed_keys = self::get_columns();
        return array_intersect_key($arr, array_flip($allowed_keys));
    }

    public static function get_table()
    {
        global $table_prefix;
        return $table_prefix . "hunter";
    }

    public static function get_default()
    {
        $cols = array_flip(self::get_columns());
        $res = array_map(function ($val) {
            return '';
        }, $cols);
        return $res;
    }

    public static function col_tipocaccia_options()
    {
        return array(
            ["name" => "caccia-cani-ferma", "attr" => []],
            ["name" => "caccia-cinghiale",  "attr" => []],
            ["name" => "caccia-lepre",  "attr" => []],
            ["name" => "caccia-migratoria", "attr" => []]
        );
    }

    public static function col_regione_options()
    {
        return array(
            ["name"=> "abruzzo","attr" => []],
            ["name"=> "basilicata","attr" => []],
            ["name"=> "campania","attr" => []],
            ["name"=> "emilia-romagna","attr" => []],
            ["name"=> "lazio","attr" => []],
            ["name"=> "liguria","attr" => []],
            ["name"=> "lombardia","attr" => []],
            ["name"=> "marche","attr" => []],
            ["name"=> "puglia","attr" => []],
            ["name"=> "sicilia","attr" => []],
            ["name"=> "toscana","attr" => []],
            ["name"=> "sardegna","attr" => []],
            ["name"=> "umbria","attr" => []],
            ["name"=> "veneto","attr" => []]
        );
    }

    public static function col_priorita_options()
    {
        return array(
            ["name" => "nessuna", "attr" => []],
            ["name" => "a",  "attr" => []],
            ["name" => "b",  "attr" => []],
            ["name" => "c", "attr" => []],
            ["name" => "d", "attr" => []],
            ["name" => "e", "attr" => []]
        );
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

    public static function save($data)
    {
        global $wpdb;

        $wp_track_table = self::get_table();

        $wpdb->insert($wp_track_table, self::filter_keys($data));
    }

    public static function get($id)
    {
        global $wpdb;
        
        $table = self::get_table();

        $sql = "SELECT * FROM {$table} where id={$id}";
        $result = $wpdb->get_results($sql, 'ARRAY_A');
        if (count($result)!=1) {
            return false;
        }
        return $result[0];
    }

    public static function get_list($per_page, $page_number)
    {
        global $wpdb;

        $table = self::get_table();

        
        $sql = "SELECT * FROM {$table}";
        if (! empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }
        $sql .= " LIMIT $per_page";
        $sql .= ' OFFSET ' . ($page_number - 1) * $per_page;
        $result = $wpdb->get_results($sql, 'ARRAY_A');
        return $result;
    }

    public static function delete($id)
    {
        global $wpdb;

        $table = self::get_table();

        $wpdb->delete(
            "{$table}",
            [ 'id' => $id ],
            [ '%d' ]
        );
    }

    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public static function record_count()
    {
        global $wpdb;
        $table = self::get_table();

        $sql = "SELECT COUNT(*) FROM {$table}";
        return $wpdb->get_var($sql);
    }
}
