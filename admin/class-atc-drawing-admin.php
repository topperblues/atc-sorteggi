<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    atc-drawing
 * @subpackage atc-drawing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    atc-drawing
 * @subpackage atc-drawing/admin
 * @author     Nicola Bonavita <n.bonavita@ereg.it>
 */
class Atc_Drawing_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the menu for the admin area.
     *
     * @since    1.0.0
     */
    public function add_menu()
    {
        add_menu_page(
            'Ambito Territoriale di Caccia',
            'ATC Drawing',
            'manage_options',
            'atc-plugin',
            plugin_dir_url(__FILE__) . 'partials/atc-drawing-admin-start.php',
            plugin_dir_url(__FILE__) . 'images/icon.png'
        );
        add_submenu_page(
            'atc-plugin',
            'Aggiungi cacciatore',
            'Aggiungi cacciatore',
            'manage_options',
            'atc-plugin-hunter-add',
            plugin_dir_url(__FILE__) . 'partials/atc-drawing-admin-hunter-add.php',
            1
        );
        add_submenu_page(
            'atc-plugin',
            'Lista cacciatori',
            'Lista cacciatori',
            'manage_options',
            'atc-plugin-hunters-list',
            plugin_dir_url(__FILE__) . 'partials/atc-drawing-admin-hunter-list.php',
            2
        );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/atc-drawing-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/atc-drawing-admin.js', array( 'jquery' ), $this->version, false);
    }
}
