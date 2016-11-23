<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Configurationsdatei
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 23.11.2016
# Version: Basisversion für Schulungszwecke
?>

<?php

//echo '<pre style="text-align: left;">';
//var_dump(is_file(__DIR__ . '/../index.php'));
//echo '</pre>';

/*
 * Nachrichten / Meldungen
 * Prefix: MSG ('message')
 */

/*
 * TITLE (Die Versionen die der Titel annehmen kann.)
 */
const MSG_TITLE_DEFAULT = 'Die 10 neusten Filme';
const MSG_TITLE_COMPANY = 'Filme der Filmgesellschaft';
const MSG_TITLE_GENRE   = 'Filme des Genres';