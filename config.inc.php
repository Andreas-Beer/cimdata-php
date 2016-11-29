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
/*
 * Login Konfiguration
 */
const LOGIN_PASS_SALT = 'sods/&$)?-=su3d2nso"§?';

/*
 * Ordner und Dateibenennung
 */

/* Ordner */
const NAME_DIR_INCLUDE       = 'inc';
const NAME_DIR_IMAGES        = 'bilder';
const NAME_DIR_ADMIN         = 'admin';
const NAME_DIR_STYLES        = 'css';
const NAME_DIR_FONTS         = 'fonts';
const NAME_DIR_JS            = 'js'; 
  

/* dateien */    

// css
const NAME_FILE_STYLE_MAIN   = 'main.css';

// js
const NAME_FILE_JS_BOOTSTRAP = 'bootstrap.min.js';
const NAME_FILE_JS_JQUERY    = 'jquery-1.12.4.min.js';
   
// php
const NAME_FILE_MAIN         = 'index.php';
const NAME_FILE_DASHBOARD    = 'dashboard.php';
const NAME_FILE_LOGOUT       = 'logout.php';
const NAME_FILE_FILMEDIT     = 'filmform.php';
const NAME_FILE_FILMIMAGE    = 'filmimage.php';
const NAME_FILE_LOGINVARIFY  = 'test_login.inc.php';
     
// include     
const NAME_FILE_FOOTER       = 'footer.inc.php';
const NAME_FILE_HEADER       = 'header.inc.php';
const NAME_FILE_ADMINBAR     = 'adminbar.inc.php';
const NAME_FILE_FILM         = 'film.inc.php';
const NAME_FILE_COMPANY      = 'company.inc.php';
     
// hilfsdateien     
const NAME_FILE_DBCONNECT    = 'dbconn.php';
const NAME_FILE_FUNCTIONS    = 'functions.inc.php';

/*
 * Pfade
 * 
 * Prefix:
 *  PATH_DIR  ('falls es ein Ordner ist')
 *  PATH_FILE ('falls es eine Datei ist')
 */

// ROOT Ordner der Seite. Muss angepasst werden.
const ROOT = 'http://localhost/php_kurs/filmwebsite/phpmySQLI_filmwebseite_neu/';

/*
 *  Seiten und Ordner absolut von Root an
 */
define('PATH_DIR_ROOT'           , '.' . getRelativePath() . DIRECTORY_SEPARATOR); // muss angepasst werden.
   
/* Ordner */   
const PATH_DIR_ADMIN             = PATH_DIR_ROOT  . NAME_DIR_ADMIN   . DIRECTORY_SEPARATOR;
const PATH_DIR_INCL_ADMIN        = PATH_DIR_ADMIN . NAME_DIR_INCLUDE . DIRECTORY_SEPARATOR;
       
const PATH_DIR_INCL              = PATH_DIR_ROOT  . NAME_DIR_INCLUDE . DIRECTORY_SEPARATOR;
const PATH_DIR_IMAGE             = PATH_DIR_ROOT  . NAME_DIR_IMAGES  . DIRECTORY_SEPARATOR;
const PATH_DIR_STYLES            = PATH_DIR_ROOT  . NAME_DIR_STYLES  . DIRECTORY_SEPARATOR;
const PATH_DIR_JS                = PATH_DIR_ROOT  . NAME_DIR_JS      . DIRECTORY_SEPARATOR;
       
/* Dateien */   
// style   
const PATH_FILE_STYLE_MAIN       = PATH_DIR_STYLES . NAME_FILE_STYLE_MAIN;
   
// js   
const PATH_FILE_JS_BOOTSTRAP     = PATH_DIR_JS . NAME_FILE_JS_BOOTSTRAP;
const PATH_FILE_JS_JQUERY        = PATH_DIR_JS . NAME_FILE_JS_JQUERY;
   
// php   
const PATH_FILE_MAIN             = PATH_DIR_ROOT  . NAME_FILE_MAIN;   
const PATH_FILE_DASHBOARD        = PATH_DIR_ADMIN . NAME_FILE_DASHBOARD;
const PATH_FILE_LOGOUT           = PATH_DIR_ADMIN . NAME_FILE_LOGOUT;
const PATH_FILE_FILMEDIT         = PATH_DIR_ADMIN . NAME_FILE_FILMEDIT;
const PATH_FILE_FILMIMAGE        = PATH_DIR_ADMIN . NAME_FILE_FILMIMAGE;
   
// Includs   
const PATH_FILE_INCL_ADMINBAR    = PATH_DIR_INCL_ADMIN . NAME_FILE_ADMINBAR;
const PATH_FILE_INCL_LOGINVERIFY = PATH_DIR_INCL_ADMIN . NAME_FILE_LOGINVARIFY;
const PATH_FILE_INCL_FOOTER      = PATH_DIR_INCL . NAME_FILE_FOOTER;
const PATH_FILE_INCL_HEADER      = PATH_DIR_INCL . NAME_FILE_HEADER;
const PATH_FILE_INCL_FILM        = PATH_DIR_INCL . NAME_FILE_FILM;
const PATH_FILE_INCL_COMPANY     = PATH_DIR_INCL . NAME_FILE_COMPANY;

// Hilfsdateien
const PATH_FILE_INCL_DBCONNECT   = PATH_DIR_INCL . NAME_FILE_DBCONNECT;
const PATH_FILE_INCL_FUNCTIONS   = PATH_DIR_INCL . NAME_FILE_FUNCTIONS;


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
