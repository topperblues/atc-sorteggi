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

class Views_Util
{
    public static function format_label($string)
    {
        return ucfirst(str_replace(str_split('-_'), ' ', $string));
    }

    public static function format_attribute($key, $val)
    {
        return " ".$key."=\"".$val."\" ";
    }

    public static function create_option($val, $attr, $selected)
    {
        $option = "<option value=\"".$val."\" ";
        foreach ($attr as $key => $value) {
            $option .= self::format_attribute($key, $val);
        }
        if ($val === $selected) {
            $option.= " selected ";
        }
        $option .= ">".self::format_label($val)."</option>";
        return $option;
    }

    public static function create_select($id, $opts, $attr, $selected)
    {
        $select = "<select id=\"".$id."\" name=\"".$id."\" ";
        foreach ($attr as $key => $value) {
            $select .= self::format_attribute($key, $value);
        }
        $select .= ">";
        foreach ($opts as $value) {
            $select .= self::create_option($value['name'], $value['attr'], $selected);
        }
        $select .= "</select>";
        return $select;
    }
}
