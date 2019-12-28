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

$hutersTable = new Lib\Hunters_Table();
?>


<h1>Inserimento</h1>
<br />
<form method="POST">
    <h2>Scheda</h2>
    <table class="form-table" role="presentation">

        <tbody>
            <tr>
                <th scope="row"><label for="numero">Numero</label></th>
                <td><input name="numero" type="number" id="numero" /></td>
                <th scope="row"><label for="datareg">Data di registrazione</label></th>
                <td><input name="datareg" type="date" id="datareg" /></td>
                <th scope="row"><label for="anno">Anno</label></th>
                <td><input name="anno" type="number" id="anno" /></td>
            </tr>
        </tbody>
    </table>

    <h2>Anagrafica</h2>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><label for="nome">Nome</label></th>
                <td colspan="5"><input name="nome" type="text" id="nome" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="datanas">Data di nascita</label></th>
                <td><input name="datanas" type="date" id="datanas" /></td>
                <th scope="row"><label for="comunenas">Luogo di nascita</label></th>
                <td colspan="3"><input name="comunenas" type="text" id="comunenas" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="indirizzo">Indirizzo</label></th>
                <td><input name="indirizzo" type="text" id="indirizzo" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="cap">CAP</label></th>
                <td><input name="cap" type="number" id="cap" /></td>
                <th scope="row"><label for="loc">Località</label></th>
                <td><input name="loc" type="text" id="loc" /></td>
                <th scope="row"><label for="prov">Provincia</label></th>
                <td><input name="prov" type="text" id="prov" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="tel">Telefono</label></th>
                <td><input name="tel" type="number" id="tel" /></td>
                <th scope="row"><label for="cell">Cellulare</label></th>
                <td><input name="cell" type="number" id="cell" /></td>
            </tr>
        </tbody>
    </table>



</form>

<?php

function ATC_save_ana()
{
    global $wpdb;
    $table_name = $wpdb->prefix.'atc-anagrafica';
    $wpdb->insert($table_name, $data, $format);
}
