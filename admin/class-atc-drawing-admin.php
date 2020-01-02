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

namespace atcDrawing\admin;

use atcDrawing as NS;
use atcDrawing\includes as Includes;
use atcDrawing\frontend as Frontend;

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
     * The user capability needed to use this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $capability    The user capability needed to use this plugin.
     */
    private $capability;

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
        $this->capability = 'manage_options';
    }

    /**
     * Add the WPHost Welcome Panel
     *
     * @since 1.0.0
     */
    public function welcome_page($page)
    {
        include(plugin_dir_path(__FILE__) . 'partials/atc-drawing-admin-welcome.php');
    }

    /**
     * Add the WPHost Welcome Panel
     *
     * @since 1.0.0
     */
    public function add_hunter_page($page)
    {
        include(plugin_dir_path(__FILE__) . 'partials/atc-drawing-admin-hunter-add.php');
    }

    /**
     * Add the WPHost Welcome Panel
     *
     * @since 1.0.0
     */
    public function list_hunter_page($page)
    {
        include(plugin_dir_path(__FILE__) . 'partials/atc-drawing-admin-hunter-list.php');
    }

    /**
     * Add the WPHost Welcome Panel
     *
     * @since 1.0.0
     */
    public function get_admin_page($page)
    {
        include(plugin_dir_path(__FILE__) . 'partials/atc-drawing-admin-welcome.php');
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
            $this->capability,
            $this->plugin_name,
            array( $this, 'welcome_page' ),
            plugin_dir_url(__FILE__) . 'images/icon.png'
        );

        add_submenu_page(
            $this->plugin_name,
            'Ambito Territoriale di Caccia',
            'Aggiungi cacciatore',
            $this->capability,
            $this->plugin_name . '-add-hunter',
            array( $this, 'add_hunter_page' ),
            1
        );

        add_submenu_page(
            $this->plugin_name,
            'Ambito Territoriale di Caccia',
            'Lista cacciatori',
            $this->capability,
            $this->plugin_name . '-list-hunter',
            array( $this, 'list_hunter_page' ),
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
        //wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/bootstrap/bootstrap-reboot.min.css', array(), $this->version, 'all');
        //wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/atc-drawing-admin.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/bootstrap/bootstrap.min.css', array(), $this->version, 'all');
        // wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/bootstrap/bootstrap-grid.min.css', array(), $this->version, 'all');
    }

    /**
     * Reset the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function reset_styles()
    {
        //wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/bootstrap/bootstrap-reboot.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        //wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/jquery-3.4.1.slim.min.js', array(), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/atc-drawing-admin.js', array( 'jquery' ), $this->version, false);
    }
}
