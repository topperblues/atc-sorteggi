<?php
echo "PLUGIN => ";
var_dump(ATC_Plugin);
var_dump(ATC_Plugin);
?>
<div class="wrap">
    <h2>Lista cacciatori</h2>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                        <?php
                                $this->customers_obj->prepare_items();
                                $this->customers_obj->display();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>
<?php