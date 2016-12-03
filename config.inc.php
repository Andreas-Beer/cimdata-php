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
    
    // Besser unterteilen.
  
    $root_dir = array_unique(explode('/', str_replace(['/', '\\'], '/', ROOT)));
    $root_dir = array_pop($root_dir);
        
    $curr_script_dir   = dirname(str_replace(['/', '\\'], '/', $_SERVER['SCRIPT_NAME']));
    $relativePath_file = explode($root_dir, $curr_script_dir);
    $slashes           = explode('/', array_pop($relativePath_file));
          
    $relativePath_dir = '';

    for ($i = 0; $i < count($slashes) - 1; $i++) {
        $relativePath_dir .= DIRECTORY_SEPARATOR . '..';
    }
    
    return $relativePath_dir;
}


# PHP-Warnungen und Fehler ausblenden
error_reporting(0);
# PHP-Notizen ausblenden
error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_NOTICE);


/*
 * Login Konfiguration
 */
const LOGIN_PASS_SALT = 'sods/&$)?-=su3d2nso"§?';

/*
 * Ordner und Dateibenennung
 */

/* Ordner */
const NAME_DIR_INCLUDE       = 'incl';
const NAME_DIR_IMAGES        = 'bilder';
const NAME_DIR_ADMIN         = 'admin';
const NAME_DIR_STYLES        = 'css';
const NAME_DIR_FONTS         = 'fonts';
const NAME_DIR_JS            = 'js'; 
const NAME_DIR_DATABASE      = 'db';
const NAME_DIR_HELPERS       = 'hilfsdateien';
  

/* dateien */    

// css
const NAME_FILE_STYLE_MAIN     = 'main.css';
  
// js  
const NAME_FILE_JS_BOOTSTRAP   = 'bootstrap.min.js';
const NAME_FILE_JS_JQUERY      = 'jquery-1.12.4.min.js';
     
// php  
const NAME_FILE_MAIN           = 'index.php';
const NAME_FILE_DASHBOARD      = 'dashboard.php';
const NAME_FILE_LOGOUT         = 'logout.php';
const NAME_FILE_LOGINVARIFY    = 'test_login.inc.php';
const NAME_FILE_FILMEDIT       = 'filmform.php';
const NAME_FILE_FILMIMAGE      = 'filmimage.php';
const NAME_FILE_FILMDELETE     = 'filmdelete.php';
       
// include       
const NAME_FILE_FOOTER         = 'footer.inc.php';
const NAME_FILE_ADMINBAR       = 'adminbar.inc.php';
const NAME_FILE_GENRE          = 'genre.inc.php';
const NAME_FILE_COMPANY        = 'company.inc.php';
const NAME_FILE_FILM_MAIN      = 'film.inc.php';
const NAME_FILE_FILM_DASHBOARD = 'film_dashboard.incl.php';
     
// hilfsdateien     
const NAME_FILE_DBCONNECT      = 'dbconn.incl.php';
const NAME_FILE_FUNCTIONS      = 'functions.inc.php';

/*
 * Pfade
 * 
 * Prefix:
 *  PATH_DIR  ('falls es ein Ordner ist')
 *  PATH_FILE ('falls es eine Datei ist')
 */

// ROOT Ordner der Seite. Muss angepasst werden.
const ROOT = 'http://localhost/Cimdata_dozent/PHP_MySQL_I/_Material/cimdata-php-filmwebseite/';

/*
 *  Seiten und Ordner absolut von Root an
 */
define('PATH_DIR_ROOT'         , '.' . getRelativePath() . DIRECTORY_SEPARATOR); 
      
/* Ordner */      
const PATH_DIR_ADMIN           = PATH_DIR_ROOT  . NAME_DIR_ADMIN    . DIRECTORY_SEPARATOR; 
const PATH_DIR_ADMIN_INCL      = PATH_DIR_ADMIN . NAME_DIR_INCLUDE  . DIRECTORY_SEPARATOR; 
          
const PATH_DIR_INCL            = PATH_DIR_ROOT  . NAME_DIR_INCLUDE  . DIRECTORY_SEPARATOR;
const PATH_DIR_INCL_DB         = PATH_DIR_INCL  . NAME_DIR_DATABASE . DIRECTORY_SEPARATOR;
const PATH_DIR_INCL_HELPERS    = PATH_DIR_INCL  . NAME_DIR_HELPERS  . DIRECTORY_SEPARATOR;
  
const PATH_DIR_IMAGE           = PATH_DIR_ROOT  . NAME_DIR_IMAGES   . DIRECTORY_SEPARATOR; 
const PATH_DIR_STYLES          = PATH_DIR_ROOT  . NAME_DIR_STYLES   . DIRECTORY_SEPARATOR; 
const PATH_DIR_JS              = PATH_DIR_ROOT  . NAME_DIR_JS       . DIRECTORY_SEPARATOR; 
        
/* Dateien */    
// style    
const PATH_FILE_STYLE_MAIN     = PATH_DIR_STYLES       . NAME_FILE_STYLE_MAIN;
        
// js        
const PATH_FILE_JS_BOOTSTRAP   = PATH_DIR_JS           . NAME_FILE_JS_BOOTSTRAP;
const PATH_FILE_JS_JQUERY      = PATH_DIR_JS           . NAME_FILE_JS_JQUERY;
        
// php        
const PATH_FILE_MAIN           = PATH_DIR_ROOT         . NAME_FILE_MAIN;   
const PATH_FILE_DASHBOARD      = PATH_DIR_ADMIN        . NAME_FILE_DASHBOARD;
const PATH_FILE_LOGOUT         = PATH_DIR_ADMIN        . NAME_FILE_LOGOUT;
const PATH_FILE_FILMEDIT       = PATH_DIR_ADMIN        . NAME_FILE_FILMEDIT;
const PATH_FILE_FILMIMAGE      = PATH_DIR_ADMIN        . NAME_FILE_FILMIMAGE;
const PATH_FILE_FILMDELETE     = PATH_DIR_ADMIN        . NAME_FILE_FILMDELETE;
        
// Includs        
const PATH_FILE_ADMINBAR       = PATH_DIR_ADMIN_INCL   . NAME_FILE_ADMINBAR;
const PATH_FILE_LOGINVERIFY    = PATH_DIR_ADMIN_INCL   . NAME_FILE_LOGINVARIFY;
const PATH_FILE_FILM_DASHBOARD = PATH_DIR_ADMIN_INCL   . NAME_FILE_FILM_DASHBOARD;
const PATH_FILE_FOOTER         = PATH_DIR_INCL         . NAME_FILE_FOOTER;
const PATH_FILE_FILM_MAIN      = PATH_DIR_INCL         . NAME_FILE_FILM_MAIN;
const PATH_FILE_GENRE          = PATH_DIR_INCL         . NAME_FILE_GENRE;
const PATH_FILE_COMPANY        = PATH_DIR_INCL         . NAME_FILE_COMPANY;
           
// Hilfsdateien           
const PATH_FILE_DBCONNECT      = PATH_DIR_INCL_DB      . NAME_FILE_DBCONNECT;
const PATH_FILE_FUNCTIONS      = PATH_DIR_INCL_HELPERS . NAME_FILE_FUNCTIONS;


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
 * Fehlermeldungen für das Film Formular
 */
const MSG_FILMFORM_MISSING_COMPANY    = 'Bitte eine Filmgesellschaft auswählen.';
const MSG_FILMFORM_MISSING_GENRE      = 'Bitte ein Filmgenre auswählen.';
const MSG_FILMFORM_MISSING_TITLE      = 'Bitte einen Filmtitel angeben.';
const MSG_FILMFORM_MISSING_DATE       = 'Bitte ein Erscheinungsdatum angeben.';
const MSG_FILMFORM_WRONG_DATE         = 'Bitte ein korrektes Erscheinungsdatum angeben.';

/*
 * Fehlermeldungen für den Image upload
 */
define('MSG_IMAGEUPLOAD_ERR_INI_SIZE' , 'Die Hochgeladene Datei war zu Groß (SERVER). es sind maximal ' . ini_get('upload_max_filesize') . ' bytes erlaubt.');
const MSG_IMAGEUPLOAD_ERR_FORM_SIZE   = 'Die Hochgeladene Datei war zu Groß (HTML). es sind maximal ' . SIZE_MAX_IMAGE . ' bytes erlaubt.';
const MSG_IMAGEUPLOAD_ERR_PARTIAL     = 'Die Datei wurde Leider nur Teilweise Hochgeladen!';
const MSG_IMAGEUPLOAD_ERR_NO_FILE     = 'Es wurde keine Datei ausgewählt';
const MSG_IMAGEUPLOAD_ERR_CANT_WRITE  = 'Die Datei konnt nicht gespeichert werden.';
const MSG_IMAGEUPLOAD_ERR_EXTENSION   = 'Die Datei hatte den falschen Typ';
const MSG_IMAGEUPLOAD_ERR_UNDOC       = 'Ein unbekannter Fehler ist aufgetreten';

/*
 * Text z.B. auf Buttons und Überschriften.
 * 
 * Schema:
 * TEXT_<Seite>_<Elementtyp>_<Elementbezeichung>[_<Elementeigenschaft>]
 */

// Global
const TEXT_GLOBAL_GUI_CURRENCY             = '€';
const TEXT_GLOBAL_GUI_REQUIRED             = '* ';
  
// Main  
const TEXT_MAIN_GUI_HEADLINE_DEFAULT       = 'Die 10 neusten Filme';
const TEXT_MAIN_GUI_HEADLINE_COMPANY       = 'Filme der Filmgesellschaft: %s';
const TEXT_MAIN_GUI_HEADLINE_GENRE         = 'Filme des Genres: %s';
const TEXT_MAIN_GUI_FILM_PRICE             = 'Preis: %s&nbsp;' . TEXT_GLOBAL_GUI_CURRENCY;
const TEXT_MAIN_GUI_SEARCH_PLACEHOLDER     = 'Suchen&hellip;';
const TEXT_MAIN_GUI_MSG_FILMFOUND          = '%d Filme Gefunden';
  
// Adminbar  
const TEXT_ADMINBAR_GUI_HEADLINE           = 'Adminbar';
const TEXT_ADMINBAR_BUTTON_TODASHBOARD     = 'Dashboard';
const TEXT_ADMINBAR_BUTTON_TOMAIN          = 'Zur Webseite';
const TEXT_ADMINBAR_BUTTON_LOGOUT          = 'Logout';
  
// Daschboard  
const TEXT_DASHBOARD_GUI_HEADLINE          = 'Alle Filme';
const TEXT_DASHBOARD_GUI_THEAD_TITLE       = 'Titel';
const TEXT_DASHBOARD_GUI_THEAD_GENRE       = 'Genre';
const TEXT_DASHBOARD_GUI_THEAD_COMPANY     = 'Filmgesellschaft';
const TEXT_DASHBOARD_GUI_THEAD_PRICE       = 'Preis' . ' ' . TEXT_GLOBAL_GUI_CURRENCY;
const TEXT_DASHBOARD_GUI_THEAD_VISIBLE     = 'Sichtbar';
const TEXT_DASHBOARD_GUI_THEAD_IMAGE       = 'Bild';
const TEXT_DASHBOARD_BUTTON_FILM_NEW       = 'Film hinzufügen';
const TEXT_DASHBOARD_BUTTON_FILM_EDIT      = 'Bearbeiten';
const TEXT_DASHBOARD_BUTTON_IMAGE_NEW      = 'NEU';
const TEXT_DASHBOARD_BUTTON_IMAGE_EDIT     = 'Bearbeiten';
const TEXT_DASHBOARD_BUTTON_DELETE_FILM    = 'Löschen';
  
// FilmEdit  
const TEXT_FILMEDIT_GUI_HEADLINE_NEW       = 'Neuen Film Anlegen';
const TEXT_FILMEDIT_GUI_HEADLINE_UPDATE    = 'Filmtitel bearbeiten<br><small>%s</small>';
const TEXT_FILMEDIT_GUI_DROPDOWN_DEFAULT   = 'Bitte Auswählen';
const TEXT_FILMEDIT_GUI_COMPANIES          = TEXT_GLOBAL_GUI_REQUIRED . 'Filmgesellschaften';
const TEXT_FILMEDIT_GUI_GENRES             = TEXT_GLOBAL_GUI_REQUIRED . 'Genres';
const TEXT_FILMEDIT_GUI_TITLE              = TEXT_GLOBAL_GUI_REQUIRED . 'Filmtitel';
const TEXT_FILMEDIT_GUI_DATE               = TEXT_GLOBAL_GUI_REQUIRED . 'Erscheinungsdatum';
const TEXT_FILMEDIT_GUI_DESCRIPTION        = 'Beschreibung';
const TEXT_FILMEDIT_GUI_DURATION           = 'Dauer';
const TEXT_FILMEDIT_GUI_PRICE              = 'Preis';
const TEXT_FILMEDIT_GUI_IMAGE              = 'Bild';
const TEXT_FILMEDIT_GUI_VISIBILITY         = 'Freigegeben (Für die Kunden sichtbar)';
const TEXT_FILMEDIT_BUTTON_SAVE            = 'Speichern';
const TEXT_FILMEDIT_BUTTON_CANCEL          = 'Abbrechen';
const TEXT_FILMEDIT_BUTTON_UPDATE          = 'Aktualisieren';

// ImageEdit
const TEXT_IMAGEEDIT_GUI_HEADLINE          = 'Bild bearbeiten';