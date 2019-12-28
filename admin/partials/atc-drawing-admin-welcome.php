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

?>

<div id="welcome-panel" class="welcome-panel">
    <div class="welcome-panel-content">
        <h2>Benvenuto in Sorteggi ATC!</h2>
        <p class="about-description">Scegli l'azione che vuoi effettuare:</p>
        <div class="welcome-panel-column-container">
            <div class="welcome-panel-column">
                <h3>Come iniziare</h3>
                <a class="button button-primary button-hero"
                    href="<?=NS\PLUGIN_ADMIN_BASE_URL.'list-hunter'?>">Lista
                    cacciatori</a>
                <p>
                    oppure <a
                        href="<?=NS\PLUGIN_ADMIN_BASE_URL.'add-hunter'?>">Aggiungi
                        nuovo cacciatore</a> </p>
            </div>
            <div class="welcome-panel-column">
                <h3>Sorteggi</h3>
                <ul>
                    <li><a href="#" class="welcome-icon welcome-write-blog">Scrivi il tuo primo articolo</a></li>
                    <li><a href="#" class="welcome-icon welcome-add-page">Aggiungi una pagina info</a></li>
                    <li><a href="#" class="welcome-icon welcome-setup-home">Imposta la tua pagina principale</a></li>
                    <li><a href="#" class="welcome-icon welcome-view-site">Visualizza il tuo sito</a></li>
                </ul>
            </div>
            <div class="welcome-panel-column welcome-panel-last">
                <h3>Comunicazioni</h3>
                <ul>
                    <li><a href="#" class="welcome-icon welcome-widgets-menus">Gestione</a></li>
                    <li><a href="#" class="welcome-icon welcome-comments">Attiva o disattiva i commenti</a></li>
                    <li><a href="#" class="welcome-icon welcome-learn-more">Maggiori informazioni su come iniziare</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>