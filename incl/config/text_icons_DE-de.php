<?php
/**
 * Konstanten für die Texte und Icons
 *
 * PHP version 5.6
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @author     Andreas Beer <andreasbeer@gmx.com>
 * @author     Andreas 
 * @copyright  2016 Andreas Beer
 * @version    1.0.0
 */

/**
 * FUNCTIONS
 */

// Polyfill für mb_ucfirst
if (!function_exists('mb_ucfirst')) {

  function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
    $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
    $str_end      = "";
    if ($lower_str_end) {
      $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
    } else {
      $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }
    $str = $first_letter . $str_end;
    return $str;
  }

}

function formInput_markAsRequired ($name) {
  return TEXT_GLOBAL_ICON_REQUIRED . ' ' . $name;
}

/*
 * Global
 * 
 * Schema
 * TEXT_GLOBAL_<art_des_Gebrauchs>_<gramatikalische_wortart>_<name>_<numerus>
 * 
 * <art_des_Gebrauchs>
 *  ICON  als kleines Symbol. Innerhalb oder statt text.
 *  GUI   als Wort im Grafischen Interface-
 * 
 * <gramatikalische_wortart> (Zur hilfe für übersetzung)
 *  N     Substantiv (noun)
 *  V     Verb 
 *  A     Adjektiv
 *  P     Partikel
 * 
 * <numerus>
 *  SG    Suingular
 *  PL    Plural
 */

// Icons
const TEXT_GLOBAL_ICON_CURRENCY            = '€';
const TEXT_GLOBAL_ICON_REQUIRED            = '*';
const TEXT_GLOBAL_ICON_NO                  = '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
const TEXT_GLOBAL_ICON_YES                 = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
const TEXT_GLOBAL_ICON_SAVE                = '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>';
const TEXT_GLOBAL_ICON_ADD                 = '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
const TEXT_GLOBAL_ICON_EDIT                = '<i class="fa fa-pencil" aria-hidden="true"></i>';
const TEXT_GLOBAL_ICON_DELETE              = '<i class="fa fa-trash-o" aria-hidden="true"></i>';
const TEXT_GLOBAL_ICON_TIME                = '<i class="fa fa-clock-o" aria-hidden="true"></i>';
const TEXT_GLOBAL_ICON_CALENDAR            = '<i class="fa fa-calendar" aria-hidden="true"></i>';
const TEXT_GLOBAL_ICON_IMAGE               = '<i class="fa fa-file-image-o" aria-hidden="true"></i>';
const TEXT_GLOBAL_ICON_CANCEL              = TEXT_GLOBAL_ICON_NO;

// Text
const TEXT_GLOBAL_GUI_P_YES                = 'ja';
const TEXT_GLOBAL_GUI_P_NO                 = 'nein';
const TEXT_GLOBAL_GUI_P_ALL                = 'alle';
const TEXT_GLOBAL_GUI_N_IMAGE_SG           = 'bild';
const TEXT_GLOBAL_GUI_N_IMAGE_PL           = 'bilder';
const TEXT_GLOBAL_GUI_N_FILM_SG            = 'film';
const TEXT_GLOBAL_GUI_N_FILM_PL            = 'filme';
const TEXT_GLOBAL_GUI_N_COMPANY_SG         = 'filmgesellschaft';
const TEXT_GLOBAL_GUI_N_TITLE_SG           = 'titel';
const TEXT_GLOBAL_GUI_N_PUBLISHDATE_SG     = 'erscheinungsdatum';
const TEXT_GLOBAL_GUI_N_GENRE_SG           = 'genre';
const TEXT_GLOBAL_GUI_N_PRICE_SG           = 'preis';
const TEXT_GLOBAL_GUI_N_DURATION           = 'dauer';
const TEXT_GLOBAL_GUI_N_DESCRIPTION_SG     = 'beschreibung';
const TEXT_GLOBAL_GUI_A_PUBLIC             = 'sichtbar';
const TEXT_GLOBAL_GUI_V_SEARCH             = 'suchen';
const TEXT_GLOBAL_GUI_V_SAVE               = 'speichern';
const TEXT_GLOBAL_GUI_V_CANCEL             = 'abbrechen';
const TEXT_GLOBAL_GUI_V_UPDATE             = 'aktualisieren';
const TEXT_GLOBAL_GUI_V_ADD                = 'hinzufügen';
const TEXT_GLOBAL_GUI_V_CHANGE             = 'ändren';
const TEXT_GLOBAL_GUI_V_EDIT               = 'bearbeiten';
const TEXT_GLOBAL_GUI_V_DELETE             = 'löschen';

/*
 * Meldungen
 * 
 * Schema:
 *  MSG_<seite>_<meldungs_art>_<meldungs_unterart> ('für alle Meldungen')
 */

// Film Formular
const MSG_FILMFORM_ERR_MISSING_COMPANY     = 'Bitte eine Filmgesellschaft auswählen.';
const MSG_FILMFORM_ERR_MISSING_GENRE       = 'Bitte ein Filmgenre auswählen.';
const MSG_FILMFORM_ERR_MISSING_TITLE       = 'Bitte einen Filmtitel angeben.';
const MSG_FILMFORM_ERR_MISSING_DATE        = 'Bitte ein Erscheinungsdatum angeben.';
const MSG_FILMFORM_ERR_WRONG_DATE          = 'Bitte ein korrektes Erscheinungsdatum angeben.';

 // Image upload
define('MSG_IMAGEUPLOAD_ERR_TOBIG_INI'      , 'Die Hochgeladene Datei war zu Groß (SERVER). es sind maximal ' . ini_get('upload_max_filesize') . ' bytes erlaubt.');  
const MSG_IMAGEUPLOAD_ERR_TOBIG_FORM       = 'Die Hochgeladene Datei war zu Groß (HTML). es sind maximal ' . SIZE_MAX_IMAGE . ' bytes erlaubt.';
const MSG_IMAGEUPLOAD_ERR_PARTIAL          = 'Die Datei wurde Leider nur Teilweise Hochgeladen!';
const MSG_IMAGEUPLOAD_ERR_MISSING_FILE     = 'Es wurde keine Datei ausgewählt';
const MSG_IMAGEUPLOAD_ERR_RESTRICT_WRITE   = 'Die Datei konnt nicht gespeichert werden.';
const MSG_IMAGEUPLOAD_ERR_WRONG_EXTENSION  = 'Die Datei hatte den falschen Typ';
const MSG_IMAGEUPLOAD_ERR_OTHER            = 'Ein unbekannter Fehler ist aufgetreten';

/*
 * TEXT & ICONS
 * z.B. auf Buttons und Überschriften.
 * 
 * Schema:
 * TEXT_<Seite>_<Elementtyp>_<Elementbezeichung>[_<Elementeigenschaft>]
 */
  
// Main  
define('TEXT_MAIN_GUI_HEADLINE_COMPANY'    , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_PL) . ' der ' . mb_ucfirst(TEXT_GLOBAL_GUI_N_COMPANY_SG) . ': %s');
define('TEXT_MAIN_GUI_SEARCH_PLACEHOLDER'  , mb_ucfirst(TEXT_GLOBAL_GUI_V_SEARCH) . '&hellip;');
const TEXT_MAIN_GUI_HEADLINE_DEFAULT       = 'Die 10 neusten Filme';
define('TEXT_MAIN_GUI_HEADLINE_GENRE'      , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_PL) . ' des ' . mb_ucfirst(TEXT_GLOBAL_GUI_N_GENRE_SG) . 's : %s');
define('TEXT_MAIN_GUI_FILM_PRICE'          , mb_ucfirst(TEXT_GLOBAL_GUI_N_PRICE_SG) . ': %s&nbsp;' . TEXT_GLOBAL_ICON_CURRENCY);
const TEXT_MAIN_GUI_MSG_FILMFOUND          = '%d Filme Gefunden';
  
// Adminbar  
const TEXT_ADMINBAR_GUI_HEADLINE           = 'Adminbar';
const TEXT_ADMINBAR_BUTTON_TODASHBOARD     = 'Dashboard';
const TEXT_ADMINBAR_BUTTON_TOMAIN          = 'Zur Webseite';
const TEXT_ADMINBAR_BUTTON_LOGOUT          = 'Logout';
  
// Daschboard  
define('TEXT_DASHBOARD_GUI_HEADLINE'       , mb_ucfirst(TEXT_GLOBAL_GUI_P_ALL) . ' ' . ucfirst(TEXT_GLOBAL_GUI_N_FILM_PL));
define('TEXT_DASHBOARD_GUI_THEAD_TITLE'    , mb_ucfirst(TEXT_GLOBAL_GUI_N_TITLE_SG));
define('TEXT_DASHBOARD_GUI_THEAD_GENRE'    , mb_ucfirst(TEXT_GLOBAL_GUI_N_GENRE_SG));
define('TEXT_DASHBOARD_GUI_THEAD_COMPANY'  , mb_ucfirst(TEXT_GLOBAL_GUI_N_COMPANY_SG));
define('TEXT_DASHBOARD_GUI_THEAD_PRICE'    , mb_ucfirst(TEXT_GLOBAL_GUI_N_PRICE_SG) . ' ' . TEXT_GLOBAL_ICON_CURRENCY);
define('TEXT_DASHBOARD_GUI_THEAD_VISIBLE'  , mb_ucfirst(TEXT_GLOBAL_GUI_A_PUBLIC));
define('TEXT_DASHBOARD_GUI_THEAD_IMAGE'    , mb_ucfirst(TEXT_GLOBAL_GUI_N_IMAGE_SG));
define('TEXT_DASHBOARD_BUTTON_FILM_NEW'    , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_SG) . ' ' . TEXT_GLOBAL_GUI_V_ADD);
define('TEXT_DASHBOARD_BUTTON_FILM_EDIT'   , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_SG) . ' ' . TEXT_GLOBAL_GUI_V_EDIT);
define('TEXT_DASHBOARD_BUTTON_IMAGE_NEW'   , mb_ucfirst(TEXT_GLOBAL_GUI_V_ADD));
define('TEXT_DASHBOARD_BUTTON_IMAGE_EDIT'  , mb_ucfirst(TEXT_GLOBAL_GUI_V_CHANGE));
define('TEXT_DASHBOARD_BUTTON_DELETE_FILM' , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_SG) . ' ' . TEXT_GLOBAL_GUI_V_DELETE);
  
// FilmEdit  
const TEXT_FIMLEDIT_ICON_DURATION          = TEXT_GLOBAL_ICON_TIME;
const TEXT_FILMEDIT_ICON_DATE              = TEXT_GLOBAL_ICON_CALENDAR;
const TEXT_FILMEDIT_ICON_IMAGE             = TEXT_GLOBAL_ICON_IMAGE;
const TEXT_FILMEDIT_ICON_CURRENCY          = TEXT_GLOBAL_ICON_CURRENCY;

const TEXT_FILMEDIT_GUI_HEADLINE_UPDATE    = 'Film bearbeiten<br><small>%s</small>';
const TEXT_FILMEDIT_GUI_DROPDOWN_DEFAULT   = 'Bitte Auswählen';
const TEXT_FILMEDIT_GUI_VISIBILITY         = 'Freigegeben (Für die Kunden sichtbar)';
define('TEXT_FILMEDIT_GUI_HEADLINE_NEW'    , 'Neuen ' . mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_SG) . ' ' .  TEXT_GLOBAL_GUI_V_ADD);
define('TEXT_FILMEDIT_GUI_COMPANIES'       , formInput_markAsRequired(mb_ucfirst(TEXT_GLOBAL_GUI_N_COMPANY_SG)));
define('TEXT_FILMEDIT_GUI_GENRES'          , formInput_markAsRequired(mb_ucfirst(TEXT_GLOBAL_GUI_N_GENRE_SG)));
define('TEXT_FILMEDIT_GUI_TITLE'           , formInput_markAsRequired(mb_ucfirst(TEXT_GLOBAL_GUI_N_TITLE_SG)));
define('TEXT_FILMEDIT_GUI_DATE'            , formInput_markAsRequired(mb_ucfirst(TEXT_GLOBAL_GUI_N_PUBLISHDATE_SG)));
define('TEXT_FILMEDIT_GUI_DESCRIPTION'     , mb_ucfirst(TEXT_GLOBAL_GUI_N_DESCRIPTION_SG));
define('TEXT_FILMEDIT_GUI_DURATION'        , mb_ucfirst(TEXT_GLOBAL_GUI_N_DURATION));
define('TEXT_FILMEDIT_GUI_PRICE'           , mb_ucfirst(TEXT_GLOBAL_GUI_N_PRICE_SG));
define('TEXT_FILMEDIT_GUI_IMAGE'           , mb_ucfirst(TEXT_GLOBAL_GUI_N_IMAGE_SG));
define('TEXT_FILMEDIT_BUTTON_SAVE'         , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_SG) . ' ' . TEXT_GLOBAL_GUI_V_SAVE);
define('TEXT_FILMEDIT_BUTTON_CANCEL'       , mb_ucfirst(TEXT_GLOBAL_GUI_V_CANCEL));
define('TEXT_FILMEDIT_BUTTON_UPDATE'       , mb_ucfirst(TEXT_GLOBAL_GUI_N_FILM_SG) . ' ' . TEXT_GLOBAL_GUI_V_UPDATE);

// ImageEdit
define('TEXT_IMAGEEDIT_GUI_HEADLINE'       , mb_ucfirst(TEXT_GLOBAL_GUI_N_IMAGE_SG) . ' ' . TEXT_GLOBAL_GUI_V_EDIT);
define('TEXT_IMAGEEDIT_BUTTON_SAVE'        , TEXT_GLOBAL_ICON_SAVE . mb_ucfirst(TEXT_GLOBAL_GUI_N_IMAGE_SG) . ' ' . TEXT_GLOBAL_GUI_V_SAVE);
define('TEXT_IMAGEEDIT_BUTTON_CANCEL'      , TEXT_GLOBAL_ICON_CANCEL . mb_ucfirst(TEXT_GLOBAL_GUI_V_CANCEL));