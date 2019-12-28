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

namespace atcDrawing\includes;

use atcDrawing as NS;
use atcDrawing\admin as Admin;
use atcDrawing\frontend as Frontend;

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
        //require_once plugin_dir_path(dirname(__FILE__)) . 'includes/atc-drawing-admin-hunter.class.php';
        //$this->create_hunter_table();

        
        //Hunters_Table::create_table();
    }
}
