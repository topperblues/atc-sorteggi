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

namespace atcDrawing;

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

define(__NAMESPACE__ . '\NS', __NAMESPACE__ . '\\');
define(NS . 'PLUGIN_NAME', 'atc-drawing');
define(NS . 'PLUGIN_VERSION', '1.0.0');
define(NS . 'PLUGIN_NAME_DIR', plugin_dir_path(__FILE__));
define(NS . 'PLUGIN_NAME_URL', plugin_dir_url(__FILE__));
define(NS . 'PLUGIN_BASENAME', plugin_basename(__FILE__));
define(NS . 'PLUGIN_TEXT_DOMAIN', 'atc-drawing');
define(NS . 'PLUGIN_ADMIN_BASE_URL', esc_url(admin_url('/admin.php?page=' . PLUGIN_NAME . '-')));



/**
 * Autoload Classes
 */
require_once(PLUGIN_NAME_DIR . 'includes/lib/autoloader.php');


register_activation_hook(__FILE__, array( NS . 'includes\Atc_Drawing_Activator', 'activate' ));
register_deactivation_hook(__FILE__, array( NS . 'includes\Atc_Drawing_Deactivator', 'deactivate' ));


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
    $plugin = new includes\Atc_Drawing();
    $plugin->run();
}
run_atc_drawing();
