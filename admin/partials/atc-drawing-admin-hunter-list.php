<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    atc-drawing
 * @subpackage atc-drawing/admin/partials
 */

namespace atcDrawing\admin;

use atcDrawing as NS;
use atcDrawing\includes\lib as Lib;

$huntersList = new Lib\Hunters_List();

?>

<div class="wrap">
    <h2>Lista cacciatori</h2>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                        <?php
                                $huntersList->prepare_items();
                                $huntersList->search_box('Cerca', 'search_id');
                                $huntersList->display();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>