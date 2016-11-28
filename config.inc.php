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
/*
 * Helper Functions
 */
function getRelativePath () {
    
    $root_dir = array_pop(array_unique(explode('/', str_replace(['/', '\\'], '/', ROOT))));
        
    $curr_script_dir   = dirname(str_replace(['/', '\\'], '/', $_SERVER['SCRIPT_NAME']));
    $relativePath_file = explode($root_dir, $curr_script_dir);
    $slashes           = explode('/', array_pop($relativePath_file));
        
    $relativePath_dir = '';

    for ($i = 0; $i < count($slashes) - 1; $i++) {
        $relativePath_dir .= DIRECTORY_SEPARATOR . '..';
    }
    
    return $relativePath_dir;
}

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

// ROOT Ordner der Seite. Muss angepasst werden.
const ROOT = 'http://localhost/php_kurs/filmwebsite/phpmySQLI_filmwebseite_neu/';

/*
 *  Seiten und Ordner absolut von Root an
 */
define('PATH_DIR_ROOT'    , '.' . getRelativePath() . DIRECTORY_SEPARATOR); // muss angepasst werden.

const PATH_DIR_IMAGE      = PATH_DIR_ROOT . 'bilder' . DIRECTORY_SEPARATOR;
const PATH_FILE_MAIN      = PATH_DIR_ROOT . 'index.php';

const PATH_DIR_ADMIN      = PATH_DIR_ROOT  . 'admin' . DIRECTORY_SEPARATOR;
const PATH_FILE_DASHBOARD = PATH_DIR_ADMIN . 'index.php';
const PATH_FILE_LOGOUT    = PATH_DIR_ADMIN . 'logout.php';


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
