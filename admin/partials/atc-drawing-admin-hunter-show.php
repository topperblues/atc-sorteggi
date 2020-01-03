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

if (!isset($_GET['hunter'])) {
    wp_redirect(esc_url_raw(NS\PLUGIN_ADMIN_BASE_URL.'list-hunter'));
    exit;
}


$hunter = Lib\Hunters_Table::get($_GET['hunter']);

?>
<div class="container-fluid mt-3">
    <div class="row border border-primary rounded">
        <div class="col-12 p-3">
            <h5>Scheda</h5>

            <div class="form-row mb-3">
                <div class="form-group col-4">
                    <label for="numero">Numero</label>
                    <input class="form-control" readonly
                        value="<?=$hunter['numero']?>" />
                </div>
                <div class="form-group col-4">
                    <label for="datareg">Data di registrazione</label>
                    <input class="form-control" readonly
                        value="<?=date_format(date_create($hunter['datareg']), "d/m/Y")?>" />
                </div>
                <div class="form-group col-4">
                    <label for="anno">Anno</label>
                    <input class="form-control" readonly
                        value="<?=$hunter['anno']?>" />
                </div>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs  mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="anagrafica-tab" data-toggle="tab" href="#anagrafica" role="tab"
                        aria-controls="anagrafica" aria-selected="true">Anagrafica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="porto-armi-tab" data-toggle="tab" href="#porto-armi" role="tab"
                        aria-controls="porto-armi" aria-selected="false">Porto d'armi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="richiesta-tab" data-toggle="tab" href="#richiesta" role="tab"
                        aria-controls="richiesta" aria-selected="false">Richiesta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sorteggio-tab" data-toggle="tab" href="#sorteggio" role="tab"
                        aria-controls="sorteggio" aria-selected="false">Sorteggio</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="anagrafica" role="tabpanel" aria-labelledby="anagrafica-tab">
                    <h5>Anagrafica</h5>

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" readonly
                            value="<?=$hunter['nome']?>" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="datanas">Data di nascita</label>
                            <input class="form-control" readonly
                                value="<?=date_format(date_create($hunter['datanas']), "d/m/Y")?>" />
                        </div>
                        <div class="form-group col-6">
                            <label for="comunenas">Luogo di nascita</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['comunenas']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="indirizzo">Indirizzo</label>
                        <input class="form-control" readonly
                            value="<?=$hunter['indirizzo']?>" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="cap">CAP</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['cap']?>" />
                        </div>
                        <div class="form-group col-4">
                            <label for="localita">Località</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['localita']?>" />
                        </div>
                        <div class="form-group col-4">
                            <label for="provincia">Provincia</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['provincia']?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="telefono">Telefono</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['telefono']?>" />
                        </div>
                        <div class="form-group col-6">
                            <label for="cellulare">Cellulare</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['cellulare']?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cf">Codice fiscale</label>
                        <input class="form-control" readonly
                            value="<?=$hunter['cf']?>" />
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control"
                            readonly><?=$hunter['note']?></textarea>
                    </div>

                </div>
                <div class="tab-pane" id="porto-armi" role="tabpanel" aria-labelledby="porto-armi-tab">
                    <h5>Porto d'armi</h5>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="panumero">Numero</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['panumero']?>" />
                        </div>
                        <div class="form-group col-4">
                            <label for="paquestura">Rilasciato dalla questura di</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['paquestura']?>" />
                        </div>
                        <div class="form-group col-4">
                            <label for="padata">In data</label>
                            <input class="form-control" readonly
                                value="<?=date_format(date_create($hunter['padata']), "d/m/Y")?>" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="painvio">Mezzo di invio</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['painvio']?>" />
                        </div>
                        <div class="form-group col-6">
                            <label for="paallegato">Allegato</label>
                            <input class="form-control" name="paallegato" type="file" id="paallegato" />
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="richiesta" role="tabpanel" aria-labelledby="richiesta-tab">
                    <h5>Richiesta</h5>
                    <div class="form-group">
                        <label for="tipocaccia">Tipologia di caccia</label>
                        <input class="form-control" readonly
                            value="<?=$hunter['tipocaccia']?>" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="regione">Regione</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['regione']?>" />
                        </div>
                        <div class="form-group col-6">
                            <label for="priorita">Priorità</label>
                            <input class="form-control" readonly
                                value="<?=$hunter['priorita']?>" />
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="sorteggio" role="tabpanel" aria-labelledby="sorteggio-tab">Sort</div>
            </div>


            <a class="btn btn-primary"
                href="<?=esc_url_raw(add_query_arg('hunter', $_GET['hunter'], NS\PLUGIN_ADMIN_BASE_URL.'add-hunter'));?>"
                role="button">Modifica</a>
        </div>
    </div>
</div>

<br />