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
 * Größen
 * (maximalgrößen für überprüfungen und Meldungen)
 */
const SIZE_MAX_IMAGE = '500';

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

/*
 * Fehlermeldungen für das Film Formular
 */
const MSG_FILMFORM_MISSING_COMPANY = 'Bitte eine Filmgesellschaft auswählen.';
const MSG_FILMFORM_MISSING_GENRE   = 'Bitte ein Filmgenre auswählen.';
const MSG_FILMFORM_MISSING_TITLE   = 'Bitte einen Filmtitel angeben.';
const MSG_FILMFORM_MISSING_DATE    = 'Bitte ein Erscheinungsdatum angeben.';
const MSG_FILMFORM_WRONG_DATE      = 'Bitte ein korrektes Erscheinungsdatum angeben.';

/*
 * Fehlermeldungen für den Image upload
 */
const MSG_IMAGEUPLOAD_SIZE = 'Das Bild war leider zu groß. es sind maximal' . SIZE_MAX_IMAGE . 'bytes erlaubt.';
