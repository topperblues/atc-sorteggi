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
use atcDrawing\includes\lib as Lib;

class Hunters_List extends \WP_List_Table
{
    /** Class constructor */
    public function __construct()
    {
        parent::__construct([
            'singular' => __('Cacciatore', 'sp'), //singular name of the listed records
            'plural'   => __('Cacciatori', 'sp'), //plural name of the listed records
            'ajax'     => false //does this table support ajax?
        ]);
    }
    /**
     * Retrieve hunters data from the database
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return mixed
     */
    public static function get_hunters($per_page = 5, $page_number = 1)
    {
        global $wpdb;
        
        $table = Lib\Hunters_Table::get_table();

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
    /**
     * Delete a hunter record.
     *
     * @param int $id hunter ID
     */
    public static function delete_hunter($id)
    {
        global $wpdb;
        $table = Lib\Hunters_Table::get_table();

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
        $table = Lib\Hunters_Table::get_table();

        $sql = "SELECT COUNT(*) FROM {$table}";
        return $wpdb->get_var($sql);
    }
    /** Text displayed when no hunter data is available */
    public function no_items()
    {
        _e('Nessun cacciatore disponibile.', 'sp');
    }
    /**
     * Render a column when no column specific method exist.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'numero':
            case 'anno':
            case 'nome':
            case 'cf':
            case 'tipocaccia':
            case 'regione':
            case 'priorita':
                return $item[ $column_name ];
            // default:
            //     return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }
    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />',
            $item['id']
        );
    }
    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    public function column_numero($item)
    {
        $delete_nonce = wp_create_nonce('sp_delete_hunter');
        $edit_nonce = wp_create_nonce('sp_edit_hunter');
        $title = '<strong>' . $item['numero'] . '</strong>';
        $actions = [
            'edit' => sprintf('<a href="?page=%s&action=%s&hunter=%s&_wpnonce=%s">Edit</a>', esc_attr($_REQUEST['page']), 'edit', absint($item['id']), $edit_nonce),
            'delete' => sprintf('<a href="?page=%s&action=%s&hunter=%s&_wpnonce=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['id']), $delete_nonce)
        ];
        return $title . $this->row_actions($actions);
    }
    /**
     *  Associative array of columns
     *
     * @return array
     */
    public function get_columns()
    {
        $columns = [
            'cb'      => '<input type="checkbox" />',
            'numero'    => __('Numero', 'sp'),
            'anno'    => __('Anno', 'sp'),
            'nome' => __('Nome', 'sp'),
            'cf'    => __('Codice fiscale', 'sp'),
            'tipocaccia'    => __('Tipologia di caccia', 'sp'),
            'regione'    => __('Regione', 'sp'),
            'priorita'    => __('Priorità', 'sp')
        ];
        return $columns;
    }
    /**
     * Columns to make sortable.
     *
     * @return array
     */
    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'numero'    => array('numero', true),
            'anno'    => array('anno', true),
            'nome' => array('nome', true),
            'cf'    => array('cf', true),
            'tipocaccia'    => array('tipocaccia', true),
            'regione'    => array('regione', true),
            'priorita'    => array('priorita', true)
        );
        return $sortable_columns;
    }
    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = [
            'bulk-delete' => 'Delete'
        ];
        return $actions;
    }
    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        /** Process bulk action */
        $this->process_bulk_action();
        $per_page     = $this->get_items_per_page('hunters_per_page', 5);
        $current_page = $this->get_pagenum();
        $total_items  = self::record_count();
        $this->set_pagination_args([
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page'    => $per_page //WE have to determine how many items to show on a page
        ]);
        $this->items = self::get_hunters($per_page, $current_page);
    }
    public function process_bulk_action()
    {
        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);
            if (! wp_verify_nonce($nonce, 'sp_delete_hunter')) {
                die('Go get a life script kiddies');
            } else {
                self::delete_hunter(absint($_GET['hunter']));
                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
                // add_query_arg() return the current url
                wp_redirect(esc_url_raw(add_query_arg()));
                exit;
            }
        }
        if ('edit' === $this->current_action()) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);
            if (! wp_verify_nonce($nonce, 'sp_edit_hunter')) {
                die('Go get a life script kiddies');
            } else {
                // TODO: redirect to admin edit hunter!!!
                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
                // add_query_arg() return the current url
                wp_redirect(esc_url_raw(add_query_arg()));
                exit;
            }
        }
        // If the delete bulk action is triggered
        if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
             || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
        ) {
            $delete_ids = esc_sql($_POST['bulk-delete']);
            // loop over the array of record IDs and delete them
            foreach ($delete_ids as $id) {
                self::delete_hunter($id);
            }
            // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
            // add_query_arg() return the current url
            wp_redirect(esc_url_raw(add_query_arg()));
            exit;
        }
    }
}
