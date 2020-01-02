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

//$hutersTable = new Lib\Hunters_Table();
?>
<div class="container-fluid mt-3">
    <div class="row border border-success rounded">
        <div class="col-12 p-3">
            <h1>Inserimento</h1>
            <form method="POST" enctype="multipart/form-data">

                <h5>Scheda</h5>

                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="numero">Numero</label>
                        <input class="form-control" name="numero" type="number" id="numero" />
                    </div>
                    <div class="form-group col-4">
                        <label for="datareg">Data di registrazione</label>
                        <input class="form-control" name="datareg" type="date" id="datareg" />
                    </div>
                    <div class="form-group col-4">
                        <label for="anno">Anno</label>
                        <input class="form-control" name="anno" type="number" id="anno" />
                    </div>
                </div>

                <h5>Anagrafica</h5>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input class="form-control" name="nome" type="text" id="nome" />
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="datanas">Data di nascita</label>
                        <input class="form-control" name="datanas" type="date" id="datanas" />
                    </div>
                    <div class="form-group col-6">
                        <label for="comunenas">Luogo di nascita</label>
                        <input class="form-control" name="comunenas" type="text" id="comunenas" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="indirizzo">Indirizzo</label>
                    <input class="form-control" name="indirizzo" type="text" id="indirizzo" />
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="cap">CAP</label>
                        <input class="form-control" name="cap" type="number" id="cap" />
                    </div>
                    <div class="form-group col-4">
                        <label for="localita">Località</label>
                        <input class="form-control" name="localita" type="text" id="localita" />
                    </div>
                    <div class="form-group col-4">
                        <label for="provincia">Provincia</label>
                        <input class="form-control" name="provincia" type="text" id="provincia" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="telefono">Telefono</label>
                        <input class="form-control" name="telefono" type="text" id="telefono" />
                    </div>
                    <div class="form-group col-6">
                        <label for="cellulare">Cellulare</label>
                        <input class="form-control" name="cellulare" type="text" id="cellulare" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="cf">Codice fiscale</label>
                    <input class="form-control" name="cf" type="text" id="cf" />
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea class="form-control" id="note" name="note"></textarea>
                </div>

                <h5>Porto d'armi</h5>

                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="panumero">Numero</label>
                        <input class="form-control" name="panumero" type="text" id="panumero" />
                    </div>
                    <div class="form-group col-4">
                        <label for="paquestura">Rilasciato dalla questura di</label>
                        <input class="form-control" name="paquestura" type="text" id="paquestura" />
                    </div>
                    <div class="form-group col-4">
                        <label for="padata">In data</label>
                        <input class="form-control" name="padata" type="date" id="padata" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="painvio">Mezzo di invio</label>
                        <input class="form-control" name="painvio" type="text" id="painvio" />
                    </div>
                    <div class="form-group col-6">
                        <label for="paallegato">Allegato</label>
                        <input class="form-control" name="paallegato" type="file" id="paallegato" />
                    </div>
                </div>

                <h5>Richiesta</h5>
                <div class="form-group">
                    <label for="tipocaccia">Tipologia di caccia</label>
                    <select class="form-control" id="tipocaccia" name="tipocaccia">
                        <option value="cani-ferma">Caccia cani ferma</option>
                        <option value="cinghiale">Caccia cinghiale</option>
                        <option value="lepre">Caccia lepre</option>
                        <option value="migratoria">Caccia migratoria</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="regione">Regione</label>
                        <select class="form-control" id="regione" name="regione">
                            <option value="abruzzo">Abruzzo</option>
                            <option value="basilicata">Basilicata</option>
                            <option value="campania">Campania</option>
                            <option value="emilia-romagna">Emilia Romagna</option>
                            <option value="lazio">Lazio</option>
                            <option value="liguria">Liguria</option>
                            <option value="lombardia">Lombardia</option>
                            <option value="marche">Marche</option>
                            <option value="puglia">Puglia</option>
                            <option value="sicilia">Sicilia</option>
                            <option value="toscana">Toscana</option>
                            <option value="sardegna">Sardegna</option>
                            <option value="umbria">Umbria</option>
                            <option value="veneto">Veneto</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="priorita">Priorità</label>
                        <select class="form-control" id="priorita" name="priorita">
                            <option value="nessuna">Nessuna</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                    </div>
                </div>
                <button name="save" type="submit" class="btn btn-success">Salva</button>
            </form>
        </div>
    </div>
</div>

<br />









<?php
if (isset($_POST['save'])) {
    $_POST['paallegatonome'] = $_FILES['paallegato']['name'];
    $_POST['paallegatotipo'] = $_FILES['paallegato']['type'];
    $_POST['paallegato'] = file_get_contents($_FILES['paallegato']['tmp_name']);
    Lib\Hunters_Table::save($_POST);
}
