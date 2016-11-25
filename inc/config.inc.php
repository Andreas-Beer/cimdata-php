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
// Password Salt
const LOGIN_PASS_SALT = 'sods/&$)?-=su3d2nso"§?';


/*
 * Pfade
 * 
 * Prefix:
 *  PATH_DIR  ('falls es ein Ordner ist')
 *  PATH_FILE ('falls es eine Date ist')
 */
define('PATH_DIR_ROOT', __DIR__ . '/../' );
const PATH_DIR_IMAGE  = '../bilder/'; // TODO Relativ


/*
 * Größen
 * (maximalgrößen für überprüfungen und Meldungen)
 */
const SIZE_MAX_IMAGE = 50000; //kb


/*
 * Nachrichten / Meldungen
 * 
 * Prefix:
 *  MSG ('für alle Meldungen')
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
define('MSG_IMAGEUPLOAD_ERR_INI_SIZE', 'Die Hochgeladene Datei war zu Groß (SERVER). es sind maximal ' . ini_get('upload_max_filesize') . ' bytes erlaubt.');
const MSG_IMAGEUPLOAD_ERR_FORM_SIZE  = 'Die Hochgeladene Datei war zu Groß (HTML). es sind maximal ' . SIZE_MAX_IMAGE . ' bytes erlaubt.';
const MSG_IMAGEUPLOAD_ERR_PARTIAL    = 'Die Datei wurde Leider nur Teilweise Hochgeladen!';
const MSG_IMAGEUPLOAD_ERR_NO_FILE    = 'Es wurde keine Datei ausgewählt';
const MSG_IMAGEUPLOAD_ERR_CANT_WRITE = 'Die Datei konnt nicht gespeichert werden.';
const MSG_IMAGEUPLOAD_ERR_EXTENSION  = 'Die Datei hatte den falschen Typ';
const MSG_IMAGEUPLOAD_ERR_UNDOC      = 'Ein unbekannter Fehler ist aufgetreten';
