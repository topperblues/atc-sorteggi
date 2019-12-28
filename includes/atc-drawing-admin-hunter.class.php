<?php

namespace atcDrawing\includes;

use atcDrawing as NS;
use atcDrawing\admin as Admin;
use atcDrawing\frontend as Frontend;

class Hunters_Table
{
    public static function get_table()
    {
        global $table_prefix;
        return $table_prefix . "hunter ";
    }

    public static function create_table()
    {
        global $wpdb;

        $wp_track_table = self::get_table();

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

    public static function save($data)
    {
        global $wpdb;

        $wp_track_table = self::get_table();

        $wpdb->insert($wp_track_table, $data, $format);
    }
}

class Hunters_List extends WP_List_Table
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

        $sql = "SELECT * FROM {$huntersTable}";

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

        $wpdb->delete(
            "{$huntersTable}",
            [ 'ID' => $id ],
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

        $sql = "SELECT COUNT(*) FROM {$huntersTable}";

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
            case 'address':
            case 'city':
                return $item[ $column_name ];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
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
            $item['ID']
        );
    }


    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    public function column_name($item)
    {
        $delete_nonce = wp_create_nonce('sp_delete_hunter');

        $title = '<strong>' . $item['name'] . '</strong>';

        $actions = [
            'delete' => sprintf('<a href="?page=%s&action=%s&hunter=%s&_wpnonce=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['ID']), $delete_nonce)
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
            'name'    => __('Name', 'sp'),
            'address' => __('Address', 'sp'),
            'city'    => __('City', 'sp')
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
            'name' => array( 'name', true ),
            'city' => array( 'city', false )
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
        $this->_column_headers = $this->get_column_info();

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
