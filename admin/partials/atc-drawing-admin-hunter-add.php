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

$hunter = Lib\Hunters_Table::get_default();

if (isset($_GET['hunter'])) {
    $hunter = Lib\Hunters_Table::get($_GET['hunter']);
}

$select_attr = array('class' => 'form-control');

$select_tipocaccia = Lib\Views_Util::create_select('tipocaccia', Lib\Hunters_Table::col_tipocaccia_options(), $select_attr, $hunter['tipocaccia']);
$select_regione = Lib\Views_Util::create_select('regione', Lib\Hunters_Table::col_regione_options(), $select_attr, $hunter['regione']);
$select_priorita = Lib\Views_Util::create_select('priorita', Lib\Hunters_Table::col_priorita_options(), $select_attr, $hunter['priorita']);

if (isset($_POST['save'])) {
    if (isset($_FILES['paallegato']['name']) && isset($_FILES['paallegato']['type'])) {
        $_POST['paallegatonome'] = $_FILES['paallegato']['name'];
        $_POST['paallegatotipo'] = $_FILES['paallegato']['type'];
        $_POST['paallegato'] = file_get_contents($_FILES['paallegato']['tmp_name']);
    } else {
        $_POST['paallegatonome'] = $hunter['paallegatonome'];
        $_POST['paallegatotipo'] = $hunter['paallegatotipo'];
        $_POST['paallegato'] = $hunter['paallegato'];
    }
    $res = Lib\Hunters_Table::save($_POST);
    if (!$res) {
        echo  " <div class=\"alert alert-danger\" role=\"alert\">
                Errore durante il salvataggio dei dati
                </div>";
    } else {
        echo " <div class=\"alert alert-success\" role=\"alert\">
                Dati salvati con successo!
                </div>";
    }
} else {
    ?>
<div class="container-fluid mt-3">
    <div class="row border border-primary rounded">
        <div class="col-12 p-3">
            <h1>Inserimento</h1>
            <form method="POST" enctype="multipart/form-data">

                <h5>Scheda</h5>

                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="numero">Numero</label>
                        <input class="form-control" name="numero" type="number" id="numero"
                            value="<?=$hunter['numero']?>" />
                    </div>
                    <div class="form-group col-4">
                        <label for="datareg">Data di registrazione</label>
                        <input class="form-control" name="datareg" type="date" id="datareg"
                            value="<?=date_format(date_create($hunter['datareg']), "Y-m-d")?>" />
                    </div>
                    <div class="form-group col-4">
                        <label for="anno">Anno</label>
                        <input class="form-control" name="anno" type="number" id="anno"
                            value="<?=$hunter['anno']?>" />
                    </div>
                </div>

                <h5>Anagrafica</h5>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input class="form-control" name="nome" type="text" id="nome"
                        value="<?=$hunter['nome']?>" />
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="datanas">Data di nascita</label>
                        <input class="form-control" name="datanas" type="date" id="datanas"
                            value="<?=date_format(date_create($hunter['datanas']), "Y-m-d")?>" />
                    </div>
                    <div class="form-group col-6">
                        <label for="comunenas">Luogo di nascita</label>
                        <input class="form-control" name="comunenas" type="text" id="comunenas"
                            value="<?=$hunter['comunenas']?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="indirizzo">Indirizzo</label>
                    <input class="form-control" name="indirizzo" type="text" id="indirizzo"
                        value="<?=$hunter['indirizzo']?>" />
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="cap">CAP</label>
                        <input class="form-control" name="cap" type="number" id="cap"
                            value="<?=$hunter['cap']?>" />
                    </div>
                    <div class="form-group col-4">
                        <label for="localita">Località</label>
                        <input class="form-control" name="localita" type="text" id="localita"
                            value="<?=$hunter['localita']?>" />
                    </div>
                    <div class="form-group col-4">
                        <label for="provincia">Provincia</label>
                        <input class="form-control" name="provincia" type="text" id="provincia"
                            value="<?=$hunter['provincia']?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="telefono">Telefono</label>
                        <input class="form-control" name="telefono" type="text" id="telefono"
                            value="<?=$hunter['telefono']?>" />
                    </div>
                    <div class="form-group col-6">
                        <label for="cellulare">Cellulare</label>
                        <input class="form-control" name="cellulare" type="text" id="cellulare"
                            value="<?=$hunter['cellulare']?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="cf">Codice fiscale</label>
                    <input class="form-control" name="cf" type="text" id="cf"
                        value="<?=$hunter['cf']?>" />
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea class="form-control" id="note"
                        name="note"><?=$hunter['note']?></textarea>
                </div>

                <h5>Porto d'armi</h5>

                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="panumero">Numero</label>
                        <input class="form-control" name="panumero" type="text" id="panumero"
                            value="<?=$hunter['panumero']?>" />
                    </div>
                    <div class="form-group col-4">
                        <label for="paquestura">Rilasciato dalla questura di</label>
                        <input class="form-control" name="paquestura" type="text" id="paquestura"
                            value="<?=$hunter['paquestura']?>" />
                    </div>
                    <div class="form-group col-4">
                        <label for="padata">In data</label>
                        <input class="form-control" name="padata" type="date" id="padata"
                            value="<?=$hunter['padata']?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="painvio">Mezzo di invio</label>
                        <input class="form-control" name="painvio" type="text" id="painvio"
                            value="<?=$hunter['painvio']?>" />
                    </div>
                    <div class="form-group col-6">
                        <label for="paallegato">Allegato</label>
                        <input class="form-control" name="paallegato" type="file" id="paallegato" />
                    </div>
                </div>

                <h5>Richiesta</h5>
                <div class="form-group">
                    <label for="tipocaccia">Tipologia di caccia</label>
                    <?=$select_tipocaccia?>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="regione">Regione</label>
                        <?=$select_regione?>
                    </div>
                    <div class="form-group col-6">
                        <label for="priorita">Priorità</label>
                        <?=$select_priorita?>
                    </div>
                </div>

                <input class="form-control" name="id" type="hidden" id="id"
                    value="<?=$hunter['id']?>" />

                <button name="save" type="submit" class="btn btn-primary">Salva</button>
            </form>
        </div>
    </div>
</div>

<br />




<?php
}
