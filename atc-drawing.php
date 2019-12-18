<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           atc-drawing
 *
 * @wordpress-plugin
 * Plugin Name:       ATC Drawing
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Gestionale ambito territoriale di caccia.
 * Version:           1.0.0
 * Author:            Nicola Bonavita <n.bonavita@ereg.it>
 * Author URI:        https://etec.cloud/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       atc-drawing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('ATC_DRAWING_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_atc_drawing()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-atc-drawing-activator.php';
    Atc_Drawing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_atc_drawing()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-atc-drawing-deactivator.php';
    Atc_Drawing_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_atc_drawing');
register_deactivation_hook(__FILE__, 'deactivate_atc_drawing');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-atc-drawing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_atc_drawing()
{
    $plugin = new Atc_Drawing();
    $plugin->run();
}
run_atc_drawing();
