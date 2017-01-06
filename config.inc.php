<?php

# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Configurationsdatei
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 23.11.2016
# Version: Basisversion für Schulungszwecke

/*
 * Helper Functions
 */

/**
 * 
 * @param  string $URL
 * @return string
 */
function extractLastPart($URL) {
  
  // Spalte den Pfad in seine Bestandteile auf
  $path_parts = array_unique(explode('/', $URL));
  
  // Lösche Leere Einträge
  $path_parts = array_diff($path_parts, array(''));

  // extrahiere das letzte Teil
  $dir = array_pop($path_parts);

  return $dir;
}

/**
 * Gleiche die arten der Trennzeichen des Pfades an
 * 
 * @param  string $dir Die URL, die angeglichen werden soll
 * @return string Die angeglichene URL
 */
function levelingDirSeperators($dir) {
  return str_replace('\\', '/', $dir);
}

/**
 * Ermittelt den Relativen Pfad zu der aktuellen 
 * 
 * @param  string $current_url
 * @return string Der Relative Pfad vom Root zur aktuellen Datei
 */
function calcRelativeDirPath ($current_url, $root) {
  
  // gleiche bei den Beiden Pfade die Trennzeichen an 
  $curr_dir_leveled = levelingDirSeperators($current_url);
  $root_dir_leveled = levelingDirSeperators($root);
  
  $curr_dir     = dirname($curr_dir_leveled);
  $root_dir_end = extractLastPart($root_dir_leveled);
    
  // Teile den Aktuellen Pfad an dem Ende des Root Pfades
  $path_parts = explode($root_dir_end, $curr_dir);
  
  // Der relative Pfad ist der letzte Teil
  $rel_path = array_pop($path_parts);
    
  return $rel_path;
}

/**
 * Ermittelt den relativen Pfad zum Root Verzeichneis der aktuellen url aus.
 * 
 * @param  string $current_url Die aktuelle URL
 * @return string Der Relative Pfad zum Root Verzeichnis
 */
function calcRelativeRootPath($current_url, $root) {
    
  // Ermittle den Relativen Pfad zu der Aktuellen Datei
  $rel_path = calcRelativeDirPath($current_url, $root);
  
  // Teile den Pfad in seine Ordner
  $rel_backPath_parts = explode('/', $rel_path);
  
  // entferne die Leeren Einträge
  $rel_path_dirs_cleaned = array_diff($rel_backPath_parts, array(''));

  // Ersetze jeden Eintrag durch \..
  $rel_backPath_parts = array_map(
    function ($e) { return DIRECTORY_SEPARATOR . '..'; },
    $rel_path_dirs_cleaned);
  
  // implodiere das array um den Pfad, zurück zum root zu erhalten
  $rel_backPath = implode('', $rel_backPath_parts);

  return $rel_backPath;
}

/*
 * Fehler-Anzeigelevel Einstellungen.
 */
error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL);

/*
 *  Angaben zur Datenbankverbindung
 */
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_BASE = "filmwebsite";

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
const NAME_DIR_HELPERS       = 'helpers';
  

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

// Default
const NAME_FILE_DEFAULT_IMAGE  = 'default.jpg';

/*
 * Pfade
 * 
 * Prefix:
 *  PATH_DIR  ('falls es ein Ordner ist')
 *  PATH_FILE ('falls es eine Datei ist')
 */

// ROOT Ordner der Seite. Muss angepasst werden.
//const ROOT = 'http://localhost/Cimdata_dozent/PHP_MySQL_I/_Material/cimdata-php-filmwebseite/';
const ROOT = 'filmwebseite/';

/*
 *  Seiten und Ordner absolut von Root an
 */
define('PATH_DIR_ROOT'         , '.' . calcRelativeRootPath($_SERVER['SCRIPT_NAME'], ROOT) . DIRECTORY_SEPARATOR); 
      
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

// Default
const PATH_DIR_DEFAULT_IMAGE   = PATH_DIR_IMAGE        . NAME_FILE_DEFAULT_IMAGE; 


/*
 * Größen
 * (maximalgrößen für überprüfungen und Meldungen)
 */
const SIZE_MAX_IMAGE = 50000; //kb

include_once PATH_DIR_ROOT . 'incl/config/text_icons_de.php';