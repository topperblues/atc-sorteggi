<?php
/**
 * Plugin Name:       ATC
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Gestionale ambito territoriale di caccia.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Author:            Nicola Bonavita
 * Author URI:        https://etec.cloud/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

if (!defined('ATC_DIR')) {
    define('ATC_DIR', dirname(__FILE__));
}

if (!defined('ATC_URL')) {
    define('ATC_URL', plugins_url('', __FILE__));
}


function create_anagrafica_table()
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

function atc_install()
{
    // create anagrafica table
    create_anagrafica_table();
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'atc_install');

function atc_deactivation()
{
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'atc_deactivation');

//Create a function called "wporg_init" if it doesn't already exist
if (!function_exists('wporg_init')) {
    function wporg_init()
    {
        register_setting('wporg_settings', 'wporg_option_foo');
    }
}

if (!class_exists('WPOrg_Plugin')) {
    class WPOrg_Plugin
    {
        public static function init()
        {
            register_setting('wporg_settings', 'wporg_option_foo');
        }
 
        public static function get_foo()
        {
            return get_option('wporg_option_foo');
        }
    }
 
    WPOrg_Plugin::init();
    WPOrg_Plugin::get_foo();
}

if (is_admin()) {
    // we are in admin mode
    function ATC_add_front_page()
    {
        include_once('atc-add_anagrafica.php');
    }

    add_action('admin_menu', 'atc_menu');
 
    function atc_menu()
    {
        add_menu_page(
            'Ambito Territoriale di Caccia',
            'ATC',
            'manage_options',
            'atc-plugin',
            'ATC_add_front_page',
            ATC_URL.'/assets/images/icon.png'
        );
    }
}
